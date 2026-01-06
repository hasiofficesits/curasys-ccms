
<?php $__env->startSection('title'); ?>
GRN List
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
            GRN
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            GRN List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_grn"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> New GRN</button>
                        </div>
                    </div>
                    <table id="otable_grn" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Invoice</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <!-- add_grn_modal -->
    <div id="add_grn_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New GRN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Invoice :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="invoice" placeholder="Enter invoice">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-5 col-form-label">Supplier :</label>
                                <div class="col-sm-9">
                                    <div id="supplier" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Date :</label>
                                <div class="col-sm-9">
                                    <div id="date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-5 col-form-label">PO Type :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="po_type" value="Pharmacy Item" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Item :</label>
                                <div class="col-sm-9">
                                    <div id="item" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-5 col-form-label">Expire Date :</label>
                                <div class="col-sm-9">
                                    <div id="exp_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Qty :</label>
                                <div class="col-sm-8 ps-4">
                                    <div id="qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Free Qty :</label>
                                <div class="col-sm-8">
                                    <div id="free_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Total :</label>
                                <div class="col-sm-8">
                                    <div id="total" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Purchase Price :</label>
                                <div class="col-sm-8  ps-4">
                                    <div id="purchase_price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Selling Price :</label>
                                <div class="col-sm-8">
                                    <div id="selling_price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Discount :</label>
                                <div class="col-sm-8">
                                    <div id="discount" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                            <div class="row text-right">
                                <div class="col-sm-9">
                                </div>
                                <div class="col-sm-3 d-grid">
                                    <button type="button" id="btn_add_toGrid" onclick="add_toGrid()" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>

                        <div id="grid_container" class="dx-header-row mt-3"></div>

                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Total :</label>
                                <div class="col-sm-8">
                                    <div id="final_total" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Discount :</label>
                                <div class="col-sm-8">
                                    <div id="final_discount" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Gross :</label>
                                <div class="col-sm-8">
                                    <div id="final_gross" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_grn" onclick="save_grn()"
                        class="btn btn-primary">Save</button>
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
                    <input type="hidden" class="form-control" id="grn_id">

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
                        class="btn btn-primary">Print</button>
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
        var item = [];
        var ds = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_supplier();
        load_item();

        $('#supplier').dxSelectBox({
            dataSource: supplier,
            displayExpr: 'Company',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Company;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Company"]
        });

        $('#item').dxSelectBox({
            dataSource: item,
            displayExpr: 'Pharma_name',
            // valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Pharma_name + " - " + data.Chemical_Name;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Pharma_name", "Chemical_Name"],
            onValueChanged:function(e){
                $("#purchase_price").dxNumberBox('instance').option('value',0);
                $("#selling_price").dxNumberBox('instance').option('value',0);
                load_item_details(e);
            },
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
        $('#exp_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
        });
        $("#qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
            onValueChanged:function(e){
                let purchase_price = $("#purchase_price").dxNumberBox('instance').option('value');
                let discount = $("#discount").dxNumberBox('instance').option('value');
                let qty = e.value;
                let net = purchase_price*qty;
                let dis_val = net*discount;

                let total = net - dis_val;
                $("#total").dxNumberBox('instance').option('value', total);

            },
        });
        $("#free_qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
        });
        $("#final_total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
            onValueChanged:function(e){
                let discount = $("#final_discount").dxNumberBox('instance').option('value');
                let total = e.value;
                let dis_val = total*discount;

                let gross = total - dis_val;
                $("#final_gross").dxNumberBox('instance').option('value', gross);

            },
        });
        $("#final_gross").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly:true,
        });
        $("#purchase_price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged:function(e){
                let purchase_price = e.value;
                let discount = $("#discount").dxNumberBox('instance').option('value');
                let qty = $("#qty").dxNumberBox('instance').option('value');
                let net = purchase_price*qty;
                let dis_val = net*discount;

                let total = net - dis_val;
                $("#total").dxNumberBox('instance').option('value', total);

            },
        });
        $("#selling_price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
        });
        $("#discount").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged:function(e){
                let purchase_price = $("#purchase_price").dxNumberBox('instance').option('value');
                let qty = $("#qty").dxNumberBox('instance').option('value');
                let net = purchase_price*qty;
                let discount = e.value;
                let dis_val = net*discount;

                let total = net - dis_val;
                $("#total").dxNumberBox('instance').option('value', total);

            },
        });

        $("#final_discount").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged:function(e){
                let net = $("#final_total").dxNumberBox('instance').option('value');
                let discount = e.value;
                let dis_val = net*discount;

                let gross = net - dis_val;
                $("#final_gross").dxNumberBox('instance').option('value', gross);

            },
        });

        function load_supplier() {
            $.ajax({
                url: "<?php echo e(route('load_supplier_to_stock')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    supplier = response.data
                    $('#supplier').dxSelectBox("instance").option("dataSource", supplier);
                }
            })
        }

        function load_item() {
            $.ajax({
                url: "<?php echo e(route('load_stock_item_grn')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    item = response.data
                    $('#item').dxSelectBox("instance").option("dataSource", item);
                }
            })
        }

        var otable_grn = $("#otable_grn").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_grn_grid')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [{
                    data: 'Grid',
                    name: 'ID',
                    "width": "25px",
                },
                {
                    data: 'Date',
                    name: 'Date',
                },
                {
                    data: 'supplier.Company',
                    name: 'supplier.Company',
                    render:function(data, type){
                        if(data==null){
                            return '-';
                        }else {
                            return data;
                        }
                        return data
                    },
                },
                {
                    data: 'RefInv',
                    name: 'RefInv',
                },
                {
                    data: 'Total',
                    name: 'Total',
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
                    "width": "100px",
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

        $("#btn_add_grn").on('click', function() {
            $("#add_grn_modal").modal("show");
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
                allowDeleting: true,
                allowAdding: true,
            },
            // filterRow: {
            //     visible: true
            // },
            columns: [
                {
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'Code',
                    caption: 'CODE',
                    allowEditing: false,
                    width: 120,
                },
                {
                    dataField: 'Name',
                    caption: 'ITEM',
                    width: 300,
                    allowEditing: false,
                },
                {
                    dataField: 'Exp',
                    caption: 'EXP',
                    width: 100,
                    allowEditing: true,
                },
                {
                    dataField: 'UnitCost',
                    caption: 'COST',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 100,
                    allowEditing: true,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'Price',
                    caption: 'PRICE',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 100,
                    allowEditing: true,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'Qty',
                    caption: 'QTY',
                    format: '#,##0.000',
                    allowEditing: true,
                    width: 100,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'Discount',
                    caption: 'DISCOUNT',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 130,
                    allowEditing: true,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'Total',
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
                    dataField: 'Free_Qty',
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
                    info.rowElement.addClass('bg-primary')
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
                let UnitCost = e.oldData.UnitCost;
                let Discount = e.oldData.Discount;
                let Qty = e.oldData.Qty;

                if (e.newData.UnitCost) {
                    UnitCost = e.newData.UnitCost;
                }
                if (e.newData.Qty) {
                    Qty = e.newData.Qty;
                }
                if (e.newData.Discount) {
                    Discount = e.newData.Discount;
                }

                if (e.oldData.status == "old") {
                    e.newData.status = "old_updated";
                }

                e.newData.Total = parseFloat(UnitCost) * parseFloat(Qty) - parseFloat(Discount);
                process_total(ds)
            },
            onRowUpdated(e) {
                if (e.status == "old") {
                    e.status = "old_updated";


                }
                process_total(ds)
            },
            onRowRemoving(e) {
                // console.log("Deleteing..1");
                // console.log(e.key);
                // console.log("Deleteing..1");
                if(e.key.status==="old")
                {
                    deleteItems.push(e.key);

                }
                if(e.key.status==="old_updated")
                {
                    deleteItems.push(e.key);

                }
                process_total(ds)
                // console.log(deleteItems);
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);
                if(e.key.status==="old")
                {
                    deleteItems.push(e.key);

                }
                if(e.key.status==="old_updated")
                {
                    deleteItems.push(e.key);

                }
                process_total(ds)

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        function process_total(ds1) {
            let total = 0;
            if (ds1.length != 0) {
                $.each(ds1, function(k, v) {
                    total += parseFloat(v.Total);
                });
                $("#final_total").dxNumberBox('instance').option('value', total);
            } else {
                $("#final_total").dxNumberBox('instance').option('value', 0);
            }
        }

        function load_item_details() {
            let item_id = $('#item').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_item_details_to_grid')); ?>",
                method: "POST",
                "data": {
                    "item_id":item_id.ID,
                },
                success: function(response) {
                    console.log(response.data);
                    if (response.data == null) {
                        $("#purchase_price").dxNumberBox('instance').option('value',parseFloat(0));
                        $("#selling_price").dxNumberBox('instance').option('value',parseFloat(0));
                    } else {
                        $("#purchase_price").dxNumberBox('instance').option('value',parseFloat(response.data?.Cost));
                        $("#selling_price").dxNumberBox('instance').option('value',parseFloat(response.data?.Price));
                    }
                }
            });
        };

        function add_toGrid() {
            let item_obj = $('#item').dxSelectBox("instance").option("value");
            let item_id = item_obj.ID;
            let item_code = item_obj.Code;
            let item_name = item_obj.Pharma_name;

            let exp_date = $("#exp_date").dxDateBox('instance').option('value');
            let qty = $("#qty").dxNumberBox('instance').option('value');
            let free_qty = $("#free_qty").dxNumberBox('instance').option('value');
            let total = $("#total").dxNumberBox('instance').option('value');
            let purchase_price = $("#purchase_price").dxNumberBox('instance').option('value');
            let selling_price = $("#selling_price").dxNumberBox('instance').option('value');
            let discount = $("#discount").dxNumberBox('instance').option('value');
            
            let net = qty*purchase_price;
            let dis_val = discount*net;

            let data = {
                "ID":item_id,
                "Code":item_code,
                "Name":item_name,
                "UnitCost":purchase_price,
                "Price":selling_price,
                "Exp":exp_date,
                "Qty":qty,
                "Discount":dis_val,
                "Total":total,
                "Free_Qty":free_qty
            };

            var dataSource = dataGrid.getDataSource();

            dataSource.store().insert(data).then(function() {
                dataSource.reload();
                process_total(ds); //calculate total
            })

            reset_elements();
        }

        function reset_elements() {
            $('#item').dxSelectBox("instance").option("value",'');
            $("#qty").dxNumberBox('instance').option('value',0);
            $("#free_qty").dxNumberBox('instance').option('value',0);
            $("#total").dxNumberBox('instance').option('value',0);
            $("#purchase_price").dxNumberBox('instance').option('value',0);
            $("#selling_price").dxNumberBox('instance').option('value',0);
            $("#discount").dxNumberBox('instance').option('value',0);
        };

        $("#add_grn_modal").on('keydown', function ( e ) {
            var key = e.which || e.keyCode;
            if (key == 13) {
                add_toGrid();
                reset_elements(); // <----use the DOM click this way!!!
            }
        });

        function save_grn() {
            let invo_no = $("#invoice").val();
            let supplier = $('#supplier').dxSelectBox("instance").option("value");
            let grn_date = $("#date").dxDateBox('instance').option('value');
            let final_discount = $("#final_discount").dxNumberBox('instance').option('value');
            let final_gross = $("#final_gross").dxNumberBox('instance').option('value');
            let final_total = $("#final_total").dxNumberBox('instance').option('value');
            let po_type = $("#po_type").val();
            let body_data = JSON.stringify(ds);

            console.log(po_type);

            if (invo_no == "") {
                toastr.error("Invoice Number Required");
                $("#btn_save_grn").attr("disabled", false);
            } else if (supplier == null) {
                toastr.error("Supplier Required");
                $("#btn_save_grn").attr("disabled", false);
            }

            $("#btn_save_grn").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_pharma_grn')); ?>",
                "method": "POST",
                "data": {
                    "invo_no":invo_no,
                    "supplier": supplier,
                    "grn_date": grn_date,
                    "po_type":po_type,
                    "final_discount":final_discount,
                    "final_total":final_total,
                    "final_gross":final_gross,
                    "body_data":body_data
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("GRN Added Successfully");
                        otable_grn.ajax.reload();
                        $("#add_grn_modal").modal("hide");
                        ds = [];
                        clear_grn_form();
                        $("#btn_save_grn").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_grn").attr("disabled", false);
                    }
                },
            });
        }

        function clear_grn_form() {
            ds = [];
            $("#invoice").val('');
            $('#supplier').dxSelectBox("instance").option("value",'');
            $('#item').dxSelectBox("instance").option("value",'');
            $("#qty").dxNumberBox('instance').option('value',0);
            $("#free_qty").dxNumberBox('instance').option('value',0);
            $("#total").dxNumberBox('instance').option('value',0);
            $("#purchase_price").dxNumberBox('instance').option('value',0);
            $("#selling_price").dxNumberBox('instance').option('value',0);
            $("#discount").dxNumberBox('instance').option('value',0);
            $("#final_discount").dxNumberBox('instance').option('value',0);
            $("#final_gross").dxNumberBox('instance').option('value',0);
            $("#final_total").dxNumberBox('instance').option('value',0);
        }

        $('#otable_grn tbody').on('click', '.btn-print', function() {

            var data = otable_grn.row($(this).parents('tr')).data();

            $("#grn_id").val(data.Grid);
            $("#ask_print_modal").modal("show");
        });

        function print_grn() {
            let print_size = $("#print_size option:selected").val();
            let grn_no = $("#grn_id").val();

            printJS("/grn_invo/"+print_size+"/"+grn_no);
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/Stock/GRN/grn.blade.php ENDPATH**/ ?>