<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Authorization, Origin');
    header('Access-Control-Allow-Methods:  GET')
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        * {
            padding: 0;
            margin: 0;
        }

        #header {
            position: fixed;
            top: -82px;
            width: 100%;
            height: 109px;
            background: #aaa url("path/to/logo.png") no-repeat right;
        }

        .text-center {
            text-align: center;
        }

        .text-header {
            font-size: 8mm;
        }

        .text-header-sub {
            font-size: 4mm;
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

        .text-sm {
            font-size: 12px;
        }

        .main-title{
            font-size: 15px;
            font-weight: bold;
        }

        .content-text {
            font-size: 12px;
        }

        .font-reduce{
            font-size: 15px;
        }
        .font-reduce2{
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-2" style="position: relative; margin-top:5mm; margin-left:3mm; margin-right:3mm;">
        <table style="border-bottom:1px solid black" width="100%">

            <tr>
                <td class="text-center" style="padding: 0px;">
                    <h3 class="text-header" style="font-size: 20px; padding:0px;margin:0;"><?php echo e($company->com_name); ?></h3>
                    <p class="text-header-sub" style="padding: 0px;margin:0;"><?php echo e($company->com_add1); ?></p>
                    <?php if($company->com_add2): ?>
                        <p class="text-header-sub" style="padding: 0px;margin:0;"><?php echo e($company->com_add2); ?></p>
                    <?php endif; ?>
                    <p class="text-header-sub" style="padding: 0px;margin:0;"><?php echo e($company->com_add3); ?></p>
                    <p class="text-header-sub" style="padding: 0px;margin:0;margin-bottom:2px; font-size:12px;">Tel: <?php echo e($company->com_tel); ?> email: <?php echo e($company->com_email); ?></p>
                </td>

            </tr>
        </table>
        <p class="text-center main-title" style="margin: 0px">INVOICE</p>
        <table border="0" width="100%" class="content-text1 font-reduce2">
            <tr>
                <td style="width: 100px" colspan="2"><p class="mb-1 mt-2 content-text1"><b><u>Bill To</u></b></p></td>
            </tr>
            <tr>
                <td style="width: 50px">Name</td>
                <td>: <?php echo e($invoice->customer->FullName); ?></td>
            </tr>
        </table>
        <hr style="margin: 1px">
        <table border="0" width="100%" class="content-text1 font-reduce2">
            <tr>
                <td style="width: 50px" class="content-text1">Inv. No</td>
                <td>: <?php echo e($invoice->invno); ?></td>
                <td>Inv Date</td>
                <td>: <?php echo e(date('Y-M-d', strtotime($invoice->date))); ?></td>

            </tr>
            <tr>
                <td>Inv Type</td>
                <td>: <?php echo e($invoice->type); ?></td>
            </tr>
        </table>
        
        <table border="0" width="100%" style="margin-top:5mm;" class="content-text1 font-reduce2">
            <thead>
                <tr style="background-color: rgb(206, 206, 206)">
                    <th>ID</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $invoice_body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="font-reduce2">
                    <td><?php echo e($item->id); ?></td>

                    <td><?php echo e($item->description); ?></td>
                    <?php if($item->rate): ?>
                    <td ><?php echo e(number_format(floatval($item->rate),  2, '.', ',')); ?></td>
                    <?php else: ?>
                    <td ><?php echo e(number_format(0,  2, '.', ',')); ?></td>
                    <?php endif; ?>

                    <td><?php echo e($item->qty); ?></td>
                    <?php if($item->total): ?>
                        <td class="text-right"><?php echo e(number_format(floatval($item->total),  2, '.', ',')); ?></td>
                    <?php else: ?>
                        <td class="text-right"><?php echo e(number_format(0, 2, '.', ',')); ?></td>
                    <?php endif; ?>

                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr class="border-top border-dark" style="border-bottom: 2px double #000;">
                    <th colspan="3" class="text-right"></th>
                    <th  >Total</th>
                    <?php if($invoice->total): ?>
                    <td class="text-right"><?php echo e(number_format(floatval($invoice->total), 2, '.', ',')); ?></td>
                    <?php else: ?>
                    <td class="text-right"><?php echo e(number_format(0, 2, '.', ',')); ?></td>
                    <?php endif; ?>

                </tr>
            </tbody>
        </table>

        <table border="0" width="100%" class="font-reduce2 mt-3 content-text11">
            <tr>
                <td>Discount</td>
                <td class="text-right"><?php echo e(number_format(floatval($invoice->dis_val), 2, '.', ',')); ?></td>
            </tr>
            <tr>
                <td>Gross</td>
                <td class="text-right"><?php echo e(number_format(floatval($invoice->gross), 2, '.', ',')); ?></td>
            </tr>
            
            
            <tr style="border-bottom: 2px double #000;">
                <td>Grand Total</td>
                <td class="text-right"><?php echo e(number_format($invoice->gross, 2, '.', ',')); ?></td>
            </tr>

            <tr style="border-bottom: 1px solid #000;">
                <td>Paid Amount</td>
                <td class="text-right"><?php echo e(number_format($invoice->pay, 2, '.', ',')); ?></td>
            </tr>
            <tr style="border-bottom: 1px solid #000;">
                <td>Balance</td>
                <?php if($invoice->extra_pay): ?>
                    <td class="text-right"><?php echo e(number_format($invoice->extra_pay, 2, '.', ',')); ?></td>
                <?php else: ?>
                    <td class="text-right">0.00</td>
                <?php endif; ?>
                
            </tr>
        </table>
        <hr style="margin-top: 3px">
        <p style="font-size:12px; margin: 0px; margin-top: 3px; text-align:center"><b>**** WISHING YOU A SPEED RECOVERY ****</b></p>
        <p style="font-size:7px; margin: 0px; margin-top: 3px; text-align:center">Solutions provided by Hasith Perera</p>
        <p style="font-size:7px; margin: 0px; margin-top: 3px; text-align:center">www.hpsolutions.com</p>
        
    </div>

</body>

</html>
<?php /**PATH D:\BIT\Project\Project\SAHANYA\CuraSys\resources\views/pdf/invoice.blade.php ENDPATH**/ ?>