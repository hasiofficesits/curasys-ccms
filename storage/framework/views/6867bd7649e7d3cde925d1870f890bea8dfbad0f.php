
<?php $__env->startSection('title'); ?>
Doctor
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
        Doctor
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Doctor
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_doctor"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Doctor</button>
                        </div>
                    </div>
                    <table id="otable_doctor" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Speciality</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_doctor_modal -->
    <div id="add_doctor_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" rows="3" placeholder="Enter address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Email : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Speciality : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="speciality"
                                            placeholder="Enter Speciality">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Birth Day : </label>
                                    <div class="col-sm-8">
                                        <div id="date" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">NIC : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nic"
                                            placeholder="NIC">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Gender : </label>
                                    <div class="col-sm-8">
                                        <div id="gender" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Mobile : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="mobile"
                                            placeholder="Mobile">
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_doctor" onclick="save_doctor()" class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- edit_doctor_modal -->
    <div id="edit_doctor_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="doc_id">

                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_edit" placeholder="Enter name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address_edit" rows="3" placeholder="Enter address"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Email : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_edit"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Speciality : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="speciality_edit"
                                            placeholder="Enter Speciality">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Birth Day : </label>
                                    <div class="col-sm-8">
                                        <div id="date_edit" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">NIC : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="nic_edit"
                                            placeholder="NIC">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Gender : </label>
                                    <div class="col-sm-8">
                                        <div id="gender_edit" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Mobile : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="mobile_edit"
                                            placeholder="Mobile">
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_doctor" onclick="update_doctor()" class="btn btn-primary">Update</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask active -->
    <div id="ask_active_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Active Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="doctor_id">
                    <h5 class="modal-title">Do You Want to Active the Doctor ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_doctor()" class="btn btn-success">Active</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask in active -->
    <div id="ask_inactive_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Inactive Doctor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="doctor_id">
                    <h5 class="modal-title">Do You Want to Inactive the Doctor ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_doctor()" class="btn btn-danger">Inactive</button>
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
        $('#date_edit').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            }, 
        });

        let gender = [{id: "1",name: "Male"},{id: "2",name: "Female"}];
        $('#gender').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: gender,
        });
        $('#gender_edit').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: gender,
        });
        var otable_doctor = $("#otable_doctor").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_doctor_grid')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [{
                    data: 'DID',
                    name: 'DID',
                    "width": "25px",
                },
                {
                    data: 'Name',
                    name: 'Name',
                },
                {
                    data: 'Speciality',
                    name: 'Speciality',

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

        $("#btn_add_doctor").on('click', function(){
            $("#add_doctor_modal").modal("show");
        });

        function save_doctor(){
            let name = $("#name").val();
            let address = $("#address").val();
            let email = $("#email").val();
            let speciality = $("#speciality").val();
            let birthday = $("#date").dxDateBox('instance').option('value');
            let nic = $("#nic").val();
            let mobile = $("#mobile").val();
            let gender = $("#gender").dxSelectBox('instance').option('value');

            if (name == "") {
                toastr.error("Doctor Name Required");
                $("#btn_save_doctor").attr("disabled", false);
            } else if (speciality == "") {
                toastr.error("Doctor Speciality Required");
                $("#btn_save_doctor").attr("disabled", false);
            } else if (nic == "") {
                toastr.error("Doctor NIC Required");
                $("#btn_save_doctor").attr("disabled", false);
            } else if (mobile == "") {
                toastr.error("Doctor Mobile Number Required");
                $("#btn_save_doctor").attr("disabled", false);
            }

            $("#btn_save_doctor").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_new_doctor')); ?>",
                "method": "POST",
                "data": {
                    "name":name,
                    "address":address,
                    "email":email,
                    "speciality":speciality,
                    "birthday":birthday,
                    "nic":nic,
                    "mobile":mobile,
                    "gender":gender
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Doctor Added Successfully");
                        otable_doctor.ajax.reload();
                        $("#add_doctor_modal").modal("hide");

                        $("#btn_save_doctor").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_doctor").attr("disabled", false);
                    }
                },
            });
        };

        function clear_form() {
            $("#name").val('');
            $("#address").val('');
            $("#email").val('');
            $("#speciality").val('');
            $("#nic").val('');
            $("#gender").dxSelectBox('instance').option('value','');
        };

        $('#otable_doctor tbody').on('click', '.btn-edit', function() {

            var data = otable_doctor.row($(this).parents('tr')).data();
            console.log(data);

            $("#doc_id").val(data.DID);
            $("#name_edit").val(data.Name);
            $("#address_edit").val(data.Address);
            $("#email_edit").val(data.Email);
            $("#speciality_edit").val(data.Speciality);
            $("#nic_edit").val(data.NICNumber);
            $("#mobile_edit").val(data.Mobile);
            $("#gender_edit").dxSelectBox('instance').option('value',data.Gender);
            $("#date_edit").dxDateBox('instance').option('value',data.BirthDay);

            $("#edit_doctor_modal").modal("show");

        });

        function update_doctor() {
            let doc_id = $("#doc_id").val();
            let name_edit = $("#name_edit").val();
            let address_edit = $("#address_edit").val();
            let email_edit = $("#email_edit").val();
            let speciality_edit = $("#speciality_edit").val();
            let nic_edit = $("#nic_edit").val();
            let mobile_edit = $("#mobile_edit").val();
            let gender_edit = $("#gender_edit").dxSelectBox('instance').option('value');
            let date_edit = $("#date_edit").dxDateBox('instance').option('value');

            if (name_edit == "") {
                toastr.error("Doctor Name Required");
                $("#btn_update_doctor").attr("disabled", false);
            } else if (speciality_edit == "") {
                toastr.error("Doctor Speciality Required");
                $("#btn_update_doctor").attr("disabled", false);
            } else if (nic_edit == "") {
                toastr.error("Doctor NIC Required");
                $("#btn_update_doctor").attr("disabled", false);
            } else if (mobile_edit == "") {
                toastr.error("Doctor Mobile Number Required");
                $("#btn_update_doctor").attr("disabled", false);
            }

            $("#btn_update_doctor").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_exist_doctor')); ?>",
                "method": "POST",
                "data": {
                    "doc_id":doc_id,
                    "name_edit":name_edit,
                    "address_edit":address_edit,
                    "email_edit":email_edit,
                    "speciality_edit":speciality_edit,
                    "nic_edit":nic_edit,
                    "mobile_edit":mobile_edit,
                    "gender_edit":gender_edit,
                    "date_edit":date_edit
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Doctor Updated Successfully");
                        otable_doctor.ajax.reload();
                        $("#edit_doctor_modal").modal("hide");

                        $("#btn_update_doctor").attr("disabled", false);
                        clear_update_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_doctor").attr("disabled", false);
                    }
                },
            });
        };

        $('#otable_doctor tbody').on('click', '.btn-active', function() {

            var data = otable_doctor.row($(this).parents('tr')).data();

            if (data.Isdelete == 0) {
                $("#doctor_id").val(data.DID);
                $("#ask_inactive_modal").modal("show");
            } else if (data.Isdelete == 1) {
                $("#doctor_id").val(data.DID);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_doctor() {
            let doctor_id = $("#doctor_id").val();

            $.ajax({
                url:"<?php echo e(route('active_doctor_from_id')); ?>",
                method:"POST",
                data:{
                    "doctor_id":doctor_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_doctor.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#doctor_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        function inactive_doctor() {
            let doctor_id = $("#doctor_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_doctor_from_id')); ?>",
                method:"POST",
                data:{
                    "doctor_id":doctor_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_doctor.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#doctor_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\CuraSys\resources\views/management/doctor/doctor.blade.php ENDPATH**/ ?>