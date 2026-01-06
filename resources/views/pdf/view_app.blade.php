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
        <table style="border: 1px solid #000; background-color:#3dbdec;" width="100%">

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

                    <p style="margin-top: 25px; margin-bottom: 1px;"><b><u>APPOINTMENT DOCUMENT</u></b></p>
                </td>

            </tr>
        </table>

        <table width="100%" style="border: 1px solid #000;">
            <tr class="font-reduce">
                <td width="50%" width="100%">
                    <p><b>Appointment Details:</b></p>
                    <table style="margin-top:0px;" width="100%">
                        <tr>
                            <th style="text-align: left">Appointment Number</th>
                            <th style="text-align: left">Date</th>
                            <th style="text-align: left">Patient</th>
                            <th style="text-align: left">Doctor</th>
                        </tr>
                        <tr>
                            <td style="text-align: left;width:150px">{{ $appointment->ID }}</td>
                            <td style="text-align: left">{{ $appointment->Date }}</td>
                            <td style="text-align: left">{{ $appointment->patient->FullName }}</td>
                            @if ($appointment->doctor->Name)
                                <td style="text-align: left">{{ $appointment->doctor->Name }}</td>
                            @endif
                        </tr>
                        <tr></tr>
                        <tr></tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <div style="page-break-after:auto;">
            <p><b>Prescription</b></p>
            <table class="inv_table font-reduce" width="100%" style="border: 1px solid #000; border-spacing: 0;">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>DOSE</th>
                        <th>FREQUENCY</th>
                        <th>PERIOD</th>
                        <th>QTY</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($pres_body)

                        @foreach ($pres_body as $item)
                            <tr>
                                <td>{{ $item->item->Pharma_name }}</td>

                                @if ($item->Dose)
                                    <td style="text-align: right">{{ number_format(floatval($item->Dose),  2, '.', ',') }}</td>
                                @else
                                    <td style="text-align: right">{{ number_format(0,  2, '.', ',') }}</td>
                                @endif

                                @if ($item->Freq)
                                    <td style="text-align: right">{{ number_format(floatval($item->Freq),  2, '.', ',') }}</td>
                                @else
                                    <td style="text-align: right">{{ number_format(0, 2, '.', ',') }}</td>
                                @endif

                                @if ($item->Period)
                                    <td style="text-align: right">{{ number_format(floatval($item->Period),  2, '.', ',') }}</td>
                                @else
                                    <td style="text-align: right">{{ number_format(0, 2, '.', ',') }}</td>
                                @endif

                                @if ($item->Qty)
                                    <td style="text-align: right">{{ number_format(floatval($item->Qty),  2, '.', ',') }}</td>
                                @else
                                    <td style="text-align: right">{{ number_format(0,  2, '.', ',') }}</td>
                                @endif
            
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>

            <p><b>Service List</b></p>
            <table class="inv_table font-reduce" width="100%" style="border: 1px solid #000; border-spacing: 0;">
                <thead>
                    <tr>
                        <th>SERVICE</th>
                        <th>QTY</th>
                        <th>RATE</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($service)

                        @foreach ($service as $item)
                            <tr>
                                <td>{{ $item->Description }}</td>

                                @if ($item->Qty)
                                    <td style="text-align: right">{{ number_format(floatval($item->Qty),  2, '.', ',') }}</td>
                                @else
                                    <td style="text-align: right">{{ number_format(0,  2, '.', ',') }}</td>
                                @endif

                                @if ($item->Unit_Price)
                                    <td style="text-align: right">{{ number_format(floatval($item->Unit_Price),  2, '.', ',') }}</td>
                                @else
                                    <td style="text-align: right">{{ number_format(0, 2, '.', ',') }}</td>
                                @endif

                                @if ($item->Total)
                                    <td style="text-align: right">{{ number_format(floatval($item->Total),  2, '.', ',') }}</td>
                                @else
                                    <td style="text-align: right">{{ number_format(0,  2, '.', ',') }}</td>
                                @endif
            
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>

            <p><b>Clinical Notes</b></p>
            <table class="inv_table font-reduce" width="100%" style="border: 1px solid #000; border-spacing: 0;">
                <thead>
                    <tr>
                        <th>TYPE</th>
                        <th>NOTE</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($note_body)

                        @foreach ($note_body as $item)
                            <tr>
                                <td>{{ $item->Type }}</td>
                                <td>{{ $item->Description }}</td>
            
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>

            <p><b>Investigation Results</b></p>
            @if ($result)
            <p><b>Result Details:</b></p>
                @foreach ($result as $value)
                    <table style="margin-top:0px;" width="100%">
                        <tr class="font-reduce">
                            <th style="text-align: left">Date</th>
                            <th style="text-align: left">MLT</th>
                            <th style="text-align: left">Type</th>
                        </tr>
                        <tr class="font-reduce">
                            <td style="text-align: left;width:150px">{{ $value->Date }}</td>
                            <td style="text-align: left">{{ $value->Mlt }}</td>
                            <td style="text-align: left">{{ $value->Ix }}</td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                        @if ($ix_body)
                            <table class="inv_table font-reduce" width="100%" style="border: 1px solid #000; border-spacing: 0;">
                                <thead>
                                    <tr>
                                        <th>TYPE</th>
                                        <th>NARRATION</th>
                                        <th>RESULT</th>
                                        <th>NORMAL RANGE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($ix_body as $item)
                                            @if ($value->Id == $item->Ix_id)
                                                <tr>
                                                    <td>{{ $item->Type }}</td>
                                                    <td>{{ $item->Narration }}</td>
                                                    <td>{{ $item->Results }}</td>
                                                    <td>{{ $item->Normal_range }}</td>
                                
                                                </tr>
                                            @endif
                                        @endforeach
                                </tbody>
                            </table>
                        @endif
                    </table>
                @endforeach
            @endif

        </div>

</body>

</html>
