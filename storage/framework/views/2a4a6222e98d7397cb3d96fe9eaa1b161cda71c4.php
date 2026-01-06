
<?php $__env->startSection('title'); ?>
Return Note
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
        Return Note
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Return Note
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
                                <i class="las la-plus-circle"></i> New Return Note</button>
                        </div>
                    </div>
                    <table id="otable_return" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Type</th>
                                <th>Balance</th>
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

    <!-- add_return_modal -->
    <div id="add_return_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Return Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Supplier :</label>
                                <div class="col-sm-9">
                                    <div id="supplier" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-5 col-form-label">Date :</label>
                                <div class="col-sm-9">
                                    <div id="return_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Reason :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="reason" placeholder="Enter Reason">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-5 col-form-label">Type :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="type" value="Pharmacy Item" disabled>
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
                                <label for="colFormLabel" class="col-sm-3 ps-5 col-form-label">Lot :</label>
                                <div class="col-sm-9">
                                    <div id="lot" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Rate :</label>
                                <div class="col-sm-8 ps-4">
                                    <div id="rate" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Qty :</label>
                                <div class="col-sm-8">
                                    <div id="qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Total :</label>
                                <div class="col-sm-8">
                                    <div id="total" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row text-right">
                                <div class="col-sm-5">
                                </div>
                                <div class="col-sm-7 d-grid">
                                    <button type="button" id="btn_add_toGrid" onclick="add_toGrid()" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>

                        <div id="grid_container" class="dx-header-row mt-3"></div>

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
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Total :</label>
                                <div class="col-sm-8">
                                    <div id="final_total" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_return_note" onclick="save_return_note()"
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
                    <input type="hidden" class="form-control" id="return_note_id">

                    <p>Do you want to print this Return Note ?</p>
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
                    <button type="button" id="btn_print_return_note" onclick="print_return_note()"
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
        var lot = [];
        var ds = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_supplier();

        $('#supplier').dxSelectBox({
            dataSource: supplier,
            displayExpr: 'Company',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Company;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Company"],
            onValueChanged:function(e){
                load_item(e);
            },
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
                load_lot(e);
            },
        });
        $('#lot').dxSelectBox({
            dataSource: lot,
            displayExpr: 'ID',
            // valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Batch + " - " + data.Exp_date;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Exp_date", "Batch"],
            onValueChanged:function(e){
                load_lot_price(e);
            },
            
        });
        $('#return_date').dxDateBox({
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

                let rate = $("#rate").dxNumberBox('instance').option('value');
                let qty = e.value;

                let total = rate * qty;
                $("#total").dxNumberBox('instance').option('value', total);
            },
        });
        $("#total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#rate").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#final_total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
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
            let supplier_id = $('#supplier').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_stock_item_from_supplier')); ?>",
                method: "GET",
                "data": {
                    "supplier_id":supplier_id,
                },
                success: function(response) {
                    // console.log(response)
                    item = response.data
                    $('#item').dxSelectBox("instance").option("dataSource", item);
                }
            })
        }

        function load_lot() {
            let item_id = $('#item').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_lot_details')); ?>",
                method: "POST",
                "data": {
                    "item_id":item_id.ID,
                },
                success: function(response) {
                    // console.log(response.data);
                    lot = response.data
                    $('#lot').dxSelectBox("instance").option("dataSource", lot);
                }
            });
        }

        function load_lot_price() {
            let lot_id = $('#lot').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_lot_price')); ?>",
                method: "POST",
                "data": {
                    "lot_id":lot_id.ID,
                },
                success: function(response) {
                    console.log(response.data);
                    if (response.data == null) {
                        $("#rate").dxNumberBox('instance').option('value',parseFloat(0));
                    } else {
                        $("#rate").dxNumberBox('instance').option('value',parseFloat(response.data?.Cost));
                    }
                }
            });
        }

        function add_toGrid() {
            let item_obj = $('#item').dxSelectBox("instance").option("value");
            let item_id = item_obj.ID;
            let item_code = item_obj.Code;
            let item_name = item_obj.Pharma_name;

            let lot_obj = $('#lot').dxSelectBox("instance").option("value");
            let lot_id = lot_obj.ID;

            let rate = $("#rate").dxNumberBox('instance').option('value');
            let qty = $("#qty").dxNumberBox('instance').option('value');
            let total = $("#total").dxNumberBox('instance').option('value');

            let data = {
                "ID":item_id,
                "Code":item_code,
                "Name":item_name,
                "Qty":qty,
                "Total":total,
                "UnitCost":rate,
                "LotId":lot_id
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
            $('#lot').dxSelectBox("instance").option("value",'');
            $("#rate").dxNumberBox('instance').option('value',0);
            $("#qty").dxNumberBox('instance').option('value',0);
            $("#total").dxNumberBox('instance').option('value',0);
        };

        $("#add_return_modal").on('keydown', function ( e ) {
            var key = e.which || e.keyCode;
            if (key == 13) {
                add_toGrid();
                reset_elements(); // <----use the DOM click this way!!!
            }
        });

        var otable_return = $("#otable_return").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_return_note_grid')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [{
                    data: 'ID',
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
                },
                {
                    data: 'Type',
                    name: 'Type',
                },
                {
                    data: 'Balance',
                    name: 'Balance',
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
                    dataField: 'LotId',
                    caption: 'LOT ID',
                    width: 50,
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'ID',
                    caption: 'ITEM ID',
                    width: 50,
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'Name',
                    caption: 'ITEM',
                    width: 300,
                    allowEditing: false,
                },
                {
                    dataField: 'UnitCost',
                    caption: 'COST',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 100,
                    allowEditing: false,
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
                    dataField: 'Total',
                    caption: 'TOTAL',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 100,
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
                let Qty = e.oldData.Qty;

                if (e.newData.UnitCost) {
                    UnitCost = e.newData.UnitCost;
                }
                if (e.newData.Qty) {
                    Qty = e.newData.Qty;
                }
                if (e.oldData.status == "old") {
                    e.newData.status = "old_updated";
                }

                e.newData.Total = parseFloat(UnitCost) * parseFloat(Qty);
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

        $("#btn_add_grn").on('click', function(){
            $("#add_return_modal").modal("show");
        });

        function save_return_note() {
            let supplier = $('#supplier').dxSelectBox("instance").option("value");
            let date = $("#return_date").dxDateBox('instance').option('value');
            let reason = $("#reason").val();
            let type = $("#type").val();
            let body_data = JSON.stringify(ds);
            let final_total = $("#final_total").dxNumberBox('instance').option('value');

            if (supplier == null) {
                toastr.error("Supplier Required");
                $("#btn_save_return_note").attr("disabled", false);
            }

            $("#btn_save_return_note").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_return_note')); ?>",
                "method": "POST",
                "data": {
                    "supplier":supplier,
                    "date":date,
                    "reason":reason,
                    "type":type,
                    "body_data":body_data,
                    "final_total":final_total
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Return Note Added Successfully");
                        // otable_grn.ajax.reload();
                        $("#add_return_modal").modal("hide");
                        ds = [];
                        clear_form();
                        $("#btn_save_return_note").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_return_note").attr("disabled", false);
                    }
                },
            });

        }

        function clear_form() {
            $('#supplier').dxSelectBox("instance").option("value",'');
            $("#reason").val('');
            $("#final_total").dxNumberBox('instance').option('value',0);
        }

        $('#otable_return tbody').on('click', '.btn-print', function() {

            var data = otable_return.row($(this).parents('tr')).data();

            $("#return_note_id").val(data.ID);
            $("#ask_print_modal").modal("show");
        });

        function print_return_note() {
            let print_size = $("#print_size option:selected").val();
            let return_note_id = $("#return_note_id").val();

            printJS("/return_note_invo/"+print_size+"/"+return_note_id);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/Stock/return_note/return_note.blade.php ENDPATH**/ ?>