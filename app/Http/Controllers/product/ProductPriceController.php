<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\product\ProductPrice;
use App\Models\product\Product;
use Illuminate\Http\Request;
use DB;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_prices = ProductPrice::all();
        return view('product_prices.index', compact('product_prices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product_prices.create');
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
        $data = $request->except(['_token']);
        $data['status'] = 'active';
        $products = Product::where('category', $data['category'])->get();
        try {
            DB::beginTransaction();
            $previous_product_price = ProductPrice::where(['category'=> $data['category'], 'status'=>'active'])->first();
            if($previous_product_price){

                $previous_product_price->status = 'inactive';
                $previous_product_price->end_date = $data['from_date'];
                $previous_product_price->update();
            }
            $product_price = ProductPrice::create($data);
            foreach ($products as $product) {
                $product->price = $product_price->price;
                $product->update();
            }
            if($product_price){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status', 'Error Creating Product Price');
        }
        return redirect()->route('product_price.index')->with('status', 'ProductPrice Created Successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product_price = ProductPrice::find($id);
        return view('product_prices.view', compact('product_price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_price = ProductPrice::find($id);
        return view('product_prices.edit', compact('product_price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product_price = ProductPrice::find($id);
        $data = $request->except(['_token']);
        try {
            DB::beginTransaction();
            $result = $product_price->update($data);
            if($product_price){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status', 'Error Updating Product_price');
        }
        return redirect()->route('product_price.index')->with('status','ProductPrice Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductPrice  $productPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $product_price = ProductPrice::find($id);
            if($product_price->delete()){
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('status','ProductPrice Failed to Delete!!');
        }
        return redirect()->back()->with('status','ProductPrice Deleted Successfully!!');
    }
}
