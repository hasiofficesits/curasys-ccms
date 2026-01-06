
<?php $__env->startSection('title'); ?>
Current Stock Report
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.css')); ?>" rel="stylesheet" type="text/css" />
    <style>
        .myClass {
            font-size: 2rem;
        }
        .dx-header-row {  
            color: white;  
        } 
        #grid_container {
            height: 150px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        Stock Summary Report
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Stock Summary Report
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2">
                            <label for="colFormLabel" class="col-form-label">Item : </label>
                            <div id="pharma_item" class="form-control-sm"></div>
                        </div>
                        <div class="col-lg-2">
                            <label for="colFormLabel" class="col-form-label">Suppliers : </label>
                            <div id="pharma_supplier" class="form-control-sm"></div>
                        </div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-1">
                            <button id="btn_loadReport" class="btn btn-primary btn-md w-100" style="margin-top:35px;">Load</button>
                        </div>
                        <div class="col-lg-1">
                            <button id="btn_exportReport" class="btn btn-warning btn-md w-100" style="margin-top:35px;">Export</button>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <table id="otable_currentStock_report" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Item Name</th>
                                        <th>Category</th>
                                        <th>Packet QTY</th>
                                        <th>Recorder Level</th>
                                        <th>Supplier</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <!-- apexcharts -->
    <script src="<?php echo e(URL::asset('/assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/libs/jsvectormap/jsvectormap.min.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.js')); ?>"></script>

    <!-- dashboard init -->
    <script src="<?php echo e(URL::asset('/assets/js/pages/dashboard-ecommerce.init.js')); ?>"></script>
    <script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>

    <script>
        var myData = {
            pharma_item: '',
            pharma_supplier: ''
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#pharma_item').dxSelectBox({
            dataSource: new DevExpress.data.DataSource({
                load: function() {
                    return $.getJSON("<?php echo e(route('load_stock_item_to_dropdown')); ?>");
                }
            }),
            displayExpr: 'Pharma_name',
            valueExpr: 'ID',
            placeholder: 'Select a medicine...',
            searchEnabled: true,
            showClearButton: true,
            width: '100%'
        });
        $('#pharma_supplier').dxSelectBox({
            dataSource: new DevExpress.data.DataSource({
                load: function() {
                    return $.getJSON("<?php echo e(route('load_supplier_to_dropdown')); ?>");
                }
            }),
            displayExpr: 'Company',
            valueExpr: 'ID',
            placeholder: 'Select a supplier...',
            searchEnabled: true,
            showClearButton: true,
            width: '100%'
        });

        $('#from_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
        });
        $('#to_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
        });


        var otable_currentStock_report = $("#otable_currentStock_report").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_stock_report_grid')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [
                { data: 'ID', name: 'ID', width: "25px" },
                { data: 'Pharma_name', name: 'Item Name' },
                { data: 'category.CategoryName', name: 'Category' },
                { data: 'Pack_Qty', name: 'Packet Qty' },
                { data: 'ReorderLevel', name: 'Recorder Level' },
                { data: 'suplier.Company', name: 'Supplier' },
            ],
            order: [[0, 'desc']],
            drawCallback: function() {
                $('table tbody tr td').css({
                    'padding-top': '1px',
                    'padding-bottom': '1px',
                    'font-size': '14px'
                });
            }
        });

        $("#btn_loadReport").on('click', function() {
            let itemId = $("#pharma_item").dxSelectBox("instance").option("value");
            let supplierId = $("#pharma_supplier").dxSelectBox("instance").option("value");

            myData = {
                pharma_item: itemId,
                pharma_supplier: supplierId
            };

            otable_currentStock_report.ajax.reload();
        });

        $("#btn_exportReport").on('click', function() {
            let itemId = $("#pharma_item").dxSelectBox("instance").option("value");
            let supplierId = $("#pharma_supplier").dxSelectBox("instance").option("value");

            // Build the export URL with filters
            let exportUrl = "<?php echo e(route('export_stock_report_excel')); ?>" + 
                "?pharma_item=" + (itemId || '') + 
                "&pharma_supplier=" + (supplierId || '');

            window.location.href = exportUrl; // 🔁 Trigger Excel download
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/reports/stock/current-stock.blade.php ENDPATH**/ ?>