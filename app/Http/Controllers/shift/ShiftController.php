<?php

namespace App\Http\Controllers\shift;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shift\Shift;
use App\Models\shift\ShiftItem;
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
        // $shifts = $shifts->map(function($v){
        //     // dd($v);
        //     $start_time = Carbon::createFromFormat('H:i:s', $v->start_time);
        //     $end_time = Carbon::createFromFormat('H:i:s', $v->end_time);

        //     $v->start_time = $start_time->format('g:i A');
        //     $v->end_time = $end_time->format('g:i A');
        //     return $v;
        // });
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
        $data = $request->only(['shift_name']);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shift = Shift::find($id);
         $shift_items = $shift->items->map(function($v){
            // dd($v);
            $start_time = Carbon::createFromFormat('H:i:s', $v->start_time);
            $end_time = Carbon::createFromFormat('H:i:s', $v->end_time);

            $v->start_time = $start_time->format('g:i A');
            $v->end_time = $end_time->format('g:i A');
            return $v;
        });
        return view('shifts.view', compact('shift','shift_items'));
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
            'name', 'start_time','end_time','id'
        ]);
        $data_items = modify_array($data_items);
        
        try {
            DB::beginTransaction();
            $result = $shift->update($data);

            $item_ids = array_map(function ($v) { return $v['id']; }, $data_items);
            $shift->items()->whereNotIn('id', $item_ids)->delete();

            // create or update items
            foreach($data_items as $item) {
                $shift_item = ShiftItem::firstOrNew(['id' => $item['id']]);
                $shift_item->fill(array_replace($item, ['shift_id' => $shift['id']]));
                if (!$shift_item->id) unset($shift_item->id);
                $shift_item->save();
            }
            if($shift){
                DB::commit();
            }
            
        } catch (\Throwable $th) {dd($th);
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
            if($shift->delete() && $shift->items->each->delete()){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status','Shift Failed to Delete!!');
        }
        return redirect()->back()->with('status','Shift Deleted Successfully!!');
    }
}
