
<?php $__env->startSection('title'); ?>
    User
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
            User
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            User
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_user"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New User</button>
                        </div>
                    </div>
                    <table id="otable_user" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_user_modal -->
    <div id="add_user_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
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
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Email :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="email" placeholder="Enter email">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Password :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="password" placeholder="Enter password">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Contact :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="contact" placeholder="+94(0)## ## ## ###">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">User Type : </label>
                                <div class="col-sm-10">
                                    <div id="user_type" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_user" onclick="save_user()"
                        class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_user_modal -->
    <div id="update_user_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="user_id">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_name" placeholder="Enter name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Email :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_email" placeholder="Enter email">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Contact :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_contact" placeholder="+94(0)## ## ## ###">
                                </div>
                            </div>
                        </div>

                        


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_user" onclick="update_user()"
                        class="btn btn-primary">Update</button>
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
                    <h5 class="modal-title" id="myModalLabel">Active User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="act_user_id">
                    <h5 class="modal-title">Do You Want to Active the User ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_user()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="act_user_id">
                    <h5 class="modal-title">Do You Want to Inactive the User ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_user()" class="btn btn-danger">Inactive</button>
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

        let type = [{id: "1",name: "Admin"},{id: "2",name: "User"}];
        $('#user_type').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'id',
            items: type,
        });
        $('#edit_user_type').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'id',
            items: type,
        });

        var otable_user = $("#otable_user").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_user_grid')); ?>",
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
                    data: 'role',
                    name: 'role',
                    render:function(data, type){
                        if(data==0){
                            return '<span class="badge bg-danger p-2">Super Admin</span>'
                        }else if(data==1){
                            return '<span class="badge bg-primary p-2">Admin</span>'
                        }else if(data==2){
                            return '<span class="badge bg-success p-2">User</span>'
                        }
                        return data
                    },
                },
                {
                    data: 'name',
                    name: 'name',

                },
                {
                    data: 'email',
                    name: 'email',

                },
                {
                    data: 'contact',
                    name: 'contact',

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

        $("#btn_add_user").on('click', function(){
            $("#add_user_modal").modal("show");
        });

        function save_user() {
            let name = $("#name").val();
            let email = $("#email").val();
            let password = $("#password").val();
            let contact = $("#contact").val();
            let user_type = $("#user_type").dxSelectBox('instance').option('value');

            if (name == "") {
                toastr.error("User's Name Required");
                $("#btn_save_user").attr("disabled", false);
            } else if (email == "") {
                toastr.error("User's Email Required");
                $("#btn_save_user").attr("disabled", false);
            } else if (password == "") {
                toastr.error("User's Password Required");
                $("#btn_save_user").attr("disabled", false);
            } else if (user_type == null) {
                toastr.error("User's Type Required");
                $("#btn_save_user").attr("disabled", false);
            }

            $("#btn_save_user").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_new_user')); ?>",
                "method": "POST",
                "data": {
                    "name": name,
                    "email": email,
                    "password": password,
                    "contact":contact,
                    "user_type":user_type
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("User Added Successfully");
                        otable_user.ajax.reload();
                        $("#add_user_modal").modal("hide");

                        $("#btn_save_user").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_user").attr("disabled", false);
                    }
                },
            });
        };

        function clear_form() {
            $("#name").val('');
            $("#email").val('');
            $("#password").val('');
            $("#contact").val('');
            $("#user_type").dxSelectBox('instance').option('value','');
        };

        $('#otable_user tbody').on('click', '.btn-edit', function() {

            var data = otable_user.row($(this).parents('tr')).data();
            console.log(data);

            $("#edit_name").val(data.name);
            $("#user_id").val(data.id);
            $("#edit_email").val(data.email);
            $("#edit_password").val(data.password);
            $("#edit_contact").val(data.contact);
            // $("#edit_user_type").dxSelectBox('instance').option('value', data.role);

            $("#update_user_modal").modal("show");
        });

        function update_user() {
            let user_id = $("#user_id").val();
            let name = $("#edit_name").val();
            let email = $("#edit_email").val();
            let contact = $("#edit_contact").val();

            if (name == "") {
                toastr.error("User's Name Required");
                $("#btn_update_user").attr("disabled", false);
            } else if (email == "") {
                toastr.error("User's Email Required");
                $("#btn_update_user").attr("disabled", false);
            }

            $("#btn_update_user").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_user')); ?>",
                "method": "POST",
                "data": {
                    "user_id":user_id,
                    "name": name,
                    "email": email,
                    "contact":contact
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("User Updated Successfully");
                        otable_user.ajax.reload();
                        $("#update_user_modal").modal("hide");

                        $("#btn_update_user").attr("disabled", false);
                        clear_update_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_user").attr("disabled", false);
                    }
                },
            });
        };

        function clear_update_form() {
            $("#user_id").val('');
            $("#edit_name").val('');
            $("#edit_email").val('');
            $("#edit_contact").val('');
        };

        $('#otable_user tbody').on('click', '.btn-active', function() {

            var data = otable_user.row($(this).parents('tr')).data();

            if (data.IsDelete == 0) {
                $("#act_user_id").val(data.id);
                $("#ask_inactive_modal").modal("show");
            } else if (data.IsDelete == 1) {
                $("#act_user_id").val(data.id);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_user() {
            let act_user_id = $("#act_user_id").val();

            $.ajax({
                url:"<?php echo e(route('active_user_from_id')); ?>",
                method:"POST",
                data:{
                    "act_user_id":act_user_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_user.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#act_user_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

        function inactive_user() {
            let act_user_id = $("#act_user_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_user_from_id')); ?>",
                method:"POST",
                data:{
                    "act_user_id":act_user_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_user.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#act_user_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\SAHANYA\resources\views/management/user/user.blade.php ENDPATH**/ ?>