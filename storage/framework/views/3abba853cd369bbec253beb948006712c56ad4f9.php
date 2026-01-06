
<?php $__env->startSection('title'); ?>
    Complete Appointment
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
        Appoinment
    <?php $__env->endSlot(); ?>
    <?php $__env->slot('title'); ?>
        Complete Appointment
    <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">

                <table id="otable_done_oppintment" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Date</th>
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

<!-- view_history_modal -->
<div id="view_appointment_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header p-3 bg-light">
                <h5 class="modal-title" id="myModalLabel">View Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="recipe-tab" data-bs-toggle="tab" data-bs-target="#prescription_view" type="button" role="tab" aria-controls="prescription_view" aria-selected="true">Prescription</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#note_view" type="button" role="tab" aria-controls="note_view" aria-selected="false">Note</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#investigation_view" type="button" role="tab" aria-controls="investigation_view" aria-selected="false">Investigation Order</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#result_view" type="button" role="tab" aria-controls="result_view" aria-selected="false">Investigation Result</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#service_view" type="button" role="tab" aria-controls="service_view" aria-selected="false">Service</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="prescription_view" role="tabpanel" aria-labelledby="prescription_view-tab">
                        <br>
                        <div id="prescription" class="dx-header-row mt-3"></div>
                    </div>
                    
                    <div class="tab-pane fade show" id="note_view" role="tabpanel" aria-labelledby="note_view-tab">
                        <br>
                        <div id="note" class="dx-header-row mt-3"></div>
                    </div>
                    
                    <div class="tab-pane fade show" id="investigation_view" role="tabpanel" aria-labelledby="investigation_view-tab">
                        <br>
                        <div id="investigation" class="dx-header-row mt-3"></div>
                    </div>
                    
                    <div class="tab-pane fade show" id="result_view" role="tabpanel" aria-labelledby="result_view-tab">
                        <br>
                        <div id="result_grid" class="dx-header-row mt-3"></div>
                    </div>
                    
                    <div class="tab-pane fade show" id="service_view" role="tabpanel" aria-labelledby="service_view-tab">
                        <br>
                        <div id="service" class="dx-header-row mt-3"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                
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
            <input type="hidden" class="form-control" id="appointment_id">

            <p>Do you want to print this Appointment ?</p>
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
            <button type="button" id="btn_print_appointment" onclick="print_appointment()"
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

        var ds_pres = [];
        var ds_note = [];
        var ds_order = [];
        var ds_result = [];
        var ds_service = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var otable_done_oppintment = $("#otable_done_oppintment").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_complete_appointment')); ?>",
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
                    data: 'Complain',
                    name: 'Complain',

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

        $('#otable_done_oppintment tbody').on('click', '.btn-view', function() {

            var data = otable_done_oppintment.row($(this).parents('tr')).data();

            $.post('<?php echo e(route('load_history_data')); ?>',
            {
                "appointment_id":data.ID
            },
            function(res){
                ds_pres = [];
                ds_note = [];
                ds_order = [];
                ds_result = [];
                ds_service = [];

                //----------------PRESCRIPTION---------------
                $.each(res.pres_body, function(k, v) {
                    ds_pres.push({
                        "ID":v.Id,
                        "Name":v.item.Pharma_name,
                        "Dose":v.Dose,
                        "Unit":v.Unit,
                        "Freq":v.Freq,
                        "Period":v.Period,
                        "Qty":v.Qty
                    });
                });
                $("#prescription").dxDataGrid("instance").option("dataSource", ds_pres);

                //----------------NOTE---------------
                $.each(res.note_body, function(k, v) {
                    ds_note.push({
                        "ID":v.Id,
                        "Name":v.Description
                    });
                });
                $("#note").dxDataGrid("instance").option("dataSource", ds_note);

                //----------------ORDER---------------
                $.each(res.inv_order, function(k, v) {
                    ds_order.push({
                        "ID":v.Id,
                        "Narrations":v.Narrations,
                        "Type":v.Ix_type,
                        "Speciman":v.Speciman
                    });
                });
                $("#investigation").dxDataGrid("instance").option("dataSource", ds_order);

                //----------------RESULT---------------
                $.each(res.inves_body, function(k, v) {
                    ds_result.push({
                        "ID":v.Id,
                        "Narration":v.Narration,
                        "Result":v.Results,
                        "Range":v.Normal_range
                    });
                });
                $("#result_grid").dxDataGrid("instance").option("dataSource", ds_result);

                //----------------SERVICE---------------
                $.each(res.opd_ser, function(k, v) {
                    ds_service.push({
                        "ID":v.ID,
                        "Name":v.Description,
                        "Qty":v.Qty,
                        "Rate":v.Unit_Price,
                        "Total":v.Total
                    });
                });
                $("#service").dxDataGrid("instance").option("dataSource", ds_service);

            });

            $("#view_appointment_modal").modal("show");
        });

        var prescription = $('#prescription').dxDataGrid({
            dataSource: ds_pres,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
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
                    allowEditing: true,
                },
                {
                    dataField: 'Unit',
                    caption: 'UNIT',
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
                    allowEditing: true,
                },
                {
                    dataField: 'Qty',
                    caption: 'QTY',
                    format: '#,##0.000',
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },

            ],

            toolbar: {
                items: [

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
                
            },
            onRowUpdated(e) {
                
            },
            onRowRemoving(e) {
                
            },
            onRowRemoved(e) {

            },
            onSaved(e) {
                
            },

        }).dxDataGrid('instance');

        var note = $('#note').dxDataGrid({
            dataSource: ds_note,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
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
                },
                {
                    dataField: 'Description',
                    caption: 'NOTE',
                    allowEditing: false,
                    width: 300,
                },

            ],

            toolbar: {
                items: [
                    
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
                
            },
            onRowUpdated(e) {
                
            },
            onRowRemoving(e) {
                
            },
            onRowRemoved(e) {

            },
            onSaved(e) {
                
            },

        }).dxDataGrid('instance');

        var investigation = $('#investigation').dxDataGrid({
            dataSource: ds_order,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
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
                },
                {
                    dataField: 'Narrations',
                    caption: 'NARRATION',
                    allowEditing: false,
                    width: 300,
                },
                {
                    dataField: 'Type',
                    caption: 'TYPE',
                    allowEditing: true,
                },
                {
                    dataField: 'Speciman',
                    caption: 'SPECIMAN',
                    allowEditing: false,
                },

            ],

            toolbar: {
                items: [
                   
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
                
            },
            onRowUpdated(e) {
                
            },
            onRowRemoving(e) {
                
            },
            onRowRemoved(e) {

            },
            onSaved(e) {
                
            },

        }).dxDataGrid('instance');

        var result_grid = $('#result_grid').dxDataGrid({
            dataSource: ds_result,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
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
                },
                {
                    dataField: 'Narration',
                    caption: 'NARRATION',
                    allowEditing: false,
                    width: 300,
                },
                {
                    dataField: 'Result',
                    caption: 'RESULT',
                    allowEditing: true,
                },
                {
                    dataField: 'Range',
                    caption: 'RANGE',
                    allowEditing: false,
                },

            ],

            toolbar: {
                items: [

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
                
            },
            onRowUpdated(e) {
                
            },
            onRowRemoving(e) {
                
            },
            onRowRemoved(e) {

            },
            onSaved(e) {
                
            },

        }).dxDataGrid('instance');

        var service = $('#service').dxDataGrid({
            dataSource: ds_service,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            // filterRow: {
            //     visible: true
            // },
            columns: [
                {
                    dataField: 'ID',
                    caption: 'ID',
                    width: 100,
                    allowEditing: false,
                },
                {
                    dataField: 'Name',
                    caption: 'NAME',
                    allowEditing: false,
                    width: 300,
                },
                {
                    dataField: 'Qty',
                    caption: 'QTY',
                    format: '#,##0.000',
                    allowEditing: true,
                },
                {
                    dataField: 'Rate',
                    caption: 'RATE',
                    allowEditing: false,
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                },
                {
                    dataField: 'Total',
                    caption: 'TOTAL',
                    allowEditing: false,
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                },

            ],

            toolbar: {
                items: [

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
                
            },
            onRowUpdated(e) {
                
            },
            onRowRemoving(e) {
                
            },
            onRowRemoved(e) {

            },
            onSaved(e) {
                
            },

        }).dxDataGrid('instance');

        $('#otable_done_oppintment tbody').on('click', '.btn-print', function() {

            var data = otable_done_oppintment.row($(this).parents('tr')).data();

            $("#appointment_id").val(data.ID);
            $("#ask_print_modal").modal("show");
        });

        function print_appointment() {
            let print_size = $("#print_size option:selected").val();
            let appointment_id = $("#appointment_id").val();

            printJS("/appointment/"+print_size+"/"+appointment_id);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\SAHANYA\resources\views/cashier/appointment/complete.blade.php ENDPATH**/ ?>