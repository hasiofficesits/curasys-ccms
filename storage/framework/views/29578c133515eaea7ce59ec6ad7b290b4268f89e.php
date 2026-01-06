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
        
        
    </div>

    <div style="position: relative;">
        <table style="border: 1px solid #000; background-color:#2ecc71;" width="100%">

            <tr class="text-white">
                <td class="text-center">
                    <h3 class="text-header" style="font-size: 20px"><?php echo e($company->com_name); ?></h3>
                    <p class="text-header-sub"><?php echo e($company->com_add1); ?></p>
                    <?php if($company->com_add2): ?>
                        <p class="text-header-sub"><?php echo e($company->com_add2); ?></p>
                    <?php endif; ?>
                    <p class="text-header-sub"><?php echo e($company->com_add3); ?></p>
                    <p class="text-header-sub"><b>Tel: <?php echo e($company->com_tel); ?> email:
                            <?php echo e($company->com_email); ?></b></p>

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
                            <td style="text-align: left;width:150px"><?php echo e($appointment->ID); ?></td>
                            <td style="text-align: left"><?php echo e($appointment->Date); ?></td>
                            <td style="text-align: left"><?php echo e($appointment->patient->FullName); ?></td>
                            <?php if($appointment->doctor->Name): ?>
                                <td style="text-align: left"><?php echo e($appointment->doctor->Name); ?></td>
                            <?php endif; ?>
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
                    <?php if($pres_body): ?>

                        <?php $__currentLoopData = $pres_body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->item->Pharma_name); ?></td>

                                <?php if($item->Dose): ?>
                                    <td style="text-align: right"><?php echo e(number_format(floatval($item->Dose),  2, '.', ',')); ?></td>
                                <?php else: ?>
                                    <td style="text-align: right"><?php echo e(number_format(0,  2, '.', ',')); ?></td>
                                <?php endif; ?>

                                <?php if($item->Freq): ?>
                                    <td style="text-align: right"><?php echo e(number_format(floatval($item->Freq),  2, '.', ',')); ?></td>
                                <?php else: ?>
                                    <td style="text-align: right"><?php echo e(number_format(0, 2, '.', ',')); ?></td>
                                <?php endif; ?>

                                <?php if($item->Period): ?>
                                    <td style="text-align: right"><?php echo e(number_format(floatval($item->Period),  2, '.', ',')); ?></td>
                                <?php else: ?>
                                    <td style="text-align: right"><?php echo e(number_format(0, 2, '.', ',')); ?></td>
                                <?php endif; ?>

                                <?php if($item->Qty): ?>
                                    <td style="text-align: right"><?php echo e(number_format(floatval($item->Qty),  2, '.', ',')); ?></td>
                                <?php else: ?>
                                    <td style="text-align: right"><?php echo e(number_format(0,  2, '.', ',')); ?></td>
                                <?php endif; ?>
            
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
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
                    <?php if($service): ?>

                        <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->Description); ?></td>

                                <?php if($item->Qty): ?>
                                    <td style="text-align: right"><?php echo e(number_format(floatval($item->Qty),  2, '.', ',')); ?></td>
                                <?php else: ?>
                                    <td style="text-align: right"><?php echo e(number_format(0,  2, '.', ',')); ?></td>
                                <?php endif; ?>

                                <?php if($item->Unit_Price): ?>
                                    <td style="text-align: right"><?php echo e(number_format(floatval($item->Unit_Price),  2, '.', ',')); ?></td>
                                <?php else: ?>
                                    <td style="text-align: right"><?php echo e(number_format(0, 2, '.', ',')); ?></td>
                                <?php endif; ?>

                                <?php if($item->Total): ?>
                                    <td style="text-align: right"><?php echo e(number_format(floatval($item->Total),  2, '.', ',')); ?></td>
                                <?php else: ?>
                                    <td style="text-align: right"><?php echo e(number_format(0,  2, '.', ',')); ?></td>
                                <?php endif; ?>
            
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
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
                    <?php if($note_body): ?>

                        <?php $__currentLoopData = $note_body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($item->Type); ?></td>
                                <td><?php echo e($item->Description); ?></td>
            
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                </tbody>
            </table>

            <p><b>Investigation Results</b></p>
            <?php if($result): ?>
            <p><b>Result Details:</b></p>
                <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <table style="margin-top:0px;" width="100%">
                        <tr class="font-reduce">
                            <th style="text-align: left">Date</th>
                            <th style="text-align: left">MLT</th>
                            <th style="text-align: left">Type</th>
                        </tr>
                        <tr class="font-reduce">
                            <td style="text-align: left;width:150px"><?php echo e($value->Date); ?></td>
                            <td style="text-align: left"><?php echo e($value->Mlt); ?></td>
                            <td style="text-align: left"><?php echo e($value->Ix); ?></td>
                        </tr>
                        <tr></tr>
                        <tr></tr>
                        <?php if($ix_body): ?>
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
                                        <?php $__currentLoopData = $ix_body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($value->Id == $item->Ix_id): ?>
                                                <tr>
                                                    <td><?php echo e($item->Type); ?></td>
                                                    <td><?php echo e($item->Narration); ?></td>
                                                    <td><?php echo e($item->Results); ?></td>
                                                    <td><?php echo e($item->Normal_range); ?></td>
                                
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </table>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

        </div>

</body>

</html>
<?php /**PATH D:\Intern\SAHANYA\resources\views/pdf/view_app.blade.php ENDPATH**/ ?>