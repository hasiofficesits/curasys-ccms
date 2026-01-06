
<?php $__env->startSection('title'); ?>
Account Settings
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
        Account Settings
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
        Account Settings
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5>Customize Your Account Settings</h5>
                    <br><br>
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label fw-bold">STOCK : </label>
                                <div class="col-sm-8">
                                    <div id="stock" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 ps-3 col-form-label">NEW : </label>
                                <div class="col-sm-10">
                                    <div id="stock_acc" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label fw-bold">SALES : </label>
                                <div class="col-sm-8">
                                    <div id="sales" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 ps-3 col-form-label">NEW : </label>
                                <div class="col-sm-10">
                                    <div id="sales_acc" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label fw-bold">COST OF SALES : </label>
                                <div class="col-sm-8">
                                    <div id="cost_sales" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 ps-3 col-form-label">NEW : </label>
                                <div class="col-sm-10">
                                    <div id="cost_sales_acc" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label fw-bold">RECEIVED DISCOUNT : </label>
                                <div class="col-sm-8">
                                    <div id="re_dis" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 ps-3 col-form-label">NEW : </label>
                                <div class="col-sm-10">
                                    <div id="rec_dis" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label fw-bold">GIVEN DISCOUNT : </label>
                                <div class="col-sm-8">
                                    <div id="gi_dis" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 ps-3 col-form-label">NEW : </label>
                                <div class="col-sm-10">
                                    <div id="giv_dis" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-3">
                        </div>
                        <div class="col-md-4 mt-3">
                        </div>
                        <div class="col-md-4 mt-3 d-grid text-right">
                            <button id="btn_save_acc" onclick="save_acc()" class="btn btn-md btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>


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
        var stock_acc = [];
        var sales_acc = [];
        var cost_sales_acc = [];
        var rec_dis = [];
        var giv_dis = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_def_acc();
        load_exist_acc();

        $('#stock_acc').dxSelectBox({
            dataSource: stock_acc,
            displayExpr: 'Acc',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Acc"]
        });
        $('#sales_acc').dxSelectBox({
            dataSource: sales_acc,
            displayExpr: 'Acc',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Acc"]
        });
        $('#cost_sales_acc').dxSelectBox({
            dataSource: cost_sales_acc,
            displayExpr: 'Acc',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Acc"]
        });
        $('#rec_dis').dxSelectBox({
            dataSource: cost_sales_acc,
            displayExpr: 'Acc',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Acc"]
        });
        $('#giv_dis').dxSelectBox({
            dataSource: giv_dis,
            displayExpr: 'Acc',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Acc;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Acc"]
        });

        $("#stock").dxTextBox({ 
            readOnly:true,
        });
        $("#sales").dxTextBox({ 
            readOnly:true,
        });
        $("#cost_sales").dxTextBox({ 
            readOnly:true,
        });
        $("#re_dis").dxTextBox({ 
            readOnly:true,
        });
        $("#gi_dis").dxTextBox({ 
            readOnly:true,
        });

        function load_def_acc() {
            $.ajax({
                url: "<?php echo e(route('load_def_acc')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    acc = response.data;
                    $('#stock_acc').dxSelectBox("instance").option("dataSource", acc);
                    $('#sales_acc').dxSelectBox("instance").option("dataSource", acc);
                    $('#cost_sales_acc').dxSelectBox("instance").option("dataSource", acc);
                    $('#rec_dis').dxSelectBox("instance").option("dataSource", acc);
                    $('#giv_dis').dxSelectBox("instance").option("dataSource", acc);
                }
            })
        }

        function load_exist_acc() {
            $.ajax({
                url: "<?php echo e(route('load_exist_def_acc')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    $('#stock').dxTextBox("instance").option("value",response.stock_acc.Acc);
                    $('#sales').dxTextBox("instance").option("value",response.sales_acc.Acc);
                    $('#cost_sales').dxTextBox("instance").option("value",response.cost_sales_acc.Acc);
                    $('#re_dis').dxTextBox("instance").option("value",response.rec_dis.Acc);
                    $('#gi_dis').dxTextBox("instance").option("value",response.giv_dis.Acc);
                    
                }
            })
        }

        function save_acc() {
            let stock_acc = $("#stock_acc").dxSelectBox('instance').option('value');
            let sales_acc = $("#sales_acc").dxSelectBox('instance').option('value');
            let cost_sales = $("#cost_sales_acc").dxSelectBox('instance').option('value');
            let rec_dis = $("#rec_dis").dxSelectBox('instance').option('value');
            let giv_dis = $("#giv_dis").dxSelectBox('instance').option('value');

            $("#btn_save_acc").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_default_acc')); ?>",
                "method": "POST",
                "data": {
                    "stock_acc":stock_acc,
                    "sales_acc":sales_acc,
                    "cost_sales":cost_sales,
                    "rec_dis":rec_dis,
                    "giv_dis":giv_dis
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Account Updated Successfully");
                        $("#btn_save_acc").attr("disabled", false);
                        load_exist_acc()
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_acc").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#stock_acc").dxSelectBox('instance').option('value','');
            $("#sales_acc").dxSelectBox('instance').option('value','');
            $("#cost_sales_acc").dxSelectBox('instance').option('value','');
            $("#rec_dis").dxSelectBox('instance').option('value','');
            $("#giv_dis").dxSelectBox('instance').option('value','');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/management/acc_setting/acc_setting.blade.php ENDPATH**/ ?>