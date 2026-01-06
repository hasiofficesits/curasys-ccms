<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
    header('Access-Control-Allow-Methods:  GET')
?>
<html>
<?php header('Content-type: text/html; charset=UTF-8') ; ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
    <style>
        /* @font-face {
            font-family: Noto-2;
            font-display: block;
            src: url({{ asset('fonts/NotoSerifSinhala-Light.ttf') }}) format("truetype");
        } */
        table *{
            padding: 0;
            margin: 0;
            padding-left:2px;
            padding-right:2px;
        }

        @page {
            margin: 50px 20px;
        }

        #header {
            position: fixed;
            top: -82px;
            width: 100%;
            height: 109px;
            background: #aaa url("path/to/logo.png") no-repeat right;
        }

        #content {
            width: 100%;
            height: 100%;
            background-color: #d1d977;
        }

        footer {
            position: fixed;
            bottom: -65px;
            height: 30px;
            background-color: #333399;
        }

        footer .page-number {
            text-align: center;
        }

        .page-number:before {
            content: "Seite "counter(page);
        }

        .text-center {
            text-align: center;
        }

        .show_border {
            border: 1px solid #000;
        }

        #logo {
            /* border: 1px solid #000; */
            display: inline-block;
            position: relative;
            /* top:8px; */
        }

        .text-header {
            font-size: 6mm;
        }

        .text-header-sub {
            font-size: 3mm;
        }

        .text-sm {
            font-size: 12px;
        }

        .content-text {
            font-size: 13px;
        }

        .inv_table table,
        .inv_table th {
            border: 1px solid black;
        }

        .inv_table td {
            border-left: 1px solid black;
            border-right: 1px solid black;
        }

        .page-break {
            page-break-after: always;
        }

        .brke {
            page-break-inside: avoid !important;
        }

        .font-reduce{
            font-size: 13px;
        }
        /* @font-face {
            font-family: 'Noto Sans Sinhala';
            font-style: normal;
            font-weight: 400;
            src: url('http://127.0.0.1:8000/Iskoola Pota Regular.ttf') format('true-type');
        } */
    </style>
    {{-- <link href="'http://127.0.0.1:8000/Iskoola Pota Regular.ttf" rel="stylesheet" /> --}}
</head>

<body>
    {{-- <div class=" mt-3 mx-4" style="position: relative">
            <table border="0" width="100%">
                <tr>

                </tr>
            </table>
            <hr>
        </div> --}}
    <div style="position: absolute; top:10px; left:10px;">
        {{-- <img src="http://aa-rk-demo.sapms.com/images/black_backg.png" width="80px"> --}}
        {{-- <img src="http://aa-rk-demo.sapms.com/images/white_backg.png" width="80px"> --}}
    </div>

    <div style="position: relative;">
        <table style="border: 1px solid #000; background-color:#2ecc71;" width="100%">

            <tr class="text-white">
                <td class="text-center">
                    <h3 class="text-header" style="font-size: 20px">{{ $company->com_name }}</h3>
                    <p class="text-header-sub">{{ $company->com_add1 }}</p>
                    @if ($company->com_add2)
                        <p class="text-header-sub">{{ $company->com_add2 }}</p>
                    @endif
                    <p class="text-header-sub">{{ $company->com_add3 }}</p>
                    <p class="text-header-sub"><b>Tel: {{ $company->com_tel }} email:
                            {{ $company->com_email }}</b></p>

                    <p style="margin-top: 25px; margin-bottom: 1px;"><b><u>RETURN NOTE</u></b></p>
                </td>

            </tr>
        </table>

        <table width="100%" style="border: 1px solid #000;">
            <tr class="font-reduce">
                <td width="50%" width="100%">
                    <p><b>Return Note Details:</b></p>
                    <table style="margin-top:0px;" width="100%">
                        <tr>
                            <th style="text-align: left">Note ID</th>
                            <th style="text-align: left">Date</th>
                            <th style="text-align: left">Supplier</th>
                            <th style="text-align: left">Type</th>
                        </tr>
                        <tr>
                            <td style="text-align: left;width:150px">{{ $return->ID }}</td>
                            <td style="text-align: left">{{ $return->Date }}</td>
                            <td style="text-align: left">{{ $return->supplier->Company }}</td>
                            <td style="text-align: left">{{ $return->Type }}</td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <div style="page-break-after:auto;">
            <table class="inv_table font-reduce" width="100%" style="border: 1px solid #000; border-spacing: 0;">
                <thead>
                    <tr>
                        <th>CODE</th>
                        <th>NAME</th>
                        <th>EXP</th>
                        <th>RATE</th>
                        <th>QTY</th>
                        <th>AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $net=0; ?>
                    @if ($return_body)

                    @foreach ($return_body as $item)
                        <tr>
                            <td>{{ $item->item->Code }}</td>
                            <td>{{ $item->item->Pharma_name }}</td>

                            <td style="text-align: right;">{{ $item->ExpDate }}</td>
                            @if ($item->Cost)
                                <td style="text-align: right">{{ number_format(floatval($item->Cost),  2, '.', ',') }}</td>
                            @else
                                <td style="text-align: right">{{ number_format(0,  2, '.', ',') }}</td>
                            @endif

                            <td style="text-align: right; width:40px">{{ $item->Qty }}</td>

                            @if ($item->Total)
                                <td style="text-align: right">{{ number_format(floatval($item->Total),  2, '.', ',') }}</td>
                            @else
                                <td style="text-align: right">{{ number_format(0, 2, '.', ',') }}</td>
                            @endif
        
                        </tr>
                    @endforeach

                            @if(count($return_body)<=15)
                                @for ($i = 0; $i < 15-count($return_body); $i++)
                                    <tr>
                                        <td style="text-align: right;"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right;color:white;">`</td>
                                    </tr>
                                @endfor
                            @endif
                    @endif
                    <tr>
                        <td class="text-center" colspan="5" style="padding-bottom:5px; border:1px solid #000; text-align: right; vertical-align: bottom;">
                            <span>Total</span>
                        </td>

                        <td style="border:1px solid #000;text-align: right;">{{ number_format($return->Total, 2, ".", ",") }}</td>
                    </tr>

                    <tr>
                        <td class="text-center" colspan="5" rowspan="1" style="border-bottom:1px solid #000;  text-align: right; vertical-align: bottom;">
                            <span>Balance</span>
                        </td>

                        <td style="border:1px solid #000;text-align: right;">{{ number_format($return->Balance, 2, ".", ",") }}</td>
                    </tr>

                </tbody>
            </table>
            <table class="font-reduce" style="border: 1px solid #000" width="100%">
                <tr>
                     <?php date_default_timezone_set('Asia/Colombo'); ?>
                    <td>
                        <p>Cashier Details:</p>
                        @if($return->CreateTo)
                            <p>Prepared By: {{ $return->CreateTo }}</p>
                        @else
                            @if(Auth::user())
                            <p>Prepared By: {{ Auth::user()->Name }}</p>
                            @else
                            <p>Prepared By: Admin</p>
                            @endif
                        @endif
                        <p>Date Time: </p>
                        <p>{{ date('d-m-Y', strtotime($return->Date)) }}</p>
                    </td>
                </tr>

                <tr>
                <td style="text-align: right">{{ $company->com_name }}</td>
            </tr>
            </table>

        </div>

</body>

</html>
