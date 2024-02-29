<?php

namespace App\Http\Controllers\shift;

use Carbon\Carbon;
use App\Models\shift\Shift;
use Illuminate\Http\Request;
use App\Models\shift\ShiftItem;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\pump\Pump;
use App\Models\pump\Nozzle;
use App\Models\User;
use Exception;
use App\Models\shift\CloseShiftItem;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = checkShift();
        $shift = $data["shift"];
        $users = $data["users"];

        if (!$shift) {
            $date = date('Y-m-d');
            return $this->create($date);
        } else {
            if ($shift->status == 'pending') {
                return view('shifts.index', compact('shift', 'users'));
            } else if ($shift->status == 'open') {
                return view('shifts.manage', compact('shift'));
            } else if ($shift->status == 'closed') {
                $date = date('Y-m-d', strtotime("+1 day"));
                return $this->create($date);
            }
        }
    }

    public function shifts_admin()
    {
        $shifts = Shift::orderBy('id', 'desc')->get();
        return view('shifts.admin_index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($date)
    {

        return view('shifts.create', compact('date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['shift_name', 'pass_key']);
        $validate = true;
        $checkuser = verifyUser($data['pass_key']);
        if (!$checkuser['status']) {
            $validate = false;
            $output = [
                'success' => false,
                'msg' => 'Invalid Pass Key or User is Inactive',
                'data' => null
            ];
        }

        if ($validate) {
            $pumpsavailable = true;
            $pumps = Pump::where('status', 'active')->get(['id'])->toArray();
            if (count($pumps) == 0) {
                $pumpsavailable = false;
                $output = [
                    'success' => false,
                    'msg' => 'No active pump found. Inform administration and try again',
                    'data' => null
                ];
            }

            if ($pumpsavailable) {
                try {
                    DB::beginTransaction();
                    $data['created_by'] = $checkuser['user_id'];
                    $shift = Shift::create($data);
                    $data_items = [];
                    foreach ($pumps as $pump) {
                        $data_items[] = [
                            'shift_id' => $shift->id,
                            'pump_id' => $pump["id"],
                        ];
                    }

                    ShiftItem::insert($data_items);
                    if ($shift) {
                        DB::commit();
                        $output = [
                            'success' => true,
                            'msg' => 'Shift Created Successfully',
                            'data' => $shift
                        ];
                    }
                } catch (\Throwable $th) {

                    DB::rollback();
                    $output = [
                        'success' => false,
                        'msg' => 'Error Creating Shift',
                        'data' => null
                    ];
                }
            }
        }
        return $output;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shift $shift)
    {
        // $shift = Shift::find($id);
        // $shift_items = $shift->items->map(function ($v) {
        //     // dd($v);
        //     $start_time = Carbon::createFromFormat('H:i:s', $v->start_time);
        //     $end_time = Carbon::createFromFormat('H:i:s', $v->end_time);

        //     $v->start_time = $start_time->format('g:i A');
        //     $v->end_time = $end_time->format('g:i A');
        //     return $v;
        // });
        return view('shifts.view', compact('shift'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Shift $shift)
    {
        // $shift = Shift::find($id);
        $users =  $users = User::whereHas('role', function ($q) {
            $q->where('type', 'attendant');
        })->get(['id', 'name']);
        return view('shifts.edit', compact('shift', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        // dd($request->all(), $id);
        // $shift = Shift::find($id);
        // $data = $request->only(['shift_name']);
        $data_items = $request->only([
            'user_id', 'id'
        ]);
        $data_items = modify_array($data_items);

        try {
            DB::beginTransaction();
            // $result = $shift->update($data);

            $item_ids = array_map(function ($v) {
                return $v['id'];
            }, $data_items);
            $shift->items()->whereNotIn('id', $item_ids)->delete();

            // create or update items
            foreach ($data_items as $item) {
                $shift_item = ShiftItem::firstOrNew(['id' => $item['id']]);
                $shift_item->fill(array_replace($item, ['shift_id' => $shift['id']]));
                if (!$shift_item->id) unset($shift_item->id);
                $shift_item->save();
            }
            if ($shift) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Updating Shift!!');
        }
        return redirect()->route('shift.shifts_admin')->with('flash_success', 'Shift Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $shift = Shift::find($id);
            if ($shift->delete() && $shift->items->each->delete()) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Shift Failed to Delete!!');
        }
        return redirect()->back()->with('flash_success', 'Shift Deleted Successfully!!');
    }


    public function assignUser(Request $request, $shiftitem)
    {
        $shift = ShiftItem::find($shiftitem);
        $user = $request->user_id;
        $status = $request->status;

        if ($user != null && $status == 'active') {
            $user = null;
        }

        // Handle the request, update the Shift model, and return a response
        $shift->update([
            'user_id' => $user,
            'status' => $user == null ? 'inactive' : 'active',
            // Add other fields as needed
        ]);

        return response()->json(['message' => 'Assignment successful']);
    }

    public function finalizeAllocation(Request $request)
    {
        $shiftid = $request->shift_id;
        $passkey = $request->pass_key;
        $shiftitems = ShiftItem::where('shift_id', $shiftid)->get();

        $allusersactive = true;
        $output = [];
        foreach ($shiftitems as $shiftitem) {
            // Check if status is inactive
            if ($shiftitem->status == 'inactive') {
                $allusersactive = false;
                $output = [
                    'success' => false,
                    'msg' => 'Allocate all users to their respective pumps',
                    'data' => null
                ];
                break;
            }

            // Check for duplicated user id
            $duplicateCount = ShiftItem::where('shift_id', $shiftid)
                ->where('user_id', $shiftitem->user_id)
                ->where('id', '<>', $shiftitem->id)
                ->count();

            if ($duplicateCount > 0) {
                $allusersactive = false;
                $output = [
                    'success' => false,
                    'msg' => 'Duplicated user in pumps',
                    'data' => null
                ];
                break;
            }
        }

        if ($allusersactive) {
            $validate = true;
            $checkuser = verifyUser($passkey);

            if (!$checkuser['status']) {
                $validate = false;
                $output = [
                    'success' => false,
                    'msg' => 'Invalid Pass Key',
                    'data' => null
                ];
            }
            if ($validate) {
                $shift = Shift::where('id', $shiftid)->first();

                DB::beginTransaction();
                try {
                    $shift->update([
                        'status' => 'open',
                        'allocated_by' => $checkuser['user_id']
                    ]);

                    DB::commit();
                    $output = [
                        'success' => true,
                        'msg' => 'Allocation Completed Successfully',
                        'data' => $shift
                    ];
                    // return response(['message' => 'Allocation Completed Successfully'], 200);
                } catch (Exception $e) {
                    DB::rollBack();
                    $output = [
                        'success' => false,
                        'msg' => 'Error Creating Shift',
                        'data' => null
                    ];
                    // return response(['message' => $e->getMessage()], 400);
                }
            }
        }

        return $output;
    }

    public function loginUser(Request $request, $shiftitem)
    {
        $shift = ShiftItem::find($shiftitem);
        $user = $request->user_id;
        $status = $request->status;

        if ($user != null) {
            $shift->update([
                'status' => $status == 'active' ? 'inactive' : 'active',
                'end_time' => $status == 'active' ? date('Y-m-d H:i:s') : null
            ]);

            return response(['message' => $status == 'active' ? 'Logout successful' : 'Log in successful']);
        }

        // Handle the request, update the Shift model, and return a response

    }

    public function closeShift(Request $request)
    {
        $shiftid = $request->shift_id;
        $passkey = $request->pass_key;
        $shiftitems = ShiftItem::where('shift_id', $shiftid)->get();
        $allusersinactive = true;
        $output = [];
        foreach ($shiftitems as $shiftitem) {
            // Check if status is active
            if ($shiftitem->status == 'active') {
                $allusersinactive = false;
                $output = [
                    'success' => false,
                    'msg' => 'Log out all users in order to close shift',
                    'data' => null
                ];
                break;
            }
        }

        if ($allusersinactive) {
            $validate = true;
            $checkuser = verifyUser($passkey);

            if (!$checkuser['status']) {
                $validate = false;
                $output = [
                    'success' => false,
                    'msg' => 'Invalid Pass Key',
                    'data' => null
                ];
            }
            if ($validate) {

                $shift = Shift::where('id', $shiftid)->first();

                DB::beginTransaction();
                try {
                    $shift->update([
                        'status' => 'closed',
                        'end_date' => date('Y-m-d H:i:s'),
                        'closed_by' => $checkuser['user_id']
                    ]);

                    DB::commit();
                    $output = [
                        'success' => true,
                        'msg' => 'Shift Closed Successfully',
                        'data' => $shift
                    ];
                } catch (Exception $e) {
                    DB::rollBack();
                    $output = [
                        'success' => false,
                        'msg' => 'Error Creating Shift',
                        'data' => null
                    ];
                }
            }
        }
        return $output;
    }

    public function goods(Request $request)
    {
        $shift = Shift::find(request('shift_id'));
        //     $shift_items = $shift->items()->get();

        //     //Use relation
        //     // $items = $shift->whereHas('items', function($q){
        //     //     $q->with(['pump'=> function($query){
        //     //         // dd($query->get());
        //     //         $query->whereHas('nozzles')->get();
        //     //     }]);
        //     // })->get();
        //     $nozzles = [];
        //     foreach($shift_items as $item){
        //         $nozzles[] = $item->pump->nozzles;
        //         // foreach ($pumps as $pump) {
        //         //     $nozzles[] = $pump->nozzles;
        //         // }
        //     }
        //     $nozzlebb = [];
        //    foreach($nozzles as $nozzle){
        //     $nozzlebb[] = $nozzle->map(function($v){
        //         // dd($v);
        //         $v->pump = $v->pump ? $v->pump->name : '';
        //         $v->product = $v->product ? $v->product->name : '';
        //         return $v;
        //     });
        //    }
        // $nozzles = Nozzle::whereIn('pump_id', function ($query) {
        //     $query->select('pump_id')
        //         ->from(with(new ShiftItem)->getTable())
        //         ->where('shift_id', function ($query) {
        //             $query->select('id')
        //                     ->from(with(new Shift)->getTable());
        //         });
        // })->get();
        // $nozzles = $nozzles->map(function($v){
        //     // dd($v);
        //     $v->pump_name = $v->pump ? $v->pump->name : '';
        //     $v->product_name = $v->product ? $v->product->name : '';
        //     return $v;
        // });
        $nozzles = Shift::with(['items' => function ($query) {
            $query->with(['pump.nozzles']);
        }])
            ->with(['items.user'])
            ->find($shift->id)
            ->items
            ->pluck('pump.nozzles')
            ->flatten();
        // dd($nozzles);
        $nozzles = $nozzles->map(function ($v) use ($shift) {
            // dd($v);
            $v->pump_name = $v->pump ? $v->pump->name : '';
            $v->product_name = $v->product ? $v->product->name : '';
            $v->product_price = $v->product ? $v->product->price : '';
            $v->category = $v->product ? $v->product->category : '';
            $close_shift_item = CloseShiftItem::where('nozzle_id', $v->id)->latest()->first();
            if ($close_shift_item) {
                $v->opening_stock = $close_shift_item ? $close_shift_item->current_stock : 0;
            } else {
                $v->opening_stock = $v->readings;
            }
            $v->user_id = 0;
            $v->user_name = '';
            if ($v->pump) {
                if ($v->pump->shift_items) {
                    $item = $v->pump->shift_items->where('shift_id', $shift->id)->first();
                    $v->user_id = $item->user_id;
                    $v->user_name = $item->user->name;
                    // dd($item);
                }
            }
            // $v->user_name = $v->product ? $v->product->name : '';
            return $v;
        });
        // dd($nozzles);
        return response()->json($nozzles);
    }
}
