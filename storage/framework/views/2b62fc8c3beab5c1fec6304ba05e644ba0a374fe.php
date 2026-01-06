
<?php $__env->startSection('title'); ?>
    Stock Location
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
            Stock
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Stock Location
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_location"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Location</button>
                        </div>
                    </div>
                    <table id="otable_location" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <!-- add_location_modal -->
    <div id="add_location_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder="Enter location Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Type :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="type"
                                        placeholder="Enter location type">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_location" onclick="save_location()"
                        class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- edit_location_modal -->
    <div id="edit_location_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="location_id">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_name" placeholder="Enter location Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Type :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_type"
                                        placeholder="Enter location type">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_location" onclick="update_location()"
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
                    <h5 class="modal-title" id="myModalLabel">Active Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="act_location_id">
                    <h5 class="modal-title">Do You Want to Active this Location ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_location()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="act_location_id">
                    <h5 class="modal-title">Do You Want to Inactive this Location ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_location()" class="btn btn-danger">Inactive</button>
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

        var otable_location = $("#otable_location").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_stock_location_grid')); ?>",
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
                    data: 'Name',
                    name: 'Name',
                },
                {
                    data: 'Type',
                    name: 'Type',
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

        $("#btn_add_location").on('click', function() {
            $("#add_location_modal").modal("show");
        });

        function save_location() {
            let name = $("#name").val();
            let type = $("#type").val();

            if (name == "") {
                toastr.error("Location Name Required");
                $("#btn_save_location").attr("disabled", false);
            } else if (type == "") {
                toastr.error("Location Type Required");
                $("#btn_save_location").attr("disabled", false);
            }

            $("#btn_save_location").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_new_location')); ?>",
                "method": "POST",
                "data": {
                    "name": name,
                    "type": type
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Item Added Successfully");
                        otable_location.ajax.reload();
                        $("#add_location_modal").modal("hide");
                        clear_form();
                        $("#btn_save_location").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_location").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#name").val('');
            $("#type").val('');
        }

        $('#otable_location tbody').on('click', '.btn-edit', function() {

            var data = otable_location.row($(this).parents('tr')).data();
            console.log(data);

            $("#location_id").val(data.ID);
            $("#edit_name").val(data.Name);
            $("#edit_type").val(data.Type);
            $("#edit_location_modal").modal("show");
        });

        function update_location() {
            let location_id = $("#location_id").val();
            let edit_name = $("#edit_name").val();
            let edit_type = $("#edit_type").val();

            if (edit_name == "") {
                toastr.error("Location Name Required");
                $("#btn_update_location").attr("disabled", false);
            } else if (edit_type == "") {
                toastr.error("Location Type Required");
                $("#btn_update_location").attr("disabled", false);
            }

            $("#btn_update_location").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_location')); ?>",
                "method": "POST",
                "data": {
                    "location_id":location_id,
                    "edit_name": edit_name,
                    "edit_type": edit_type
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Location Updated Successfully");
                        otable_location.ajax.reload();
                        $("#edit_location_modal").modal("hide");
                        clear_form();
                        $("#btn_update_location").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_location").attr("disabled", false);
                    }
                },
            });
        }

        $('#otable_location tbody').on('click', '.btn-active', function() {

            var data = otable_location.row($(this).parents('tr')).data();

            if (data.IsDelete == 0) {
                $("#act_location_id").val(data.ID);
                $("#ask_inactive_modal").modal("show");
            } else if (data.IsDelete == 1) {
                $("#act_location_id").val(data.ID);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_location() {
            let act_location_id = $("#act_location_id").val();

            $.ajax({
                url:"<?php echo e(route('active_location_from_id')); ?>",
                method:"POST",
                data:{
                    "act_location_id":act_location_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_location.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#act_location_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

        function inactive_location() {
            let act_location_id = $("#act_location_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_location_from_id')); ?>",
                method:"POST",
                data:{
                    "act_location_id":act_location_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_location.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#act_location_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\CuraSys\resources\views/Stock/stockMaster/location.blade.php ENDPATH**/ ?>