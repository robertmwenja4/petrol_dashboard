<?php

namespace App\Http\Controllers\sale;

use App\Models\User;
use App\Models\pump\Pump;
use App\Models\sale\Sale;
use App\Models\shift\Shift;
use Illuminate\Http\Request;
use App\Models\product\Product;
use App\Models\customer\Customer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class SaleController extends Controller
{

    protected $headers = [
        "Content-type" => "application/pdf",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::where('customer_type', 'credit')->get()->pluck('company', 'id');
        $products = Product::all()->pluck('name', 'id');

        $pumps = Pump::where('status', 'active')->get()->pluck('name', 'id');
        $data = checkShift();
        $shift = $data["shift"];


        if (!$shift) {
            $date = date('Y-m-d');
            // Instead of view, return the route with parameters
            return route('shift.create', compact('date'));
        } else {
            if ($shift->status == 'pending') {
                return redirect()->route('shift.index');
                // return view('shifts.index', compact('shift', 'users'));
            } else if ($shift->status == 'open') {
                return view('sales.create', compact('customers', 'products', 'pumps', 'shift'));
            } else if ($shift->status == 'closed') {
                $date = date('Y-m-d', strtotime("+1 day"));

                return redirect()->route('shift.index');
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Sale $sale)
    {
        $data = $request->except('_token');
        $tid = $sale->max('tid');
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
        if ($validate) {
            try {
                DB::beginTransaction();
                $data['user_id'] = $checkuser['user_id'];
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
    public function findProduct($productid)
    {
        $product = Product::find($productid);

        if (!$product) {
            return response(['message' => 'Product Not Found'], 402);
        } else {
            return response(['message' => null, 'data' => $product], 200);
        }
    }
    public function findCustomer($customerid)
    {
        $customer = Customer::find($customerid);

        if (!$customer) {
            return response(['message' => 'Product Not Found'], 402);
        } else {
            return response(['message' => null, 'data' => $customer], 200);
        }
    }
    public function search(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $sales = Sale::whereHas('shift', function ($q) use ($request) {
            // dd($q);
            $q->whereBetween('shift_name', [$request->date_from, $request->date_to]);
        })->get();
        $users = User::whereHas('sales', function ($q) use ($request) {
            $q->whereHas('shift', function ($q) use ($request) {
                $q->whereBetween('shift_name', [$request->date_from, $request->date_to]);
            });
        })->get();
        $data = [
            'sales' => $sales,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'users' => $users,
        ];
        $html = view('prints.print_sales_report', $data)->render();
        $pdf = new \Mpdf\Mpdf();
        $pdf->WriteHTML($html);
        // dd($pdf);
        return Response::stream($pdf->Output('sales.pdf', 'I'), 200, $this->headers);
    }

    public function fetchSale(Request $request)
    {
        $id = $request->id;
        $sale = Sale::whereHas('product')
            ->whereHas('user')
            ->whereHas('pump')
            ->where('id', $id)->first();
        // dd($sale);
        return view('sales.print_invoice', compact('sale'));
    }
}
