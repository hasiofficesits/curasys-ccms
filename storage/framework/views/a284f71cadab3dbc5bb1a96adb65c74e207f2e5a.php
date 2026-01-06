
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
            Tables
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Tables
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_table_type"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Table</button>
                        </div>
                    </div>
                    <table id="otable_table" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_table_modal -->
    <div id="add_table_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Table Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="table_name" placeholder="Enter Table Name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Table Number :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="table_number" placeholder="Ex:- TB001, VIP001">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Description :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_table" onclick="add_table()" class="btn btn-success">Add</button>
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
                    <h5 class="modal-title" id="myModalLabel">Active Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_table_id">
                    <h5 class="modal-title">Do You Want to Active this Table ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_table()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_table_id">
                    <h5 class="modal-title">Do You Want to Inactive this Table ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_table()" class="btn btn-danger">Inactive</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_table_modal -->
    <div id="update_table_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Table</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="selected_table_id">

                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Table Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="table_name_edit" placeholder="Enter Table Name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Table Number :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="table_number_edit" placeholder="Ex:- TB001, VIP001">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Description :</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="description_edit" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                        </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_table" onclick="update_table()" class="btn btn-success">Update</button>
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

        var otable_table = $("#otable_table").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_table_details')); ?>",
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
                    data: 'number',
                    name: 'number',

                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row, meta) {
                        if (data == 0) {
                            return '<span class="badge bg-success p-2">Available</span>'
                        } else if (data == 1) {
                            return '<span class="badge bg-danger p-2">Not Available</span>';
                        }
                    }
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

        $("#btn_add_table_type").on('click', function(){
            $("#add_table_modal").modal("show");
        });

        function add_table() {
            let table_name = $("#table_name").val();
            let table_number = $("#table_number").val();
            let description = $("#description").val();

            $("#btn_add_table").attr("disabled", true);

            if (table_name == "")
            {
                toastr.error("Table Name Required");
                $("#btn_add_table").attr("disabled", false);

            } else if (table_number == "") {

                toastr.error("Table Number Required");
                $("#btn_add_table").attr("disabled", false);
            }

            $.ajax({
                "url": "<?php echo e(route('save_new_table')); ?>",
                "method": "POST",
                "data": {
                    "table_name":table_name,
                    "table_number":table_number,
                    "description":description
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("New Table Added Successfully");
                        otable_table.ajax.reload();
                        $("#add_table_modal").modal("hide");

                        $("#btn_add_table").attr("disabled", false);
                        clear_form();

                    } else {
                        toastr.error(response.message);
                        $("#btn_add_table").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#table_name").val('');
            $("#table_number").val('');
            $("#description").val('');
        }

        $('#otable_table tbody').on('click', '.btn-active', function() {

            var data = otable_table.row($(this).parents('tr')).data();
            active_status = data.isDelete;
            selected_table_id = data.id;

            if (active_status == 1) 
            {
                $("#selected_table_id").val(selected_table_id);
                $("#ask_active_modal").modal("show");

            } else if (active_status == 0) 
            {
                $("#selected_table_id").val(selected_table_id);
                $("#ask_inactive_modal").modal("show");
            }
        });

        function inactive_table()
        {
            let selected_table_id = $("#selected_table_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_table')); ?>",
                method:"POST",
                data:{
                    "ID":selected_table_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_table.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#selected_table_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        function active_table()
        {
            let selected_table_id = $("#selected_table_id").val();

            $.ajax({
                url:"<?php echo e(route('active_table')); ?>",
                method:"POST",
                data:{
                    "ID":selected_table_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_table.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#selected_table_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        $('#otable_table tbody').on('click', '.btn-edit', function() {

            var data = otable_table.row($(this).parents('tr')).data();
            
            console.log(data);
            $("#table_name_edit").val(data.name);
            $("#table_number_edit").val(data.number);
            $("#description_edit").val(data.description);

            $("#selected_table_id").val(data.id);

            $("#update_table_modal").modal("show");

        });

        function update_table() {
            let table_name_edit = $("#table_name_edit").val();
            let table_number_edit = $("#table_number_edit").val();
            let description_edit = $("#description_edit").val();
            let selected_table_id = $("#selected_table_id").val();

            $("#btn_update_table").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_table')); ?>",
                "method": "POST",
                "data": {
                    "table_name_edit":table_name_edit,
                    "table_number_edit":table_number_edit,
                    "description_edit":description_edit,
                    "selected_table_id":selected_table_id
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Table Updated Successfully");

                        otable_table.ajax.reload();
                        $("#update_table_modal").modal("hide");

                        $("#btn_update_table").attr("disabled", false);
                        update_form_clear();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_table").attr("disabled", false);
                    }
                },
            });

        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/tables/tables.blade.php ENDPATH**/ ?>