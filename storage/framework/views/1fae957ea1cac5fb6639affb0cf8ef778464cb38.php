
<?php $__env->startSection('title'); ?>
Patient
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
        Patient
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Patient
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <a href="<?php echo e(route('add_patient_page')); ?>" class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Patient</a>
                        </div>
                    </div>
                    <table id="otable_patient" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>NIC</th>
                                <th>Mobile</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- ask active -->
    <div id="ask_active_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Active Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="patient_id">
                    <h5 class="modal-title">Do You Want to Active this Patient ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_patient()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="patient_id">
                    <h5 class="modal-title">Do You Want to Inactive this Patient ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_patient()" class="btn btn-danger">Inactive</button>
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

        var otable_patient = $("#otable_patient").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_patient_grid')); ?>",
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
                    data: 'FullName',
                    name: 'FullName',
                },
                {
                    data: 'Gender',
                    name: 'Gender',
                    width:'30px',
                    render:function(data, type){
                        if(data==1){
                            return "Male"
                        }else{
                            return "Female"
                        }
                        return data
                    },

                },
                {
                    data: 'Nic',
                    name: 'Nic',
                    render:function(data){
                        if(data){
                            return data
                        } else {
                            return "-"
                        }
                        return data
                    }

                },
                {
                    data: 'Mobile',
                    name: 'Mobile',

                },
                {
                    data: 'Isdelete',
                    name: 'Isdelete',
                    width:'50px',
                    render:function(data, type){
                        if(data==0){
                            return '<span class="badge bg-success p-2">Active</span>'
                        }else{
                            return '<span class="badge bg-warning p-2">Inactive</span>'
                        }
                        return data
                    },
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

        $('#otable_patient tbody').on('click', '.btn-edit', function() {
            var data = otable_patient.row($(this).parents('tr')).data();
            console.log(data);
        });

        $('#otable_patient tbody').on('click', '.btn-active', function() {

            var data = otable_patient.row($(this).parents('tr')).data();

            if (data.Isdelete == 0) {
                $("#patient_id").val(data.ID);
                $("#ask_inactive_modal").modal("show");
            } else if (data.Isdelete == 1) {
                $("#patient_id").val(data.ID);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_patient() {
            let patient_id = $("#patient_id").val();

            $.ajax({
                url:"<?php echo e(route('active_patient')); ?>",
                method:"POST",
                data:{
                    "patient_id":patient_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_patient.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#patient_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

        function inactive_patient() {
            let patient_id = $("#patient_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_patient')); ?>",
                method:"POST",
                data:{
                    "patient_id":patient_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_patient.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#patient_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\CuraSys\resources\views/management/patient/patient.blade.php ENDPATH**/ ?>