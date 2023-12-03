<?php

namespace App\Http\Controllers\attendant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\shift\Shift;
use App\Models\shift\ShiftItem;
use Illuminate\Support\Facades\DB;
use App\Models\pump\Pump;
use App\Models\pump\Nozzle;
use App\Models\User;
use Exception;
use App\Models\shift\CloseShiftItem;
use App\Models\customer\Customer;
use App\Models\sale\Sale;
use App\Models\product\Product;
use App\Models\cash\GiveCash;
use App\Models\product_bin\ProductBin;



class AttendantController extends Controller
{
    public function user_dashboard()
    {
        return view('users_dashboard.index');
    }

    public function index_shift()
    {
        $data = checkShift();
        // dd($data);
        $shift = $data["shift"];
        $users = $data["users"];

        if (!$shift) {
            $date = date('Y-m-d');
            return $this->create_shift($date);
        } else {
            if ($shift->status == 'pending') {
                return view('shifts.index', compact('shift', 'users'));
            } else if ($shift->status == 'open') {
                return view('shifts.manage', compact('shift'));
            } else if ($shift->status == 'closed') {
                $date = date('Y-m-d', strtotime("+1 day"));
                return $this->create_shift($date);
            }
        }
    }

    public function create_shift($date)
    {

        return view('shifts.create', compact('date'));
    }

    public function store_shift(Request $request)
    {
        $data = $request->only(['shift_name', 'pass_key']);
        $validate = true;
        $checkuser = verifyUser($data['pass_key']);
        if (!$checkuser['status']) {
            $validate = false;
            $output = [
                'success' => false,
                'msg' => 'Invalid Pass Key or User is Inactive',
                'data' => null
            ];
        }

        if ($validate) {
            $pumpsavailable = true;
            $pumps = Pump::where('status', 'active')->get(['id'])->toArray();
            if (count($pumps) == 0) {
                $pumpsavailable = false;
                $output = [
                    'success' => false,
                    'msg' => 'No active pump found. Inform administration and try again',
                    'data' => null
                ];
            }

            if ($pumpsavailable) {
                try {
                    DB::beginTransaction();
                    $data['created_by'] = $checkuser['user_id'];
                    $shift = Shift::create($data);
                    $products = Product::all();
                    foreach ($products as $product) {
                        ProductBin::create([
                            'product_id' => $product->id,
                            'shift_id' => $shift->id,
                            'transaction_id' => 0,
                            'type' => 'stock_movement',
                            'opening_stock' => $product->readings,
                            'closing_stock' => 0,
                            'stock_in' => 0,
                            'stock_out' => 0
                        ]);
                    }
                    $data_items = [];
                    foreach ($pumps as $pump) {
                        $data_items[] = [
                            'shift_id' => $shift->id,
                            'pump_id' => $pump["id"],
                        ];
                    }

                    ShiftItem::insert($data_items);
                    if ($shift) {
                        DB::commit();
                        $output = [
                            'success' => true,
                            'msg' => 'Shift Created Successfully',
                            'data' => $shift
                        ];
                    }
                } catch (\Throwable $th) {
                    // dd($th);
                    DB::rollback();
                    $output = [
                        'success' => false,
                        'msg' => 'Error Creating Shift',
                        'data' => null
                    ];
                }
            }
        }
        return $output;
    }
    public function assignUser(Request $request, $shiftitem)
    {
        // dd($request->all());
        $shift = ShiftItem::find($shiftitem);
        $user = $request->user_id;
        $status = $request->status;

        if ($user != null && $status == 'active') {
            $user = null;
        }

        // Handle the request, update the Shift model, and return a response
        $shift->update([
            'user_id' => $user,
            'status' => $user == null ? 'inactive' : 'active',
            // Add other fields as needed
        ]);

        return response()->json(['message' => 'Assignment successful']);
    }

