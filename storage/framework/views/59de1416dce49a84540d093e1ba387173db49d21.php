
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
        Stock Category
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
                    <h5 class="modal-title" id="myModalLabel">Add Store Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="cat_name" placeholder="Enter name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="cat_code" placeholder="Enter code - PTO001, TMT002">
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_category" onclick="add_category()" class="btn btn-success">Add</button>
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
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_store_category')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'name',
                    name: 'name',
                    "width": "200px",

                },
                {
                    data: 'code',
                    name: 'code',
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

        $("#btn_add_category").on('click', function(){
            $("#add_category_modal").modal("show");
        });

        function add_category() {
            let name = $("#cat_name").val();
            let code = $("#cat_code").val();

            console.log(name);

            $("#btn_save_category").attr("disabled", true);

            if (name == "") {
                toastr.error("Name Required");
                $("#btn_save_category").attr("disabled", false);
            } else if (code == "") {
                toastr.error("Code Required");
                $("#btn_save_category").attr("disabled", false);
            }

            $.ajax({
                "url": "<?php echo e(route('add_category')); ?>",
                "method": "POST",
                "data": {
                    "name":name,
                    "code":code
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Category Added Successfully");
                        otable_category.ajax.reload();
                        $("#add_category_modal").modal("hide");

                        $("#btn_save_category").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_category").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#cat_name").val('');
            $("#cat_code").val('');
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-Chamee\resources\views/stores/stock_category.blade.php ENDPATH**/ ?>