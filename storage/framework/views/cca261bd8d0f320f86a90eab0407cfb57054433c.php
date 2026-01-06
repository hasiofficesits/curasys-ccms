
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
            Category
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Category
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="modal-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="kitchen-tab" data-bs-toggle="tab" data-bs-target="#kitchen" type="button" role="tab" aria-controls="kitchen" aria-selected="true">Kitchen Category</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="counter-tab" data-bs-toggle="tab" data-bs-target="#counter" type="button" role="tab" aria-controls="counter" aria-selected="false">Counter Category</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            
                            <div class="tab-pane fade show active" id="kitchen" role="tabpanel" aria-labelledby="kitchen-tab">
                                <br>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <button type="button" id="btn_add_kitchen"
                                            class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                            <i class="las la-plus-circle"></i> Add Category</button>
                                    </div>
                                </div>
                                <table id="otable_kitchen_cat" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
    
                            
                            <div class="tab-pane fade" id="counter" role="tabpanel" aria-labelledby="counter-tab">
                                <br>
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <button type="button" id="btn_add_counter"
                                            class="btn rounded-pill btn-md btn-info waves-effect waves-light">
                                            <i class="las la-plus-circle"></i> Add Category</button>
                                    </div>
                                </div>
                                <table id="otable_counter_cat" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_kitchen_category_modal -->
    <div id="add_kitchen_category_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Kitchen Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_kitchen" placeholder="Enter name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code_kitchen" placeholder="Enter code - PTO001, TMT002">
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_kitstock" onclick="add_category_kitchen()" class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_counter_category_modal -->
    <div id="add_counter_category_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Counter Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name_counter" placeholder="Enter name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code_counter" placeholder="Enter code">
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_counstock" onclick="add_category_counter()" class="btn btn-success">Add</button>
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
        var myData_kitchen = {};
        var myData_counter = {};

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn_add_kitchen").on('click', function(){
            $("#add_kitchen_category_modal").modal("show");
        });

        $("#btn_add_counter").on('click', function(){
            $("#add_counter_category_modal").modal("show");
        });

        var otable_kitchen_cat = $("#otable_kitchen_cat").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_kitchen_category_2')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData_kitchen);
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

        //
        // $("#counter button").on("click",function(){
        //     changeSelect()
        // })
       
        //     const triggerTabList = document.querySelectorAll('#counter button')
        // triggerTabList.forEach(triggerEl => {
        //   const tabTrigger = new bootstrap.Tab(triggerEl)

        //   triggerEl.addEventListener('click', event => {
        //     event.preventDefault()
        //     tabTrigger.show()
        //     changeSelect()
        //   })
        // })

        $("#counter").click(function(){
            changeSelect();
        });
        // Select2
        function changeSelect() {
            otable_counter_cat.columns.adjust().draw()
            
        }

        var otable_counter_cat = $("#otable_counter_cat").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_counter_category_2')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData_kitchen);
                }
            },
            columns: [{
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

        //add_category_kitchen
        function add_category_kitchen() {
            let name = $("#name_kitchen").val();
            let code = $("#code_kitchen").val();

            console.log(name);

            $("#btn_save_kitstock").attr("disabled", true);

            if (name == "") {
                toastr.error("Name Required");
                $("#btn_save_kitstock").attr("disabled", false);
            } else if (code == "") {
                toastr.error("Code Required");
                $("#btn_save_kitstock").attr("disabled", false);
            }

            $.ajax({
                "url": "<?php echo e(route('add_kitchen_category')); ?>",
                "method": "POST",
                "data": {
                    "name":name,
                    "code":code
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Category Added Successfully");
                        otable_kitchen_cat.ajax.reload();
                        $("#add_kitchen_category_modal").modal("hide");

                        $("#btn_save_kitstock").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_kitstock").attr("disabled", false);
                    }
                },
            });
        }

        //add_category_counter
        function add_category_counter() {
            let name = $("#name_counter").val();
            let code = $("#code_counter").val();

            console.log(name);

            $("#btn_save_counstock").attr("disabled", true);

            if (name == "") {
                toastr.error("Name Required");
                $("#btn_save_counstock").attr("disabled", false);
            } else if (code == "") {
                toastr.error("Code Required");
                $("#btn_save_counstock").attr("disabled", false);
            }

            $.ajax({
                "url": "<?php echo e(route('add_counter_category')); ?>",
                "method": "POST",
                "data": {
                    "name":name,
                    "code":code
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Category Added Successfully");
                        otable_counter_cat.ajax.reload();
                        $("#add_counter_category_modal").modal("hide");

                        $("#btn_save_counstock").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_counstock").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#name_kitchen").val('');
            $("#code_kitchen").val('');
            $("#name_counter").val('');
            $("#code_counter").val('');
            
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/category/category.blade.php ENDPATH**/ ?>