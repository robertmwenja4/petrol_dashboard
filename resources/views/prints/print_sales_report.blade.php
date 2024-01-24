<html>

<head>
    <title>
        {{ 'Sales Report' }}
    </title>
    {{-- <style>
		body {
			font-family: "Times New Roman", Times, serif;
			font-size: 10pt;
		}
		table {
			font-family: "Myriad Pro", "Myriad", "Liberation Sans", "Nimbus Sans L", "Helvetica Neue", Helvetica, Arial, sans-serif
;
			font-size: 10pt;
		}
		table thead td {
			background-color: #BAD2FA;
			text-align: center;
			border: 0.1mm solid black;
			font-variant: small-caps;
		}
		td {
			vertical-align: top;
		}
		.bullets {
			width: 8px;
		}
		.items {
			border-bottom: 0.1mm solid black;
			font-size: 10pt;
			border-collapse: collapse;
			width: 100%;
			font-family: sans-serif;
		}
		.items td {
			border-left: 0.1mm solid black;
			border-right: 0.1mm solid black;
		}

		.align-r {
			text-align: right;
		}
		.align-c {
			text-align: center;
		}
		.bd {
			border: 1px solid black;
		}
		.bd-t {
			border-top: 1px solid
		}
		.ref {
			width: 100%;
			font-family: serif;
			font-size: 10pt;
			border-collapse: collapse;
		}
		.ref tr td {
			border: 0.1mm solid #888888;
		}
		.ref tr:nth-child(2) td {
			width: 50%;
		}
		.customer-dt {
			width: 100%;
			font-family: serif;
			font-size: 10pt;
		}
		.customer-dt tr td:nth-child(1) {
			border: 0.1mm solid #888888;
		}
		.customer-dt tr td:nth-child(3) {
			border: 0.1mm solid #888888;
		}
		.customer-dt-title {
			font-size: 7pt;
			color: #555555;
			font-family: sans;
		}
		.doc-title-td {
			text-align: center;
			width: 100%;
		}
		.doc-title {
			font-size: 15pt;
			color: #0f4d9b;
		}
		.doc-table {
			font-size: 10pt;
			margin-top:5px;
			width: 100%;
		}

		.header-table {
			width: 100%;
			border-bottom: 0.8mm solid #0f4d9b;
		}
		.header-table tr td:first-child {
			color: #0f4d9b;
			font-size: 9pt;
			width: 60%;
			text-align: left;
		}
		.address {
			color: #0f4d9b;
			font-size: 10pt;
			width: 40%;
			text-align: right;
		}
		.header-table-text {
			color:#0f4d9b;
			font-size:9pt;
			margin: 0;
		}
		.header-table-child {
			color:#0f4d9b;
			font-size:8pt;
		}
		.header-table-child tr:nth-child(2) td {
			font-size:9pt;
			padding-left:50px;
		}
		.footer {
			font-size: 9pt;
			text-align: center;
		}
		.items-table {
			font-size: 7pt;
			border-collapse: collapse;
			height: 700px;
			width: 100%;
		}
		table, th, td {
            border: 0.5px solid;
        }
	</style> --}}
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 8pt;
            margin: 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            line-height: 12px;
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

        .f-size {
            font-size: 18px;
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

    <div style="width:100%">
        <div style="float:left;width:30%"> <img src="{{ url('storage/img/company/oxyr.jpg') }}" style="width:200px;"></div>
        <div style="float:left;width:70%">
            <h2 style="padding-top:25px;margin-left:5px;text-transform: uppercase;">Fuel Sales Day Book from
                {{ date('d/m/Y', strtotime($date_from)) . ' to ' . date('d/m/Y', strtotime($date_to)) }}</h2>
        </div>

    </div>





    <br>
    <table class="items" cellpadding="0">
        <thead>
            <tr>
                <td width="15%">Fuel Inv</td>
                <td width="8%">Sale No.</td>
                <td width="18%">Date & Time</td>
                <td width="20%">Customer</td>
                <td width="10%">Item</td>
                <td width="12%">Quantity</td>
                <td width="15%">Amount</td>
            </tr>
        </thead>
        <tbody>
            @php
                $total_price = 0;
                $total_qty = 0;
            @endphp
            @foreach ($sales as $i => $sale)
                <tr>
                    @php
                        $total_price += $sale->total_price;
                        $total_qty += $sale->qty;
                        $timestamp = $sale->created_at;
                        $date = date('d/m/Y', strtotime($timestamp));
                        $time = date('h:i A', strtotime($timestamp));
                        $date_time = $date . ' ' . $time;
                    @endphp
                    <td>{{ $sale->lpo_no }}</td>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $date_time }}</td>
                    <td>{{ $sale->customer ? $sale->customer->company : '' }}</td>
                    <td>{{ $sale->product ? $sale->product->name : '' }}</td>
                    <td>{{ number_format($sale->qty, '3') }}</td>
                    <td>{{ number_format($sale->total_price, '3') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="bd-t" rowspan="2">Total Invoice: {{ $sales->count() }}</td>
                <td class="bd-t">{{ number_format($total_qty, '3') }}</td>
                <td class="bd-t">{{ number_format($total_price, '3') }}</td>
            </tr>
        </tbody>
    </table><br>
    <h4>Day Book Summary by Attendant</h4>
    <table class="items-table" cellpadding="0">
        <thead>
            <tr>
                <td width="20%">User</td>
                <td width="10%">Pump</td>
                <td width="25%">Sales Date</td>
                <td width="10%">Super/Diesel</td>
                <td width="8%">Item</td>
                <td width="12%">Quantity</td>
                <td width="15%">Amount</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td rowspan="{{ $user->sales->count() + 1 }}">{{ $user->name }}</td>
                </tr>
                @foreach ($user->sales as $sale)
                    <tr>
                        @php
                            $timestamp = $sale->created_at;
                            $date = date('d/m/Y', strtotime($timestamp));
                            $time = date('h:i A', strtotime($timestamp));
                            $date_time = $date . ' ' . $time;
                        @endphp
                        <td>{{ @$sale->pump->name }}</td>
                        <td>{{ $date_time }}</td>
                        <td>{{ @$sale->product->description }}</td>
                        <td>{{ @$sale->product->name }}</td>
                        <td>{{ number_format($sale->qty, '3') }}</td>
                        <td>{{ number_format($sale->total_price, '3') }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td class="bd-t" colspan="5"></td>
                    <td class="bd-t">{{ number_format($user->sales->sum('qty'), '3') }}</td>
                    <td class="bd-t">{{ number_format($user->sales->sum('total_price'), '3') }}</td>
                </tr>
            @endforeach
            <tr>
                <td class="bd-t" colspan="5"></td>
                <td class="bd-t">{{ number_format($users->pluck('sales')->flatten()->sum('qty'),'3') }}</td>
                <td class="bd-t">{{ number_format($users->pluck('sales')->flatten()->sum('total_price'),'3') }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
