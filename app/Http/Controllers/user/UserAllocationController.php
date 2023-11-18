<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\UserAllocation;
use Illuminate\Http\Request;

class UserAllocationController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['user_id','shift_id','pump_id']);
        $data_items = $request->only([
            'name', 'start_time','end_time'
        ]);
        $data_items = modify_array($data_items);
        
        try {
            DB::beginTransaction();
            $shift = Shift::create($data);

            // $data_items = $input['data_items'];
            $data_items = array_map(function ($v) use($shift) {
                return array_replace($v, [
                    'shift_id' => $shift->id, 
                ]);
            }, $data_items);
            // dd($data_items);
            ShiftItem::insert($data_items);
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
     * @param  \App\Models\UserAllocation  $userAllocation
     * @return \Illuminate\Http\Response
     */
    public function show(UserAllocation $userAllocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAllocation  $userAllocation
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAllocation $userAllocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAllocation  $userAllocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAllocation $userAllocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAllocation  $userAllocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAllocation $userAllocation)
    {
        //
    }
}
