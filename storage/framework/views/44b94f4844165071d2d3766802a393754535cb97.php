
<?php $__env->startSection('title'); ?>
Dosage List
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
            Dosage Strength Unit List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_unit"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Unit</button>
                        </div>
                    </div>
                    <table id="otable_dosage_list" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_unit_modal -->
    <div id="add_unit_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="unit_name" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_unit" onclick="save_unit()"
                        class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_unit_modal -->
    <div id="update_unit_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="unit_id">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="unit_name_edit" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_unit" onclick="update_unit()"
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
                    <h5 class="modal-title" id="myModalLabel">Active Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="act_unit_id">
                    <h5 class="modal-title">Do You Want to Active the Unit ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_unit()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Unit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="act_unit_id">
                    <h5 class="modal-title">Do You Want to Inactive the Unit ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_unit()" class="btn btn-danger">Inactive</button>
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

        var otable_dosage_list = $("#otable_dosage_list").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_Dosage_unit_list')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [{
                    data: 'Id',
                    name: 'Id',
                },
                {
                    data: 'Name',
                    name: 'Name',

                },
                {
                    data: 'action',
                    name: 'action',
                    "width":'150px',
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

        $('#otable_dosage_list tbody').on('click', '.btn-active', function() {

            var data = otable_dosage_list.row($(this).parents('tr')).data();

            if (data.Isdelete == 0) {
                $("#act_unit_id").val(data.Id);
                $("#ask_inactive_modal").modal("show");
            } else if (data.Isdelete == 1) {
                $("#act_unit_id").val(data.Id);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_unit() {
            let act_unit_id = $("#act_unit_id").val();

            $.ajax({
                url:"<?php echo e(route('active_dosage_list')); ?>",
                method:"POST",
                data:{
                    "act_unit_id":act_unit_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_dosage_list.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#act_unit_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

        function inactive_unit() {
            let act_unit_id = $("#act_unit_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_dosage_list')); ?>",
                method:"POST",
                data:{
                    "act_unit_id":act_unit_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_dosage_list.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#act_unit_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        $("#btn_add_unit").on('click', function() {
            $("#add_unit_modal").modal("show");
        });

        function save_unit() {
            let unit_name = $("#unit_name").val();

            if (unit_name == "") {
                toastr.error("Unit Name Required");
                $("#btn_save_unit").attr("disabled", false);
            }

            $("#btn_save_unit").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_new_dosage_unit')); ?>",
                "method": "POST",
                "data": {
                    "unit_name": unit_name
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Unit Added Successfully");
                        otable_dosage_list.ajax.reload();
                        $("#add_unit_modal").modal("hide");

                        $("#btn_save_unit").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_unit").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#unit_name").val('');
        }

        $('#otable_dosage_list tbody').on('click', '.btn-edit', function() {

            var data = otable_dosage_list.row($(this).parents('tr')).data();

            $("#unit_id").val(data.Id);
            $("#unit_name_edit").val(data.Name);
            $("#update_unit_modal").modal("show");
        });

        function update_unit() {
            let id = $("#unit_id").val();
            let name = $("#unit_name_edit").val();

            if (name == "") {
                toastr.error("Unit Name Required");
                $("#btn_update_unit").attr("disabled", false);
            }

            $("#btn_update_unit").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_new_dosage_unit')); ?>",
                "method": "POST",
                "data": {
                    "name": name,
                    "id":id
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Unit Updated Successfully");
                        otable_dosage_list.ajax.reload();
                        $("#update_unit_modal").modal("hide");

                        $("#btn_update_unit").attr("disabled", false);
                        clear_update_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_unit").attr("disabled", false);
                    }
                },
            });
        }

        function clear_update_form() {
            $("#unit_id").val('');
            $("#unit_name_edit").val('');
        }
        
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\SAHANYA\resources\views/appointment/settings/dosage.blade.php ENDPATH**/ ?>