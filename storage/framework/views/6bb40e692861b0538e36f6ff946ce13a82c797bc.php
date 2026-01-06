
<?php $__env->startSection('title'); ?>
    GRN
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
            Store
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            GOOD RECIEVE NOTE
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_GRN"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> New GRN</button>
                        </div>
                    </div>
                    <table id="otable_grn" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Supplier</th>
                                <th>Total</th>
                                <th>Discount</th>
                                <th>Net Val</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_new_grn_modal -->
    <div id="add_new_grn_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add GRN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form id="add_grn" method="POST" enctype="multipart/form-data">
                        <div class="row g-2">

                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Select PO : </label>
                                    <div class="col-sm-8">
                                        <div id="po_data" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Supplier : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="supplier" disabled>
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

                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">GRN No : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="next_grn"
                                            value="<?php echo e($next_grn_code); ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Ref. No : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="ref">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Invoice : </label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="file" id="invoice" name="image">
                                    </div>
                                </div>
                            </div>

                            <br><br>
                            <hr>
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
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_grn" onclick="save_grn()" class="btn btn-success">Save</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- view_grn_modal -->
    <div id="view_grn_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add GRN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">

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
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Date : </label>
                                <div class="col-sm-8">
                                    <div id="date_view" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">GRN No : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="grn_view" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Ref. No : </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="ref_view" disabled>
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <hr>
                        <br>
                        <div id="grid_container_view" class="dx-header-row"></div>

                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Total : </label>
                                <div class="col-sm-9">
                                    <div id="total_view" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Discount : </label>
                                <div class="col-sm-8">
                                    <div id="discount_view" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Net Value : </label>
                                <div class="col-sm-8">
                                    <div id="net_value_view" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_view_invo" class="btn btn-info">View Invoice</button>
                    <button type="button" id="btn_ask_print_grn" class="btn btn-success">Print</button>
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
                    <input type="hidden" class="form-control" id="grn_code">

                    <p>Do you want to print this GRN ?</p>
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
                    <button type="button" id="btn_print_grn" onclick="print_grn()"
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

        var purchase_order = [];
        var ds = [];
        var ds_view = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_po_data();

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

        $('#po_data').dxSelectBox({
            dataSource: purchase_order,
            displayExpr: 'po_number',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.po_number;
            },
            searchEnabled: true,
            searchExpr: ["id", "po_number"],
            onValueChanged: function(e) {
                load_po_data_to_grid(e);
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
        $("#total_view").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#discount_view").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });

        $("#net_value").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#net_value_view").dxNumberBox({
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

        function load_po_data() {
            $.ajax({
                url: "<?php echo e(route('load_po_data')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    purchase_order = response.data
                    $('#po_data').dxSelectBox("instance").option("dataSource", purchase_order);

                }
            })
        }

        function load_po_data_to_grid() {

            let po_id = $('#po_data').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_po_to_grid')); ?>",
                method: "POST",
                "data": {
                    "po_id": po_id,
                },
                success: function(response) {

                    $("#supplier").val(response.po_head.supplier.company);
                    // $("#date").dxDateBox("instance").option("value", response.po_head.date);

                    ds = [];
                    console.log(response);

                    $.each(response.po_body, function(k, v) {
                        ds.push({
                            "code": v.code,
                            "name": v.name,
                            "rate": v.rate,
                            "qty": v.qty,
                            "free_qty": 0,
                            "total": v.total,
                        });
                    });
                    $("#grid_container").dxDataGrid("instance").option("dataSource", ds);
                    process_total(ds);
                }
            });
        }

        var otable_grn = $("#otable_grn").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_grn_data')); ?>",
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
                    data: 'supplier.company',
                    name: 'supplier.company',
                    "width": "200px",
                },
                {
                    data: 'total_value',
                    name: 'total_value',
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
                    data: 'discount',
                    name: 'discount',
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
                    data: 'net_value',
                    name: 'net_value',
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

        $("#btn_add_GRN").on('click', function() {
            $("#add_new_grn_modal").modal("show");
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
                {
                    dataField: 'free_qty',
                    caption: 'FREE QTY',
                    format: '#,##0.000',
                    allowEditing: true,
                    width: 100,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
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
                    dataField: 'free_qty',
                    caption: 'FREE QTY',
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

        function save_grn() {
            let po_id = $('#po_data').dxSelectBox("instance").option("value");
            let date = $("#date").dxDateBox("instance").option("value");
            let grn_no = $("#next_grn").val();
            let ref_no = $("#ref").val();
            let invo_image = $("#invoice").val();
            let body_data = JSON.stringify(ds);
            let total = $("#total").dxNumberBox('instance').option('value');
            let discount = $("#discount").dxNumberBox('instance').option('value');
            let net_val = $("#net_value").dxNumberBox('instance').option('value');

            let data = {
                "po_id": po_id,
                "date": date,
                "grn_no": grn_no,
                "ref_no": ref_no,
                "body_data": body_data,
                "total": total,
                "discount": discount,
                "net_val": net_val
            }

            //get image
            var formData = new FormData();
            for (var key in data) {
                formData.append(key, data[key]);
            }

            if ($("#invoice")[0].files[0]) {
                console.log("select");
                formData.append('invoice', $("#invoice")[0].files[0]);
            } else {
                formData.append('invoice', 'not');
            }

            $("#btn_save_grn").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('save_grn_to_db')); ?>",
                data: formData,
                method: "POST",
                processData: false,
                contentType: false,
                success: function(response) {

                    console.log(response);
                    if (response.success) {

                        toastr.success("GRN Successfully Done!");
                        $("#add_new_grn_modal").modal("hide")
                        clear_data();
                        otable_grn.ajax.reload();
                        $("#btn_save_grn").attr("disabled", false);
                    } else {
                        toastr.error("Invalid data issue");
                        $("#btn_save_grn").attr("disabled", false);
                    }
                }
            });
        }

        function clear_data() {
            ds = [];
            $('#po_data').dxSelectBox("instance").option("value", '');
            $("#next_grn").val('');
            $("#ref").val('');
            $("#invoice").val('');
            $("#total").dxNumberBox('instance').option('value', 0);
            $("#discount").dxNumberBox('instance').option('value', 0);
            $("#net_value").dxNumberBox('instance').option('value', 0);
        }

        //view GRN
        $('#otable_grn tbody').on('click', '.btn-view', function() {

            var data = otable_grn.row($(this).parents('tr')).data();

            $("#supplier_view").val(data.supplier.company);
            $("#grn_view").val(data.grn_number);
            $("#ref_view").val(data.ref_no);

            $("#total_view").dxNumberBox('instance').option('value', data.total_value);
            $("#discount_view").dxNumberBox('instance').option('value', data.discount);
            $("#net_value_view").dxNumberBox('instance').option('value', data.net_value);

            $.ajax({
                url: "<?php echo e(route('load_grn_body_view')); ?>",
                method: "GET",
                "data": {
                    "grn_id": data.id,
                },
                success: function(response) {

                    ds_view = [];
                    console.log(response);

                    $.each(response.grn_body, function(k, v) {
                        ds_view.push({
                            "code": v.code,
                            "name": v.name,
                            "rate": v.rate,
                            "qty": v.qty,
                            "free_qty": v.free_qty,
                            "total": v.value,
                        });
                    });
                    $("#grid_container_view").dxDataGrid("instance").option("dataSource", ds_view);
                }
            });

            $("#view_grn_modal").modal("show");
        });

        $("#btn_ask_print_grn").on('click', function(){
            let grn_nu = $("#grn_view").val();
            $("#grn_code").val(grn_nu);

            $("#ask_print_modal").modal("show");
        })

        function print_grn() {
            let print_size = $("#print_size option:selected").val();
            let grn_no = $("#grn_code").val();

            printJS("/grn_invo/"+print_size+"/"+grn_no);
        }

        //view bill
        $("#btn_view_invo").on('click', function() {
            let grn_code = $("#grn_view").val();

            $.ajax({
                url: "<?php echo e(route('load_grn_bill_image')); ?>",
                method: "GET",
                "data": {
                    "grn_code": grn_code,
                },
                success: function(response) {
                    console.log(response.grn_data.inv_image);
                    window.open(response.grn_data.inv_image, '_blank', '', '');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-Chamee\resources\views/stores/grn.blade.php ENDPATH**/ ?>