<?php

namespace App\Http\Controllers\sale;

use App\Http\Controllers\Controller;
use App\Models\customer\Customer;
use App\Models\sale\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;

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
        $customers = Customer::all()->pluck('company', 'id');
        return view('sales.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function search(Request $request)
    {
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        $sales = Sale::whereHas('shift', function($q) use($request){
            // dd($q);
            $q->whereBetween('shift_name',[$request->date_from, $request->date_to]);
        })->get();
        $users = User::whereHas('sales', function($q) use($request){
            $q->whereHas('shift', function($q) use($request){
                $q->whereBetween('shift_name',[$request->date_from, $request->date_to]);
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
}
