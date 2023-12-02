<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\StockAdjustment;
use App\Models\product\Product;
use App\Models\product_bin\ProductBin;
use DB;

class StockAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_adjustments = StockAdjustment::all();
        return view('stock_adjustments.index', compact('stock_adjustments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('stock_adjustments.create', compact('products'));
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
        // dd($data);
        try {
            DB::beginTransaction();
            $stock_adjustment = StockAdjustment::create($data);
            $product = Product::find($data['product_id']);
            $product->readings = $stock_adjustment->current_qty;
            $product->update();
            ProductBin::create([
                'product_id' => $product->id,
                'shift_id' => 0,
                'transaction_id' => $stock_adjustment->id,
                'type' => 'stock_adjustment',
                'opening_stock' => $stock_adjustment->previous_qty,
                'closing_stock' => $stock_adjustment->current_qty,
                'stock_in' => $stock_adjustment->current_qty,
                'stock_out' => 0
            ]);

            if($stock_adjustment){
                DB::commit();
            }

        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Creating StockAdjustment!!');
        }
        return redirect()->route('stock_adjustment.index')->with('flash_success', 'StockAdjustment Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StockAdjustment $stock_adjustment)
    {
        return view('stock_adjustments.view', compact('stock_adjustment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StockAdjustment $stock_adjustment)
    {
        return view('stock_adjustments.edit', compact('stock_adjustment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockAdjustment $stock_adjustment)
    {
        $data = $request->except(['_token']);
        try {
            DB::beginTransaction();
            //Revert
            $product = Product::find($data['product_id']);
            $product->readings = $stock_adjustment->previous_qty;
            $product->update();
            $product_bin = ProductBin::where([
                'type'=>'stock_adjustment',
                'product_id' => $product->id,
                'transaction_id' => $stock_adjustment->id
            ])->first();
            $product_bin->delete();
            $stock_adjustment->update($data);
            //Changes
            $product->readings = $stock_adjustment->current_qty;
            $product->update();
            ProductBin::create([
                'product_id' => $product->id,
                'shift_id' => 0,
                'transaction_id' => $stock_adjustment->id,
                'type' => 'stock_adjustment',
                'opening_stock' => $stock_adjustment->previous_qty,
                'closing_stock' => $stock_adjustment->current_qty,
                'stock_in' => $stock_adjustment->current_qty,
                'stock_out' => 0
            ]);
            if($stock_adjustment){
                DB::commit();
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Updating stock_adjustment!!');
        }
        return redirect()->route('stock_adjustment.index')->with('flash_success', 'stock_adjustment Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockAdjustment $stock_adjustment)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($stock_adjustment->product_id);
            $product->readings = $stock_adjustment->previous_qty;
            $product->update();
            $product_bin = ProductBin::where([
                'type'=>'stock_adjustment',
                'product_id' => $product->id,
                'transaction_id' => $stock_adjustment->id
            ])->first();
            $product_bin->delete();
            if ($stock_adjustment->delete()) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'StockAdjustment Failed to Delete!!');
        }
        return redirect()->back()->with('flash_success', 'StockAdjustment Deleted Successfully!!');
    }

    public function stock_adjust($id){
        $product = Product::find($id);
        return response()->json($product);
    }
}
