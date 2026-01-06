<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
    header('Access-Control-Allow-Methods:  GET')
?>
<html>
<?php header('Content-type: text/html; charset=UTF-8') ; ?>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    <style>
        /* @font-face {
            font-family: Noto-2;
            font-display: block;
            src: url(<?php echo e(asset('fonts/NotoSerifSinhala-Light.ttf')); ?>) format("truetype");
        } */
        table *{
            padding: 0;
            margin: 0;
            padding-left:2px;
            padding-right:2px;
        }

        @page  {
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
    
</head>

<body>
    
    <div style="position: absolute; top:10px; left:10px;">
        
        <img src="http://aa-rk-demo.sapms.com/images/white_backg.png" width="80px">
    </div>

    <div style="position: relative;">
        <table style="border: 1px solid #000;" width="100%">

            <tr>
                <td class="text-center">
                    <h3 class="text-header" style="font-size: 20px"><?php echo e($company->mas_com_name); ?></h3>
                    <p class="text-header-sub"><?php echo e($company->mas_com_add1); ?></p>
                    <?php if($company->mas_com_add2): ?>
                        <p class="text-header-sub"><?php echo e($company->mas_com_add2); ?></p>
                    <?php endif; ?>
                    <p class="text-header-sub"><?php echo e($company->mas_com_add3); ?></p>
                    <p class="text-header-sub"><b>Tel: <?php echo e($company->mas_com_tel); ?> email:
                            <?php echo e($company->mas_com_email); ?></b></p>

                    <p style="margin-top: 25px; margin-bottom: 1px;"><b><u>BILL</u></b></p>
                </td>

            </tr>
        </table>

        

            
        
        <div style="page-break-after:auto;">
            <table class="inv_table font-reduce" width="100%" style="border: 1px solid #000; border-spacing: 0;">
                <thead>
                    <tr>
                        
                        <th>Description</th>
                        <th>Discount</th>
                        <th>Rate</th>
                        <th>Qty</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $net=0; ?>
                    <?php if($invo_body): ?>

                    <?php $__currentLoopData = $invo_body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->item_description); ?></td>
                            <td style="text-align: right"><?php echo e($item->dis_val); ?></td>

                            <?php if($item->rate): ?>
                                <td style="text-align: right"><?php echo e(number_format(floatval($item->rate),  2, '.', ',')); ?></td>
                            <?php else: ?>
                                <td style="text-align: right"><?php echo e(number_format(0,  2, '.', ',')); ?></td>
                            <?php endif; ?>

                            <td style="text-align: right; width:40px"><?php echo e($item->qty); ?></td>

                            <?php if($item->total): ?>
                                <td style="text-align: right"><?php echo e(number_format(floatval($item->total),  2, '.', ',')); ?></td>
                            <?php else: ?>
                                <td style="text-align: right"><?php echo e(number_format(0, 2, '.', ',')); ?></td>
                            <?php endif; ?>
        
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if(count($invo_body)<=15): ?>
                                <?php for($i = 0; $i < 15-count($invo_body); $i++): ?>
                                    <tr>
                                        <td style="text-align: right;"></td>
                                        <td></td>
                                        <td></td>
                                        <td style="text-align: right;color:white;">`</td>
                                    </tr>
                                <?php endfor; ?>
                            <?php endif; ?>
                    <?php endif; ?>
                    <tr>
                        <td class="text-center" colspan="4" style="padding-bottom:5px; border:1px solid #000; text-align: right; vertical-align: bottom;">
                            <span>Net</span>
                        </td>

                        <td style="border:1px solid #000;text-align: right;"><?php echo e(number_format($invoice->net, 2, ".", ",")); ?></td>
                    </tr>

                    <tr>
                        <td class="text-center" colspan="4" rowspan="1" style="border-bottom:1px solid #000;  text-align: right; vertical-align: bottom;">
                            <span>Discount</span>
                        </td>

                        <td style="border:1px solid #000;text-align: right;"><?php echo e(number_format($invoice->dis_val, 2, ".", ",")); ?></td>
                    </tr>
                    
                    <tr>
                        <td class="text-center" colspan="4" rowspan="1" style=" text-align: right; border-bottom:1px solid #000; vertical-align: bottom;">
                            <span>Service Charges</span>
                        </td>

                        <?php if($invoice->service_charges): ?>
                            <td style="text-align: right; border-bottom:1px solid #000;"><?php echo e(number_format($invoice->service_charges, 2, ".", ",")); ?></td>
                        <?php else: ?>
                            <td style="text-align: right; border-bottom:1px solid #000;">0.00</td>
                        <?php endif; ?>

                    </tr>

                    <tr>
                        <td class="text-center" colspan="4" rowspan="1" style="padding-bottom:5px; text-align: right; border-bottom:1px solid #000; vertical-align: bottom;">
                            <span>Gross</span>
                        </td>

                        <?php if($invoice->gross): ?>
                            <td style="text-align: right; border-bottom:1px solid #000;"><?php echo e(number_format($invoice->gross, 2, ".", ",")); ?></td>
                        <?php else: ?>
                            <td style="text-align: right; border-bottom:1px solid #000;">0.00</td>
                        <?php endif; ?>

                    </tr>

                </tbody>
            </table>
            <table class="font-reduce" style="border: 1px solid #000" width="100%">
                <tr>
                     <?php date_default_timezone_set('Asia/Colombo'); ?>
                    <td>
                        <p>Cashier Details:</p>
                        <?php if($invoice->prepared_by): ?>
                            <p>Prepared By: <?php echo e($invoice->prepared_by); ?></p>
                        <?php else: ?>
                            <?php if(Auth::user()): ?>
                            <p>Prepared By: <?php echo e(Auth::user()->Name); ?></p>
                            <?php else: ?>
                            <p>Prepared By: Admin</p>
                            <?php endif; ?>
                        <?php endif; ?>
                        <p>Date Time: </p>
                        <p><?php echo e(date('d-m-Y', strtotime($invoice->date))); ?></p>
                    </td>
                </tr>

                
            </table>

        </div>

</body>

</html>
<?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/pdf/invoice_pdf.blade.php ENDPATH**/ ?>