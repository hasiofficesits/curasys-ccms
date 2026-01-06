
<?php $__env->startSection('title'); ?>
    Book Appointment
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
            Book Appointment
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_appointment"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Make New Appointment</button>
                        </div>
                    </div>
                    <table id="otable_oppintment" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Date</th>
                                <th>Patient</th>
                                <th>Que</th>
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
    <!-- add_appointment_modal -->
    <div id="add_appointment_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Appointment No</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="next_app_number" value="<?php echo e($next_app_number); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Date : </label>
                                <div class="col-sm-8">
                                    <div id="date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Patient : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="patient" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-8">
                                    
                                </div>
                                <div class="col-sm-4 d-grid">
                                    <button type="button" id="btn_select_patient" class="btn btn-primary">Select Patient</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Complaint : </label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="complaint" rows="3"></textarea>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_appointment" onclick="save_appointment()"
                        class="btn btn-primary">Make Appointment</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- select_patient_modal -->
    <div id="select_patient_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Select Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <form id="table_form">
                            <table id="otable_patient" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Mobile</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </form>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <button type="button" id="btn_new_patient" class="btn btn-primary">
                                    <i class="las la-plus-circle"></i> New Patient</button>
                            </div>
                        </div>
                        <form id="add_patient_form">
                            <div class="row g-2">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Name : </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 col-form-label">Gender : </label>
                                        <div class="col-sm-8">
                                            <div id="gender" class=" form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Birthday : </label>
                                        <div class="col-sm-8">
                                            <div id="birthday" class=" form-control"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 col-form-label">Email : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Contact : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="contact">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Address : </label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="address" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_patient" onclick="save_patient()"
                        class="btn btn-primary">Save Patient</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_cancel_modal -->
    <div id="ask_cancel_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Cancel Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="app_id">
                    <h5 class="modal-title">Do You Want to Cancel this Appointment ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_cancel" onclick="cancel()" class="btn btn-danger">Cancel</button>
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
        var selected_patient = null;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#gender').dxSelectBox({
            items: ['Male', "Female"],

        });

        $('#date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                next_app_number(e);
            }, 
        });

        $('#birthday').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            // onValueChanged: function(e) {
            //     next_app_number(e);
            // }, 
        });

        $("#btn_add_appointment").on('click', function() {
            $("#add_appointment_modal").modal("show");
        });

        function next_app_number() {
            let date = $("#date").dxDateBox('instance').option('value');

            $.ajax({
                url: "<?php echo e(route('next_app_number')); ?>",
                method: "GET",
                "data": {
                    "date":date,
                },
                success: function(response) {
                    // console.log(response)
                    console.log(response.data);
                    $("#next_app_number").val(response.data);
                }
            })
        };

        $("#btn_select_patient").on('click', function(){
            otable_patient.ajax.reload();
            $("#select_patient_modal").modal("show");
        });

        var otable_oppintment = $("#otable_oppintment").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_opdqueue_grid')); ?>",
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
                    data: 'DaiyCount',
                    name: 'DaiyCount',
                },
                {
                    data: 'Status',
                    name: 'Status',
                    render:function(data, type){
                        if(data=="New"){
                            return '<span class="badge bg-info p-2">NEW</span>'
                        }else if(data=="Canceled"){
                            return '<span class="badge bg-danger p-2">CANCELED</span>'
                        }else if(data=="Complete"){
                            return '<span class="badge bg-success p-2">COMPLETED</span>'
                        }
                        return data
                    },
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

        var otable_patient = $("#otable_patient").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_patient_select_grid')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [
                {
                    data: 'ID',
                    name: 'ID',
                    "width": "25px",
                },
                {
                    data: 'FullName',
                    name: 'FullName',
                },
                {
                    data: 'Gender',
                    name: 'Gender',
                    width:'30px',
                    render:function(data, type){
                        if(data==1){
                            return "Male";
                        }else{
                            return "Female";
                        }
                        return data
                    },

                },
                {
                    data: 'Mobile',
                    name: 'Mobile',

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

        $('#otable_patient tbody').on('click', '.btn-select', function() {
            var data = otable_patient.row($(this).parents('tr')).data();
            // console.log(data);

            selected_patient = data.ID;
            $("#patient").val(data.FullName);
            $("#select_patient_modal").modal("hide");

        });

        $('#add_patient_form').toggle();
        $("#btn_save_patient").toggle();

        $("#btn_new_patient").on('click', function(){
            $("#add_patient_form").slideToggle("slow");
            $("#btn_save_patient").slideToggle("slow");
            // $("#table_form").toggle();
        });

        function save_patient() {
            let name = $("#name").val();
            let gender = $("#gender").dxSelectBox("instance").option("value");
            let dob = $("#birthday").dxDateBox("instance").option('value');
            let email = $("#email").val();
            let contact = $("#contact").val();
            let address = $("#address").val();

            if (name == "") {
                toastr.error("Patient Name Required");
                $("#btn_save_patient").attr("disabled", false);
            } else if (contact == "") {
                toastr.error("Patient Contact Required");
                $("#btn_save_patient").attr("disabled", false);
            }

            $("#btn_save_patient").attr("disabled", true);
            selected_patient = null;

            $.ajax({
                "url": "<?php echo e(route('save_patient_in_oppointment')); ?>",
                "method": "POST",
                "data": {
                    "gender":gender,
                    "name": name,
                    "dob": dob,
                    "email": email,
                    "contact":contact,
                    "address":address
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Patient Added Successfully");
                        $("#select_patient_modal").modal("hide");

                        selected_patient = response.patient_id;
                        $("#patient").val(response.patient_name);

                        $("#btn_save_patient").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_patient").attr("disabled", false);
                    }
                },
            });
        };

        function clear_form() {
            $("#name").val('');
            $("#gender").dxSelectBox("instance").option("value",'');
            $("#email").val('');
            $("#contact").val('');
            $("#address").val('');
        };

        function save_appointment() {
            let app_no = $("#next_app_number").val();
            let app_date = $("#date").dxDateBox("instance").option('value');
            let patient_id = selected_patient;
            let complaint = $("#complaint").val();

            $("#btn_save_appointment").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_oppointment')); ?>",
                "method": "POST",
                "data": {
                    "app_no":app_no,
                    "app_date": app_date,
                    "patient_id": patient_id,
                    "complaint": complaint
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Appointment Added Successfully");
                        $("#add_appointment_modal").modal("hide");
                        $("#next_app_number").val('');

                        otable_oppintment.ajax.reload();
                        selected_patient = null;
                        clear_app_form();

                        console.log(response.next_number);
                        $("#next_app_number").val(response.next_number);

                        $("#btn_save_appointment").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_appointment").attr("disabled", false);
                    }
                },
            });
        }

        function clear_app_form() {
            // $("#next_app_number").val('');
            $("#patient").val('');
            $("#complaint").val('');
        };

        $('#otable_oppintment tbody').on('click', '.btn-cancel', function() {

            var data = otable_oppintment.row($(this).parents('tr')).data();
            console.log(data);
            $("#app_id").val(data.ID);
            $("#ask_cancel_modal").modal("show");
        });

        function cancel() {
            let app_id = $("#app_id").val();

            $("#btn_cancel").attr("disabled", true);

            $.ajax({
                url:"<?php echo e(route('cancel_appointment')); ?>",
                method:"POST",
                data:{
                    "app_id":app_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Appointment Cancel Successfully !');
                        otable_oppintment.ajax.reload();
                        $("#ask_cancel_modal").modal("hide");
                        $("#app_id").val("");
                        $("#btn_cancel").attr("disabled", false);

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\SAHANYA\resources\views/cashier/appointment/make_appointment.blade.php ENDPATH**/ ?>