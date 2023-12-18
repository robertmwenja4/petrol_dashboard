<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=auto initial-scale=1.0" />
    <title>Oryx</title>
    <style>
        #invoice-Receipt {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 78mm;
            background: #fff;
            text-align: center;

            h1 {
                font-size: 1.5em;
                color: #222;
            }

            h2 {
                font-size: 0.9em;
            }

            h3 {
                font-size: 1.2em;
                font-weight: 300;
                line-height: 2em;
            }

            p {
                font-size: 0.7em;
                color: #666;
                line-height: 1.2em;
            }

            #top,
            #mid,
            #top {
                min-height: 100px;
            }

            #mid {
                min-height: 80px;
            }


            .clientlogo {
                float: left;
                height: 60px;
                width: 60px;
                /* background: url(http://michaeltruong.ca/images/client.jpg) no-repeat; */
                background-size: 60px 60px;
                border-radius: 50px;
            }

            .info {
                display: block;
                /* float:left; */
                margin-left: 0;
            }

            .title {
                float: right;
            }

            .title p {
                text-align: right;
            }
        }

        #bot {
            min-height: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .service {
            border-bottom: 2px dotted #000;
        }

        .item {
            width: 24mm;
        }

        .itemtext {
            font-size: 0.5em;
        }

        #legalcopy {
            margin-top: 5mm;
        }

        .start {
            text-align: start;
        }

        .descrip {
            margin-bottom: 20px;
            /* Adjust the value as needed */
            line-height: 1.5;
            /* Adjust the line height as needed */
        }

        .saledescrip {
            margin-bottom: 20px;
            /* Adjust the value as needed */
            line-height: 1.5;
            font-size: 13.5px
        }

        .rule {
            border: none;
            border-top: 2px dotted #1b1a1a;
        }

        .customer-table {
            width: 100%;
        }

        .end {
            text-align: end;
        }

        .pump {
            margin-left: 20px;
        }
    </style>
</head>

<body>
    <div id="invoice-Receipt">
        <div id="top">
            <div><img src="{{ url('storage/img/company/oxyr.jpg') }}" style="width:200px;"></div>
            <div class="info">
                <p>DELIVERY NOTE NO : {{ gen4tid('DN-', $sale->tid) }}</p>
            </div>
            <!-- End Info -->
        </div>
        <!-- End InvoiceTop -->
        <!-- Company Details -->
        <div id="mid">

            <div class="info">
                <p class="descrip">
                    Clock Tower Service Station Ltd<br />
                    P.O. Box 391, Arusha, Tanzania<br />
                </p>
            </div>
        </div>
        <!--End Company Details-->
        <div class="rule"></div>

        <!-- Customer Details -->
        <div id="customerTbl" class="start">
            <table class="customer-table">
                <tbody>
                    <tr>
                        <td width="50%">
                            <p class="saledescrip">
                                {{-- CASH <br /> --}}
                                Name: <b>{{ $sale->customer ? $sale->customer->company : '' }}</b><br>
                                LPO NO: <b>{{ strtoupper($sale->lpo_no) }}</b> <br />
                                VRN: <b>{{ strtoupper($sale->vrn_no) }} </b><br />
                                VEHICLE: <b>{{ strtoupper($sale->vehicle_no) }} </b><br />

                                DRIVER: <b>{{ strtoupper($sale->driver) }}</b> <br />
                            </p>
                        </td>
                        <td width="50%">
                            <p class="saledescrip">
                                TIN: <b>{{ strtoupper($sale->tin_no) }}</b> <br />

                                MILEAGE: <b>{{ $sale->mileage }} KM</b> <br />
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Customer Details -->
        <div class="rule"></div>

        <!-- Date and Time -->
        <div>
            @php
                $timestamp = $sale->created_at;
                $date = date('Y-m-d', strtotime($timestamp));
                $time = date('h:i A', strtotime($timestamp));
            @endphp
            <table class="start">
                <tbody>
                    <tr>
                        <td width="50%">
                            <p>Date: {{ $date }}</p>
                        </td>
                        <td width="50%">
                            <p>Time: {{ $time }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- End of Date and Time -->
        <div class="rule"></div>

        <!-- Sale Details -->
        <div>
            <table id="saleTbl" class="start">
                <tbody>
                    <tr class="service">
                        <td width="25%">
                            <p>ITEM</p>
                        </td>
                        <td width="25%">
                            <p>QTY</p>
                        </td>
                        <td width="25%">
                            <p>PRICE</p>
                        </td>
                        <td width="25%">
                            <p>TOTAL</p>
                        </td>
                    </tr>
                    <tr class="service">
                        <td width="25%">
                            <p>{{ strtoupper($sale->product->name) }}</p>
                        </td>
                        <td width="25%">
                            <p>{{ number_format(floatval($sale->qty), 3) }}</p>
                        </td>
                        <td width="25%">
                            <p>{{ number_format(floatval($sale->rate), 3) }}</p>
                        </td>
                        <td width="25%">
                            <p>{{ number_format(floatval($sale->total_price), 3) }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- End of Sales -->

        <!-- Sum Totals -->
        <br />
        <div>
            <table class="start">
                <tr>
                    <td width="50%">TOTAL AMOUNT</td>
                    <td class="end" width="50%">{{ number_format(floatval($sale->total_price), 3) }}</td>
                </tr>
                {{-- <tr>
                    <td width="50%">DISCOUNT</td>
                    <td class="end" width="50%">0.00</td>
                </tr>
                <tr>
                    <td width="50%">VAT</td>
                    <td class="end" width="50%">0.00</td>
                </tr> --}}
                {{-- <tr>
                    <td width="50%">NET AMOUNT DUE</td>
                    <td class="end" width="50%">{{ number_format(floatval($sale->total_price), 2) }}</td>
                </tr> --}}
            </table>
        </div>
        <!-- End of sum totals -->
        <br />
        <div id="bot">
            <div id="legalcopy">
                <p class="start descrip">
                    Attendant - {{ strtoupper($sale->user->name) }} <span
                        class="pump">{{ $sale->pump->code }}</span> <br />
                    THANK YOU - PLEASE COME AGAIN
                </p>
            </div>
        </div>
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->
</body>

</html>
