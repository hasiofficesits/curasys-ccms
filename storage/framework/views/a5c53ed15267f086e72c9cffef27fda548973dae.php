
<?php $__env->startSection('title'); ?>
    KOT Dashboard
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
            KOT Dashboard
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            KOT Dashboard
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="otable_kot" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>KOT No.</th>
                                <th>Recipe Code</th>
                                <th>Recipe Name</th>
                                <th>Order Type</th>
                                <th>Qty</th>
                                <th>Portion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- change_kot_status_modal -->
    <div id="change_kot_status_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Change Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="selected_kot_id">

                    <div class="col-sm-12 mb-3 d-grid">
                        <button type="button" id="status_process" onclick="process_status()"
                            class="btn btn-lg btn-warning">Processing</button>
                    </div>
                    <div class="col-sm-12 d-grid">
                        <button type="button" id="status_done" onclick="done_status()"
                            class="btn btn-lg btn-danger">Done</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    
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

        document.documentElement.setAttribute('data-sidebar-size', 'sm');

        var otable_kot = $("#otable_kot").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_kot_details')); ?>",
                method: "POST",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [{
                    data: 'id',
                    name: 'id',
                    "width": "100px",
                },
                {
                    data: 'recipe_code',
                    name: 'recipe_code',
                },
                {
                    data: 'recipe',
                    name: 'recipe',
                },
                {
                    data: 'order_type',
                    name: 'order_type',
                },
                {
                    data: 'qty',
                    name: 'qty',
                },
                {
                    data: 'portion',
                    name: 'portion',
                    render: function(data, type, row, meta) {
                        if (data == "Full") {
                            return '<span class="badge bg-warning p-2">Full</span>'
                        } else if (data == "Half") {
                            return '<span class="badge bg-info p-2">Half</span>';
                        } else if (data == "Normal") {
                            return '<span class="badge bg-success p-2">Normal</span>';
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

        $('#otable_kot tbody').on('click', '.btn-status', function() {

            var data = otable_kot.row($(this).parents('tr')).data();
            if (data.status != 2) {
                $("#selected_kot_id").val(data.id);

                if (data.status == 0) {
                    $("#status_process").show();
                    $("#status_done").show();
                } else if (data.status == 1) {
                    $("#status_process").hide();
                    $("#status_done").show();
                }

                $("#change_kot_status_modal").modal("show");
            }

        });

        function process_status() {
            let kot_id = $("#selected_kot_id").val();

            $("#status_process").attr('disabled', true);
            $("#status_done").attr('disabled', true);

            $.ajax({
                url: "<?php echo e(route('change_kot_status_process')); ?>",
                method: "POST",
                "data": {
                    "kot_id": kot_id,
                },
                success: function(response) {
                    otable_kot.ajax.reload();
                    $("#status_process").attr('disabled', false);
                    $("#change_kot_status_modal").modal("hide");

                }
            })
        }

        function done_status() {
            let kot_id = $("#selected_kot_id").val();

            $("#status_process").attr('disabled', true);
            $("#status_done").attr('disabled', true);


            $.ajax({
                url: "<?php echo e(route('change_kot_status_done')); ?>",
                method: "POST",
                "data": {
                    "kot_id": kot_id,
                },
                success: function(response) {
                    otable_kot.ajax.reload();
                    $("#status_process").attr('disabled', false);
                    $("#status_done").attr('disabled', false);

                    $("#change_kot_status_modal").modal("hide");

                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/kitchen/kot_dashboard.blade.php ENDPATH**/ ?>