    public function create_sales()
    {
        $customers = Customer::where('customer_type', 'credit')->get()->pluck('company', 'id');
        $products = Product::all()->pluck('name', 'id');

        $pumps = Pump::where('status', 'active')->get()->pluck('name', 'id');
        $data = checkShift();
        $shift = $data["shift"];


        if (!$shift) {

            return redirect()->route('shifts.index_shift');
        } else {
            if ($shift->status == 'pending') {
                return redirect()->route('shifts.index_shift');
            } else if ($shift->status == 'open') {
                return view('sales.create', compact('customers', 'products', 'pumps', 'shift'));
            } else if ($shift->status == 'closed') {

                return redirect()->route('shifts.index_shift');
            }
        }
    }

    public function store_sales(Request $request)
    {
        $data = $request->except('_token');
        $tid = Sale::max('tid');
        $data['tid'] = $tid + 1;
        $data['type'] = 'invoice';

        $validate = true;
        $checkuser = verifyUser($data['pass_key']);
        if (!$checkuser['status']) {
            $validate = false;
            $output = [
                'success' => false,
                'msg' => 'Invalid Pass Key',
                'data' => null
            ];
        }

        $pump = $data["pump_id"];
        $shift = $data["shift_id"];

        $shiftitem = ShiftItem::where([
            "pump_id" => $pump,
            "shift_id" => $shift
        ])->first();
        if ($validate) {
            try {
                DB::beginTransaction();
                $data['sold_by'] = $checkuser['user_id'];
                $data['user_id'] = $shiftitem->user_id;

                $sale = Sale::create($data);


                if ($sale) {
                    DB::commit();
                    $output = [
                        'success' => true,
                        'msg' => 'Sale Created Successfully',
                        'data' => $sale
                    ];
                }
            } catch (\Throwable $th) {


                DB::rollback();
                $output = [
                    'success' => false,
                    'msg' => 'Error Creating Sale',
                    'data' => null
                ];
            }
        }

        return $output;
    }

    public function create_cash_give()
    {
        $pumps = Pump::where('status', 'active')->get()->pluck('name', 'id');
        $data = checkShift();
        $shift = $data["shift"];
        if (!$shift) {
            return redirect()->route('shifts.index_shift');
        } else {
            if ($shift->status == 'pending') {
                return redirect()->route('shifts.index_shift');
            } else if ($shift->status == 'open') {
                return view('give_cash.create', compact('pumps', 'shift'));
            } else if ($shift->status == 'closed') {
                return redirect()->route('shifts.index_shift');
            }
        }
    }

    public function store_cash_give(Request $request)
    {
        $data = $request->except('_token');
        $tid = GiveCash::max('tid');
        $data['tid'] = $tid + 1;
        $validate = true;
        $checkuser = verifyUser($data['pass_key']);
        if (!$checkuser['status']) {
            $validate = false;
            $output = [
                'success' => false,
                'msg' => 'Invalid Pass Key',
                'data' => null
            ];
        }
        $pump = $data["pump_id"];
        $shift = $data["shift_id"];

        $shiftitem = ShiftItem::where([
            "pump_id" => $pump,
            "shift_id" => $shift
        ])->first();
        // dd($shiftitem);
        if ($validate) {
            try {
                DB::beginTransaction();
                $data['user_id'] = $shiftitem->user_id;
                $data['cash_given_by'] = $checkuser['user_id'];
                $sale = GiveCash::create($data);
                if ($sale) {
                    DB::commit();
                    $output = [
                        'success' => true,
                        'msg' => 'Cash Record Created Successfully',
                        'data' => $sale
                    ];
                }
            } catch (\Exception $e) {
                DB::rollback();
                $output = [
                    'success' => false,
                    'msg' => 'Error Creating Cash Record ',
                    'data' => null
                ];
            }
        }
        return $output;
    }


    public function get_latest_invoice_receipt()
    {

        $sale =  Sale::latest('id')->first();
        return view('prints.print_invoice', compact('sale'));
    }
    public function get_latest_cash_receipt()
    {

        $cash =  GiveCash::latest('id')->first();
        return view('prints.print_cash_receipt', compact('cash'));
    }
}
