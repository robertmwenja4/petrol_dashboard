<?php

namespace App\Http\Controllers\shift;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\shift\CloseShift;
use App\Models\shift\CloseShiftItem;
use DB;
use App\Models\shift\Shift;
use Illuminate\Support\Facades\Response;
use App\Models\User;

class CloseShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $close_shifts = CloseShift::all();
        $shifts = Shift::where('is_readings','yes')->get();
        return view('close_shifts.index',compact('close_shifts','shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shifts = Shift::where('is_readings','no')->get();
        return view('close_shifts.create', compact('shifts'));
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
        $data = $request->only(['shift_id',]);
        $data_items = $request->only([
            'user_id','pump_id','product_id','nozzle_id','product_price','balance','amount',
            'open_stock','category',
            'current_stock',
        ]);
        $data_items = modify_array($data_items);
        
        try {
            DB::beginTransaction();
            $running_shift = Shift::find($data['shift_id']);
            $running_shift->is_readings = 'yes';
            $running_shift->update();
            
            $shift = CloseShift::create($data);

            // $data_items = $input['data_items'];
            $data_items = array_map(function ($v) use($shift) {
                return array_replace($v, [
                    'close_shift_id' => $shift->id, 
                    'user_id' => auth()->user()->id,
                ]);
            }, $data_items);
            // dd($data_items);
            CloseShiftItem::insert($data_items);
            if($shift){
                DB::commit();
            }
            
        } catch (\Throwable $th) {dd($th);
            //throw $th;
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Creating Closing Shift!!');
        }
        return redirect()->route('close_shift.index')->with('flash_success', 'Shift Close Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CloseShift $close_shift)
    {
        // $close_shift = CloseShift::find($id);
        return view('close_shifts.view', compact('close_shift'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CloseShift $close_shift)
    {
        // $close_shift = CloseShift::find($id);
        $shifts = Shift::get();
        return view('close_shifts.edit', compact('close_shift','shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CloseShift $close_shift)
    {
        // dd($request->all());
        // $close_shift = CloseShift::find($id);
        // $data = $request->only(['shift_id',]);
        $data_items = $request->only([
            'user_id','pump_id','product_id','nozzle_id','product_price','balance','amount',
            'open_stock','category',
            'current_stock','id'
        ]);
        $data_items = modify_array($data_items);
        
        try {
            DB::beginTransaction();
            // $result = $close_shift->update($data);

            $item_ids = array_map(function ($v) { return $v['id']; }, $data_items);
            $close_shift->close_shift_items()->whereNotIn('id', $item_ids)->delete();

            // create or update items
            foreach($data_items as $item) {
                $close_shift_item = CloseShiftItem::firstOrNew(['id' => $item['id']]);
                $close_shift_item->fill(array_replace($item, ['close_shift_id' => $close_shift['id']]));
                if (!$close_shift_item->id) unset($close_shift_item->id);
                $close_shift_item->save();
            }
            if($close_shift){
                DB::commit();
            }
            
        } catch (\Throwable $th) {dd($th);
            //throw $th;
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Updating Closing Shift!!');
        }
        return redirect()->route('close_shift.index')->with('flash_success', 'Shift Close Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        try {
            DB::beginTransaction();
            $close_shift = CloseShift::find($id);
            if($close_shift->shift){
                $close_shift->shift->is_readings = 'no';
                $close_shift->shift->update();
            }
            if($close_shift->delete() && $close_shift->close_shift_items->each->delete()){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error','Close Shift Failed to Delete!!');
        }
        return redirect()->back()->with('flash_success','Shift Close Deleted Successfully!!');
    }

    public function shift(Request $request)
    {
        $shift = Shift::with(['close_shift.close_shift_items'=> function($q){
            $q->where('category','diesel');
        }])->find($request->shift_id);
        $close_shift_item_diesel = $shift->close_shift->close_shift_items()->where('category','diesel')->get();
        $close_shift_item_petrol = $shift->close_shift->close_shift_items()->where('category','petrol')->get();
        // dd($shift->close_shift->close_shift_items);

        $shift_item = Shift::where('id',$request->shift_id )->with([
            'close_shift.close_shift_items',
            'sales',
            'sales.user',
            'cash',
        ])->get();
        // Accessing the connected data
        // $userFromSales = $shift_item->sales ? $shift_item->sales->user :'';
        // dd($shift_item);
        // $pumpAllocated = $shift_item->closeShift->closeShiftItems->first()->pump_allocated;
        // $totalAmountFromSales = $shift_item->sales->sum('amount');
        // $amountRecordedFromCloseShiftItem = $shift_item->closeShift->closeShiftItems->sum('amount_recorded');
        // $cashCollected = $shift_item->cash->amount_collected;
        // $shift_item = $shift_item->sales()
        // dd($shift_item);
        $sales = [];
        foreach($shift_item as $item){
            $sales[] = $item->sales->groupBy('user_id')->map(function($q) use($item){
                // dd($q->first()->pump_id);
                // dd($item->cash->where('user_id', $q->first()->user_id)->sum('amount'));
                $q->user_name = $q->first()->user->name;
                $q->price = $q->sum('total_price');
                $q->pump_name = $item->close_shift->close_shift_items->where('pump_id', $q->first()->pump_id)->first()->pump->name;
                $q->amount = $item->close_shift->close_shift_items->where('pump_id', $q->first()->pump_id)->first()->amount;
                $q->give_cash = $item->cash->where('user_id', $q->first()->user_id)->sum('amount');
                return $q;
            });
        }
        // dd($sales);
        $users = User::with(['sales'=> function($q) use($request){
            $q->with(['shift'=> function($q) use($request){
                $q->where('id',$request->shift_id);
                $q->with('close_shift.close_shift_items');
            }]);
        }])->get();
        $user_sales = [];
        // dd($users);
        foreach ($users as $user) {
            if(count($user->sales) > 0){
            //    dd($user);
            $user_sales[] = $user->sales->groupBy('product_id')->map(function($q){
                $q->user_name = $q->first()->user->name;
                $q->pump_name = $q->first()->pump->code;
                $q->product_name = $q->first()->product->description;
                $q->sales_date = @$q->first()->shift->shift_name;
                $q->sales_type = $q->first()->type;
                $q->qty = $q->sum('qty');
                $q->amount = $q->sum('total_price');
                // dd($q->first()->shift->close_shift->close_shift_items->sum('balance'));
                $q->actual_qty = @$q->first()->shift->close_shift->close_shift_items->sum('balance')?: 0;
                $q->actual_amount = @$q->first()->shift->close_shift->close_shift_items->sum('amount');
                if($q->actual_qty > $q->qty){

                    $q->qty_diff =  $q->actual_qty - $q->qty;
                    $q->amt_diff =  $q->actual_amount - $q->amount;
                }else{
                    $q->qty_diff =  $q->actual_qty;
                    $q->amt_diff =  $q->actual_amount;
                }
                if($q->first()->product->category == 'super'){
                    //user Diff
                }
                return $q;
            });
           }
        }
        // dd($user_sales);
        // foreach ($user_sales as $sale) {
        //     foreach($sale as $s){

        //         dd($s);
        //     }
        // }
        $data = [
            'close_shift_item_diesel' => $close_shift_item_diesel,
            'close_shift_item_petrol' => $close_shift_item_petrol,
            'shifts' => $shift_item,
            'sales' => $sales,
            'user_sales' => $user_sales,
            'shift' => $shift,

        ];
        $html = view('prints.print_shift_report', $data)->render();
        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($html);
        // dd($pdf);
        return Response::stream($pdf->Output('sales.pdf', 'I'), 200, $this->headers);
    }
}
