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
        $give_cashs = GiveCash::all();
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

        return view('give_cash.create', compact('pumps'));
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
        $data['user_id'] = Auth()->user()->id;
        $data['shift_id'] = Auth()->user()->id;

        try {
            DB::beginTransaction();

            $sale = GiveCash::create($data);


            if ($sale) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            dd($th);
            //throw $th;
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Creating Cash Issuance!!');
        }
        return redirect()->route('give_cash.create')->with('flash_success', 'Cash issuance Created Successfully!!');
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
        $pumps = Pump::where('status', 'active')->get(['id','name']);
        $shifts = Shift::all();
        $users = User::all();
        return view('give_cash.edit', compact('give_cash','users','shifts','pumps'));
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
            dd($th);
            //throw $th;
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
            dd($th);
            //throw $th;
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Deleting Cash Issuance!!');
        }
        return redirect()->route('give_cash.index')->with('flash_success', 'Cash issuance Deleted Successfully!!');
    }

    public function approve(Request $request){
        // dd($request->all());
        $data = $request->only(['status','approve_note']);
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
}
