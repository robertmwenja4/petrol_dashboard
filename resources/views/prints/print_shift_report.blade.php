<html>

<head>
    <title>
        {{ 'Sales Report' }}
    </title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 10pt;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        .item {
            background: grey;
        }

        .align_c {
            align-items: center;
            text-align: center;
        }

        .no_border {
            border: none;
        }
    </style>
</head>

<body>
    <htmlpagefooter name="myfooter">
        <div class="footer">
            Page {PAGENO} of {nb}
        </div>
    </htmlpagefooter>
    <sethtmlpagefooter name="myfooter" value="on" />
    {{-- <table class="header-table">
		<tr>
			<td>
				<img src="{{ Storage::disk('public')->url('app/public/img/company/oxyr.jpg') }}" style="object-fit:contain" width="100%"/>
			</td>
		</tr>
	</table> --}}
    <table>
        <tbody>
            <tr>
                <td width="20%" class="no_border">
                    <table class="no_border">
                        <tbody>
                            <tr class="no_border">
                                <td class="no_border">VRN: {{ $company->vrn_no }}</td>
                            </tr>
                            <tr>
                                <td class="no_border">TIN NO: {{ $company->tin_no }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="60%" class="no_border">
                    <table>
                        <tbody>
                            <tr>
                                <td class="no_border"><img
                                        src="{{ Storage::disk('public')->url('app/public/img/company/oxyr.jpg') }}"
                                        style="object-fit:contain" width="100%" /></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="20%" class="no_border">
                    <table>
                        <tbody>
                            <tr>
                                <td class="no_border"> {{ $company->address }}</td>
                            </tr>
                            <tr>
                                <td class="no_border">Phone: {{ $company->phone_number }}</td>
                            </tr>
                            <tr>
                                <td class="no_border">Email: {{ $company->email }}</td>
                            </tr>
                            <tr>
                                <td class="no_border">Fax: {{ $company->fax }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <h4 class="align_c">Shift Ends at <span>{{ date('d/m/Y', strtotime($shift->close_shift->created_at)) }}</span><span>
            {{ date('h:i A', strtotime($shift->close_shift->created_at)) }}</span></h4>
    <table class="items">
        <thead>
            <tr>
                <th>Details</th>
                @foreach ($close_shift_item_diesel as $item)
                    <th>{{ @$item->nozzle->code }}</th>
                @endforeach
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_diff = 0;
            @endphp
            <tr>
                <td>Closing</td>
                @foreach ($close_shift_item_diesel as $item)
                    <td>{{ @$item->current_stock }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Opening</td>
                @foreach ($close_shift_item_diesel as $item)
                    <td>{{ @$item->open_stock }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Sales</td>
                @foreach ($close_shift_item_diesel as $item)
                    @php
                        $total_diff += $item->balance;
                    @endphp
                    <td>{{ @$item->balance }}</td>
                @endforeach
                <td>{{ $total_diff }}</td>
            </tr>
        </tbody>
    </table><br>
    <table class="items">
        <thead>
            <tr>
                <th>Details</th>
                @foreach ($close_shift_item_petrol as $item)
                    <th>{{ @$item->nozzle->code }}</th>
                @endforeach
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_super_diff = 0;
            @endphp
            <tr>
                <td>Closing</td>
                @foreach ($close_shift_item_petrol as $item)
                    <td>{{ @$item->current_stock }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Opening</td>
                @foreach ($close_shift_item_petrol as $item)
                    <td>{{ @$item->open_stock }}</td>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Sales</td>
                @foreach ($close_shift_item_petrol as $item)
                    @php
                        $total_super_diff += $item->balance;
                    @endphp
                    <td>{{ @$item->balance }}</td>
                @endforeach
                <td>{{ $total_super_diff }}</td>
            </tr>
        </tbody>
    </table><br>
    <table>
        <tr>
            <td width="60%" class="no_border" style="padding:0 px">
                <table border="1">
                    <thead>
                        <tr>
                            <th width="40%">Tank</th>
                            <th width="20%">B/F BALANCE</th>
                            <th width="10%">IN</th>
                            <th width="10%">OUT</th>
                            <th width="20%">C/F BALANCE</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            @foreach ($product_bin as $item)
                                <tr>
                                    <td>{{$item->product ? $item->product->description : ''}}</td>
                                    <td>{{$item->opening_stock}}</td>
                                    <td>{{$item->stock_in}}</td>
                                    <td>{{$item->stock_out}}</td>
                                    <td>{{$item->closing_stock}}</td>
                                    
                                </tr>
                            @endforeach
                       
                        {{-- <tr>
                            <td>SUPER TANK</td>
                            <td>10000</td>
                            <td>200</td>
                            <td>700</td>
                            <td>9100</td>
                        </tr> --}}
                    </tbody>
                </table>
            </td>
            <td width="40%" class="no_border">
                <p style="color: blue">
                    <b><i>Fuel Prices</i></b>
                </p><br />
                <table border="1">
                    <tbody>
                        @foreach ($fuel_prices as $price)
                            
                            <tr>
                                <td>{{$price->product ? $price->product->name : ''}}</td>
                                <td>{{$price->price}}</td>
                            </tr>
                        @endforeach
                       
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <table width="100%">
        <tr>
            <th rowspan="2">Pump</th>
            <th rowspan="2">User</th>
            <th>Credit Sale</th>
            <th rowspan="2">Total Sales (A)</th>
            <th rowspan="2">Sales By Metre (B)</th>
            <th rowspan="2">Diff (A-B)</th>
            <th>Paid Amount</th>
            <th rowspan="2">Comment</th>
        </tr>
        <tr>
            <th>Real Cash Sale</th>
            <th>Outstanding </th>
        </tr>
        <tbody>
            @php
                $total_sales_by_meter = 0;
                $credit_sale = 0;
                $balance = 0;
                $total_cash = 0;
            @endphp
            @foreach (collect($pump_sales) as $selling)
            {{-- {{dd($selling['give_cash'])}} --}}
                @php
                    $diff = $selling['amount'] - ($selling['price'] + $selling['give_cash']);
                    $total_sales_by_meter += $selling['amount'];
                    $credit_sale += $selling['price'];
                    $balance += $diff;
                    $total_cash += $selling['give_cash'];
                    $t_sale = $selling['price'] + $selling['give_cash'];
                    $t_amount = number_format($selling['amount'], '3');
                    $t_diff = $selling['amount'] - ($selling['price'] + $selling['give_cash']);
                    //New

                @endphp
            <tr>

                <td rowspan="2">{{ $selling['pump_name'] }}</td>
                <td rowspan="2">{{ $selling['user_name'] }}</td>
                <td>{{ number_format($selling['price'], '3') }}</td>
                <td rowspan="2">{{ number_format($t_sale, '3') }}</td>
                <td rowspan="2">{{ $t_amount }}</td>
                <td rowspan="2">{{ number_format($t_diff, '3') }}</td>
                <td></td>
                <td rowspan="2"></td>
            </tr>
            <tr>

                <td>{{ number_format($selling['give_cash'], '3') }}</td>
                <td></td>
            </tr>
            @endforeach
            {{-- @foreach (collect($sales) as $sale)
                @foreach (collect($sale) as $selling)
                    @php
                        $diff = $selling->amount - ($selling->price + $selling->give_cash);
                        $total_sales_by_meter += $selling->amount;
                        $credit_sale += $selling->price;
                        $balance += $diff;
                        $total_cash += $selling->give_cash;
                        $t_sale = $selling->price + $selling->give_cash;
                        $t_amount = number_format($selling->amount, '3');
                        $t_diff = $selling->amount - ($selling->price + $selling->give_cash);
                        //New

                    @endphp
                    <tr>

                        <td rowspan="2">{{ $selling->pump_name }}</td>
                        <td rowspan="2">{{ $selling->user_name }}</td>
                        <td>{{ number_format($selling->price, '3') }}</td>
                        <td rowspan="2">{{ number_format($t_sale, '3') }}</td>
                        <td rowspan="2">{{ $t_amount }}</td>
                        <td rowspan="2">{{ number_format($t_diff, '3') }}</td>
                        <td></td>
                        <td rowspan="2"></td>
                    </tr>
                    <tr>

                        <td>{{ number_format($selling->give_cash, '3') }}</td>
                        <td></td>
                    </tr>
                    
                @endforeach
            @endforeach --}}
        </tbody>
    </table><br>
    {{-- {{dd($total_sales_by_meter)}} --}}
    <div style="page: break;"></div>
    <table>
        <thead>
            <tr>
                <th>Grand Total Sales as per Meter</th>
                <th><em>{{ number_format($total_sales_by_meter, '3') }}</em></th>
                <th>Diff(Total)</th>
                <th>{{ number_format($balance, '3') }}</th>
            </tr>
            <tr>
                <th>Credit Totals</th>
                <th><em>{{ number_format($credit_sale, '3') }}</em></th>
                <th>CASH TOTALS</th>
                <th><em>{{ number_format($total_cash, '3') }}</em></th>
            </tr>
        </thead>
    </table>
    <table border="1">
        <thead>
            <tr>
                <td width="20%">User</td>
                <td width="10%">Pump</td>
                <td width="15%">Sales Date</td>
                <td width="20%">Super/Diesel</td>
                <td width="8%">Sales Type</td>
                <td width="10%">Quantity</td>
                <td width="15%">Amount</td>
            </tr>
        </thead>
        <tbody>
            {{-- {{dd(collect($user_sales))}} --}}
            @foreach ($user_sales as $sales)
                @foreach ($sales as $sale)
                    <tr>
                        <td>{{ $sale->user_name }}</td>
                        <td>{{ $sale->pump_name }}</td>
                        <td>{{ date('d/m/Y', strtotime($sale->sales_date)) ?: '' }}</td>
                        <td>{{ $sale->product_name }}</td>
                        <td>{{ ucfirst($sale->sales_type) }}</td>
                        <td>{{ $sale->qty }}</td>
                        <td>{{ number_format($sale->amount, '3') }}</td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                        <td>Actual</td>
                        <td>{{ $sale->actual_qty }}</td>
                        <td>{{ number_format($sale->actual_amount, '3') }}</td>
                    </tr>
                    <tr class="item">
                        <td colspan="4"></td>
                        <td>Diff</td>
                        <td>{{ $sale->qty_diff }}</td>
                        <td>{{ number_format($sale->amt_diff, '3') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table><br>
</body>

</html>
