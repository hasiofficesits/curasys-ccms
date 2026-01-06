
<?php $__env->startSection('title'); ?>
Stock Issue
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
            Stock Issue
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">

                    <table id="otable_issue" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Outlet</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- issue_order_modal -->
    <div id="issue_order_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Issue Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">
                            <input type="hidden" class="form-control" id="order_id">
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Outlet : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="outlet" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Issue Date : </label>
                                    <div class="col-sm-8">
                                        <div id="date" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <div id="grid_container" class="dx-header-row"></div>

                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label">Total : </label>
                                    <div class="col-sm-9">
                                        <div id="total" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Discount : </label>
                                    <div class="col-sm-8">
                                        <div id="discount" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Net Value : </label>
                                    <div class="col-sm-8">
                                        <div id="net_value" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_issuer_order" onclick="issue_order()" class="btn btn-success">Issue</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_icancel_order_modal -->
    <div id="ask_cancel_order_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Cancel Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="order_id">
                    <h5 class="modal-title">Do You Want to Cancel this Order ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_cancel_order" onclick="cancel_order()" class="btn btn-danger">Yes</button>
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

    
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <script>
        var myData = {};

        var ds = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
        
        $("#total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
            onValueChanged: function(e) {
                total = e.value;
                $("#net_value").dxNumberBox('instance').option('value', total);
            },
        });
        $("#net_value").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#discount").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                discount = e.value;
                let total = $("#total").dxNumberBox('instance').option('value');

                let dis_val = discount * total;
                let net_val = total - dis_val;
                $("#net_value").dxNumberBox('instance').option('value', net_val);

            },
        });

        var otable_issue = $("#otable_issue").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_stock_order_data')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    "width": "25px",
                },
                {
                    data: 'outlet.name',
                    name: 'outlet.name',
                    "width": "200px",
                },
                {
                    data: 'total',
                    name: 'total',
                    render: function(data, type, row, meta) {
                        var price = parseFloat(data);
                        if (!isNaN(price)) {
                            return 'LKR. ' + price.toFixed(2);
                        } else {
                            return '-';
                        }
                    }

                },
                {
                    data: 'approve',
                    name: 'approve',
                    render: function(data, type, row, meta) {
                        if (data == 0) {
                            return '<span class="badge bg-warning p-2">Pending</span>'
                        } else if (data == 1) {
                            return '<span class="badge bg-info p-2">Issued</span>';
                        }
                    }

                },
                {
                    data: 'action',
                    name: 'action',
                    "width": "150px",
                },
            ],
            order: [
                [0, 'desc']
            ],

            'drawCallback': function() {
                $('table tbody tr td').css('padding-top', '1px');
                $('table tbody tr td').css('font-size', '14px');
                $('table tbody tr td').css('padding-bottom', '1px');
            }
        });

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
            filterRow: {
                visible: false
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
            let full_tot = 0;

            if (ds1.length != 0) {
                $.each(ds1, function(k, v) {
                    full_tot += parseFloat(v.total);
                });
                $("#total").dxNumberBox('instance').option('value', full_tot);
            } else {
                $("#total").dxNumberBox('instance').option('value', 0);
            }
        }


        $('#otable_issue tbody').on('click', '.btn-view', function() {

            var data = otable_issue.row($(this).parents('tr')).data();
            console.log(data);
            $("#order_id").val(data.id);
            $("#outlet").val(data.outlet.name);
            $("#total").dxNumberBox('instance').option('value',data.total);

            $.ajax({
                url: "<?php echo e(route('load_order_body_view')); ?>",
                method: "GET",
                "data": {
                    "order_id": data.id,
                },
                success: function(response) {

                    ds = [];
                    console.log(response);

                    $.each(response.order_body, function(k, v) {
                        ds.push({
                            "code": v.code,
                            "name": v.name,
                            "rate": v.rate,
                            "qty": v.qty,
                            "total": v.total,
                        });
                    });
                    $("#grid_container").dxDataGrid("instance").option("dataSource", ds);
                }
            });

            if (data.approve == 0) {
                $("#btn_issuer_order").show();
            } else {
                $("#btn_issuer_order").hide();
            }
            $("#issue_order_modal").modal("show");

        });

        function issue_order() {
            let order_id = $("#order_id").val();
            let date = $("#date").dxDateBox("instance").option("value");
            let total = $("#total").dxNumberBox('instance').option('value');
            let discount = $("#discount").dxNumberBox('instance').option('value');
            let net_value = $("#net_value").dxNumberBox('instance').option('value');
            let body_data = JSON.stringify(ds);

            let data = {
                "order_id":order_id,
                "date":date,
                "total":total,
                "discount":discount,
                "net_value":net_value,
                "body_data":body_data
            };

            $("#btn_issuer_order").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('issue_outlet_order')); ?>",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        toastr.success("Order Issue Successfully Done!");
                        clear_form();
                        otable_issue.ajax.reload();
                        $("#issue_order_modal").modal("hide");
                        
                        $("#btn_issuer_order").attr("disabled", false);

                    } else {
                        toastr.error("Invalid Data!");
                        $("#btn_issuer_order").attr("disabled", false);
                    }
                },
                error: function(err) {
                    toastr.error("Invalid Data!");
                    $("#btn_issuer_order").attr("disabled", false);
                }
            });
        }

        function clear_form() {
            ds = [];
            $("#total").dxNumberBox('instance').option('value',0);
            $("#discount").dxNumberBox('instance').option('value',0);
            $("#net_value").dxNumberBox('instance').option('value',0);
        }

        $('#otable_issue tbody').on('click', '.btn-cancel', function() {

            var data = otable_issue.row($(this).parents('tr')).data();
            console.log(data);
            $("#order_id").val(data.id);
            $("#ask_cancel_order_modal").modal("show");
        });

        function cancel_order() {
            let order_id = $("#order_id").val();

            $("#btn_cancel_order").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('cancel_outlet_orders')); ?>",
                "method": "POST",
                "data": {
                    "order_id":order_id
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Order Canceled Successfully");
                        otable_issue.ajax.reload();
                        $("#ask_cancel_order_modal").modal("hide");

                        $("#order_id").val('');

                        $("#btn_cancel_order").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_cancel_order").attr("disabled", false);
                    }
                },
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-Chamee\resources\views/outlets/stock_issue.blade.php ENDPATH**/ ?>