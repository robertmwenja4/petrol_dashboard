<?php

namespace App\Http\Controllers\shift;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shift\ShiftType;
use DB;

class ShiftTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shift_types = ShiftType::all();
        return view('shift_types.index', compact('shift_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shift_types.create');
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
            $shift_type = ShiftType::create($data);
            if($shift_type){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status', 'Error Creating ShiftType');
        }
        return redirect()->route('shift_type.index')->with('flash_success', 'ShiftType Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  ShiftType $shift_type
     * @return \Illuminate\Http\Response
     */
    public function show(ShiftType $shift_type)
    {
        return view('shift_types.view', compact('shift_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  ShiftType $shift_type
     * @return \Illuminate\Http\Response
     */
    public function edit(ShiftType $shift_type)
    {
        return view('shift_types.edit', compact('shift_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  ShiftType $shift_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShiftType $shift_type)
    {
        $data = $request->except('_token');
        // dd($data);
        try {
            DB::beginTransaction();
            $shift_type->update($data);
            if ($shift_type) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Updating Shift Type!!');
        }
        return redirect()->route('shift_type.index')->with('flash_success', 'Shift Type Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  ShiftType $shift_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShiftType $shift_type)
    {
        try {
            DB::beginTransaction();
            if ($shift_type->delete()) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'ShiftType Failed to Delete!!');
        }
        return redirect()->back()->with('flash_success', 'ShiftType Deleted Successfully!!');
    }
}
