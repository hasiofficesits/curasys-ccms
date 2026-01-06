
<?php $__env->startSection('title'); ?>
Purchase Order
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
            height: 300px;
        }
        #po_total input {
            text-align: right;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('li_1'); ?>
        Store
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Purchase Order
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_PO_order"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> New Order</button>
                        </div>
                    </div>
                    <table id="otable_po" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Total</th>
                                <th>GRN</th>
                                <th>Approved</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_new_po_modal -->
    <div id="add_new_po_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Purchase Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">

                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">PO No : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="next_po" value="<?php echo e($next_po_code); ?>"disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Supplier : </label>
                                    <div class="col-sm-8">
                                        <div id="supplier" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
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
                                        <div id="po_total" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_po" onclick="save_po()" class="btn btn-success">Save</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_cancel_modal  -->
    <div id="ask_cancel_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Cancel Purchase Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="po_id">
                    <h5 class="modal-title">Do You Want to Cancel this Purchase Order ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_cancel_po" onclick="cancel_po()" class="btn btn-danger">Yes</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_approve_modal  -->
    <div id="ask_approve_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Approve Purchase Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="po_id">
                    <h5 class="modal-title">Do You Want to Approve this Purchase Order ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_approve_po" onclick="approve_po()" class="btn btn-success">Yes</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- view_po_modal -->
    <div id="view_po_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Purchase Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <input type="hidden" id="po_id">

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">PO : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="po_number_view" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Date : </label>
                                <div class="col-sm-8">
                                    <div id="date_view" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Supplier : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="supplier_view" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">GRN : </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="grn_view" disabled>
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <hr>
                        <br>
                        <div id="grid_container_view" class="dx-header-row"></div>

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
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Total : </label>
                                <div class="col-sm-9">
                                    <div id="total_view" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_ask_print_po" class="btn btn-success">Print</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_print_modal -->
    <div id="ask_print_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Print ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="po_id_print">

                    <p>Do you want to print this PO ?</p>
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Print Size :</label>
                                <div class="col-sm-9">
                                    <select id="print_size" class="form-select mb-3" aria-label="Default select example">
                                        <option selected>Select Print Size..</option>
                                        <option value="A4">A4 Size - Normal</option>
                                        <option value="A5">A5 Size - Small(Half of A4)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_print_po" onclick="print_po()"
                        class="btn btn-success">Print</button>
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

        var supplier = [];
        var ds = [];
        var ds_view = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_supplier();

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

        $('#supplier').dxSelectBox({
            dataSource: supplier,
            displayExpr: 'company',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.id + " - " + data.company;
            },
            searchEnabled: true,
            searchExpr: ["id", "company"],
            onValueChanged: function(e) {
                load_stock_item(e);
            },
        });

        $("#po_total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly : true,
        });

        $('#date_view').dxDateBox({
            type: 'date',
            readOnly: true,
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
        });
        $("#total_view").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });

        function load_supplier() {
            $.ajax({
                url: "<?php echo e(route('load_supplier')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    supplier = response.data
                    $('#supplier').dxSelectBox("instance").option("dataSource", supplier);
                    
                }
            })
        }

        var otable_po = $("#otable_po").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_purchase_order_grid')); ?>",
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
                    data: 'date',
                    name: 'date',
                },
                {
                    data: 'supplier.company',
                    name: 'supplier.company',
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
                            return '';
                        }
                    }

                },
                {
                    data: 'grn',
                    name: 'grn',
                    render: function(data, type, row, meta) {
                        if (data == null) {
                            return '-'
                        } else {
                            return data;
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
                            return '<span class="badge bg-info p-2">Issue</span>';
                        }
                    }

                },
                {
                    data: 'action',
                    name: 'action',
                    "width": "250px",
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

        $("#btn_add_PO_order").on('click', function() {
            $("#add_new_po_modal").modal("show");
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

        function load_stock_item() {
            let supplier_id = $('#supplier').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('stock_data_from_supplier')); ?>",
                method: "POST",
                "data": {
                    "supplier_id":supplier_id,
                },
                success: function(response) {

                    ds = [];
                    console.log(response);
                    
                    $.each(response.data, function(k, v) {
                        ds.push({
                            "code":v.code,
                            "name":v.name,
                            "rate":v.price,
                            "qty":0,
                            "total":0,
                        });
                    });
                    $("#grid_container").dxDataGrid("instance").option("dataSource", ds);
                    // process_total(ds);
                }
            });
        }

        function process_total(ds1) {
            let full_tot = 0;
            if (ds1.length != 0) {
                $.each(ds1, function(k, v) {
                    full_tot += parseFloat(v.total);
                });
                $("#po_total").dxNumberBox('instance').option('value', full_tot);
            } else {
                $("#po_total").dxNumberBox('instance').option('value', 0);
            }
        }

        function save_po() {
            let po_number = $("#next_po").val();
            let date = $("#date").dxDateBox("instance").option("value");
            let supplier_id = $('#supplier').dxSelectBox("instance").option("value");
            let po_total = $("#po_total").dxNumberBox('instance').option('value');
            let body_data = JSON.stringify(ds);

            let data = {
                "po_number":po_number,
                "date":date,
                "supplier_id": supplier_id,
                "po_total":po_total,
                "body_data":body_data
            };

            $("#btn_save_po").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('save_purchase_order')); ?>",
                method: 'POST',
                data: data,
                success: function(response) {
                    ds = [];
                    console.log(response);
                    if (response.success) {

                        toastr.success("PO Sent Successfully Done!");
                        $("#add_new_po_modal").modal("hide");
                        otable_po.ajax.reload();
                        clear_form();
                        $("#btn_save_po").attr("disabled", false);

                    } else {
                        toastr.error("Invalid Data!");
                        $("#btn_save_po").attr("disabled", false);
                    }
                },
                error: function(err) {
                    toastr.error("Invalid Data!");
                    $("#btn_save_po").attr("disabled", false);
                }
            });
        }

        function clear_form() {
            $('#supplier').dxSelectBox("instance").option("value", '');
            $("#po_total").dxNumberBox('instance').option('value', 0);
        }

        $('#otable_po tbody').on('click', '.btn-cancel', function() {

            var data = otable_po.row($(this).parents('tr')).data();
            console.log(data);
            $("#po_id").val(data.id);
            $("#ask_cancel_modal").modal("show");
        });

        function cancel_po() {
            let po_id = $("#po_id").val();

            $("#btn_cancel_po").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('cancel_purchase_order')); ?>",
                "method": "POST",
                "data": {
                    "po_id":po_id
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Order Cancel Successfully");
                        otable_po.ajax.reload();
                        $("#ask_cancel_modal").modal("hide");

                        $("#btn_cancel_po").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_cancel_po").attr("disabled", false);
                    }
                },
            });
        }

        $('#otable_po tbody').on('click', '.btn-approve', function() {

            var data = otable_po.row($(this).parents('tr')).data();
            console.log(data);
            $("#po_id").val(data.id);
            $("#ask_approve_modal").modal("show");
        });

        function approve_po() {

            let po_id = $("#po_id").val();

            $("#btn_approve_po").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('approve_purchase_order')); ?>",
                "method": "POST",
                "data": {
                    "po_id":po_id
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Order Approve Successfully");
                        otable_po.ajax.reload();
                        $("#ask_approve_modal").modal("hide");

                        $("#btn_approve_po").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_approve_po").attr("disabled", false);
                    }
                },
            });
        }

        $('#otable_po tbody').on('click', '.btn-view', function() {

            var data = otable_po.row($(this).parents('tr')).data();
            console.log(data);

            $("#po_id").val(data.id);
            $("#po_number_view").val(data.po_number);
            $("#date_view").dxDateBox('instance').option('value', data.date);
            $("#supplier_view").val(data.supplier.company);
            $("#grn_view").val(data.grn);
            $("#total_view").dxNumberBox('instance').option('value', data.total);

            $.ajax({
                url: "<?php echo e(route('load_po_body_view')); ?>",
                method: "GET",
                "data": {
                    "po_id": data.id,
                },
                success: function(response) {

                    ds_view = [];
                    console.log(response);

                    $.each(response.po_body, function(k, v) {
                        ds_view.push({
                            "code": v.code,
                            "name": v.name,
                            "rate": v.rate,
                            "qty": v.qty,
                            "total": v.total,
                        });
                    });
                    $("#grid_container_view").dxDataGrid("instance").option("dataSource", ds_view);
                }
            });

            $("#view_po_modal").modal("show");

        });

        var dataGrid_view = $('#grid_container_view').dxDataGrid({
            dataSource: ds_view,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            filterRow: {
                visible: true
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
                    allowEditing: false,
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
                    info.rowElement.addClass('bg-info')
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
                // console.log(e.newData)
                // console.log(e.oldData)
                // let qty = e.oldData.qty;
                // let rate = e.oldData.rate;

                // if (e.newData.rate) {
                //     rate = e.newData.rate;
                // }
                // if (e.newData.qty) {
                //     qty = e.newData.qty;
                // }

                // let total = 0;

                // if (e.newData.qty == 0) {
                //     total = 0;
                //     e.newData.total = 0;
                // } else {
                //     e.newData.total = parseFloat(rate) * qty;
                // }

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

        $("#btn_ask_print_po").on('click', function() {
            let po_id = $("#po_id").val();
            $("#po_id_print").val(po_id);

            $("#ask_print_modal").modal("show");
        });

        function print_po() {
            let print_size = $("#print_size option:selected").val();
            let po_id_print = $("#po_id_print").val();

            printJS("/po_invo/"+print_size+"/"+po_id_print);
        }
        

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-Chamee\resources\views/stores/purchase_order.blade.php ENDPATH**/ ?>