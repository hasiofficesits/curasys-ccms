
<?php $__env->startSection('title'); ?>
Due Invoice
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
            Sales
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Due Invoice
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <table id="otable_due_inv" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date</th>
                                <th>Que</th>
                                <th>Patient</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <!-- ask_remove_modal -->
    <div id="ask_remove_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Remove Due Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_inv_id">
                    <h5 class="modal-title">Do You Want to Remove this Invoice ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="remove()" class="btn btn-danger">Remove</button>
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
        var item = [];
        var lot = [];
        var customer = [];
        var branch = [];

        var ds = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var otable_due_inv = $("#otable_due_inv").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_due_invoices')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [
                {
                    data: 'ID',
                    name: 'ID',
                    "width": "25px",
                },
                {
                    data: 'Date',
                    name: 'Date',
                },
                {
                    data: 'Qno',
                    name: 'Qno',
                    "width": "25px",
                },
                {
                    data: 'patient.FullName',
                    name: 'patient.FullName',
                },
                {
                    data: 'body_total',
                    name: 'body_total',
                    render: function(data, type, row, meta) {
                        var price = parseFloat(data);
                        if (!isNaN(price)) {
                            return 'LKR. ' + price.toFixed(2);
                        } else {
                            return '-';
                        }
                    }
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

        $('#otable_due_inv tbody').on('click', '.btn-remove', function() {
            var data = otable_due_inv.row($(this).parents('tr')).data();
            console.log(data);
            $("#selected_inv_id").val(data.ID);
            $("#ask_remove_modal").modal("show");
        });

        function remove() {
            let inv_id = $("#selected_inv_id").val();

            $.ajax({
                url:"<?php echo e(route('remove_due_inv')); ?>",
                method:"POST",
                data:{
                    "inv_id":inv_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Remove Successfully !');
                        otable_due_inv.ajax.reload();
                        $("#ask_remove_modal").modal("hide");
                        $("#selected_inv_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\CuraSys\resources\views/cashier/sales/due_inv.blade.php ENDPATH**/ ?>