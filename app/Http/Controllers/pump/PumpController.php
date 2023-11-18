<?php

namespace App\Http\Controllers\pump;

use App\Http\Controllers\Controller;
use App\Models\pump\Pump;
use Illuminate\Http\Request;
use DB;

class PumpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pumps = Pump::all();
        return view('pumps.index', compact('pumps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pumps.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except(['_token']);
        try {
            DB::beginTransaction();
            $pump = Pump::create($data);
            if($pump){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status', 'Error Creating Pump');
        }
        return redirect()->route('pump.index')->with('status', 'Pump Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pump = Pump::find($id);
        return view('pumps.view', compact('pump'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function edit(Pump $pump)
    {
        $pump = Pump::find($id);
        return view('pumps.edit', compact('pump'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pump = Pump::find($id);
        $data = $request->except(['_token']);
        try {
            DB::beginTransaction();
            $result = $pump->update($data);
            if($pump){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status', 'Error Updating pump');
        }
        return redirect()->route('pump.index')->with('status','Pump Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pump  $pump
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $pump = Pump::find($id);
            if($pump->delete()){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status','Pump Failed to Delete!!');
        }
        return redirect()->back()->with('status','Pump Deleted Successfully!!');
    }
}
