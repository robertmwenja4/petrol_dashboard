<html>
<head>
	<title>
		{{'Sales Report'}}
	</title>
	<style>
		body {
			font-family: "Times New Roman", Times, serif;
			font-size: 10pt;
		}
	
		table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
        .item{
            background: grey;
        }
        .align_c{
            align-items: center;
            text-align: center;
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
	<table class="header-table">
		<tr>
			<td>
				<img src="{{ Storage::disk('public')->url('app/public/img/company/oxyr.jpg') }}" style="object-fit:contain" width="100%"/>
			</td>
		</tr>
	</table>
    <h4 class="align_c">Shift Ends at <span>{{$shift->close_shift->created_at}}</span></h4>
    <table class="items">
        <thead>
            <tr>
                <th>Details</th>
                @foreach ($close_shift_item_diesel as $item)
                    <th>{{@$item->nozzle->code}}</th>
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
                    <th>{{@$item->current_stock}}</th>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Opening</td>
                @foreach ($close_shift_item_diesel as $item)
                    <th>{{@$item->open_stock}}</th>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Sales</td>
                @foreach ($close_shift_item_diesel as $item)
                @php
                    $total_diff +=$item->balance;
                @endphp
                    <th>{{@$item->balance}}</th>
                @endforeach
                <td>{{$total_diff}}</td>
            </tr>
        </tbody>
    </table><br>
    <table class="items">
        <thead>
            <tr>
                <th>Details</th>
                @foreach ($close_shift_item_petrol as $item)
                    <th>{{@$item->nozzle->code}}</th>
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
                    <th>{{@$item->current_stock}}</th>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Opening</td>
                @foreach ($close_shift_item_petrol as $item)
                    <th>{{@$item->open_stock}}</th>
                @endforeach
                <td></td>
            </tr>
            <tr>
                <td>Sales</td>
                @foreach ($close_shift_item_petrol as $item)
                @php
                    $total_super_diff += $item->balance;
                @endphp
                    <th>{{@$item->balance}}</th>
                @endforeach
                <td>{{$total_super_diff}}</td>
            </tr>
        </tbody>
    </table><br>

    <table border="1">
        <thead>
            <tr>
                <th width="10%">Pump</th>
                <th width="15%">User</th>
                <th width="15%">Credit Sale</th>
                <th width="15%">Given Cash</th>
                <th width="20%">Total Sale(A)</th>
                <th width="20%">Sale By Meter(B)</th>
                <th width="10%">Diff(B-A)</th>
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
                        $diff = $selling->amount-($selling->price+$selling->give_cash);
                       $total_sales_by_meter += $selling->amount;
                       $credit_sale += $selling->price;
                       $balance += $diff;
                       $total_cash += $selling->give_cash;
                    @endphp
                        <td>{{$selling->pump_name}}</td>
                        <td>{{$selling->user_name}}</td>
                        <td>{{$selling->price}}</td>
                        <td>{{$selling->give_cash}}</td>
                        <td>{{$selling->price+$selling->give_cash}}</td>
                        <td>{{$selling->amount}}</td>
                        <td>{{$selling->amount-($selling->price+$selling->give_cash)}}</td>
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
                <th><em>{{$total_sales_by_meter}}</em></th>
                <th>Diff(Total)</th>
                <th>{{$balance}}</th>
            </tr>
            <tr>
                <th>Credit Totals</th>
                <th><em>{{$credit_sale}}</em></th>
                <th>CASH TOTALS</th>
                <th><em>{{$total_cash}}</em></th>
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
                    <td>{{$sale->user_name}}</td>
                    <td>{{$sale->pump_name}}</td>
                    <td>{{$sale->sales_date}}</td>
                    <td>{{$sale->product_name}}</td>
                    <td>{{ucfirst($sale->sales_type)}}</td>
                    <td>{{$sale->qty}}</td>
                    <td>{{$sale->amount}}</td>
                   </tr>
                   <tr>
                    <td colspan="4"></td>
                    <td>Actual</td>
                    <td>{{$sale->actual_qty}}</td>
                    <td>{{$sale->actual_amount}}</td>
                   </tr>
                   <tr class="item">
                    <td colspan="4"></td>
                    <td>Diff</td>
                    <td>{{$sale->qty_diff}}</td>
                    <td>{{$sale->amt_diff}}</td>
                   </tr>
                @endforeach
            @endforeach
        </tbody>
    </table><br>
    

</body>
</html>