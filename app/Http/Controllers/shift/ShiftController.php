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
        $shift = Shift::whereHas('items')
            ->with('items.pump', 'items.user', 'user')
            // ->where('status', 'open')
            ->whereDate('shift_name', '=', date('Y-m-d'))
            ->first();
        $users = User::whereHas('role', function ($q) {
            $q->where('type', 'attendant');
        })
            ->pluck('name', 'id');




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
        // $shifts = $shifts->map(function($v){
        //     // dd($v);
        //     $start_time = Carbon::createFromFormat('H:i:s', $v->start_time);
        //     $end_time = Carbon::createFromFormat('H:i:s', $v->end_time);

        //     $v->start_time = $start_time->format('g:i A');
        //     $v->end_time = $end_time->format('g:i A');
        //     return $v;
        // });

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
        $data = $request->only(['shift_name']);

        $data["created_by"] = 1;

        try {
            DB::beginTransaction();
            // $previous_shift = Shift::where('status', 'open')->first();
            // $previous_shift->status = 'closed';
            // $previous_shift->update();
            $shift = Shift::create($data);

            $pumps = Pump::where('status', 'active')->get(['id'])->toArray();
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
            }
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            DB::rollback();
            return redirect()->back()->with('status', 'Error Creating Shift!!');
        }
        return redirect()->route('shift.index')->with('status', 'Shift Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shift = Shift::find($id);
        $shift_items = $shift->items->map(function ($v) {
            // dd($v);
            $start_time = Carbon::createFromFormat('H:i:s', $v->start_time);
            $end_time = Carbon::createFromFormat('H:i:s', $v->end_time);

            $v->start_time = $start_time->format('g:i A');
            $v->end_time = $end_time->format('g:i A');
            return $v;
        });
        return view('shifts.view', compact('shift', 'shift_items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shift = Shift::find($id);
        return view('shifts.edit', compact('shift'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all(), $id);
        $shift = Shift::find($id);
        $data = $request->only(['shift_name']);
        $data_items = $request->only([
            'name', 'start_time', 'end_time', 'id'
        ]);
        $data_items = modify_array($data_items);

        try {
            DB::beginTransaction();
            $result = $shift->update($data);

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
            return redirect()->back()->with('status', 'Error Updating Shift!!');
        }
        return redirect()->route('shift.index')->with('status', 'Shift Updated Successfully!!');
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
            return redirect()->back()->with('status', 'Shift Failed to Delete!!');
        }
        return redirect()->back()->with('status', 'Shift Deleted Successfully!!');
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

    public function finalizeAllocation($shiftid)
    {
        $shiftitems = ShiftItem::where('shift_id', $shiftid)->get();

        foreach ($shiftitems as $shiftitem) {
            // Check if status is inactive
            if ($shiftitem->status == 'inactive') {
                return response(['message' => 'Allocate all pumps to users in order to complete allocation'], 400);
            }

            // Check for duplicated user id
            $duplicateCount = ShiftItem::where('shift_id', $shiftid)
                ->where('user_id', $shiftitem->user_id)
                ->where('id', '<>', $shiftitem->id)
                ->count();

            if ($duplicateCount > 0) {
                return response(['message' => 'Duplicated user in pumps'], 400);
            }
        }

        $shift = Shift::where('id', $shiftid)->first();

        DB::beginTransaction();
        try {
            $shift->update([
                'status' => 'open'
            ]);

            DB::commit();
            return response(['message' => 'Allocation Completed Successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
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

    public function closeShift($shiftid)
    {
        $shiftitems = ShiftItem::where('shift_id', $shiftid)->get();

        foreach ($shiftitems as $shiftitem) {
            // Check if status is active
            if ($shiftitem->status == 'active') {
                return response(['message' => 'Log out all users in order to close shift'], 400);
            }
        }

        $shift = Shift::where('id', $shiftid)->first();

        DB::beginTransaction();
        try {
            $shift->update([
                'status' => 'closed',
                'end_date' => date('Y-m-d H:i:s')
            ]);

            DB::commit();
            return response(['message' => 'Shift Closed Successfully'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response(['message' => $e->getMessage()], 400);
        }
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
        $nozzles = $nozzles->map(function ($v) {
            // dd($v);
            $v->pump_name = $v->pump ? $v->pump->name : '';
            $v->product_name = $v->product ? $v->product->name : '';
            $v->product_price = $v->product ? $v->product->price : '';
            $v->category = $v->product ? $v->product->category : '';
            $close_shift_item = CloseShiftItem::where('nozzle_id', $v->id)->latest()->first();
            $v->opening_stock = $close_shift_item ? $close_shift_item->current_stock : 0;
            // $v->user_name = $v->product ? $v->product->name : '';
            return $v;
        });
        // dd($nozzles);
        return response()->json($nozzles);
    }
}
