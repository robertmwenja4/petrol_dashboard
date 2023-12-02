<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product\Product;
use DB;
use App\Models\purchase\Purchase;
use App\Models\product_bin\ProductBin;
use App\Models\shift\Shift;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::all();
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
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
            $purchase = Purchase::create($data);
            $product = Product::find($purchase->product_id);
            $shift = Shift::where('status', 'open')->first();
            
            ProductBin::create([
                'product_id' => $product->id,
                'shift_id' => 0,
                'transaction_id' => $purchase->id,
                'type' => 'purchase',
                'opening_stock' => $product->readings,
                'closing_stock' => $purchase->qty + $product->readings,
                'stock_in' => $purchase->qty,
                'stock_out' => 0
            ]);
            $product_bin = ProductBin::where([
                'type'=>'stock_movement',
                'shift_id'=> $shift->id,
                'product_id' => $product->id
                
            ])->first();
            $product_bin->stock_in = $purchase->qty;
            $product_bin->update();
            $product->readings += $purchase->qty;
            $product->update();
            if($purchase){
                DB::commit();
            }

        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Creating Purchase!!');
        }
        return redirect()->route('purchase.index')->with('flash_success', 'Purchase Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('purchases.view', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        $products = Product::all();
         return view('purchases.edit', compact('purchase','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $data = $request->except(['_token']);
        try {
            DB::beginTransaction();
            //Revert
            $product = Product::find($purchase->product_id);
            $shift = Shift::where('status', 'open')->first();
            if($product){
                $product->readings -= $purchase->qty;
                $product->update();
                $product_bin = ProductBin::where([
                    'type'=>'purchase',
                    'product_id' => $product->id,
                    'transaction_id' => $purchase->id
                ])->first();
                $product_bin->delete();
            }

            $purchase->update($data);
            //create new
            ProductBin::create([
                'product_id' => $product->id,
                'shift_id' => 0,
                'transaction_id' => $purchase->id,
                'type' => 'purchase',
                'opening_stock' => $product->readings,
                'closing_stock' => $purchase->qty + $product->readings,
                'stock_in' => $purchase->qty,
                'stock_out' => 0
            ]);
            $product_bins = ProductBin::where([
                'type'=>'stock_movement',
                'shift_id'=> $shift->id,
                'product_id' => $product->id
                
            ])->first();
            $product_bins->stock_in = $purchase->qty;
            $product_bins->update();
            if($purchase){
                $product->readings += $purchase->qty;
                $product->update();
                DB::commit();
            }

        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Error Updating Purchase!!');
        }
        return redirect()->route('purchase.index')->with('flash_success', 'Purchase Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        try {
            DB::beginTransaction();
            $product = Product::find($purchase->product_id);
            $shift = Shift::where('status', 'open')->first();
            $product->readings -= $purchase->qty;
            $product->update();
            $product_bin = ProductBin::where([
                'type'=>'purchase',
                'product_id' => $product->id,
                'transaction_id' => $purchase->id
            ])->first();
            $product_bin->delete();
            $product_bins = ProductBin::where([
                'type'=>'stock_movement',
                'shift_id'=> $shift->id,
                'product_id' => $product->id
                
            ])->first();
            $product_bins->stock_in = 0;
            $product_bins->update();
            if ($purchase->delete()) {
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('flash_error', 'Purchase Failed to Delete!!');
        }
        return redirect()->back()->with('flash_success', 'Purchase Deleted Successfully!!');
    }
}
