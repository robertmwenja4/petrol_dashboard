<?php

namespace App\Http\Controllers\cash;

use App\Models\pump\Pump;
use Illuminate\Http\Request;
use App\Models\cash\GiveCash;
use App\Models\product\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GiveCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            return redirect()->back()->with('status', 'Error Creating Cash Issuance!!');
        }
        return redirect()->route('give_cash.create')->with('status', 'Cash issuance Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
