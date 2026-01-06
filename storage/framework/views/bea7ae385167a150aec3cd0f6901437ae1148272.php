
<?php $__env->startSection('title'); ?>
Dosage Frequency
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
        Dosage Frequency List
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_frequency"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Frequency</button>
                        </div>
                    </div>
                    <table id="otable_frequency" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Frequency Name</th>
                                <th>Frequency Number</th>
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

    <!-- add_frequency_modal -->
    <div id="add_frequency_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Frequency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Frequency Name :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="frequency_name" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Frequency Number :</label>
                                <div class="col-sm-9">
                                    <div id="frequency_no" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_frequency" onclick="save_frequency()"
                        class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_frequency_modal -->
    <div id="update_frequency_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Frequency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="frequency_id">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Frequency Name :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="frequency_name_edit" placeholder="Enter Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Frequency Number :</label>
                                <div class="col-sm-9">
                                    <div id="frequency_no_edit" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_frequency" onclick="update_frequency()"
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
                    <h5 class="modal-title" id="myModalLabel">Active Frequency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="frequency_id">
                    <h5 class="modal-title">Do You Want to Active the Frequency ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_frequency()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Frequency</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="frequency_id">
                    <h5 class="modal-title">Do You Want to Inactive the Frequency ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_frequency()" class="btn btn-danger">Inactive</button>
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

        $("#frequency_no").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#frequency_no_edit").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });

        var otable_frequency = $("#otable_frequency").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_frequency_list')); ?>",
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
                    data: 'Freq_Name',
                    name: 'Freq_Name',

                },
                {
                    data: 'Freq_No',
                    name: 'Freq_No',

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

        $('#otable_frequency tbody').on('click', '.btn-active', function() {

            var data = otable_frequency.row($(this).parents('tr')).data();

            if (data.Isdelete == 0) {
                $("#frequency_id").val(data.Id);
                $("#ask_inactive_modal").modal("show");
            } else if (data.Isdelete == 1) {
                $("#frequency_id").val(data.Id);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_frequency() {
            let frequency_id = $("#frequency_id").val();

            $.ajax({
                url:"<?php echo e(route('active_frequency')); ?>",
                method:"POST",
                data:{
                    "frequency_id":frequency_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_frequency.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#frequency_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

        function inactive_frequency() {
            let frequency_id = $("#frequency_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_frequency')); ?>",
                method:"POST",
                data:{
                    "frequency_id":frequency_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_frequency.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#frequency_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        $("#btn_add_frequency").on('click', function() {
            $("#add_frequency_modal").modal("show");
        });

        function save_frequency() {
            let frequency_name = $("#frequency_name").val();
            let frequency_number = $("#frequency_no").dxNumberBox('instance').option('value');

            if (frequency_name == "") {
                toastr.error("Frequency Name Required");
                $("#btn_save_frequency").attr("disabled", false);
            } else if (frequency_number == 0) {
                toastr.error("Frequency Number Required");
                $("#btn_save_frequency").attr("disabled", false);
            }

            $("#btn_save_frequency").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_new_frequency')); ?>",
                "method": "POST",
                "data": {
                    "frequency_name": frequency_name,
                    "frequency_number":frequency_number
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Frequency Added Successfully");
                        otable_frequency.ajax.reload();
                        $("#add_frequency_modal").modal("hide");

                        $("#btn_save_frequency").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_frequency").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#frequency_name").val('');
            $("#frequency_no").dxNumberBox('instance').option('value',0);
        }

        $('#otable_frequency tbody').on('click', '.btn-edit', function() {

            var data = otable_frequency.row($(this).parents('tr')).data();

            $("#frequency_id").val(data.Id);
            $("#frequency_name_edit").val(data.Freq_Name);
            $("#frequency_no_edit").dxNumberBox('instance').option('value',data.Freq_No);
            $("#update_frequency_modal").modal("show");
        });

        function update_frequency() {
            let frequency_id = $("#frequency_id").val();
            let frequency_name = $("#frequency_name_edit").val();
            let frequency_no =  $("#frequency_no_edit").dxNumberBox('instance').option('value');

            if (frequency_name == "") {
                toastr.error("Frequency Name Required");
                $("#btn_update_frequency").attr("disabled", false);
            } else if (frequency_no == 0) {
                toastr.error("Frequency Number Required");
                $("#btn_update_frequency").attr("disabled", false);
            }

            $("#btn_update_frequency").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_frequency')); ?>",
                "method": "POST",
                "data": {
                    "frequency_id": frequency_id,
                    "frequency_name":frequency_name,
                    "frequency_no":frequency_no
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Frequency Updated Successfully");
                        otable_frequency.ajax.reload();
                        $("#update_frequency_modal").modal("hide");

                        $("#btn_update_frequency").attr("disabled", false);
                        clear_update_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_frequency").attr("disabled", false);
                    }
                },
            });
        }

        function clear_update_form() {
            $("#frequency_id").val('');
            $("#frequency_name_edit").val('');
            $("#frequency_no_edit").dxNumberBox('instance').option('value',0);
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\SAHANYA\resources\views/appointment/settings/frequency.blade.php ENDPATH**/ ?>