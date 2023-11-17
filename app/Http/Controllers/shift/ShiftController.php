<?php

namespace App\Http\Controllers\shift;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shift\Shift;
use DB;
use Carbon\Carbon;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shifts = Shift::get();
        $shifts = $shifts->map(function($v){
            // dd($v);
            $start_time = Carbon::createFromFormat('H:i:s', $v->start_time);
            $end_time = Carbon::createFromFormat('H:i:s', $v->end_time);

            $v->start_time = $start_time->format('g:i A');
            $v->end_time = $end_time->format('g:i A');
            return $v;
        });
        return view('shifts.index',compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shifts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->only([
            'name', 'start_time','end_time'
        ]);
        try {
            DB::beginTransaction();
            $shift = Shift::create($data);
            if($shift){
                DB::commit();
            }
            
        } catch (\Throwable $th) {dd($th);
            //throw $th;
            DB::rollback();
            return redirect()->back()->with('status', 'Error Creating Shift!!');
        }
        return redirect()->back()->with('status', 'Shift Created Successfully!!');
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
        return view('shifts.view', compact('shift'));
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
        try {
            DB::beginTransaction();
            $shift = Shift::find($id);
            if($shift->delete()){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status','Shift Failed to Delete!!');
        }
        return redirect()->back()->with('status','Shift Deleted Successfully!!');
    }
}
