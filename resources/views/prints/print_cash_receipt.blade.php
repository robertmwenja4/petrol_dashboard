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

            #top .logo {
                /* float: left; */
                height: 60px;
                width: 60px;
                /* background: url(http://michaeltruong.ca/images/logo1.png) no-repeat; */
                background-size: 60px 60px;
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
            <!-- <div class="logo"></div> -->
            <div class="info">
                <p>CASH RECEIPT NO : {{ gent4tid('RC-',$cash->tid) }}</p>
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
        <!-- Date and Time -->
        <div>
            @php
                $timestamp = $cash->created_at;
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
        <br>
        <!-- Sale Details -->
        <div>
            <table class="start">
                <tr>
                    <td width="70%">ATTENDANT</td>
                    <td class="end" width="30%" style="font-size: 15px">{{ ucfirst($cash->user->name) }}</td>
                </tr>
            </table>
        </div>
        <br>
        <div>
            <table class="start">
                <tr>
                    <td width="66%">SHIFT</td>
                    <td class="start" width="50%">{{ $cash->shift->shift_name }}</td>
                </tr>
            </table>
        </div>
        <br>
        <div>
            <table class="start">
                <tr>
                    <td width="66%">PUMP</td>
                    <td class="start" width="50%">{{ $cash->pump->code }}</td>
                </tr>
            </table>
        </div>
        <!-- End of Sales -->
        <!-- Sum Totals -->
        <br />
        <div>
            <table class="start">
                <tr>
                    <td width="66%">TOTAL AMOUNT</td>
                    <td class="start" width="50%">{{ number_format(floatval($cash->amount), 2) }}</td>
                </tr>
            </table>
        </div>
        <!-- End of sum totals -->
        <div id="bot">
            <div id="legalcopy">
                <p class="descrip">
                    THANK YOU!!
                </p>
            </div>
        </div>
    </div>
    <!--End Invoice-->
</body>

</html>
