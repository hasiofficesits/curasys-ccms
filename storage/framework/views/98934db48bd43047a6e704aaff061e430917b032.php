
<?php $__env->startSection('title'); ?>
    Stock Category
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
            Settings
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Stock Category
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_category"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Category</button>
                        </div>
                    </div>
                    <table id="otable_category" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
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

    <!-- add_category_modal -->
    <div id="add_category_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="code" placeholder="Ex:- MDI001">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="category"
                                        placeholder="Enter category name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_category" onclick="save_category()"
                        class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_category_modal -->
    <div id="update_category_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="edit_cat_id">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_code" placeholder="Ex:- MDI001">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_category"
                                        placeholder="Enter category name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_category" onclick="update_category()"
                        class="btn btn-success">Update</button>
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
                    <h5 class="modal-title" id="myModalLabel">Active Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="category_id">
                    <h5 class="modal-title">Do You Want to Active this Category ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_category()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="category_id">
                    <h5 class="modal-title">Do You Want to Inactive this Category ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_category()" class="btn btn-danger">Inactive</button>
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

        var otable_category = $("#otable_category").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_stock_category_grid')); ?>",
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
                    data: 'Code',
                    name: 'Code',
                },
                {
                    data: 'CategoryName',
                    name: 'CategoryName',
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

        $("#btn_add_category").on('click', function() {
            $("#add_category_modal").modal("show");
        });

        function save_category() {
            let category = $("#category").val();
            let code = $("#code").val();

            if (category == "") {
                toastr.error("Category Name Required");
                $("#btn_save_category").attr("disabled", false);
            }

            $("#btn_save_category").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_new_category')); ?>",
                "method": "POST",
                "data": {
                    "category": category,
                    "code": code
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Category Added Successfully");
                        otable_category.ajax.reload();
                        $("#add_category_modal").modal("hide");
                        clear_form();
                        $("#btn_save_category").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_category").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#category").val('');
            $("#code").val('');
        }

        $('#otable_category tbody').on('click', '.btn-edit', function() {

            var data = otable_category.row($(this).parents('tr')).data();
            console.log(data);

            $("#edit_cat_id").val(data.ID);
            $("#edit_code").val(data.Code);
            $("#edit_category").val(data.CategoryName);

            $("#update_category_modal").modal("show");
        });

        function update_category() {
            let edit_cat_id = $("#edit_cat_id").val();
            let edit_code = $("#edit_code").val();
            let edit_category = $("#edit_category").val();

            if (edit_category == "") {
                toastr.error("Category Name Required");
                $("#btn_update_category").attr("disabled", false);
            }

            $("#btn_update_category").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_stock_category')); ?>",
                "method": "POST",
                "data": {
                    "edit_cat_id": edit_cat_id,
                    "edit_code": edit_code,
                    "edit_category":edit_category
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Category Updated Successfully");
                        otable_category.ajax.reload();
                        $("#update_category_modal").modal("hide");
                        clear_update_form();
                        $("#btn_update_category").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_category").attr("disabled", false);
                    }
                },
            });
        };

        function clear_update_form() {
            $("#edit_cat_id").val('');
            $("#edit_code").val('');
            $("#edit_category").val('');
        };

        $('#otable_category tbody').on('click', '.btn-active', function() {

            var data = otable_category.row($(this).parents('tr')).data();

            if (data.IsDelete == 0) {
                $("#category_id").val(data.ID);
                $("#ask_inactive_modal").modal("show");
            } else if (data.IsDelete == 1) {
                $("#category_id").val(data.ID);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_category() {
            let category_id = $("#category_id").val();

            $.ajax({
                url:"<?php echo e(route('active_category_from_id')); ?>",
                method:"POST",
                data:{
                    "category_id":category_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_category.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#category_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

        function inactive_category() {
            let category_id = $("#category_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_category_from_id')); ?>",
                method:"POST",
                data:{
                    "category_id":category_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_category.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#category_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\SAHANYA\resources\views/Stock/settings/stock_category.blade.php ENDPATH**/ ?>