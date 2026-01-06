
<?php $__env->startSection('title'); ?>
    Stock Adjusment Summary
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

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        Stock Adjusment Summary
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Stock Adjusment Summary
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Stock :</label>
                                <div class="col-sm-10">
                                    <div id="stock" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 ps-4 col-form-label">Item :</label>
                                <div class="col-sm-10">
                                    <div id="items" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Start : </label>
                                <div class="col-sm-9">
                                    <div id="start_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">End : </label>
                                <div class="col-sm-8">
                                    <div id="end_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="row">
                                
                            </div>
                        </div>
                        <div class="col-lg-2 pe-3">
                            <div class="row">
                                <button type="button" id="btn_load_report" class="btn btn-success">Load Report</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <table id="otable_adjsum_report" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Item</th>
                                <th>Stock</th>
                                <th>Adj. Qty</th>
                                <th>Inc/Dec</th>
                                <th>Adj. Value</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="text-end"></th>
                            </tr>
                        </tfoot>
                    </table>
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

    
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

    <script>
        var myData = {};

        var stock_item = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let stock = [{id: "1",name: "Kitchen Stock"},{id: "2",name: "Counter Stock"}];

        $('#stock').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: stock,
            onValueChanged: function(e) {
                load_item();
            },
        });

        $('#items').dxSelectBox({
            dataSource: stock_item,
            displayExpr: 'name',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.code + " - " + data.name;
            },
            searchEnabled: true,
            searchExpr: ["code", "name"]
        });

        $('#start_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
            
        });
        $('#end_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
            
        });

        function load_item() {
            let stock = $('#stock').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_item_to_report')); ?>",
                method: "POST",
                "data": {
                    "stock":stock,
                },
                success: function(response) {
                    // console.log(response)
                    stock_item = response.data
                    $('#items').dxSelectBox("instance").option("dataSource", stock_item);
                    
                }
            })
        }

        var otable_adjsum_report = $("#otable_adjsum_report").DataTable({
            
            dom: 'Bfrtip',
            columns: [
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'date',
                    name: 'date',
                },
                {
                    data: 'stock',
                    name: 'stock',
                    render: function(data, type, row, meta) {
                        // console.log(row)
                        
                        if (data == "Kitchen Stock") {
                            return row.kitchen.name;
                        } else if (data == "Counter Stock") {
                            return row.counter.name;
                        }
                    }
                },
                {
                    data: 'stock',
                    name: 'stock',
                },
                {
                    data: 'adj_qty',
                    name: 'adj_qty',
                    render: function(data, type, row, meta) {
                        return Math.abs(data);
                    }
                    
                },
                {
                    data: 'adj_qty',
                    name: 'adj_qty',
                    render: function(data, type, row, meta) {
                        if (data < 0) {
                            return '<span class="badge bg-warning p-2">Decrease</span>'
                        } else if (data > 0) {
                            return '<span class="badge bg-info p-2">Increase</span>';
                        }
                    }
                },
                {
                    data: 'adj_value',
                    name: 'adj_value',
                    "className": "text-end",
                    render: $.fn.dataTable.render.number( ',', '.', 2, 'LKR ' ),
                },
            ],
            order: [
                [0, 'desc']
            ],
            "footerCallback": function (row, data, start, end, display) {
                var totalAmount = 0;
                for (var i = 0; i < data.length; i++) {

                    totalAmount += parseFloat(data[i].adj_value);

                }
                $(row).find('th').eq(0).html( "Total Amount : LKR. "+parseFloat(totalAmount) );
            }
        });

        $("#btn_load_report").on('click', function() {
            let stock = $('#stock').dxSelectBox("instance").option("value");
            let item_id = $('#items').dxSelectBox("instance").option("value");
            let start_date = $("#start_date").dxDateBox('instance').option('value');
            let end_date = $("#end_date").dxDateBox('instance').option('value');

            $("#btn_load_report").attr("disabled", true);

            $.post('<?php echo e(route('load_adj_report')); ?>',
            {
                "stock":stock,
                "item_id":item_id,
                "start_date":start_date,
                "end_date":end_date,

            },
            function(res){
                otable_adjsum_report.clear();
                otable_adjsum_report.rows.add(res.data);
                otable_adjsum_report.draw();
                $("#btn_load_report").attr("disabled", false);
            })
        })


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/reports/stk_adjustment_sum.blade.php ENDPATH**/ ?>