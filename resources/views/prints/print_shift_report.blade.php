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
                    <th>{{ @$item->current_stock }}</th>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Opening</td>
                @foreach ($close_shift_item_diesel as $item)
                    <th>{{ @$item->open_stock }}</th>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Sales</td>
                @foreach ($close_shift_item_diesel as $item)
                    @php
                        $total_diff += $item->balance;
                    @endphp
                    <th>{{ @$item->balance }}</th>
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
                    <th>{{ @$item->current_stock }}</th>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Opening</td>
                @foreach ($close_shift_item_petrol as $item)
                    <th>{{ @$item->open_stock }}</th>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Sales</td>
                @foreach ($close_shift_item_petrol as $item)
                    @php
                        $total_super_diff += $item->balance;
                    @endphp
                    <th>{{ @$item->balance }}</th>
                @endforeach
                <td>{{ $total_super_diff }}</td>
            </tr>
        </tbody>
    </table><br>
    <div class="row">
        <div class="col-8">
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
                    <tr>
                        <th>DIESEL TANK</th>
                        <th>20000</th>
                        <th>200</th>
                        <th>700</th>
                        <th>19100</th>
                    </tr>
                    <tr>
                        <th>SUPER TANK</th>
                        <th>10000</th>
                        <th>200</th>
                        <th>700</th>
                        <th>9100</th>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <p>Fuel Prices</p>
            <br>
            <table border="1">
                <tbody>
                    <tr>
                        <th>DIESEL</th>
                        <th>3532</th>
                    </tr>
                    <tr>
                        <th>SUPER</th>
                        <th>3332</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th width="10%">Pump</th>
                <th width="15%">User</th>
                <th width="15%">Credit Sale</th>
                <th width="15%">Given Cash</th>
                <th width="20%">Total Sale(A)</th>
                <th width="20%">Sale By Meter(B)</th>
                <th width="15%">Diff(B-A)</th>
                <th width="15%">Paid Amt</th>
                <th width="15%">Outstanding Amt</th>
                <th width="20%">Comment</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_sales_by_meter = 0;
                $credit_sale = 0;
                $balance = 0;
                $total_cash = 0;
            @endphp
            @foreach (collect($sales) as $sale)
                @foreach (collect($sale) as $selling)
                    {{-- {{dd($selling)}} --}}
                    {{-- <tr>
                        <td>{{ $sale->user->name }}</td>
                        <td>{{ $shift->close_shift->close_shift_items->where('pump_id', $sale->pump_id)->first()->pump->name }}</td>
                        <td>{{ $sale->price }}</td>
                        <td>{{ $shift->close_shift->close_shift_items->where('pump_id', $sale->pump_id)->first()->amount }}</td>
                        <td>{{ $shift->cash->where('user_id', $sale->user_id)->sum('amount') }}</td>
                    </tr> --}}
                    <tr>
                        @php
                            $diff = $selling->amount - ($selling->price + $selling->give_cash);
                            $total_sales_by_meter += $selling->amount;
                            $credit_sale += $selling->price;
                            $balance += $diff;
                            $total_cash += $selling->give_cash;
                            $t_sale = $selling->price + $selling->give_cash;
                            $t_amount = number_format($selling->amount, '3');
                            $t_diff = $selling->amount - ($selling->price + $selling->give_cash);
                        @endphp
                        <td>{{ $selling->pump_name }}</td>
                        <td>{{ $selling->user_name }}</td>
                        <td>{{ number_format($selling->price, '3') }}</td>
                        <td>{{ number_format($selling->give_cash, '3') }}</td>
                        <td>{{ number_format($t_sale, '3') }}</td>
                        <td>{{ $t_amount }}</td>
                        <td>{{ number_format($t_diff, '3') }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table><br>
    {{-- {{dd($total_sales_by_meter)}} --}}
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
