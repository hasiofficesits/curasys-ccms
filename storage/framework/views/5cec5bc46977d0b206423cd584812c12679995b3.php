
<?php $__env->startSection('title'); ?>
Transfer-In
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
            Transfer-In
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Transfer-In
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_request"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> New Transfer Request</button>
                        </div>
                    </div>
                    <table id="otable_request_note" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>TR No</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Date</th>
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

    <!-- add_request_modal -->
    <div id="add_request_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">

                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">TR No : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tr_no"
                                            placeholder="" value="<?php echo e($next_ktrn_code); ?>"  disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Date : </label>
                                    <div class="col-sm-8">
                                        <div id="request_date" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Depatment : </label>
                                    <div class="col-sm-8">
                                        
                                        <div id="department" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Item : </label>
                                    <div class="col-sm-8">
                                        
                                        <div id="item" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Qty : </label>
                                    <div class="col-sm-8">
                                        
                                        <div id="item_qty" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <div id="unit" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="text-align: right">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel" class="col-sm-12 col-form-label">
                                            <span class="text-danger">*</span> Select Unit - Kg, Ltr, Pkt or Btl </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Name : </label>
                                    <div class="col-sm-8">
                                        
                                        <input type="text" class="form-control" id="name"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Code : </label>
                                    <div class="col-sm-8">
                                        
                                        <input type="text" class="form-control" id="code"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    
                                </div>
                            </div> 
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-sm-9">
                                    </div>
                                    <div class="col-sm-3" style="padding-left: 73px;">
                                        <button type="button" id="add_to_grid" onclick="add_item_to_grid()" class="btn btn-success">Add</button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                
                                    <div id="grid_container" class="dx-header-row"></div>
                                
                            </div>

                            

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_request" onclick="save_request()" class="btn btn-success">Send Request</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- request_check_modal -->
    <div id="request_check_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">TRN View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">

                            <div class="col-lg-3">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">TR No : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="tr_no_view"
                                            placeholder=""  disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">R.Date : </label>
                                    <div class="col-sm-8">
                                        <div id="view_date" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">From : </label>
                                    <div class="col-sm-8">
                                        
                                        <input type="text" class="form-control" id="from_dep"
                                            placeholder="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">To : </label>
                                    <div class="col-sm-8">
                                        
                                        <input type="text" class="form-control" id="to_dep"
                                            placeholder="" disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Req. By : </b></label>
                                    <div class="col-sm-9">
                                        <label for="colFormLabel" id="req_by" class="col-sm-4 col-form-label"> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Req. Date : </b></label>
                                    <div class="col-sm-9">
                                        <label for="colFormLabel" id="req_date" class="col-sm-4 col-form-label"> </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-3 col-form-label"><b>Issue By : </b></label>
                                    <div class="col-sm-9">
                                        <label for="colFormLabel" id="issue_by" class="col-sm-4 col-form-label">  </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label"><b>Issue Date : </b></label>
                                    <div class="col-sm-8">
                                        <label for="colFormLabel" id="issue_date" class="col-sm-4 col-form-label"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label"><b>Accept By : </b></label>
                                    <div class="col-sm-8">
                                        <label for="colFormLabel" id="accept_by" class="col-sm-4 col-form-label">  </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label"><b>Accept Date :</b> </label>
                                    <div class="col-sm-8">
                                        <label for="colFormLabel" id="accept_date" class="col-sm-4 col-form-label">  </label>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-lg-12">
                                
                                    <div id="grid_container_view" class="dx-header-row"></div>
                                
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label"><b>Gross Total :</b> </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control text-end" id="total" placeholder="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_trn_delete" class="btn btn-danger">Delete</button>
                    <button type="button" id="btn_trn_accept" class="btn btn-info">Accept</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask delete -->
    <div id="ask_accept_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Accept Request Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_trn_number">
                    <h5 class="modal-title">Are you sure Accept the Transfer-in Note, with all goods are recieved in good Condition ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_accept_request" class="btn btn-success">Accept</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask delete -->
    <div id="ask_delete_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Delete Request Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_trn_number">
                    <h5 class="modal-title">Do You Want toDelete this Request ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="delete_req" onclick="delete_request()" class="btn btn-success">Delete</button>
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

        var department = [];
        var item = [];
        var ds = [];
        var ds2 = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_department();

        $('#request_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
            
        });
        
        $('#view_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
            readOnly : true,
            
        });

        $("#item_qty").dxNumberBox({
            format: '#,##0.000',
            valueChangeEvent: "keyup",
        });

        $('#item').dxSelectBox({
            dataSource: item,
            displayExpr: 'name',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.code + " - " + data.name;
            },
            searchEnabled: true,
            searchExpr: ["code", "name"]
        });

        let units = [{id: "1",name: "Kg"},{id: "2",name: "Ltr"},{id: "3",name: "Pkt"},{id: "4",name: "Btl"}];

        $('#unit').dxSelectBox({

            displayExpr: 'name',
            valueExpr: 'name',
            items: units,
        });

        $('#department').dxSelectBox({
            dataSource: department,
            displayExpr: 'Department_Name',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Department_Name;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Department_Name"],
            onValueChanged: function(e) {
                const newValue = e.value;
                // Event handling commands go here
                $("#item").dxSelectBox("instance").option("value", '');
                load_depvice_item(newValue);
            }
        });

        $('#item').dxSelectBox({
            dataSource: item,
            displayExpr: 'name',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.code + " - " + data.name;
            },
            searchEnabled: true,
            searchExpr: ["code", "name"],
            onValueChanged: function(e) {
                const newValue = e.value;
                // Event handling commands go here
                $("#name").val('');
                $("#code").val('');
                load_selected_data(newValue);
            }
        });

        var otable_request_note = $("#otable_request_note").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_trn_data')); ?>",
                method: "POST",
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
                    data: 'Tr_No',
                    name: 'Tr_No',
                },
                {
                    data: 'from_dep.Department_Name',
                    name: 'from_dep.Department_Name',

                },
                {
                    data: 'to_dep.Department_Name',
                    name: 'to_dep.Department_Name',

                },
                {
                    data: 'Requested_Date',
                    name: 'Requested_Date',
                },
                {
                    data: 'Status',
                    name: 'Status',
                    render: function(data, type, row, meta) {
                        if (data == 0) {
                            return '<span class="badge bg-warning p-2">Request</span>'
                        } else if (data == 1) {
                            return '<span class="badge bg-info p-2">Issue</span>';
                        } else if (data == 2) {
                            return '<span class="badge bg-success p-2">Done</span>';
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

        $("#btn_add_request").on('click', function(){

            $("#add_request_modal").modal("show");
            
            
        });

        function load_department() {
            $.ajax({
                url: "<?php echo e(route('load_department')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    department = response.data
                    $('#department').dxSelectBox("instance").option("dataSource", department);
                    
                }
            })
        };

        var dataGrid1 = $('#grid_container').dxDataGrid({
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
                    dataField: 'item_id',
                    caption: 'Item ID',
                    allowEditing: false,
                },
                {
                    dataField: 'item_name',
                    caption: 'Item',
                    width: 200,
                    allowEditing: false,
                },

                {
                    dataField: 'code',
                    caption: 'Code',
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'qty',
                    caption: 'Qty',
                    format: '#,##0.000',
                    allowEditing: true,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'unit',
                    caption: 'Unit',
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'date',
                    caption: 'Date',
                    allowEditing: false,
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

                if (e.newData.qty) {
                    qty = e.newData.qty;
                }

                if (e.oldData.status == "old") {
                    e.newData.status = "old_updated";
                }
                // process_total(ds)
            },
            onRowUpdated(e) {
                if (e.status == "old") {
                    e.status = "old_updated";

                }
                // process_total(ds)
            },
            onRowRemoving(e) {
                
                // process_total(ds)
            },
            onRowRemoved(e) {
                
                // process_total(ds)

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        var dep_id = null;

        function load_depvice_item() {

            dep_id = $('#department').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_item_details')); ?>",
                method: "GET",
                "data": {
                    "dep_id": dep_id,
                },
                success: function(response) {
                    // console.log(response)
                    item = response.data;
                    $('#item').dxSelectBox("instance").option("dataSource", item);
                }
            })

        }

        function load_selected_data() {

            let item_id = $('#item').dxSelectBox("instance").option("value");
            let selected_dep = dep_id;
            console.log(selected_dep);

            $.ajax({
                url: "<?php echo e(route('load_selected_item_details')); ?>",
                method: "GET",
                "data": {
                    "item_id": item_id,
                    "selected_dep":selected_dep
                },
                success: function(response) {
                    console.log(response);
                    item_name = response.data.name;
                    item_code = response.data.code;

                    $("#name").val(item_name);
                    $("#code").val(item_code);
                }
            })
        }

        function add_item_to_grid() {

            let name = $("#name").val();
            let item_id = $('#item').dxSelectBox("instance").option("value");
            let item_code = $("#code").val();
            let qty = $('#item_qty').dxNumberBox("instance").option("value");
            let date = $("#request_date").dxDateBox('instance').option('value');
            let unit = $('#unit').dxSelectBox("instance").option("value");
            

            let data = {
                // "ID":temp,
                "item_name":name,
                "item_id":item_id,
                "code":item_code,
                "qty":qty,
                "date":date,
                "unit":unit,
            };

            var dataSource = dataGrid1.getDataSource();

            dataSource.store().insert(data).then(function() {
                dataSource.reload();
                // process_total(ds); //calculate total
            });

            reset_elements();

        }

        $("#add_request_modal").on('keydown', function ( e ) {
            var key = e.which || e.keyCode;
            if (key == 13) {
                add_item_to_grid();
                reset_elements(); // <----use the DOM click this way!!!
            }
        });

        $('#add_request_modal').on('hidden.bs.modal', function (e) {

            reset_elements_modal_close();
            // $('#yourForm').find("input[type=text], textarea").val("");
        })

        function reset_elements_modal_close() {
            ds = [];
            $("#item_qty").dxNumberBox('instance').option('value',0);
            $("#item").dxSelectBox('instance').option('value','');
            $("#unit").dxSelectBox('instance').option('value','');
            $("#department").dxSelectBox('instance').option('value','');
            $("#name").val('');
            $("#code").val('');
        }

        function reset_elements()
        {
            $("#item_qty").dxNumberBox('instance').option('value',0);
            $("#item").dxSelectBox('instance').option('value','');
            $("#unit").dxSelectBox('instance').option('value','');
            // $("#department").dxSelectBox('instance').option('value','');
            $("#name").val('');
            $("#code").val('');
        }

        function save_request() {

            let body_data = JSON.stringify(ds);

            let trn_no = $("#tr_no").val();
            let item_id = $('#item').dxSelectBox("instance").option("value");
            let date = $("#request_date").dxDateBox('instance').option('value');
            let dep_id = $('#department').dxSelectBox("instance").option("value");

            let data = {
                "body_data":body_data,
                "trn_no":trn_no,
                "item_id":item_id,
                "date":date,
                "dep_id":dep_id,
            };

            $("#btn_save_request").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('save_request_note')); ?>",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.success) {

                        toastr.success("Request Note Added!!");
                        $("#add_request_modal").modal("hide");
                        otable_request_note.ajax.reload();

                        $("#btn_save_request").attr("disabled", false);

                    } else {
                        toastr.error("Invalid Data!");
                        $("#btn_save_request").attr("disabled", false);
                    }
                },
                error: function(err) {
                    toastr.error("Invalid Data!");
                    $("#btn_save_request").attr("disabled", false);
                }
            })
        }
        var selected_trn_number = null;

        $('#otable_request_note tbody').on('click', '.btn-view', function() {

            var data = otable_request_note.row($(this).parents('tr')).data();
            console.log(data);

            $("#tr_no_view").val(data.Tr_No);
            $("#from_dep").val(data.from_dep.Department_Name);
            $("#to_dep").val(data.to_dep.Department_Name);
            $("#total").val("LKR. " + data.Total_Value);

            $("#req_by").text(data.Requested_by);
            $("#req_date").text(data.Requested_Date);
            $("#issue_by").text(data.Issue_by);
            $("#issue_date").text(data.Issue_Date);
            $("#accept_by").text(data.Accept_by);
            $("#accept_date").text(data.Accept_Date);
            $("#view_date").dxDateBox('instance').option('value', data.Requested_Date);

            selected_trn_number = $("#tr_no_view").val();

            let slected_trn_id = data.ID;

            //load exist recipe body to grid
            $.ajax({
                url: "<?php echo e(route('load_exist_trn_details')); ?>",
                method: "GET",
                "data": {
                    "slected_trn_id":slected_trn_id,
                },
                success: function(response) {

                    ds2 = [];
                    console.log(response);
                    
                    $.each(response.data, function(k, v) {
                        ds2.push({
                            "item_name":v.Name,
                            "code":v.Code,
                            "qty":v.Qty,
                            "cost":v.Cost,
                            "total":v.Total
                        });
                    });
                    $("#grid_container_view").dxDataGrid("instance").option("dataSource", ds2);
                }
            });

            if (data.Status == 0) {
                $("#btn_trn_delete").show();
                $("#btn_trn_accept").hide();
            } else if(data.Status == 1) {
                $("#btn_trn_delete").hide();
                $("#btn_trn_accept").show();
            } else {
                $("#btn_trn_delete").hide();
                $("#btn_trn_accept").hide();
            }

            $("#request_check_modal").modal("show");

        });
        
        var dataGrid = $('#grid_container_view').dxDataGrid({
            dataSource: ds2,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            // editing: {
            //     mode: 'row',
            //     allowUpdating: true,
            //     allowDeleting: true,
            //     allowAdding: true,
            // },
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
                    dataField: 'item_name',
                    caption: 'Item',
                    width: 200,
                    allowEditing: false,
                },

                {
                    dataField: 'code',
                    caption: 'Code',
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'qty',
                    caption: 'Qty',
                    alignment: "right",
                    format: '#,##0.000',
                    allowEditing: true,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'cost',
                    caption: 'Cost',
                    alignment: "right",
                    format: "LKR #,##0.##",
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'total',
                    caption: 'Total',
                    alignment: "right",
                    format: "LKR #,##0.##",
                    allowEditing: false,
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

                if (e.newData.qty) {
                    qty = e.newData.qty;
                }

                if (e.oldData.status == "old") {
                    e.newData.status = "old_updated";
                }
                // process_total(ds)
            },
            onRowUpdated(e) {
                if (e.status == "old") {
                    e.status = "old_updated";

                }
                // process_total(ds)
            },
            onRowRemoving(e) {
                
                // process_total(ds)
            },
            onRowRemoved(e) {
                
                // process_total(ds)

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        $("#btn_trn_delete").on('click', function(){
            $("#selected_trn_number").val(selected_trn_number);
            $("#ask_delete_modal").modal("show");
        });

        function delete_request() {

            let trn_number = $("#selected_trn_number").val();

            $("#delete_req").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('delete_trn_request')); ?>",
                method: "POST",
                "data": {
                    "trn_number":trn_number,
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Request Deleted Successfully");
                        otable_request_note.ajax.reload();
                        $("#ask_delete_modal").modal("hide");
                        $("#request_check_modal").modal("hide");

                        $("#delete_req").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#delete_req").attr("disabled", false);
                    }
                },
            });
        };

        // $("#btn_trn_accept").on('click', function(){
        //     $("#ask_accept_modal").modal("show");
        // })

        //Accept Request Note
        $("#btn_trn_accept").on('click', function(){

            let trn_number = $("#tr_no_view").val();

            $("#btn_trn_accept").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('accept_trn_request')); ?>",
                method: "POST",
                "data": {
                    "trn_number":trn_number,
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Request Accept Successfully");
                        otable_request_note.ajax.reload();

                        $("#request_check_modal").modal("hide");

                        $("#btn_trn_accept").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_trn_accept").attr("disabled", false);
                    }
                },
            });

        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/stores/transfer_in.blade.php ENDPATH**/ ?>