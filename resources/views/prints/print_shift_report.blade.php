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
				{{-- <img src="{{ Storage::disk('public')->url('app/public/img/company/' . $company->logo) }}" style="object-fit:contain" width="100%"/> --}}
			</td>
		</tr>
	</table>
	<table class="items">
		<tr>
			<td>
				<span class='doc-title'>
					<b>Shift</b>
				</span>				
			</td>
		</tr>
	</table><br>
    <table class="items">
        <thead>
            <tr>
                <th>Details</th>
                @foreach ($close_shift_item_diesel as $item)
                    <th>{{@$item->nozzle->code}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Closing</td>
                @foreach ($close_shift_item_diesel as $item)
                    <th>{{@$item->current_stock}}</th>
                @endforeach
            </tr>
            <tr>
                <td>Opening</td>
                @foreach ($close_shift_item_diesel as $item)
                    <th>{{@$item->open_stock}}</th>
                @endforeach
            </tr>
            <tr>
                <td>Sales</td>
                @foreach ($close_shift_item_diesel as $item)
                    <th>{{@$item->balance}}</th>
                @endforeach
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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Closing</td>
                @foreach ($close_shift_item_petrol as $item)
                    <th>{{@$item->current_stock}}</th>
                @endforeach
            </tr>
            <tr>
                <td>Opening</td>
                @foreach ($close_shift_item_petrol as $item)
                    <th>{{@$item->open_stock}}</th>
                @endforeach
            </tr>
            <tr>
                <td>Sales</td>
                @foreach ($close_shift_item_petrol as $item)
                    <th>{{@$item->balance}}</th>
                @endforeach
            </tr>
        </tbody>
    </table><br>

</body>
</html>
