
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
            Recipe Type
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Recipe Type
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_recipe_type"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Recipe Type</button>
                        </div>
                    </div>
                    <table id="otable_recipe_type" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Rev. Acc</th>
                                <th>Cost Acc</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_recipe_type_modal -->
    <div id="add_recipe_type_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Recipe Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Type Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="type_name" placeholder="Enter Type Name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Rev. ACC : </label>
                                    <div class="col-sm-8">
                                        <div id="rev_acc" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Cost ACC : </label>
                                    <div class="col-sm-8">
                                        <div id="cost_acc" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_recipe_type" onclick="save_recipe_type()" class="btn btn-success">Add</button>
                </div>
                

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- edit_recipe_type_modal -->
    <div id="edit_recipe_type_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Recipe Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="selected_id">

                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Type Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="type_name_edit" placeholder="Enter Type Name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Rev. ACC : </label>
                                    <div class="col-sm-8">
                                        <div id="rev_acc_edit" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Cost ACC : </label>
                                    <div class="col-sm-8">
                                        <div id="cost_acc_edit" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_edit_recipe_type" onclick="update_recipe_type()" class="btn btn-success">Update</button>
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
        var rev_acc = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_rev_acc();

        $('#rev_acc').dxSelectBox({
            dataSource: rev_acc,
            displayExpr: 'Acc',
            valueExpr: 'AccCode',
            itemTemplate: function(data) {
                return data.AccCode + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["AccCode", "Acc"]
        });

        $('#cost_acc').dxSelectBox({
            dataSource: rev_acc,
            displayExpr: 'Acc',
            valueExpr: 'AccCode',
            itemTemplate: function(data) {
                return data.AccCode + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["AccCode", "Acc"]
        });

        $('#rev_acc_edit').dxSelectBox({
            dataSource: rev_acc,
            displayExpr: 'Acc',
            valueExpr: 'AccCode',
            // itemTemplate: function(data) {
            //     return data.AccCode + " - " + data.Acc;
            // },
            // searchEnabled: true,
            // searchExpr: ["AccCode", "Acc"]
        });

        $('#cost_acc_edit').dxSelectBox({
            dataSource: rev_acc,
            displayExpr: 'Acc',
            valueExpr: 'AccCode',
            // itemTemplate: function(data) {
            //     return data.AccCode + " - " + data.Acc;
            // },
            // searchEnabled: true,
            // searchExpr: ["AccCode", "Acc"]
        });

        var otable_recipe_type = $("#otable_recipe_type").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_recipe_type_data')); ?>",
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
                    data: 'type',
                    name: 'type',
                    "width": "200px",
                },
                {
                    data: 'rev_acc.Acc',
                    name: 'rev_acc.Ac',

                },
                {
                    data: 'cost_account.Acc',
                    name: 'cost_account.Acc',

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

        function load_rev_acc() {
            $.ajax({
                url: "<?php echo e(route('load_rev_acc')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    rev_acc = response.data
                    $('#rev_acc').dxSelectBox("instance").option("dataSource", rev_acc);
                    $('#cost_acc').dxSelectBox("instance").option("dataSource", rev_acc);
                    $('#cost_acc_edit').dxSelectBox("instance").option("dataSource", rev_acc);
                    $('#rev_acc_edit').dxSelectBox("instance").option("dataSource", rev_acc);
                    
                }
            })
        };

        $("#btn_add_recipe_type").on('click', function(){
            $("#add_recipe_type_modal").modal("show");
        });

        function save_recipe_type(){

            let type_name = $("#type_name").val();
            let rev_acc = $('#rev_acc').dxSelectBox("instance").option("value");
            let cost_acc = $('#cost_acc').dxSelectBox("instance").option("value");

            $("#btn_save_recipe_type").attr("disabled", true);

            if (type_name == "") {
                toastr.error("Type Name Required");
                $("#btn_save_recipe_type").attr("disabled", false);
            } else if (rev_acc == null) {
                toastr.error("Revenue Account Required");
                $("#btn_save_recipe_type").attr("disabled", false);
            } else if (cost_acc == null) {
                toastr.error("Cost Account Required");
                $("#btn_save_recipe_type").attr("disabled", false);
            }

            $.ajax({
                "url": "<?php echo e(route('save_recipe_type')); ?>",
                "method": "POST",
                "data": {
                    "type_name":type_name,
                    "rev_acc":rev_acc,
                    "cost_acc":cost_acc
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Recipe Type Added Successfully");
                        otable_recipe_type.ajax.reload();
                        $("#add_recipe_type_modal").modal("hide");

                        $("#btn_save_recipe_type").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_recipe_type").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#rev_acc").dxSelectBox("instance").option("value", '');
            $("#cost_acc").dxSelectBox("instance").option("value", '');

            $("#type_name").val('');
        }

        function update_form_clear() {
            $("#type_name_edit").val('');
            $("#rev_acc_edit").dxSelectBox("instance").option("value", '');
            $('#cost_acc_edit').dxSelectBox("instance").option("value", '');
        }

        $('#otable_recipe_type tbody').on('click', '.btn-edit', function() {

            var data = otable_recipe_type.row($(this).parents('tr')).data();
            console.log(data);
            
            $("#selected_id").val(data.id);
            $("#type_name_edit").val(data.type);
            $("#rev_acc_edit").dxSelectBox("instance").option("value", data.revenue_acc);
            $('#cost_acc_edit').dxSelectBox("instance").option("value",  data.cost_acc);

            $("#edit_recipe_type_modal").modal("show");

        });

        function update_recipe_type() {
            let selected_id = $("#selected_id").val();
            let edit_type_name = $("#type_name_edit").val();
            let edit_rev_acc = $('#rev_acc_edit').dxSelectBox("instance").option("value");
            let edit_cost_acc = $('#cost_acc_edit').dxSelectBox("instance").option("value");

            $("#btn_edit_recipe_type").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_recipe_type')); ?>",
                "method": "POST",
                "data": {
                    "selected_id":selected_id,
                    "type_name":edit_type_name,
                    "rev_acc":edit_rev_acc,
                    "cost_acc":edit_cost_acc
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Recipe Type Updated Successfully");
                        otable_recipe_type.ajax.reload();
                        $("#edit_recipe_type_modal").modal("hide");

                        $("#btn_edit_recipe_type").attr("disabled", false);
                        update_form_clear();
                    } else {
                        toastr.error(response.message);
                        $("#btn_edit_recipe_type").attr("disabled", false);
                    }
                },
            });


        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/recipe_type/recipe_type.blade.php ENDPATH**/ ?>