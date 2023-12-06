<?php

namespace App\Http\Controllers\cash;

use App\Models\pump\Pump;
use Illuminate\Http\Request;
use App\Models\cash\GiveCash;
use App\Models\product\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\shift\Shift;
use App\Models\User;

class GiveCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $give_cashs = GiveCash::orderBy('id', 'desc')->get();
        return view('give_cash.index', compact('give_cashs'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pumps = Pump::where('status', 'active')->get()->pluck('name', 'id');
        $data = checkShift();
        $shift = $data["shift"];
        if (!$shift) {
            return redirect()->route('shift.index');
        } else {
            if ($shift->status == 'pending') {
                return redirect()->route('shift.index');
            } else if ($shift->status == 'open') {
                return view('give_cash.create', compact('pumps', 'shift'));
            } else if ($shift->status == 'closed') {
                return redirect()->route('shift.index');
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, GiveCash $giveCash)
    {
        $data = $request->except('_token');
        $tid = $giveCash->max('tid');
        $data['tid'] = $tid + 1;
        $validate = true;
        $checkuser = verifyUser($data['pass_key']);
        if (!$checkuser['status']) {
            $validate = false;
            $output = [
                'success' => false,
                'msg' => 'Invalid Pass Key',
                'data' => null
            ];
        }
        if ($validate) {
            try {
                DB::beginTransaction();
                $data['user_id'] = $checkuser['user_id'];
                $sale = GiveCash::create($data);
                if ($sale) {
                    DB::commit();
                    $output = [
                        'success' => true,
                        'msg' => 'Cash Record Created Successfully',
                        'data' => $sale
                    ];
                }
            } catch (\Exception $e) {
                DB::rollback();
                $output = [
                    'success' => false,
                    'msg' => 'Error Creating Cash Record ',
                    'data' => null
                ];
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
    public function show(GiveCash $give_cash)
    {
        return view('give_cash.view', compact('give_cash'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GiveCash $give_cash)
    {
        $pumps = Pump::where('status', 'active')->get(['id', 'name']);
        $shifts = Shift::all();
        $users = User::whereHas('role', function($q){
            $q->where('type','attendant');
        })->get();
        return view('give_cash.edit', compact('give_cash', 'users', 'shifts', 'pumps'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GiveCash $give_cash)
    {
        $data = $request->except('_token');
        // dd($data);
        try {
            DB::beginTransaction();
            $give_cash->update($data);
            if ($give_cash) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Updating Cash Issuance!!');
        }
        return redirect()->route('give_cash.index')->with('flash_success', 'Cash issuance Updated Successfully!!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GiveCash $give_cash)
    {
        try {
            DB::beginTransaction();
            if ($give_cash->delete()) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Deleting Cash Issuance!!');
        }
        return redirect()->route('give_cash.index')->with('flash_success', 'Cash issuance Deleted Successfully!!');
    }
    public function approve(Request $request)
    {
        // dd($request->all());
        $data = $request->only(['status', 'approve_note']);
        $give_cash = GiveCash::find($request->id);
        try {
            DB::beginTransaction();
            $give_cash->update($data);
            if ($give_cash) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Approving Failed!!');
        }
        return redirect()->route('give_cash.index')->with('flash_success', 'Approved Successfully!!');
    }
    public function fetchCashGiven(Request $request)
    {
        $id = $request->id;
        $cash = GiveCash::whereHas('user')
            ->whereHas('pump')
            ->where('id', $id)->first();
        // dd($sale);
        return view('prints.print_cash_receipt', compact('cash'));
    }
}
