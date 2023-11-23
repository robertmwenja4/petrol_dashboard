<?php

namespace App\Http\Controllers\pump;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pump\Nozzle;
use App\Models\pump\Pump;
use App\Models\product\Product;
use DB;

class NozzleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nozzles = Nozzle::all();
        $pumps = Pump::all();
        $products = Product::all();
        return view('nozzles.index', compact('nozzles', 'pumps','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nozzles.create');
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
            $nozzle = Nozzle::create($data);
            if($nozzle){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Creating nozzle');
        }
        return redirect()->route('nozzle.index')->with('flash_success', 'Nozzle Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Nozzle $nozzle)
    {
        // dd($nozzle);
        return view('nozzles.view', compact('nozzle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Nozzle $nozzle)
    {
        return view('nozzles.edit', compact('nozzle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nozzle $nozzle)
    {
        // dd($request->all());
        $data = $request->except(['_token']);
        try {
            DB::beginTransaction();
            $result = $nozzle->update($data);
            if($nozzle){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Updating nozzle');
        }
        return redirect()->route('nozzle.index')->with('flash_success','Nozzle Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nozzle $nozzle)
    {
        try {
            DB::beginTransaction();
            // $nozzle = nozzle::find($id);
            if($nozzle->delete()){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error','nozzle Failed to Delete!!');
        }
        return redirect()->back()->with('flash_success','nozzle Deleted Successfully!!');
    }
}
