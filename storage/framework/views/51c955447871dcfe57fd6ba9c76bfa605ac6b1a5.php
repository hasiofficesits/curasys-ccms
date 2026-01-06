
<?php $__env->startSection('title'); ?>
Stock Order
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
            height: 200px;
        }
        #po_total input {
            text-align: right;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        Outlets
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Stock Order
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Outlet : </label>
                                <div class="col-sm-10">
                                    <div id="outlet" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Date : </label>
                                <div class="col-sm-8">
                                    <div id="date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <hr>
                        <br>
                        <div id="grid_container" class="dx-header-row"></div>
                        <div class="col-lg-4">
                            <div class="row">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Total : </label>
                                <div class="col-sm-8">
                                    <div id="so_total" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">

                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 mt-1 d-grid">
                                    <button type="button" id="btn_save_so" onclick="save_order()" class="btn btn-success">Save</button>
                                </div>
                            </div>
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
        var myData = {};

        var outlets = [];
        var ds = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_item();

        $('#date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            }, 
        });

        $("#so_total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly : true,
        });

        load_outlet();

        $('#outlet').dxSelectBox({
            dataSource: outlets,
            displayExpr: 'name',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.id + " - " + data.name;
            },
            searchEnabled: true,
            searchExpr: ["id", "name"],
            onValueChanged: function(e) {
                $("#grid_container").dxDataGrid("instance").refresh();  
            },
        });

        function load_outlet() {
            $.ajax({
                url: "<?php echo e(route('load_outlet_list_to_so')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    outlets = response.data
                    $('#outlet').dxSelectBox("instance").option("dataSource", outlets);
                    
                }
            })
        };

        //Load Item
        function load_item() {
            // ds=<?php echo $data; ?>;
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                ds.push({
                    "code":'<?php echo e($item->code); ?>',
                    "name":'<?php echo e($item->name); ?>',
                    "rate":'<?php echo e($item->price); ?>',
                    "qty":0,
                    "total":0,
                })
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
        }

        var dataGrid = $('#grid_container').dxDataGrid({
            dataSource: ds,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            editing: {
                mode: 'row',
                allowUpdating: true,
                allowDeleting: false,
                allowAdding: true,
            },
            filterRow: { visible: true },
            columns: [
                // {
                //     dataField: 'ID',
                //     caption: 'ID',
                //     width: 100,
                //     allowEditing: false,
                //     // validationRules: [{
                //     //     type: 'required'
                //     // }],
                // },
                {
                    dataField: 'code',
                    caption: 'CODE',
                    allowEditing: false,
                    width: 150,
                },
                {
                    dataField: 'name',
                    caption: 'ITEM',
                    width: 400,
                    allowEditing: false,
                },
                {
                    dataField: 'rate',
                    caption: 'RATE',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 130,
                    allowEditing: false,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'qty',
                    caption: 'QTY',
                    format: '#,##0.000',
                    allowEditing: true,
                    width: 100,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'total',
                    caption: 'TOTAL',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 130,
                    allowEditing: false,
                    validationRules: [{
                        type: 'required'
                    }],
                },

            ],

            toolbar: {
                items: [
                    //     {
                    //     location: 'before',
                    //     name: 'addRowButton',
                    //     showText: 'always',
                    //     options: {
                    //         text: 'Add New Item',

                    //         visible:false,


                    //     },
                    // }
                ]
            },
            onRowPrepared: function(info) {
                if (info.rowType == 'header') {
                    info.rowElement.addClass('bg-success')
                }
            },
            // onEditingStart() {

            // },
            onInitNewRow(e) {

            },
            onRowInserting(e) {

            },
            onRowInserted(e) {

            },
            onRowUpdating(e) {
                console.log(e.newData)
                console.log(e.oldData)
                let qty = e.oldData.qty;
                let rate = e.oldData.rate;

                if (e.newData.rate) {
                    rate = e.newData.rate;
                }
                if (e.newData.qty) {
                    qty = e.newData.qty;
                }

                let total = 0;

                if (e.newData.qty == 0) {
                    total = 0;
                    e.newData.total = 0;
                } else {
                    e.newData.total = parseFloat(rate) * qty;
                }
                
                process_total(ds)
            },
            onRowUpdated(e) {
                if (e.status == "exist_data") {
                    e.status = "old_updated";

                }
                process_total(ds)
            },
            onRowRemoving(e) {
                // console.log("Deleteing..1");
                // console.log(e.key);
                // console.log("Deleteing..1");
                
                process_total(ds)
                console.log(deleteItems);
            },
            onRowRemoved(e) {
                // console.log("Deleteing..");
                // console.log("Deleteing..2");
                // console.log(e.key);
                // console.log("Deleteing..2");
                
                process_total(ds)
                console.log(deleteItems);

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        function process_total(ds1) {
            let total = 0;
            if (ds1.length != 0) {
                $.each(ds1, function(k, v) {
                    total += parseFloat(v.total);
                });
                $("#so_total").dxNumberBox('instance').option('value', total);
            } else {
                $("#so_total").dxNumberBox('instance').option('value', 0);
            }
        }

        function save_order() {
            let outlet_id = $('#outlet').dxSelectBox("instance").option("value");
            let date = $("#date").dxDateBox("instance").option("value");
            let total = $("#so_total").dxNumberBox('instance').option('value');
            let body_data = JSON.stringify(ds);

            if (outlet_id == null) {
                toastr.error("Please Select Outlet to Send Order");
            }

            let data = {
                "outlet_id":outlet_id,
                "date":date,
                "total":total,
                "body_data":body_data
            };

            $("#btn_save_so").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('save_stock_order')); ?>",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        toastr.success("Stock Order Sent Successfully Done!");

                        // dataGrid.refresh();
                        // ds = [];
                        // load_item();
                        window.location.reload()
                        $('#outlet').dxSelectBox("instance").option("value", '');

                        $("#btn_save_so").attr("disabled", false);

                    } else {
                        toastr.error("Invalid Data!");
                        $("#btn_save_so").attr("disabled", false);
                    }
                },
                error: function(err) {
                    toastr.error("Invalid Data!");
                    $("#btn_save_so").attr("disabled", false);
                }
            });
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-Chamee\resources\views/outlets/stock_order.blade.php ENDPATH**/ ?>