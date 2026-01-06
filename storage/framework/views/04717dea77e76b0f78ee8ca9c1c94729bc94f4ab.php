
<?php $__env->startSection('title'); ?>
    Recipe
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
            Employee
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Employee
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_employee"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Employee</button>
                        </div>
                    </div>
                    <table id="otable_employee" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Designation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_employee_modal -->
    <div id="add_employee_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" placeholder="Enter Employee Name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nic Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nic_name" placeholder="Employee Nic Name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Mobile : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="mobile_num">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Designation : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="designation">
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_employee" onclick="add_employee()" class="btn btn-success">Add</button>
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
                    <h5 class="modal-title" id="myModalLabel">Active Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_emp_id">
                    <h5 class="modal-title">Do You Want to Active this Employee ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_employee()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_emp_id">
                    <h5 class="modal-title">Do You Want to Inactive this Employee ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_employee()" class="btn btn-danger">Inactive</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- edit_employee_modal -->
    <div id="edit_employee_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                        <input type="hidden" id="selected_emp_id">

                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_edit" placeholder="Enter Employee Name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Nic Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nic_name_edit" placeholder="Employee Nic Name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address_edit" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Mobile : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="mobile_num_edit">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Designation : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="designation_edit">
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_employee" onclick="update_employee()" class="btn btn-success">Update</button>
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

        var otable_employee = $("#otable_employee").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_employee_details')); ?>",
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
                    data: 'name',
                    name: 'name',
                    "width": "200px",
                },
                {
                    data: 'mobile',
                    name: 'mobile',

                },
                {
                    data: 'address',
                    name: 'address',

                },
                {
                    data: 'designation',
                    name: 'designation',

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

        $("#btn_add_employee").on('click', function(){
            $("#add_employee_modal").modal("show");
        });

        function add_employee(){
            let name = $("#name").val();
            let nic_name = $("#nic_name").val();
            let address = $("#address").val();
            let mobile_num = $("#mobile_num").val();
            let designation = $("#designation").val();

            $("#btn_add_employee").attr("disabled", true);

            if (name == "") {
                toastr.error("Name Required");
                $("#btn_add_employee").attr("disabled", false);
            } else if (address == "") {
                toastr.error("Address Required");
                $("#btn_add_employee").attr("disabled", false);
            } else if (mobile_num == "") {
                toastr.error("Mobile Number Required");
                $("#btn_add_employee").attr("disabled", false);
            } else if (designation == "") {
                toastr.error("Designation Required");
                $("#btn_add_employee").attr("disabled", false);
            }

            $.ajax({
                "url": "<?php echo e(route('add_employee')); ?>",
                "method": "POST",
                "data": {
                    "name":name,
                    "nic_name":nic_name,
                    "address":address,
                    "mobile_num":mobile_num,
                    "designation":designation
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Employee Added Successfully");
                        otable_employee.ajax.reload();
                        $("#add_employee_modal").modal("hide");

                        $("#btn_add_employee").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_add_employee").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#name").val('');
            $("#nic_name").val('');
            $("#address").val('');
            $("#mobile_num").val('');
            $("#designation").val('');
        }

        $('#otable_employee tbody').on('click', '.btn-active', function() {

            var data = otable_employee.row($(this).parents('tr')).data();
            active_status = data.active;
            selected_emp_id = data.id;

            if (active_status == 1) 
            {
                $("#selected_emp_id").val(selected_emp_id);
                $("#ask_active_modal").modal("show");

            } else if (active_status == 0) 
            {
                $("#selected_emp_id").val(selected_emp_id);
                $("#ask_inactive_modal").modal("show");
            }
        });

        function inactive_employee()
        {
            let selected_emp_id = $("#selected_emp_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_employee')); ?>",
                method:"POST",
                data:{
                    "ID":selected_emp_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_employee.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#selected_emp_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        function active_employee()
        {
            let selected_emp_id = $("#selected_emp_id").val();

            $.ajax({
                url:"<?php echo e(route('active_employee')); ?>",
                method:"POST",
                data:{
                    "ID":selected_emp_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_employee.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#selected_emp_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        $('#otable_employee tbody').on('click', '.btn-edit', function() {

            var data = otable_employee.row($(this).parents('tr')).data();

            selected_emp_id = data.id;

            $("#selected_emp_id").val(selected_emp_id);
            $("#name_edit").val(data.name);
            $("#nic_name_edit").val(data.nic_name);
            $("#address_edit").val(data.address);
            $("#mobile_num_edit").val(data.mobile);
            $("#designation_edit").val(data.designation);
            
            
            $("#edit_employee_modal").modal("show");
        });

        function update_employee() {

            let selected_emp_id = $("#selected_emp_id").val();
            let name_edit = $("#name_edit").val();
            let nic_name_edit = $("#nic_name_edit").val();
            let address_edit = $("#address_edit").val();
            let mobile_num_edit = $("#mobile_num_edit").val();
            let designation_edit = $("#designation_edit").val();

            $("#btn_update_employee").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_Employee')); ?>",
                "method": "POST",
                "data": {
                    "selected_emp_id":selected_emp_id,
                    "name_edit":name_edit,
                    "nic_name_edit":nic_name_edit,
                    "address_edit":address_edit,
                    "mobile_num_edit":mobile_num_edit,
                    "designation_edit":designation_edit
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Employee Updated Successfully");

                        otable_employee.ajax.reload();
                        $("#edit_employee_modal").modal("hide");

                        $("#btn_update_employee").attr("disabled", false);
                        update_form_clear();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_employee").attr("disabled", false);
                    }
                },
            });
        }
        

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/employee/employee.blade.php ENDPATH**/ ?>