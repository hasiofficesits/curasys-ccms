
<?php $__env->startSection('title'); ?>
    Dine In
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(URL::asset('assets/libs/jsvectormap/jsvectormap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(URL::asset('assets/libs/swiper/swiper.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
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

        #net input {
            font-size: 20px;
        }

        #unit_price input {
            font-size: 20px;
        }

        #item_qty input {
            font-size: 20px;
        }

        #discount input {
            font-size: 20px;
        }

        #total_price input {
            font-size: 20px;
        }

        #net_recipe input {
            font-size: 20px;
        }

        #unit_price_recipe input {
            font-size: 20px;
        }

        #item_qty_recipe input {
            font-size: 20px;
        }

        #discount_recipe input {
            font-size: 20px;
        }

        #total_price_recipe input {
            font-size: 20px;
        }
        #display_gross input {
            font-size: 20px;
        }

        #counter_item_select {
            font-size: 30px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    
    <div class="row">

        <div class="col-4">
            <div class="card vh-100">
                <div class="card-body">
                    <div class="col-md-12 mb-4">
                        <div class="col-md-12 d-grid">
                            <button id="btn_take_away" class="btn btn-md btn-warning ">Take Away</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <h5>TABLES</h5>
                        
                    </div>
                    <div class="row mb-2">
                        <?php $__currentLoopData = $tables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $table): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 mb-2 d-grid">
                                <?php if($table->status == 1): ?>
                                    <button onclick="selected_table(<?php echo e($table->id); ?>, this)"
                                        class="btn btn-lg btn-danger"><?php echo e($table->number); ?></button>
                                <?php else: ?>
                                    <button onclick="selected_table(<?php echo e($table->id); ?>, this)"
                                        class="btn btn-lg btn-success"><?php echo e($table->number); ?></button>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-8">
            <div class="card vh-100">
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <h5>DETAILS <span id="badge" class="badge bg-danger"></span></h5>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="table_name" placeholder="" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Person</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="table_person" placeholder="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Waiter</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="waiter_name" placeholder="" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Invoice</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="due_invo_number" placeholder="" disabled>
                                </div>
                            </div>
                        </div>

                        <hr class="mt-2">

                        <div class="col-md-12">
                            <h5>SERVING DETAILS</h5>
                            
                        </div>

                        <div class="col-sm-2 d-grid">
                            <button type="button" id="add_item" class="btn btn-info">Add Item</button>
                        </div>
                        <div class="col-sm-2 d-grid">
                            <button type="button" id="add_recipe" class="btn btn-info">Add Recipe</button>
                        </div>
                        <div class="col-sm-2 d-grid">
                            
                        </div>

                        <div class="col-lg-12 mt-2 mb-2">
                            
                            <div id="grid_container" class="dx-header-row"></div>
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="row">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Total Cost : </label>
                                <div class="col-sm-8">
                                    <div id="total_cost" class="form-control-sm float-right"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-sm-6">
                                </div>
                                <div class="col-sm-6 mt-1" style="padding-left: 80px">
                                    <button type="button" id="btn_make_invoice" onclick="make_invoice()"
                                        class="btn btn-danger">Order Close</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->


    </div>

    <!-- checkin_table_modal -->
    <div id="checkin_table_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Table Checking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="table_id">
                    <div class="row g-2">
                        
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Customer Count :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="count" placeholder="Enter Count">
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Waiter :</label>
                                <div class="col-sm-9">
                                    <div id="waiter" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_checkin" onclick="checkin_table()"
                        class="btn btn-success">Checkin</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_item_modal -->
    <div id="add_item_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="selected_due_invo">

                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" style="font-size: 20px"
                                    class="col-sm-2 col-form-label col-form-label-lg">Item :</label>
                                <div class="col-sm-10">
                                    
                                    <select id="counter_item" class="form-select" size="9"
                                        aria-label="size 3 select example">
                                        <?php $__currentLoopData = $counter_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option style="font-size: 25px" value="<?php echo e($counter_item->id); ?>">
                                                <?php echo e($counter_item->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label  col-form-label-lg">Unit Price : </label>
                                        <div class="col-sm-8">
                                            <div id="unit_price" class="form-control-lg" @disabled(true)>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label col-form-label-lg">Item Qty : </label>
                                        <div class="col-sm-8">
                                            <div id="item_qty" class="form-control-lg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label col-form-label-lg">Net : </label>
                                        <div class="col-sm-8">
                                            <div id="net" class="form-control-lg"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label col-form-label-lg">Discount : </label>
                                        <div class="col-sm-8">
                                            <div id="discount" class="form-control-lg"></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label col-form-label-lg">Total : </label>
                                        <div class="col-sm-8">
                                            <div id="total_price" class="form-control-lg"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_counter_item_to_inv" onclick="add_counter_item_to_inv()"
                        class="btn btn-lg btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- add_recipe_modal -->
    <div id="add_recipe_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" class="form-control" id="selected_due_invo_2">
                    <div class="row">
                        <div class="col-6 " style="height:70vh; overflow-y:scroll;">
                            <div class="row">

                                <?php $__currentLoopData = $recipe_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-4">
                                        <figure class="figure">
                                            <img style="img-fluid,max-width: 100%; height: auto;"
                                                onclick="select_recipe(<?php echo e($recipe_item->id); ?>)"
                                                src="/<?php echo e($recipe_item->image_path); ?>" class="figure-img img-fluid rounded"
                                                alt="...">
                                            <figcaption class="figure-caption text-center fs-4"><?php echo e($recipe_item->name); ?>

                                            </figcaption>
                                        </figure>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label  col-form-label-lg">Unit Price : </label>
                                        <div class="col-sm-8">
                                            <div id="unit_price_recipe" class="form-control-lg"
                                                @disabled(true)>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="form-control" id="selected_recipe_id">
                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label col-form-label-lg">Item Qty : </label>
                                        <div class="col-sm-8">
                                            <div id="item_qty_recipe" class="form-control-lg"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label col-form-label-lg">Net : </label>
                                        <div class="col-sm-8">
                                            <div id="net_recipe" class="form-control-lg"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label col-form-label-lg">Discount : </label>
                                        <div class="col-sm-8">
                                            <div id="discount_recipe" class="form-control-lg"></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mb-2">
                                    <div class="row">
                                        <label for="colFormLabel" style="font-size: 20px"
                                            class="col-sm-4 ps-5 col-form-label col-form-label-lg">Total : </label>
                                        <div class="col-sm-8">
                                            <div id="total_price_recipe" class="form-control-lg"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_recipe_to_inv" onclick="add_recipe_to_inv()"
                        class="btn btn-lg btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- make_invoice_modal -->
    <div id="make_invoice_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Make Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="due_invo_number">

                    <div class="row g-2">
                        
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label col-form-label-lg">Gross : </label>
                                <div class="col-sm-8">
                                    <div id="display_gross" class="form-control-lg"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="form-check form-check-danger form-switch-lg">
                                    <input class="form-check-input" type="checkbox" role="switch" id="service_charge" checked>
                                    <label class="form-check-label" style="font-size: 14px" for="service_charge">Add "Service Charge" to Invoice</label>
                                </div>
                            </div>
                        </div>
    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_invoice" onclick="save_invoice()" class="btn btn-success">Invoice</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_print_modal -->
    <div id="ask_print_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Print ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="invo_number">

                    <p>Do you want to print this invoice ?</p>
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Print Size :</label>
                                <div class="col-sm-9">
                                    <select id="print_size" class="form-select mb-3" aria-label="Default select example">
                                        <option selected>Select Bill Size..</option>
                                        <option value="A4">A4 Size - Normal</option>
                                        <option value="A5">A5 Size - Small(Half of A4)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_print_invoice" onclick="print_invoice()" class="btn btn-success">Print</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_takeaway_modal -->
    <div id="ask_takeaway_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Take Away Bill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <p>Do You Want to Make Take Away Bill ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_make_takeaway" onclick="make_takeaway()" class="btn btn-success">Ok</button>
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

    
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>

    <script>
        var myData = {};
        var ds = [];
        var waiter = [];
        // var counter_item = [];
        var details = [];
        var details_recipe = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        document.documentElement.setAttribute('data-sidebar-size', 'sm');

        load_waiter_list();

        $("#total_cost").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });

        // load_counter_item();

        // $('#counter_item').dxSelectBox({
        //     dataSource: counter_item,
        //     displayExpr: 'name',
        //     valueExpr: 'id',
        //     itemTemplate: function(data) {
        //         return data.code + " - " + data.name;
        //     },
        //     searchEnabled: true,
        //     searchExpr: ["code", "type"],
        //     onValueChanged: function(e) {
        //         const newValue = e.value;
        //         // Event handling commands go here
        //         $("#unit").empty();
        //         $("#unit_price").dxNumberBox("instance").option("value", 0);
        //         load_counter_item_details(newValue);
        //     },
        // });

        $("#unit_price").dxNumberBox({
            format: 'LKR #,##0.00',
            dataSource: details,
            displayExpr: 'price',
            // valueExpr: 'id',
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#unit_price_recipe").dxNumberBox({
            format: 'LKR #,##0.00',
            dataSource: details_recipe,
            displayExpr: 'price',
            // valueExpr: 'id',
            valueChangeEvent: "keyup",
            readOnly: true,
        });

        $("#total_price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });

        $("#total_price_recipe").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#net").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,

        });

        $("#net_recipe").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,

        });
        let counter_discount = null;
        let recipe_discount = null;

        $("#discount").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let net = $("#net").dxNumberBox('instance').option('value');
                counter_discount = e.value;


                let dis_val = net * counter_discount;
                let total = net - dis_val;

                $("#total_price").dxNumberBox('instance').option('value', total);
            },
        });

        $("#discount_recipe").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let net = $("#net_recipe").dxNumberBox('instance').option('value');
                recipe_discount = e.value;


                let dis_val = net * recipe_discount;
                let total = net - dis_val;

                $("#total_price_recipe").dxNumberBox('instance').option('value', total);
            },
        });

        $("#item_qty").dxNumberBox({
            format: '#,##0.000',
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {

                let unit_price = $("#unit_price").dxNumberBox('instance').option('value');
                let entered_qty = e.value;

                let net = unit_price * entered_qty;
                let total = 0;

                $("#net").dxNumberBox('instance').option('value', net);
                counter_discount = $("#discount").dxNumberBox('instance').option('value');

                if (counter_discount == 0) {
                    $("#total_price").dxNumberBox('instance').option('value', net);
                } else {
                    total = net * counter_discount;
                    $("#total_price").dxNumberBox('instance').option('value', total);
                }
            },
        });

        $("#item_qty_recipe").dxNumberBox({
            format: '#,##0.000',
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {

                let unit_price = $("#unit_price_recipe").dxNumberBox('instance').option('value');
                // console.log(unit_price);
                let entered_qty = e.value;

                let net = unit_price * entered_qty;
                let total = 0;

                $("#net_recipe").dxNumberBox('instance').option('value', net);
                recipe_discount = $("#discount_recipe").dxNumberBox('instance').option('value');

                if (recipe_discount == 0) {
                    $("#total_price_recipe").dxNumberBox('instance').option('value', net);
                } else {
                    total = net * recipe_discount;
                    $("#total_price_recipe").dxNumberBox('instance').option('value', total);
                }
            },
        });

        $('#waiter').dxSelectBox({
            dataSource: waiter,
            displayExpr: 'nic_name',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.id + " - " + data.nic_name;
            },
            searchEnabled: true,
            searchExpr: ["id", "nic_name"]
        });

        $("#display_gross").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });


        function load_waiter_list() {
            $.ajax({
                url: "<?php echo e(route('load_waiter_list')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    waiter = response.data
                    $('#waiter').dxSelectBox("instance").option("dataSource", waiter);

                }
            })
        }

        // function load_counter_item() {
        //     $.ajax({
        //         url: "<?php echo e(route('load_counter_item')); ?>",
        //         method: "GET",
        //         success: function(response) {
        //             // console.log(response)
        //             counter_item = response.data
        //             $('#counter_item').dxSelectBox("instance").option("dataSource", counter_item);

        //         }
        //     })
        // }

        var selected_elem = '';
        var selected_table_id = '';

        function selected_table(id, elem) {

            selected_elem = elem;
            // console.log(id);
            selected_table_id = id;
            console.log(selected_table_id);
            $("#btn_make_invoice").attr('disabled', true);

            $.ajax({
                "url": "<?php echo e(route('selected_table_status')); ?>",
                "method": "POST",
                "data": {
                    "selected_table_id": selected_table_id
                },
                "success": function(response) {

                    if (response.success) {

                        if (response.is_checking) { //status is 0

                            $("#table_id").val(selected_table_id);
                            $("#checkin_table_modal").modal("show");
                            $("#btn_make_invoice").attr('disabled', false);

                        } else {
                            $("#table_name").val(response.selected_table_invoice.table.name);
                            $("#table_person").val(response.selected_table_invoice.person_count);
                            $("#waiter_name").val(response.selected_table_invoice.waiter.nic_name);
                            $("#due_invo_number").val(response.selected_table_invoice.id);

                            $("#badge").html("Table");

                            //load data to grid
                            ds = [];
                            $("#grid_container").dxDataGrid("instance").option("dataSource", ds);
                            console.log(response.due_invo_body);

                            $.each(response.due_invo_body, function(k, v) {

                                console.log(v.department.Department_Name == "Counter");
                                if (v.department_id == 2) {
                                    ds.push({
                                        "name": v.counter_item.name,
                                        "price": v.rate,
                                        "qty": v.qty,
                                        "discount": v.discount,
                                        "total": v.total,
                                        "status": "exist_data",
                                    });
                                    $("#grid_container").dxDataGrid("instance").option("dataSource",
                                        ds);
                                    process_total(ds);
                                } else if (v.department.Department_Name == "Kitchen") {
                                    ds.push({
                                        "name": v.recipe.name,
                                        "price": v.rate,
                                        "qty": v.qty,
                                        "discount": v.discount,
                                        "total": v.total,
                                        "status": "exist_data",
                                    });
                                    $("#grid_container").dxDataGrid("instance").option("dataSource",
                                        ds);
                                    process_total(ds);
                                }

                            });

                            // console.log("Load data to grid...");
                            $("#btn_make_invoice").attr('disabled', false);
                        }

                    } else {

                    }
                },
            });
        }

        function clear_grid() {
            ds = [];
        }

        function checkin_table() {

            let table_id = $("#table_id").val();
            let person_count = $("#count").val();
            let waiter_id = $('#waiter').dxSelectBox("instance").option("value");

            if (person_count == "") {
                toastr.error("Please Enter Person Count");
                $("#btn_checkin").attr("disabled", false);
            } else if (waiter_id == null) {
                toastr.error("Waiter Required");
                $("#btn_checkin").attr("disabled", false);
            }

            $("#btn_checkin").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('cheking_table_by_id')); ?>",
                "method": "POST",
                "data": {
                    "table_id": table_id,
                    "person_count": person_count,
                    "waiter_id": waiter_id
                },
                "success": function(response) {
                    if (response.success) {
                        clear_form();
                        toastr.success("Checking Successfully");
                        $("#checkin_table_modal").modal("hide");
                        $("#badge").html("Table");
                        $(selected_elem).addClass("btn-danger");

                        console.log(response.data);

                        $("#due_invo_number").val(response.data.id);
                        $("#waiter_name").val(response.data.waiter.nic_name);
                        $("#table_name").val(response.data.table.name);
                        $("#table_person").val(response.data.person_count);


                        $("#btn_checkin").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_checkin").attr("disabled", false);
                    }
                },
            });
        };

        //make take away bill
        $("#btn_take_away").on('click', function(){
            $("#ask_takeaway_modal").modal("show");
        });

        function make_takeaway() {

            $("#btn_make_takeaway").attr("disabled", false);

            $.ajax({
                "url": "<?php echo e(route('make_takeaway_invo')); ?>",
                "method": "POST",
                
                "success": function(response) {
                    if (response.success) {

                        toastr.success("Take Away Bill created");
                        $("#ask_takeaway_modal").modal("hide");
                        $("#badge").html("Take Away");

                        console.log(response.data);

                        $("#due_invo_number").val(response.data.id);
                        $("#waiter_name").val("");
                        $("#table_name").val("");
                        $("#table_person").val("");


                        $("#btn_make_takeaway").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_make_takeaway").attr("disabled", false);
                    }
                },
            });
        }

        function clear_form() {
            $("#table_id").val('');
            $("#waiter_name").val('');
            $("#count").val('');
            $('#waiter').dxSelectBox("instance").option("value", '');
        };

        //Add ITEM
        $("#add_item").on('click', function() {
            let selected_due_invo = $("#due_invo_number").val();

            if (selected_due_invo == "") {
                toastr.error("Select Table Please");
            } else {
                $("#selected_due_invo").val(selected_due_invo);
                $("#add_item_modal").modal("show");
            }
        });

        function add_counter_item_to_inv() {

            let selected_due_invo = $("#selected_due_invo").val();
            let counter_item = $("#counter_item option:selected").val();
            let rate = $("#unit_price").dxNumberBox('instance').option('value');
            let discount = counter_discount;
            let qty = $("#item_qty").dxNumberBox('instance').option('value');
            let total = $("#total_price").dxNumberBox('instance').option('value');

            // console.log(discount,selected_due_invo);

            if (counter_item == null) {
                toastr.error("Please Select Item");
                $("#btn_add_counter_item_to_inv").attr("disabled", false);
            } else if (qty == 0) {
                toastr.error("Please Add Quentity");
                $("#btn_add_counter_item_to_inv").attr("disabled", false);
            }

            $("#btn_add_counter_item_to_inv").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('add_counter_item_to_inv')); ?>",
                "method": "POST",
                "data": {
                    "selected_due_invo": selected_due_invo,
                    "counter_item": counter_item,
                    "rate": rate,
                    "discount": discount,
                    "qty": qty,
                    "total": total
                },
                "success": function(response) {
                    if (response.success) {
                        console.log(response);
                        toastr.success("Item Added Successfully");

                        $("#add_item_modal").modal("hide");

                        $("#btn_add_counter_item_to_inv").attr("disabled", false);

                        if (response.data.type == "Take Away")
                        {
                            //load data to grid
                            ds = [];
                            $("#grid_container").dxDataGrid("instance").option("dataSource", ds);
                            console.log(response.due_invo_body);

                            $.each(response.due_invo_body, function(k, v) {

                                console.log(v.department.Department_Name == "Counter");
                                if (v.department_id == 2) {
                                    ds.push({
                                        "name": v.counter_item.name,
                                        "price": v.rate,
                                        "qty": v.qty,
                                        "discount": v.discount,
                                        "total": v.total,
                                        "status": "exist_data",
                                    });
                                    $("#grid_container").dxDataGrid("instance").option("dataSource",ds);
                                    process_total(ds);
                                } else if (v.department.Department_Name == "Kitchen") {
                                    ds.push({
                                        "name": v.recipe.name,
                                        "price": v.rate,
                                        "qty": v.qty,
                                        "discount": v.discount,
                                        "total": v.total,
                                        "status": "exist_data",
                                    });
                                    $("#grid_container").dxDataGrid("instance").option("dataSource",ds);
                                    process_total(ds);
                                }

                            });
                        } else {
                            selected_table(selected_table_id, selected_elem);
                        }
                        process_total(ds);
                        // var dataSource =$('#gridContainer').dxDataGrid("instance").getDataSource();
                        // dataSource.reload();
                        clear_form();
                    } else {
                        toastr.error(response.message);
                        $("#btn_add_counter_item_to_inv").attr("disabled", false);
                    }

                },
            });


        }

        $("#counter_item").on('change', function() {
            $('#unit_price').dxNumberBox("instance").option("value", 0);
            $("#unit").val(0);
            load_counter_item_details();
        })

        function load_counter_item_details() {
            let counter_item_id = $("#counter_item option:selected").val();

            $.ajax({
                url: "<?php echo e(route('load_counter_item_details')); ?>",
                method: "GET",
                "data": {
                    "counter_item_id": counter_item_id,
                },
                success: function(response) {
                    console.log(response);
                    details = response.data.price;
                    selected_unit = response.data.unit;
                    $('#unit_price').dxNumberBox("instance").option("value", details);
                    $("#unit").val(selected_unit);
                }
            })
        }

        //Add RECIPE
        $("#add_recipe").on('click', function() {
            let selected_due_invo = $("#due_invo_number").val();

            if (selected_due_invo == "") {
                toastr.error("Select Table Please");
            } else {
                $("#selected_due_invo_2").val(selected_due_invo);
                $("#add_recipe_modal").modal("show");
            }
        });

        var selected_recipe_id = null;

        function select_recipe(id) {
            // console.log(id);
            let selected_recipe_id = id;
            // console.log("recipe id ", selected_recipe_id);

            $.ajax({
                url: "<?php echo e(route('load_recipe_details_to_add')); ?>",
                method: "GET",
                "data": {
                    "recipe_id": selected_recipe_id,
                },
                success: function(response) {
                    console.log(response);
                    details_recipe = response.data.price;
                    // selected_unit = response.data.unit;
                    $("#selected_recipe_id").val(selected_recipe_id);
                    $('#unit_price_recipe').dxNumberBox("instance").option("value", parseFloat(details_recipe));
                    // $("#unit").val(selected_unit);
                }
            })
        };

        function add_recipe_to_inv() {

            let selected_due_invo = $("#selected_due_invo_2").val();
            let recipe_id = $("#selected_recipe_id").val();
            console.log(recipe_id);
            let rate = $("#unit_price_recipe").dxNumberBox('instance').option('value');
            let discount = recipe_discount;
            let qty = $("#item_qty_recipe").dxNumberBox('instance').option('value');
            let total = $("#total_price_recipe").dxNumberBox('instance').option('value');

            if (recipe_id == null) {
                toastr.error("Please Select Recipe to Add");
                $("#btn_add_recipe_to_inv").attr("disabled", false);
            } else if (qty == 0) {
                toastr.error("Please Add Quentity");
                $("#btn_add_recipe_to_inv").attr("disabled", false);
            }

            $("#btn_add_recipe_to_inv").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('add_recipe_to_inv')); ?>",
                "method": "POST",
                "data": {
                    "selected_due_invo": selected_due_invo,
                    "recipe_id": recipe_id,
                    "rate": rate,
                    "discount": discount,
                    "qty": qty,
                    "total": total
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Recipe Added Successfully");

                        $("#add_recipe_modal").modal("hide");

                        $("#btn_add_recipe_to_inv").attr("disabled", false);
                        if (response.data.type == "Take Away")
                        {
                            //load data to grid
                            ds = [];
                            $("#grid_container").dxDataGrid("instance").option("dataSource", ds);
                            console.log(response.due_invo_body);

                            $.each(response.due_invo_body, function(k, v) {

                                console.log(v.department.Department_Name == "Counter");
                                if (v.department_id == 2) {
                                    ds.push({
                                        "name": v.counter_item.name,
                                        "price": v.rate,
                                        "qty": v.qty,
                                        "discount": v.discount,
                                        "total": v.total,
                                        "status": "exist_data",
                                    });
                                    $("#grid_container").dxDataGrid("instance").option("dataSource",ds);
                                    process_total(ds);
                                } else if (v.department.Department_Name == "Kitchen") {
                                    ds.push({
                                        "name": v.recipe.name,
                                        "price": v.rate,
                                        "qty": v.qty,
                                        "discount": v.discount,
                                        "total": v.total,
                                        "status": "exist_data",
                                    });
                                    $("#grid_container").dxDataGrid("instance").option("dataSource",ds);
                                    process_total(ds);
                                }

                            });
                        } else {
                            selected_table(selected_table_id, selected_elem);
                        }
                        process_total(ds);
                        // var dataSource =$('#gridContainer').dxDataGrid("instance").getDataSource();
                        // dataSource.reload();
                        clear_form_recipe();
                    } else {
                        toastr.error(response.message);
                        $("#btn_add_recipe_to_inv").attr("disabled", false);
                    }

                },
            });
        }

        function clear_form_recipe() {
            $("#unit_price_recipe").dxNumberBox('instance').option('value', 0);
        }

        var dataGrid = $('#grid_container').dxDataGrid({
            dataSource: ds,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            editing: {
                mode: 'row',
                allowUpdating: true,
                allowDeleting: true,
                allowAdding: true,
            },
            columns: [
                // {
                //     dataField: 'ID',
                //     caption: 'ID',
                //     width: 100,
                //     allowEditing: false,
                //     // validationRules: [{
                //     //     type: 'required'
                //     // }],
                // },
                {
                    dataField: 'name',
                    caption: 'Name',
                    allowEditing: false,
                },
                {
                    dataField: 'price',
                    caption: 'Price',
                    width: 200,
                    allowEditing: false,
                },
                {
                    dataField: 'qty',
                    caption: 'Qty',
                    allowEditing: true,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                }, {
                    dataField: 'discount',
                    caption: 'Discount',
                    allowEditing: true,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'total',
                    caption: 'Total',
                    format: '#,##0.000',
                    allowEditing: false,
                    validationRules: [{
                        type: 'required'
                    }],
                },


            ],

            toolbar: {
                items: [
                    //     {
                    //     location: 'before',
                    //     name: 'addRowButton',
                    //     showText: 'always',
                    //     options: {
                    //         text: 'Add New Item',

                    //         visible:false,


                    //     },
                    // }
                ]
            },
            onRowPrepared: function(info) {
                if (info.rowType == 'header') {
                    info.rowElement.addClass('bg-success')
                }
            },
            // onEditingStart() {

            // },
            onInitNewRow(e) {

            },
            onRowInserting(e) {

            },
            onRowInserted(e) {

            },
            onRowUpdating(e) {
                let qty = e.oldData.qty;
                let discount = e.oldData.discount;

                if (e.newData.qty) {
                    qty = e.newData.qty;
                }
                if (e.newData.discount) {
                    discount = e.newData.discount;
                }

                if (e.oldData.status == "exist_data") {
                    e.newData.status = "old_updated";
                }

                e.newData.total = parseFloat(e.oldData.price) * qty;
                process_total(ds)
            },
            onRowUpdated(e) {
                if (e.status == "exist_data") {
                    e.status = "old_updated";

                }
                process_total(ds)
            },
            onRowRemoving(e) {
                if (e.key.status === "exist_data") {
                    deleteItems.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems.push(e.key);

                }
                process_total(ds)
                console.log(deleteItems);
            },
            onRowRemoved(e) {

                process_total(ds)

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        function process_total(ds1) {
            let gross = 0;
            if (ds1.length != 0) {
                $.each(ds1, function(k, v) {
                    gross += parseFloat(v.total);
                });
                $("#total_cost").dxNumberBox('instance').option('value', gross);
            } else {
                $("#total_cost").dxNumberBox('instance').option('value', 0);
            }
        }

        function make_invoice() {
            let due_invo_number = $("#due_invo_number").val();
            let display_gross = $("#total_cost").dxNumberBox('instance').option('value');

            if (due_invo_number == "") {
                toastr.error("Please Select a Table");
            } else {

                $("#due_invo_number").val(due_invo_number);
                $("#display_gross").dxNumberBox('instance').option('value', display_gross);

                $("#make_invoice_modal").modal("show");
            }
        }

        //make_invoice
        function save_invoice() {
            let due_invo_number = $("#due_invo_number").val();
            let display_gross = $("#display_gross").dxNumberBox('instance').option('value');

            let service_charge = "";

            if($('#service_charge').prop('checked')) {
                service_charge = "true";
            } else {
                service_charge = "false";
            }

            $("#btn_save_invoice").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_invoice')); ?>",
                "method": "POST",
                "data": {
                    "due_invo_number": due_invo_number,
                    "display_gross": display_gross,
                    "service_charge": service_charge
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Invoice Save Successfully");
                        // console.log(selected_elem);
                        $(selected_elem).removeClass("btn-danger");
                        $(selected_elem).addClass("btn-success");


                        $("#make_invoice_modal").modal("hide");
                        $("#invo_number").val(response.invoice_id);
                        $("#ask_print_modal").modal("show");

                        $("#btn_save_invoice").attr("disabled", false);

                    } else {
                        toastr.error(response.message);
                        $("#btn_save_invoice").attr("disabled", false);
                    }

                },
            });
        }

        function print_invoice() {
            let print_size = $("#print_size option:selected").val();
            let inv_no = $("#invo_number").val();

            printJS("/get_invoice/"+print_size+"/"+inv_no);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master_counter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/counter/dine_in.blade.php ENDPATH**/ ?>