
<?php $__env->startSection('title'); ?>
Counter
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
            Counter
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Counter
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_counter_item"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Item</button>
                        </div>
                    </div>
                    <table id="otable_counter" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Item Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- add_counter_item_modal -->
    <div id="add_counter_item_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Stock Item</h5>
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
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="code" placeholder="Enter code">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Type : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="type"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Category : </label>
                                    <div class="col-sm-8">
                                        <div id="category" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 col-form-label">Price : </label>
                                    <div class="col-sm-8">
                                        
                                        <div id="price" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Qty : </label>
                                    <div class="col-sm-8">
                                        
                                        <div id="item_qty" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="row">
                                    <div class="col-sm-12">
                                        
                                        <div id="unit" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12" style="text-align: right">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="colFormLabel" class="col-sm-12 col-form-label">
                                            <span class="text-danger">*</span> Select Unit - Kg, Ltr, Pkt or Btl </label>
                                    </div>
                                </div>
                            </div>
                            

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_item" onclick="add_item()" class="btn btn-success">Add</button>
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_category();

        $('#category').dxSelectBox({
            dataSource: category,
            displayExpr: 'name',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.id + " - " + data.name;
            },
            searchEnabled: true,
            searchExpr: ["id", "name"]
        });

        $("#price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
        });

        $("#item_qty").dxNumberBox({
            format: '#,##0.000',
            valueChangeEvent: "keyup",
        });

        let units = [{id: "1",name: "Kg"},{id: "2",name: "Ltr"},{id: "3",name: "Pkt"},{id: "4",name: "Btl"}];

        $('#unit').dxSelectBox({

            displayExpr: 'name',
            valueExpr: 'name',
            items: units,
        });

        function load_category() {
            $.ajax({
                url: "<?php echo e(route('load_counter_category')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    category = response.data
                    $('#category').dxSelectBox("instance").option("dataSource", category);
                    
                }
            })
        };

        var otable_counter = $("#otable_counter").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_counter_stock')); ?>",
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
                    data: 'code',
                    name: 'code',
                },
                {
                    data: 'name',
                    name: 'name',
                    "width": "200px",

                },
                {
                    data: 'category.name',
                    name: 'category.name',

                },
                {
                    data: 'qty',
                    name: 'qty',
                    // render: function(data, type, row, meta) {
                    //     var qty = parseFloat(data);
                    //     if (!isNaN(qty)) {
                    //         return qty.toFixed(3) + ' KG';
                    //     } else {
                    //         return '';
                    //     }
                    // }

                },
                {
                    data: 'unit',
                    name: 'unit',

                },
                {
                    data: 'cost',
                    name: 'cost',
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

        $("#btn_add_counter_item").on('click', function(){
            $("#add_counter_item_modal").modal("show");
        });

        function add_item() {
            let name = $("#name").val();
            let code = $("#code").val();
            let type = $("#type").val();
            let category = $('#category').dxSelectBox("instance").option("value");
            let price = $("#price").dxNumberBox('instance').option('value');
            let qty = $("#item_qty").dxNumberBox('instance').option('value');
            let unit = $("#unit").dxSelectBox('instance').option('value');

            if (name == "") {
                toastr.error("Item Name Required");
                $("#btn_save_item").attr("disabled", false);
            } else if (code == "") {
                toastr.error("Item Code Required");
                $("#btn_save_item").attr("disabled", false);
            } else if (category == null) {
                toastr.error("Category Required");
                $("#btn_save_item").attr("disabled", false);
            } else if (unit == null) {
                toastr.error("Unit Required");
                $("#btn_save_item").attr("disabled", false);
            }

            $("#btn_save_item").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_counter_stock_item')); ?>",
                "method": "POST",
                "data": {
                    "name":name,
                    "code":code,
                    "type":type,
                    "category":category,
                    "price":price,
                    "qty":qty,
                    "unit":unit
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Item Added Successfully");
                        otable_counter.ajax.reload();
                        $("#add_counter_item_modal").modal("hide");

                        $("#btn_save_item").attr("disabled", false);
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_item").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#category").dxSelectBox("instance").option("value", '');
            $("#unit").dxSelectBox("instance").option("value", '');
            $("#price").dxNumberBox("instance").option("value", 0);
            $("#item_qty").dxNumberBox("instance").option("value", 0);

            $("#name").val('');
            $("#code").val('');
            $("#type").val('');
        }
        
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/stores/counter.blade.php ENDPATH**/ ?>