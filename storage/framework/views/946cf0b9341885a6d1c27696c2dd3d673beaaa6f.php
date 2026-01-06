
<?php $__env->startSection('title'); ?>
Appointment
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
            Appointment
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Appointment
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_reload"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-redo-alt"></i> Reload</button>
                        </div>
                    </div>
                    <table id="otable_appointment" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Que</th>
                                <th>Patient</th>
                                <th>Complaint</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- ask_appointment_modal -->
    <div id="ask_appointment_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Make Appointment ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="que_id">

                    <p>Do you want to make appointment ?</p>
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Doctor :</label>
                                <div class="col-sm-9">
                                    <div id="doctor" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_make_appointment" onclick="make_appointment()"
                        class="btn btn-primary">Make</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- view_history_modal -->
    <div id="view_history_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="recipe-tab" data-bs-toggle="tab"
                                data-bs-target="#prescription" type="button" role="tab"
                                aria-controls="prescription" aria-selected="true">Prescription History</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#note"
                                type="button" role="tab" aria-controls="note" aria-selected="false">Note
                                History</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#investigation" type="button" role="tab"
                                aria-controls="investigation" aria-selected="false">Investigation History</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="prescription" role="tabpanel"
                            aria-labelledby="prescription-tab">
                            <br>
                            <div id="grid_prescription" class="dx-header-row mt-3"></div>
                            
                        </div>
                        
                        <div class="tab-pane fade show" id="note" role="tabpanel" aria-labelledby="note-tab">
                            <br>
                            <div class="row" id="note-view">
                                <div class="col-6">
                                    <div class="card border card-border-success">
                                        <div class="card-header">
                                            <span class="float-end">75%</span>
                                            <h6 class="card-title mb-0">Handle to Forcast <span
                                                    class="badge bg-danger align-middle fs-10">Poor</span></h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Whether article spirits new her covered hastily sitting
                                                her. Money witty books nor son add build on the card Chicken age had evening
                                                believe but proceed pretend mrs.</p>
                                            <div class="text-end">
                                                <a href="javascript:void(0);" class="link-primary fw-medium">Read More <i
                                                        class="ri-arrow-right-line align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade show" id="investigation" role="tabpanel"
                            aria-labelledby="investigation-tab">
                            <br>
                            <div id="grid_result_view" class="dx-header-row mt-3"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    
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
        var doctor = [];

        var ds_pres_view = [];
        var ds_result_view = [];
        var ds_result_Bodyview = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_doctor();

        $('#doctor').dxSelectBox({
            dataSource: doctor,
            displayExpr: 'Name',
            valueExpr: 'DID',
            itemTemplate: function(data) {
                return data.DID + " - " + data.Name;
            },
            searchEnabled: true,
            searchExpr: ["DID", "Name"]
        });

        function load_doctor() {
            $.ajax({
                url: "<?php echo e(route('load_doctor_appo')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    doctor = response.data
                    $('#doctor').dxSelectBox("instance").option("dataSource", doctor);
                }
            })
        }

        var otable_appointment = $("#otable_appointment").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_app_queue_grid')); ?>",
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
                    data: 'DaiyCount',
                    name: 'DaiyCount',
                },
                {
                    data: 'patient.FullName',
                    name: 'patient.FullName',
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
                    data: 'Complaint',
                    name: 'Complaint',
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

        $("#btn_reload").on('click', function() {
            otable_appointment.ajax.reload();
        });

        $('#otable_appointment tbody').on('click', '.btn-make', function() {

            var data = otable_appointment.row($(this).parents('tr')).data();

            $("#que_id").val(data.ID);
            $("#ask_appointment_modal").modal("show");
        });

        function make_appointment() {
            let que_id = $("#que_id").val();
            let doctor_id = $('#doctor').dxSelectBox("instance").option("value");

            $("#btn_make_appointment").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_appointment_table')); ?>",
                "method": "POST",
                "data": {
                    "que_id":que_id,
                    "doctor_id":doctor_id
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Appointment Added Successfully");
                        otable_appointment.ajax.reload();
                        $("#que_id").val('');

                        $("#ask_appointment_modal").modal("hide");
                        $("#btn_make_appointment").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_make_appointment").attr("disabled", false);
                    }
                },
            });
        }

        $('#otable_appointment tbody').on('click', '.btn-view', function() {

            var data = otable_appointment.row($(this).parents('tr')).data();

            let appointment_id = $("#appointment_id").val();

            $.post('<?php echo e(route('load_history_data')); ?>', {
                "appointment_id": appointment_id
            },
            function(res) {
                ds_result_view = [];
                ds_pres_view = [];

                //----------------PRESCRIPTION---------------
                $.each(res.pres_body, function(k, v) {
                    ds_pres_view.push({
                        "ID": v.Id,
                        "Name": v.item.Pharma_name,
                        "Dose": v.Dose,
                        "Freq": v.Freq,
                        "Period": v.Period,
                        "Date": v.Date
                    });
                });
                $("#grid_prescription").dxDataGrid("instance").option("dataSource", ds_pres_view);


                //----------------NOTE---------------
                var template = ``;
                $("#note-view").empty()
                $.each(res.note_body, function(k, v) {
                    template += `<div class="col-6">
                                <div class="card border card-border-info">
                                    <div class="card-header">
                                        <span class="float-end">${v.Narration}</span>
                                        <h6 class="card-title mb-0">${v.Type}</h6>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">${v.Description}</p>
                                    </div>
                                </div>
                            </div>`;

                })
                $("#note-view").append(template)

                //----------------INVESTIGATION---------------
                $.each(res.investigation, function(k, v) {
                    ds_result_view.push({
                        "ID": v.Id,
                        "Investigation": v.Ix,
                        "Date": v.Date
                    });
                });
                $("#grid_result_view").dxDataGrid("instance").option("dataSource", ds_result_view);

            });

            $("#view_history_modal").modal("show");
        });

        //--------HISTORY VIEW GRIDS------------
        var dataGrid_prescription_view = $('#grid_prescription').dxDataGrid({
            dataSource: ds_pres_view,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                },
                {
                    dataField: 'Name',
                    caption: 'NAME',
                    allowEditing: false,
                    width: 300,
                },
                {
                    dataField: 'Dose',
                    caption: 'DOSE',
                    allowEditing: false,
                },
                {
                    dataField: 'Freq',
                    caption: 'FREQUENCY',
                    allowEditing: false,
                },
                {
                    dataField: 'Period',
                    caption: 'PERIOD',
                    allowEditing: false,
                },
                {
                    dataField: 'Date',
                    caption: 'ISSUE DATE',
                    allowEditing: false,
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

            },
            onRowUpdated(e) {

            },
            onRowRemoving(e) {
                // console.log("Deleteing..1");
                // console.log(e.key);
                // console.log("Deleteing..1");

                // console.log(deleteItems);
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        var result_ID = [];

        var dataGrid_result_view = $('#grid_result_view').dxDataGrid({
            dataSource: ds_result_view,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            selection: {
                // mode: 'multiple',
                mode: 'single',
            },
            // editing: {
            //     mode: 'row',
            //     allowUpdating: true,
            //     allowDeleting: true,
            //     allowAdding: true,
            // },
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                },
                {
                    dataField: 'Date',
                    caption: 'DATE',
                    allowEditing: true,
                    width: 300,
                },
                {
                    dataField: 'Investigation',
                    caption: 'INVESTIGATION',
                    allowEditing: true,
                },

            ],

            toolbar: {
                items: [

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

            },
            onRowUpdated(e) {

            },
            onRowRemoving(e) {

            },
            onRowRemoved(e) {

            },
            onSaved(e) {
                console.log(e);
            },
            onRowClick: function(e) {
                console.log(e.data);
                result_ID = e.data.ID;

                view_result_body();
            }

        }).dxDataGrid('instance');

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\SAHANYA\resources\views/appointment/appointment/new_appointment.blade.php ENDPATH**/ ?>