
<?php $__env->startSection('title'); ?>
    OPD
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
            OPD
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            OPD
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_service"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Service</button>
                        </div>
                    </div>
                    <table id="otable_service" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_service_modal -->
    <div id="add_service_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Type :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="type" placeholder="Enter type">
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" placeholder="Enter name">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Price : </label>
                                <div class="col-sm-10">
                                    <div id="price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Revenue Acc : </label>
                                <div class="col-sm-10">
                                    <div id="rev_acc" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_service" onclick="save_service()"
                        class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_service_modal -->
    <div id="update_service_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="service_id">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Type :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_type" placeholder="Enter type">
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="edit_name" placeholder="Enter name">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Price : </label>
                                <div class="col-sm-10">
                                    <div id="edit_price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Revenue Acc : </label>
                                <div class="col-sm-10">
                                    <div id="rev_acc_edit" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_service" onclick="update_service()"
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
                    <h5 class="modal-title" id="myModalLabel">Active Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="act_service_id">
                    <h5 class="modal-title">Do You Want to Active the Service ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_service()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="act_service_id">
                    <h5 class="modal-title">Do You Want to Inactive the Service ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_service()" class="btn btn-danger">Inactive</button>
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
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Acc"]
        });

        $('#rev_acc_edit').dxSelectBox({
            dataSource: rev_acc,
            displayExpr: 'Acc',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Acc"]
        });

        $("#price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
        });
        $("#edit_price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
        });

        function load_rev_acc() {

            $.ajax({
                url: "<?php echo e(route('load_rev_acc_service')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    rev_acc = response.data
                    $('#rev_acc').dxSelectBox("instance").option("dataSource", rev_acc);
                    $('#rev_acc_edit').dxSelectBox("instance").option("dataSource", rev_acc);
                    
                }
            })
        }

        var otable_service = $("#otable_service").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_opdservice_grid')); ?>",
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
                    data: 'Type',
                    name: 'Type',
                },
                {
                    data: 'Name',
                    name: 'Name',

                },
                {
                    data: 'Price',
                    name: 'Price',
                    render: function(data, type, row, meta) {
                        var price = parseFloat(data);
                        if (!isNaN(price)) {
                            return 'LKR. ' + price.toFixed(2);
                        } else {
                            return '';
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

        $("#btn_add_service").on('click', function() {
            $("#add_service_modal").modal("show");
        });

        function save_service() {
            let type = $("#type").val();
            let name = $("#name").val();
            let price = $("#price").dxNumberBox('instance').option('value');
            let rev_acc = $('#rev_acc').dxSelectBox("instance").option("value");

            if (type == "") {
                toastr.error("Service Type Required");
                $("#btn_save_service").attr("disabled", false);
            } else if (name == "") {
                toastr.error("Service Name Required");
                $("#btn_save_service").attr("disabled", false);
            } else if (price == 0) {
                toastr.error("Service Price Required");
                $("#btn_save_service").attr("disabled", false);
            } else if (rev_acc == null) {
                toastr.error("Revenue Account Required");
                $("#btn_save_service").attr("disabled", false);
            }

            $("#btn_save_service").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_new_service')); ?>",
                "method": "POST",
                "data": {
                    "name": name,
                    "type": type,
                    "price": price,
                    "rev_acc":rev_acc
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Service Added Successfully");
                        otable_service.ajax.reload();
                        $("#add_service_modal").modal("hide");

                        $("#btn_save_service").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_service").attr("disabled", false);
                    }
                },
            });
        };

        function clear_form() {
            $("#type").val('');
            $("#name").val('');
            $("#price").dxNumberBox('instance').option('value', 0);
        };

        $('#otable_service tbody').on('click', '.btn-edit', function() {

            var data = otable_service.row($(this).parents('tr')).data();
            console.log(data);

            $("#service_id").val(data.ID);
            $("#edit_name").val(data.Name);
            $("#edit_type").val(data.Type);
            $("#edit_price").dxNumberBox('instance').option('value', data.Price);
            $('#rev_acc_edit').dxSelectBox("instance").option("value",data.Ledgeracc);

            $("#update_service_modal").modal("show");
        });

        function update_service() {
            let service_id = $("#service_id").val();
            let name = $("#edit_name").val();
            let type = $("#edit_type").val();
            let price = $("#edit_price").dxNumberBox('instance').option('value');
            let rev_acc = $('#rev_acc_edit').dxSelectBox("instance").option("value");

            if (type == "") {
                toastr.error("Service Type Required");
                $("#btn_update_service").attr("disabled", false);
            } else if (name == "") {
                toastr.error("Service Name Required");
                $("#btn_update_service").attr("disabled", false);
            } else if (price == 0) {
                toastr.error("Service Price Required");
                $("#btn_update_service").attr("disabled", false);
            } else if (rev_acc == null) {
                toastr.error("Revenue Account Required");
                $("#btn_update_service").attr("disabled", false);
            }

            $("#btn_update_service").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_opd_service')); ?>",
                "method": "POST",
                "data": {
                    "service_id":service_id,
                    "name": name,
                    "type": type,
                    "price": price,
                    "rev_acc":rev_acc
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Service Updated Successfully");
                        otable_service.ajax.reload();
                        $("#update_service_modal").modal("hide");

                        $("#btn_update_service").attr("disabled", false);
                        clear_update_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_service").attr("disabled", false);
                    }
                },
            });
        };

        function clear_update_form() {
            $("#service_id").val('');
            $("#edit_name").val('');
            $("#edit_type").val('');
            $("#edit_price").dxNumberBox('instance').option('value',0);
        };

        $('#otable_service tbody').on('click', '.btn-active', function() {

            var data = otable_service.row($(this).parents('tr')).data();

            if (data.IsDelete == 0) {
                $("#act_service_id").val(data.ID);
                $("#ask_inactive_modal").modal("show");
            } else if (data.IsDelete == 1) {
                $("#act_service_id").val(data.ID);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_service() {
            let act_service_id = $("#act_service_id").val();

            $.ajax({
                url:"<?php echo e(route('active_service_from_id')); ?>",
                method:"POST",
                data:{
                    "act_service_id":act_service_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_service.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#act_service_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };

        function inactive_service() {
            let act_service_id = $("#act_service_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_service_from_id')); ?>",
                method:"POST",
                data:{
                    "act_service_id":act_service_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_service.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#act_service_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\CuraSys\resources\views/management/opd/list.blade.php ENDPATH**/ ?>