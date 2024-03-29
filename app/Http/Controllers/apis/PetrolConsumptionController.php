<?php

namespace App\Http\Controllers\apis;

use Exception;
use App\Models\User;
use App\Models\pump\Pump;
use App\Models\sale\Sale;
use Illuminate\Http\Request;
use App\Models\product\Product;
use App\Models\customer\Customer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PetrolConsumptionController extends Controller
{
    //fetch pumps
    public function fetchPumps()
    {
        try {
            $pumps = Pump::whereHas('products')->with('products')->get();
            $response = response()->json(['msg' => null, 'data' => $pumps, 'success' => true], 200);
        } catch (Exception $e) {
            $response = response()->json(['msg' => $e->getMessage(), 'data' => null, 'success' => false], 422);
        }
        return $response;
    }

    //fetch credit customers

    public function fetchCreditCustomers()
    {
        try {
            $customers = Customer::where('customer_type', 'credit')->get();
            $response = response()->json(['msg' => null, 'data' => $customers, 'success' => true], 200);
        } catch (Exception $e) {
            $response = response()->json(['msg' => $e->getMessage(), 'data' => null, 'success' => false], 422);
        }
        return $response;
    }
    //record sale

    public function recordSale(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'pass_key' => 'required',
        ]);
        if ($validator->fails()) {
            return response(['status' => 0, 'errors' => $validator->errors()->all()], 422);
        }
        $user = User::where('code', $request->pass_key)->first();
        if (!$user) {
            return response()->json(['msg' => "Pass Key is Incorrect. Try Again", 'data' => null, 'success' => false], 404);
        }
        $data = $request->only(
            [
                'type',
                'product_id',
                'qty',
                'lpo_no',
                'other_vrn_no',
                'other_tin_no',
                'customer_id',
                'driver',
                'vehicle_no',
                'shift_id'
            ]
        );

        $product = Product::find($data['product_id']);
        if (!$product) {
            return response()->json(['msg' => "Product not found", 'data' => null, 'success' => false], 404);
        }
        $customer = Customer::find($data['customer_id']);
        if (!$customer && $data['type'] == 'credit') {
            return response()->json(['msg' => "Customer not found", 'data' => null, 'success' => false], 404);
        }
        if (empty($data["customer_id"]) && $data["type"] == "cash") {
            $customer = Customer::where("customer_type", "cash")->first();
            $data["customer_id"] = $customer->id;
        }
        $data["rate"] = $product->price;
        $data["total_price"] = ($product->price) * ($data["qty"]);
        $data["shift_id"] = 1;
        $data["pump_id"] = $product->pump_id;
        $data["user_id"] = $user->id;


        DB::beginTransaction();
        try {
            Sale::create($data);

            DB::commit();
            $response = response()->json(['msg' => "Sale recorded successfully", 'data' => null, 'success' => true], 200);
            return $response;
        } catch (Exception $e) {
            DB::rollBack();
            $response = response()->json(['msg' => $e->getMessage(), 'data' => null, 'success' => false], 422);
            return $response;
        }
    }
}
