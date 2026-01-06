
<?php $__env->startSection('title'); ?>
    Outlets
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
            Outlet
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_outlet"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Register New Outlet</button>
                        </div>
                    </div>
                    <table id="otable_outlet" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Manager</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_outlet_modal -->
    <div id="add_outlet_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Register New Outlet</h5>
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
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Manager : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="manager" placeholder="Enter manager">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Email : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="email" placeholder="Enter email">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Phone : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="phone" placeholder="Enter phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_regi_item" onclick="register_outlet()" class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_outlet_modal -->
    <div id="update_outlet_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update New Outlet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" id="update_outlet_id">
                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="update_name" placeholder="Enter name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="update_address" rows="3" placeholder="Enter address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Manager : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="update_manager" placeholder="Enter manager">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Email : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="update_email" placeholder="Enter email">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Phone : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="update_phone" placeholder="Enter phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_outlet" onclick="update_outlet()" class="btn btn-success">Update</button>
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
                    <h5 class="modal-title" id="myModalLabel">Active Outlet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_outlet_id">
                    <h5 class="modal-title">Do You Want to Active the Outlet ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_outlet()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Outlet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_outlet_id">
                    <h5 class="modal-title">Do You Want to Inactive the Outlet ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_outlet()" class="btn btn-danger">Inactive</button>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var otable_outlet = $("#otable_outlet").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_outlet_list')); ?>",
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
                },
                {
                    data: 'manager',
                    name: 'manager',
                },
                {
                    data: 'address',
                    name: 'address',
                    "width": "200px",

                },
                {
                    data: 'phone',
                    name: 'phone',
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

        $("#btn_add_outlet").on('click', function(){
            $("#add_outlet_modal").modal("show");
        });

        function register_outlet() {
            let name = $("#name").val();
            let address = $("#address").val();
            let manager = $("#manager").val();
            let email = $("#email").val();
            let phone = $("#phone").val();

            if (name == "") {
                toastr.error("Name Required");
                $("#btn_regi_item").attr("disabled", false);
            } else if (address == "") {
                toastr.error("Address Required");
                $("#btn_regi_item").attr("disabled", false);
            } else if (manager == "") {
                toastr.error("Manager Required");
                $("#btn_regi_item").attr("disabled", false);
            } else if (phone == "") {
                toastr.error("Phone Required");
                $("#btn_regi_item").attr("disabled", false);
            }

            $("#btn_regi_item").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_outlet')); ?>",
                "method": "POST",
                "data": {
                    "name":name,
                    "address":address,
                    "manager":manager,
                    "email":email,
                    "phone":phone
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Outlet Registered Successfully");
                        otable_outlet.ajax.reload();
                        $("#add_outlet_modal").modal("hide");

                        $("#btn_regi_item").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_regi_item").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#name").val('');
            $("#address").val('');
            $("#manager").val('');
            $("#email").val('');
            $("#phone").val('');

            $("#update_name").val('');
            $("#update_address").val('');
            $("#update_manager").val('');
            $("#update_email").val('');
            $("#update_phone").val('');
        }

        $('#otable_outlet tbody').on('click', '.btn-active', function() {

            var data = otable_outlet.row($(this).parents('tr')).data();
            
            if (data.status == 0) {
                $("#selected_outlet_id").val(data.id);
                $("#ask_inactive_modal").modal("show");
            } else if (data.status == 1) {
                $("#selected_outlet_id").val(data.id);
                $("#ask_active_modal").modal("show");
            }

        });

        function active_outlet() {
            let selected_outlet_id = $("#selected_outlet_id").val();

            $.ajax({
                url:"<?php echo e(route('active_outlet_from_id')); ?>",
                method:"POST",
                data:{
                    "selected_outlet_id":selected_outlet_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_outlet.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#selected_outlet_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        function inactive_outlet() {
            let selected_outlet_id = $("#selected_outlet_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_outlet_from_id')); ?>",
                method:"POST",
                data:{
                    "selected_outlet_id":selected_outlet_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_outlet.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#selected_outlet_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        $('#otable_outlet tbody').on('click', '.btn-edit', function() {

            var data = otable_outlet.row($(this).parents('tr')).data();
            // console.log(data);

            $("#update_outlet_id").val(data.id);
            $("#update_name").val(data.name);
            $("#update_address").val(data.address);
            $("#update_manager").val(data.manager);
            $("#update_email").val(data.email);
            $("#update_phone").val(data.phone);

            $("#update_outlet_modal").modal("show");

        });

        function update_outlet() {
            let update_outlet_id = $("#update_outlet_id").val();
            let update_name = $("#update_name").val();
            let update_address = $("#update_address").val();
            let update_manager = $("#update_manager").val();
            let update_email = $("#update_email").val();
            let update_phone = $("#update_phone").val();

            if (update_name == "") {
                toastr.error("Name Required");
                $("#btn_update_outlet").attr("disabled", false);
            } else if (update_address == "") {
                toastr.error("Address Required");
                $("#btn_update_outlet").attr("disabled", false);
            } else if (update_manager == "") {
                toastr.error("Manager Required");
                $("#btn_update_outlet").attr("disabled", false);
            } else if (update_phone == "") {
                toastr.error("Phone Required");
                $("#btn_update_outlet").attr("disabled", false);
            }

            $("#btn_update_outlet").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_outlet')); ?>",
                "method": "POST",
                "data": {
                    "update_outlet_id":update_outlet_id,
                    "update_name":update_name,
                    "update_address":update_address,
                    "update_manager":update_manager,
                    "update_email":update_email,
                    "update_phone":update_phone
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Outlet Update Successfully");
                        otable_outlet.ajax.reload();
                        $("#update_outlet_modal").modal("hide");

                        $("#update_outlet_id").val('');

                        $("#btn_update_outlet").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_outlet").attr("disabled", false);
                    }
                },
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-Chamee\resources\views/outlets/list.blade.php ENDPATH**/ ?>