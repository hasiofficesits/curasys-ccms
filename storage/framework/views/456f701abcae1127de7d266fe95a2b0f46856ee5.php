
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
            Recipe
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Recipe
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_recipe"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Recipe</button>
                        </div>
                    </div>
                    <table id="otable_recipe" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Cost</th>
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

    <!-- add_recipe_modal -->
    <div id="add_recipe_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <form id="save_recipe" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
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
                                        <div id="recipe_type" class="form-control-sm"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Portion : </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="portion"
                                            placeholder="Half | Full | Normal">
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
                            

                            <div class="col-lg-12">
                                <div class="row">
                                    <label for="colFormLabel" class="col-sm-2 col-form-label">Image :</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="image" name="image">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_recipe" onclick="add_recipe()" class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_recipe_body_modal -->
    <div id="add_recipe_body_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Manage Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="recipe-tab" data-bs-toggle="tab" data-bs-target="#recipe" type="button" role="tab" aria-controls="recipe" aria-selected="true">Recipe</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="false">Add Details</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="recipe" role="tabpanel" aria-labelledby="recipe-tab">
                            <br>
                            <div class="row g-2">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Name :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="selected_name" placeholder="Enter name" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Code :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="selected_code" placeholder="Enter code" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 col-form-label">Portion : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="selected_portion" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 col-form-label">Price : </label>
                                        <div class="col-sm-8">
                                            
                                            <div id="display_price" class="form-control-sm"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                
                            </div>

                        </div>

                        
                        <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                            <br>
                            <div class="row g-2">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Select an Item : </label>
                                        <div class="col-sm-10">
                                            <div id="store_item" class="form-control-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 col-form-label">Unit : </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="unit" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">unit Price : </label>
                                        <div class="col-sm-8">
                                            <div id="unit_price" class="form-control-sm" @disabled(true)></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 col-form-label">Item Qty : </label>
                                        <div class="col-sm-8">
                                            
                                            <div id="item_qty" class="form-control-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Cost : </label>
                                        <div class="col-sm-8">
                                            <div id="item_cost" class="form-control-sm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        
                                    </div>
                                </div> 
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-9">
                                        </div>
                                        <div class="col-sm-3" style="padding-left: 30px;">
                                            <button type="button" id="add_to_grid" onclick="add_item_to_grid()" class="btn btn-success">Add</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    
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
                            </div>

                            
                            <input type="hidden" class="form-control" id="selected_recipe_id">

                            <div class="mt-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-light me-2" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="btn_save_recipe_body" onclick="recipe_body_save()" class="btn btn-success">Save</button>
                            </div>
                        </div>
                        
                    </div>
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
                    <h5 class="modal-title" id="myModalLabel">Active Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_res_id">
                    <h5 class="modal-title">Do You Want to Active the Recipe ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_recipe()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="selected_res_id">
                    <h5 class="modal-title">Do You Want to Inactive the Recipe ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_recipe()" class="btn btn-danger">Inactive</button>
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
        var ds = [];
        var details = [];
        var type = [];
        deleteItems = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_store_items();
        load_recipe_type();

        $('#recipe_type').dxSelectBox({
            dataSource: type,
            displayExpr: 'type',
            valueExpr: 'id',
            itemTemplate: function(data) {
                return data.id + " - " + data.type;
            },
            searchEnabled: true,
            searchExpr: ["id", "type"]
        });

        $("#price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
        });
        $("#display_price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly : true,
        });
        $("#item_cost").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly : true,
        });
        $("#total_cost").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly : true,
        });

        $("#unit_price").dxNumberBox({
            format: 'LKR #,##0.00',
            dataSource: details,
            displayExpr: 'price',
            // valueExpr: 'id',
            valueChangeEvent: "keyup",
            readOnly : true,
        });
        $("#item_qty").dxNumberBox({
            format: '#,##0.000 Kg',
            valueChangeEvent: "keyup",
            onValueChanged:function(e){

                let unit_price = $("#unit_price").dxNumberBox('instance').option('value');
                let entered_qty = e.value;

                let cost = unit_price * entered_qty ;

                $("#item_cost").dxNumberBox('instance').option('value', cost);
                
            },
        });

        $('#store_item').dxSelectBox({
                dataSource: item,
                displayExpr: 'name',
                // valueExpr: 'id',
                itemTemplate: function (data) {  
                    return data.id + " - " + data.name;  
                },
                searchEnabled: true,
                searchExpr: ["id", "name"],
                onValueChanged: function(e) {
                    const newValue = e.value;
                    // Event handling commands go here
                    $("#unit").empty();
                    $("#unit_price").dxNumberBox("instance").option("value", 0);
                    load_item_details(newValue);
                },
        });

        function load_store_items() {
            $.ajax({
                url: "<?php echo e(route('load_store_items')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    item = response.data
                    $('#store_item').dxSelectBox("instance").option("dataSource", item);
                }
            })
        };

        function load_recipe_type() {
            $.ajax({
                url: "<?php echo e(route('load_recipe_type')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    type = response.data
                    $('#recipe_type').dxSelectBox("instance").option("dataSource", type);
                    
                }
            })
        };
        
        var otable_recipe = $("#otable_recipe").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height:"40vh",
            ajax: {
                url: "<?php echo e(route('load_recipe_details')); ?>",
                method: "POST",
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
                },
                {
                    data: 'price',
                    name: 'price',
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
                    data: 'cost',
                    name: 'cost',
                    render: function(data, type, row, meta) {
                        var cost = parseFloat(data);
                        if (!isNaN(cost)) {
                            return 'LKR. ' + cost.toFixed(2);
                        } else {
                            return '';
                        }
                    }

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

        //Add Recipe
        $("#btn_add_recipe").on('click', function() {
            $("#add_recipe_modal").modal("show");
        });

        function add_recipe() {

            let code = $("#code").val();
            let recipe_type = $('#recipe_type').dxSelectBox("instance").option("value");
            let name = $("#name").val();
            let portion = $("#portion").val();
            let price = $("#price").dxNumberBox('instance').option('value');
            let image = $("#image").val();

            let data = {
                "code": code,
                "recipe_type":recipe_type,
                "name": name,
                "portion": portion,
                "price": price,
            }

            //get image
            var formData = new FormData();
            for (var key in data) {
                formData.append(key, data[key]);
            }

            if ($("#image")[0].files[0]) {
                console.log("select");
                formData.append('image', $("#image")[0].files[0]);
            } else {
                formData.append('image', 'not');
            }

            $("#btn_save_recipe").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('save_recipe')); ?>",
                data: formData,
                method: "POST",
                processData: false,
                contentType: false,
                success: function(response) {

                    console.log(response);
                    if (response.success) {

                        toastr.success("Recipe Added!");
                        $("#add_recipe_modal").modal("hide")
                        // clear_data();
                        otable_recipe.ajax.reload();
                        $("#btn_save_recipe").attr("disabled", false);
                    } else {
                        toastr.error("Invalid data issue");
                        $("#btn_save_recipe").attr("disabled", false);
                    }
                }
            });

        }

        //add recipe body
        $('#otable_recipe tbody').on('click', '.btn-view', function() {

            var data = otable_recipe.row($(this).parents('tr')).data();

            selected_recipe_id = data.id;

            var selected_price = data.price;
            var unit_price = data.price

            $("#selected_name").val(data.name);
            $("#selected_code").val(data.code);
            $("#selected_portion").val(data.portion);
            $("#selected_recipe_id").val(selected_recipe_id);

            $("#display_price").dxNumberBox('instance').option('value', parseFloat(selected_price));
            $("#add_recipe_body_modal").modal("show");

            //load exist recipe body to grid
            $.ajax({
                url: "<?php echo e(route('load_exist_item_details')); ?>",
                method: "POST",
                "data": {
                    "selected_recipe_id":selected_recipe_id,
                },
                success: function(response) {

                    ds = [];
                    console.log(response);
                    
                    $.each(response.data, function(k, v) {
                        ds.push({
                            "item_id":v.stock_item.id,
                            "item_name":v.stock_item.name,
                            "portion":v.qty,
                            "unit":v.unit,
                            "unit_price":v.stock_item.price,
                            "Cost":v.price,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_container").dxDataGrid("instance").option("dataSource", ds);
                    process_total(ds);
                }
            });

        });

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
                    dataField: 'item_id',
                    caption: 'Item ID',
                    allowEditing: false,
                },
                {
                    dataField: 'item_name',
                    caption: 'Item',
                    width: 200,
                    allowEditing: false,
                },

                {
                    dataField: 'portion',
                    caption: 'Portion',
                    format: '#,##0.000',
                    allowEditing: true,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'unit',
                    caption: 'Unit',
                    allowEditing: true,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'unit_price',
                    caption: 'Unit Price',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 130,
                    allowEditing: false,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                

                {
                    dataField: 'Cost',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 130,
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
                    info.rowElement.addClass('bg-info')
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
                console.log(e.newData)
                console.log(e.oldData)
                let unit_price = e.oldData.unit_price;
                let portion = e.oldData.portion;

                if (e.newData.unit_price) {
                    unit_price = e.newData.unit_price;
                }
                if (e.newData.portion) {
                    portion = e.newData.portion;
                }

                if (e.oldData.status == "exist_data") {
                    e.newData.status = "old_updated";
                }

                e.newData.Cost = parseFloat(unit_price) * portion;
                process_total(ds)
            },
            onRowUpdated(e) {
                if (e.status == "exist_data") {
                    e.status = "old_updated";

                }
                process_total(ds)
            },
            onRowRemoving(e) {
                // console.log("Deleteing..1");
                // console.log(e.key);
                // console.log("Deleteing..1");
                if(e.key.status==="exist_data")
                {
                    deleteItems.push(e.key);

                } 
                if(e.key.status==="old_updated")
                {
                    deleteItems.push(e.key);

                } 
                process_total(ds)
                console.log(deleteItems);
            },
            onRowRemoved(e) {
                // console.log("Deleteing..");
                // console.log("Deleteing..2");
                // console.log(e.key);
                // console.log("Deleteing..2");
                if(e.key.status==="exist_data")
                {
                    deleteItems.push(e.key);

                } 
                if(e.key.status==="old_updated")
                {
                    deleteItems.push(e.key);

                } 
                process_total(ds)
                console.log(deleteItems);

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        function load_item_details() {

            let item_id = $('#store_item').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_recipe_item_details')); ?>",
                method: "GET",
                "data": {
                    "item_id": item_id,
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

        function add_item_to_grid()
        {
            let item_qty = $("#item_qty").dxNumberBox('instance').option('value');
            let unit_price = $("#unit_price").dxNumberBox('instance').option('value');

            let item_obj = $("#store_item").dxSelectBox('instance').option('value');
            let item_name = item_obj.name;
            let item_id = item_obj.id;

            let unit = $("#unit").val();
            let unit_cost = $("#item_cost").dxNumberBox('instance').option('value');

            let data = {
                // "ID":temp,
                "portion":item_qty,
                "unit_price":unit_price,
                "item_name":item_name,
                "item_id":item_id,
                "unit":unit,
                "Cost":unit_cost,
                "status": "new_add",
            };

            var dataSource = dataGrid.getDataSource();

            dataSource.store().insert(data).then(function() {
                dataSource.reload();
                process_total(ds); //calculate total
            })

            reset_elements();
        }

        function process_total(ds1) {
            let total = 0;
            if (ds1.length != 0) {
                $.each(ds1, function(k, v) {
                    total += parseFloat(v.Cost);
                });
                $("#total_cost").dxNumberBox('instance').option('value', total);
            } else {
                $("#total_cost").dxNumberBox('instance').option('value', 0);
            }
        }

        $("#add_recipe_body_modal").on('keydown', function ( e ) {
            var key = e.which || e.keyCode;
            if (key == 13) {
                add_item_to_grid();
                reset_elements(); // <----use the DOM click this way!!!
            }
        });

        function reset_elements()
        {
            $("#item_qty").dxNumberBox('instance').option('value',0);
            $("#store_item").dxSelectBox('instance').option('');
        }

        function reset_modal(){
            ds=[];
            $("#item_qty").dxNumberBox('instance').option('value',0);
            $("#store_item").dxSelectBox('instance').option('');
        }

        function recipe_body_save()
        {
            let body_data = JSON.stringify(ds);
            // let deleted_items = JSON.stringify(deleteItems);

            let exist_recpie_id = $("#selected_recipe_id").val();
            let final_cost = $("#total_cost").dxNumberBox('instance').option('value');
            console.log(exist_recpie_id);

            let data = {
                "body_data":body_data,
                "exist_recpie_id":exist_recpie_id,
                "final_cost":final_cost,
                "deleted_items": JSON.stringify(deleteItems),
            };

            $("#btn_save_recipe_body").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('save_recipe_body')); ?>",
                method: 'POST',
                data: data,
                success: function(response) {
                    console.log(response);
                    if (response.success) {

                        toastr.success("Recipe Updated!");
                        $("#add_recipe_body_modal").modal("hide");
                        otable_recipe.ajax.reload();

                        $("#btn_save_recipe_body").attr("disabled", false);

                    } else {
                        toastr.error("Invalid Data!");
                        $("#btn_save_recipe_body").attr("disabled", false);
                    }
                },
                error: function(err) {
                    toastr.error("Invalid Data!");
                    $("#btn_save_recipe_body").attr("disabled", false);
                }
            })

        }

        // var selected_res_id = null;

        $('#otable_recipe tbody').on('click', '.btn-active', function() {

            var data = otable_recipe.row($(this).parents('tr')).data();
            delete_status = data.delete;
            selected_res_id = data.id;

            if (delete_status == 1) 
            {
                $("#selected_res_id").val(selected_res_id);
                $("#ask_active_modal").modal("show");

            } else if (delete_status == 0) 
            {
                $("#selected_res_id").val(selected_res_id);
                $("#ask_inactive_modal").modal("show");
            }
        });

        function inactive_recipe()
        {
            let selected_res_id = $("#selected_res_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_recipe')); ?>",
                method:"POST",
                data:{
                    "ID":selected_res_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_recipe.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#selected_res_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }

        function active_recipe()
        {
            let selected_res_id = $("#selected_res_id").val();

            $.ajax({
                url:"<?php echo e(route('active_recipe')); ?>",
                method:"POST",
                data:{
                    "ID":selected_res_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_recipe.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#selected_res_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Intern\KARRS-KitchenRestaurent\resources\views/recipe/recipe.blade.php ENDPATH**/ ?>