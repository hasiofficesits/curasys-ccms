
<?php $__env->startSection('title'); ?>
Suplier
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
        Suplier
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Suplier
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_suplier"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Supplier</button>
                        </div>
                    </div>
                    <table id="otable_supplier" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_store_item_modal -->
    <div id="add_supplier_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" placeholder="Enter name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address" placeholder="Enter address">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Contact : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="contact"
                                            placeholder="Contact Person Name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Email : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Telephone : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="telephone"
                                            placeholder="Telephone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Mobile : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="mobile"
                                            placeholder="Mobile">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Fax : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="fax"
                                            placeholder="Fax">
                                    </div>
                                </div>
                            </div>

                            
                            

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_suplier" onclick="save_suplier()" class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_supplier_modal -->
    <div id="update_supplier_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" id="update_sup_id">

                        <div class="row g-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="update_name" placeholder="Enter name">
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Address :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="update_address" placeholder="Enter address">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Contact : </label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="update_contact"
                                            placeholder="Contact Person Name">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Email : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="update_email"
                                            placeholder="Email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Telephone : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="update_telephone"
                                            placeholder="Telephone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Mobile : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="update_mobile"
                                            placeholder="Mobile">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">Fax : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="update_fax"
                                            placeholder="Fax">
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_suplier" onclick="update_suplier()" class="btn btn-success">Update</button>
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

        var category = [];
        var account = [];
        var creditor = [];
        var adv_creditor = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#creditor').dxSelectBox({
            // dataSource: category,
            // displayExpr: 'name',
            // valueExpr: 'id',
            // itemTemplate: function(data) {
            //     return data.id + " - " + data.name;
            // },
            // searchEnabled: true,
            // searchExpr: ["id", "name"]
        });

        $('#advance_creditor').dxSelectBox({
            // dataSource: category,
            // displayExpr: 'name',
            // valueExpr: 'id',
            // itemTemplate: function(data) {
            //     return data.id + " - " + data.name;
            // },
            // searchEnabled: true,
            // searchExpr: ["id", "name"]
        });

        var otable_supplier = $("#otable_supplier").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_supplier')); ?>",
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
                    data: 'company',
                    name: 'company',
                },
                {
                    data: 'tel',
                    name: 'tel',
                    "width": "200px",

                },
                {
                    data: 'email',
                    name: 'email',

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

        $("#btn_add_suplier").on('click', function(){
            $("#add_supplier_modal").modal("show");
        });

        function save_suplier() {
            let name = $("#name").val();
            let address = $("#address").val();
            let contact = $("#contact").val();
            let email = $("#email").val();
            let telephone = $("#telephone").val();
            let fax = $("#fax").val();
            let mobile = $("#mobile").val();

            $("#btn_save_suplier").attr('disabled', true);

            $.ajax({
                "url": "<?php echo e(route('add_new_suplier')); ?>",
                "method": "POST",
                "data": {
                    "name":name,
                    "address":address,
                    "contact":contact,
                    "email":email,
                    "telephone":telephone,
                    "fax":fax,
                    "mobile":mobile
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Supplier Added Successfully");
                        otable_supplier.ajax.reload();
                        $("#add_supplier_modal").modal("hide");

                        $("#btn_save_suplier").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_suplier").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#name").val('');
            $("#address").val('');
            $("#contact").val('');
            $("#email").val('');
            $("#telephone").val('');
            $("#fax").val('');
            $("#mobile").val('');
        }

        $('#otable_supplier tbody').on('click', '.btn-edit', function() {

            var data = otable_supplier.row($(this).parents('tr')).data();
            console.log(data);

            $("#update_sup_id").val(data.id);
            $("#update_name").val(data.company);
            $("#update_address").val(data.address);
            $("#update_contact").val(data.contact);
            $("#update_email").val(data.email);
            $("#update_telephone").val(data.tel);
            $("#update_fax").val(data.fax);
            $("#update_mobile").val(data.mobile);


            $("#update_supplier_modal").modal("show");

        });

        function update_suplier() {

            let update_sup_id = $("#update_sup_id").val();
            let update_name = $("#update_name").val();
            let update_address = $("#update_address").val();
            let update_contact = $("#update_contact").val();
            let update_email = $("#update_email").val();
            let update_telephone = $("#update_telephone").val();
            let update_fax = $("#update_fax").val();
            let update_mobile = $("#update_mobile").val();

            $("#btn_update_suplier").attr('disabled', true);

            $.ajax({
                "url": "<?php echo e(route('update_suplier')); ?>",
                "method": "POST",
                "data": {
                    "update_sup_id":update_sup_id,
                    "update_name":update_name,
                    "update_address":update_address,
                    "update_contact":update_contact,
                    "update_email":update_email,
                    "update_telephone":update_telephone,
                    "update_fax":update_fax,
                    "update_mobile":update_mobile
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Supplier Update Successfully");
                        otable_supplier.ajax.reload();
                        $("#update_supplier_modal").modal("hide");

                        $("#btn_update_suplier").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_suplier").attr("disabled", false);
                    }
                },
            });
        }

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-Chamee\resources\views/suplier/list.blade.php ENDPATH**/ ?>