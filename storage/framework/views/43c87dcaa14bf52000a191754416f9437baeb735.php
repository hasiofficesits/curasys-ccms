
<?php $__env->startSection('title'); ?>
Stock Adjust
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
        #adj_value input {
            text-align: right;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        Stock Adjust
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Stock Adjust
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
                                <label for="colFormLabel" class="col-sm-2 ps-4 col-form-label">Date :</label>
                                <div class="col-sm-10">
                                    <div id="date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div id="grid_container" class="dx-header-row"></div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 ps-4 col-form-label">ACC :</label>
                                <div class="col-sm-10">
                                    <div id="account" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-5 ps-4 col-form-label">Adjustment Value :</label>
                                <div class="col-sm-7">
                                    <div id="adj_value" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 mt-1 d-grid text-right">
                                    <button type="button" id="btn_adjust_stock" onclick="adjust_stock_btn()" class="btn btn-danger">Adjust</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- ask_adjust_modal -->
    <div id="ask_adjust_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Stock Adjustment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_res_id">
                    <h5 class="modal-title">Do You Want to Adjust this stock ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_adjust_stock_confirm" onclick="adjust_stock_confirm()" class="btn btn-success">Adjust</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
        var stock_item = [];
        var account = [];
        var ds = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#adj_value").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly : true,
        });

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

        let stock = [{id: "1",name: "Kitchen Stock"},{id: "2",name: "Counter Stock"}];

        $('#stock').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: stock,
            onValueChanged: function(e) {
                load_item();
            },
        });


        $('#account').dxSelectBox({
            dataSource: account,
            displayExpr: 'Acc',
            valueExpr: 'AccCode',
            itemTemplate: function(data) {
                return data.AccCode + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["AccCode", "Acc"]
        });

        load_account();

        $('#account').dxSelectBox({
            dataSource: account,
            displayExpr: 'Acc',
            valueExpr: 'AccCode',
            itemTemplate: function(data) {
                return data.AccCode + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["AccCode", "Acc"]
        });

        function load_account() {
            $.ajax({
                url: "<?php echo e(route('load_account')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    account = response.data
                    $('#account').dxSelectBox("instance").option("dataSource", account);
                    
                }
            })
        };

        function clear_form() {
           ds = [];
           $('#stock').dxSelectBox("instance").option("value", '');
           $('#account').dxSelectBox("instance").option("value", '');
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
                },
                {
                    dataField: 'item_name',
                    caption: 'ITEM',
                    width: 300,
                    allowEditing: false,
                },
                {
                    dataField: 'exist_qty',
                    caption: 'AVB. QTY',
                    format: '#,##0.000',
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'unit',
                    caption: 'UNIT',
                    allowEditing: false,
                },
                {
                    dataField: 'unit_price',
                    caption: 'UNIT PRICE',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 130,
                    allowEditing: false,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'phy_qty',
                    caption: 'PHY. QTY',
                    format: '#,##0.000',
                    allowEditing: true,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'item_adj_value',
                    caption: 'ADJ. VAL',
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
                let unit_price = e.oldData.unit_price;
                let phy_qty = e.oldData.phy_qty;

                if (e.newData.unit_price) {
                    unit_price = e.newData.unit_price;
                }
                if (e.newData.phy_qty) {
                    phy_qty = e.newData.phy_qty;
                }

                let adj_qty = phy_qty - e.oldData.exist_qty;
                
                e.newData.item_adj_value = parseFloat(unit_price) * adj_qty;

                
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

        function load_item() {

            let stock_id = $('#stock').dxSelectBox("instance").option("value");
            console.log(stock_id);

            $.ajax({
                url: "<?php echo e(route('load_item_details_to_adjust')); ?>",
                method: "POST",
                "data": {
                    "stock_id":stock_id,
                },
                success: function(response) {

                    ds = [];
                    // console.log(response);
                    
                    $.each(response.data, function(k, v) {
                        ds.push({
                            "code":v.code,
                            "item_name":v.name,
                            "exist_qty":v.qty,
                            "unit":v.unit,
                            "unit_price":v.price,
                            "phy_qty":0,
                            "item_adj_value":0,

                        });
                    });
                    $("#grid_container").dxDataGrid("instance").option("dataSource", ds);
                    process_total(ds);
                }
            });
        }

        function process_total(ds1) {
            let total = 0;
            if (ds1.length != 0) {
                $.each(ds1, function(k, v) {
                    total += parseFloat(v.item_adj_value);
                });
                $("#adj_value").dxNumberBox('instance').option('value', total);
            } else {
                $("#adj_value").dxNumberBox('instance').option('value', 0);
            }
        }

        function adjust_stock_btn() {

            let stock_id = $('#stock').dxSelectBox("instance").option("value");
            let adj_acc = $('#account').dxSelectBox("instance").option("value");

            if (stock_id == null) {
                toastr.error("No Adjustment Found");
            } else if (adj_acc == null) {
                toastr.error("Please Select Adjustment Account");
            } else {
                $("#ask_adjust_modal").modal("show");
            }
            
        }

        function adjust_stock_confirm() {
            let adj_date = $("#date").dxDateBox("instance").option("value");
            let adj_acc = $("#account").dxSelectBox("instance").option("value");
            let stock_id = $('#stock').dxSelectBox("instance").option("value");
            let adj_value = $("#adj_value").dxNumberBox('instance').option('value');
            let body_data = JSON.stringify(ds);

            let data = {
                "adj_date":adj_date,
                "adj_acc":adj_acc,
                "stock_id":stock_id,
                "adj_value": adj_value,
                "body_data":body_data
            };

            $("#btn_adjust_stock_confirm").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('adjust_stock_save')); ?>",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.success) {

                        toastr.success("Stock Adjust Successfully Done!");
                        $("#ask_adjust_modal").modal("hide");
                        clear_form();

                        $("#btn_adjust_stock_confirm").attr("disabled", false);

                    } else {
                        toastr.error("Invalid Data!");
                        $("#btn_adjust_stock_confirm").attr("disabled", false);
                    }
                },
                error: function(err) {
                    toastr.error("Invalid Data!");
                    $("#btn_adjust_stock_confirm").attr("disabled", false);
                }
            });

        }

        
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/stores/stock_adjust.blade.php ENDPATH**/ ?>