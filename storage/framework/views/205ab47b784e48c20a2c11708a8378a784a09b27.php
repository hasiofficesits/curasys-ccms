
<?php $__env->startSection('title'); ?>
    Stock
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
            Stock
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Stock Item
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_add_item"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add New Item</button>
                        </div>
                    </div>
                    <table id="otable_stk_item" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Code</th>
                                <th>PHM</th>
                                <th>CHM</th>
                                <th>Brand</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <!-- add_item_modal -->
    <div id="add_item_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Code:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="code" value="<?php echo e($next_code); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Phm. Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="phm_name" placeholder="Pharmacy Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Chm. Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="chm_name" placeholder="Chemical Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Brand Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="brand_name" placeholder="Brand Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Supplier:</label>
                                <div class="col-sm-9">
                                    <div id="supplier" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Move Type:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="move_type" placeholder="Move Type">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Category:</label>
                                <div class="col-sm-9">
                                    <div id="category" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Group:</label>
                                <div class="col-sm-9">
                                    <div id="group" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Dosage:</label>
                                <div class="col-sm-9">
                                    <div id="dosage" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Strength:</label>
                                <div class="col-sm-9">
                                    <div id="dosage_strength" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Pack Type</label>
                                <div class="col-sm-8">
                                    <div id="pack_type" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Pack Qty:</label>
                                <div class="col-sm-8">
                                    <div id="pack_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Expire Available:</label>
                                <div class="col-sm-9">
                                    <div id="exp" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Re-Order Lvl.</label>
                                <div class="col-sm-8">
                                    <div id="order_lvl" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Distributor:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="distributor" placeholder="Distributor Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Importer:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="importer" placeholder="Importer Name">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_item" onclick="save_item()"
                        class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_item_modal -->
    <div id="update_item_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Code:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_code" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Phm. Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_phm_name" placeholder="Pharmacy Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Chm. Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_chm_name" placeholder="Chemical Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Brand Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_brand_name" placeholder="Brand Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Supplier:</label>
                                <div class="col-sm-9">
                                    <div id="edit_supplier" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Move Type:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_move_type" placeholder="Move Type">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Category:</label>
                                <div class="col-sm-9">
                                    <div id="edit_category" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Group:</label>
                                <div class="col-sm-9">
                                    <div id="edit_group" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Dosage:</label>
                                <div class="col-sm-9">
                                    <div id="edit_dosage" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Strength:</label>
                                <div class="col-sm-9">
                                    <div id="edit_dosage_strength" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Pack Type</label>
                                <div class="col-sm-8">
                                    <div id="edit_pack_type" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Pack Qty:</label>
                                <div class="col-sm-8">
                                    <div id="edit_pack_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Expire Available:</label>
                                <div class="col-sm-9">
                                    <div id="edit_exp" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Re-Order Lvl.</label>
                                <div class="col-sm-8">
                                    <div id="edit_order_lvl" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Distributor:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_distributor" placeholder="Distributor Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Importer:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_importer" placeholder="Importer Name">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_item" onclick="update_item()"
                        class="btn btn-primary">Update</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- view_lot_modal -->
    <div id="view_lot_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Stock Lot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="selected_item">
                    <div class="row g-2">
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <button type="button" id="btn_add_new_lot"
                                    class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                    <i class="las la-plus-circle"></i> Add New Lot</button>
                            </div>
                        </div>
                        <table id="otable_stk_lot" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Qty</th>
                                    <th>Cost</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>EXP</th>
                                    <th>Supplier</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_lot_modal -->
    <div id="add_lot_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Add Stock Lot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="lot_item_id">
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Lot:</label>
                                <div class="col-sm-9">
                                    <div id="lot" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Batch:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="batch" placeholder="Batch Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">EXP Date:</label>
                                <div class="col-sm-9">
                                    <div id="exp_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Supplier:</label>
                                <div class="col-sm-9">
                                    <div id="lot_supplier" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Price:</label>
                                <div class="col-sm-9">
                                    <div id="price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Cost:</label>
                                <div class="col-sm-9">
                                    <div id="cost" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Discount:</label>
                                <div class="col-sm-9">
                                    <div id="discount" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Qty:</label>
                                <div class="col-sm-9">
                                    <div id="lot_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_lot" onclick="add_lot()"
                        class="btn btn-primary">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_lot_modal -->
    <div id="update_lot_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Update Stock Lot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="lot_id">
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Lot:</label>
                                <div class="col-sm-9">
                                    <div id="edit_lot" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Batch:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="edit_batch" placeholder="Batch Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">EXP Date:</label>
                                <div class="col-sm-9">
                                    <div id="edit_exp_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Supplier:</label>
                                <div class="col-sm-9">
                                    <div id="edit_lot_supplier" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Price:</label>
                                <div class="col-sm-9">
                                    <div id="edit_price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Cost:</label>
                                <div class="col-sm-9">
                                    <div id="edit_cost" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Discount:</label>
                                <div class="col-sm-9">
                                    <div id="edit_discount" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Qty:</label>
                                <div class="col-sm-9">
                                    <div id="edit_lot_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_update_lot" onclick="update_lot()"
                        class="btn btn-success">Update</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_delete_modal -->
    <div id="ask_delete_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Delete Lot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="delete_lot_id">
                    <h5 class="modal-title">Do You Want to Delete this Lot ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="delete_lot()" class="btn btn-danger">Delete</button>
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
                    <h5 class="modal-title" id="myModalLabel">Active Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="item_id">
                    <h5 class="modal-title">Do You Want to Active this Item ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="active_item()" class="btn btn-success">Active</button>
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
                    <h5 class="modal-title" id="myModalLabel">Inactive Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="item_id">
                    <h5 class="modal-title">Do You Want to Inactive this Item ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="inactive_item()" class="btn btn-danger">Inactive</button>
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
        var supplier = [];
        var category = [];
        var group = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#exp_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
        });
        $('#edit_exp_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
        });

        let dosage = [{id: "1",name: "ml"},{id: "2",name: "g"},{id: "3",name: "mg"},{id: "4",name: "Capsule"},{id: "5",name: "Tablet"}];
        $('#dosage').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: dosage,
        });
        $('#edit_dosage').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: dosage,
        });
        $("#dosage_strength").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#edit_dosage_strength").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        let type = [{id: "1",name: "Box"},{id: "2",name: "Bottle"},{id: "3",name: "Card"}];
        $('#pack_type').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: type,
        });
        $('#edit_pack_type').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: type,
        });
        let exp = [{id: "1",name: "Yes"},{id: "2",name: "No"}];
        $('#exp').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: exp,
        });
        $('#edit_exp').dxSelectBox({
            displayExpr: 'name',
            valueExpr: 'name',
            items: exp,
        });
        $("#pack_qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#edit_pack_qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
            readOnly : true,
        });
        $("#order_lvl").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#edit_order_lvl").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#lot").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#edit_lot").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
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
        $("#cost").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
        });
        $("#edit_cost").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
        });
        $("#lot_qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#edit_lot_qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#discount").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
        });
        $("#edit_discount").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
        });

        load_supplier();
        $('#supplier').dxSelectBox({
            dataSource: supplier,
            displayExpr: 'Company',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Company;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Company"]
        });
        $('#edit_supplier').dxSelectBox({
            dataSource: supplier,
            displayExpr: 'Company',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Company;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Company"]
        });
        $('#lot_supplier').dxSelectBox({
            dataSource: supplier,
            displayExpr: 'Company',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Company;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Company"]
        });
        $('#edit_lot_supplier').dxSelectBox({
            dataSource: supplier,
            displayExpr: 'Company',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Company;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Company"]
        });

        load_category();
        $('#category').dxSelectBox({
            dataSource: category,
            displayExpr: 'CategoryName',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.CategoryName;
            },
            searchEnabled: true,
            searchExpr: ["ID", "CategoryName"]
        });
        $('#edit_category').dxSelectBox({
            dataSource: category,
            displayExpr: 'CategoryName',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.CategoryName;
            },
            searchEnabled: true,
            searchExpr: ["ID", "CategoryName"]
        });

        load_group();
        $('#group').dxSelectBox({
            dataSource: category,
            displayExpr: 'GroupName',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.GroupName;
            },
            searchEnabled: true,
            searchExpr: ["ID", "GroupName"]
        });
        $('#edit_group').dxSelectBox({
            dataSource: category,
            displayExpr: 'GroupName',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.GroupName;
            },
            searchEnabled: true,
            searchExpr: ["ID", "GroupName"]
        });

        function load_supplier() {
            $.ajax({
                url: "<?php echo e(route('load_supplier_to_stock')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    supplier = response.data
                    $('#supplier').dxSelectBox("instance").option("dataSource", supplier);
                    $('#edit_supplier').dxSelectBox("instance").option("dataSource", supplier);
                    $('#lot_supplier').dxSelectBox("instance").option("dataSource", supplier);
                    $('#edit_lot_supplier').dxSelectBox("instance").option("dataSource", supplier);
                }
            })
        }
        function load_category() {
            $.ajax({
                url: "<?php echo e(route('load_category_to_stock')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    category = response.data
                    $('#category').dxSelectBox("instance").option("dataSource", category);
                    $('#edit_category').dxSelectBox("instance").option("dataSource", category);
                    
                }
            })
        }
        function load_group() {
            $.ajax({
                url: "<?php echo e(route('load_group_to_stock')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    group = response.data
                    $('#group').dxSelectBox("instance").option("dataSource", group);
                    $('#edit_group').dxSelectBox("instance").option("dataSource", group);
                    
                }
            })
        }

        var otable_stk_item = $("#otable_stk_item").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_stock_item_grid')); ?>",
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
                    data: 'Code',
                    name: 'Code',
                    "width": "100px",
                },
                {
                    data: 'Pharma_name',
                    name: 'Pharma_name',
                    "width": "100px",
                },
                {
                    data: 'Chemical_Name',
                    name: 'Chemical_Name',
                    "width": "100px",
                },
                {
                    data: 'Brand_Name',
                    name: 'Brand_Name',
                    "width": "200px",
                },
                {
                    data: 'Pack_Qty',
                    name: 'Pack_Qty',
                    "className": "text-right",
                    "width": "50px",
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
                $('table tbody tr td').css('font-size', '13px');
                $('table tbody tr td').css('padding-bottom', '1px');
            }
        });

        $("#btn_add_item").on('click', function() {
            $("#add_item_modal").modal("show");
        });

        function load_next_item_code() {
            $("#code").val('');
            $.ajax({
                url: "<?php echo e(route('load_next_item_code')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    console.log(response.data);
                    $("#code").val(response.data);
                }
            })
        };

        function save_item() {
            let code = $("#code").val();
            let phm_name = $("#phm_name").val();
            let chm_name = $("#chm_name").val();
            let brand_name = $("#brand_name").val();
            let supplier = $('#supplier').dxSelectBox("instance").option("value");
            let move_type = $("#move_type").val();
            let category = $('#category').dxSelectBox("instance").option("value");
            let group = $('#group').dxSelectBox("instance").option("value");
            let dosage = $('#dosage').dxSelectBox("instance").option("value");
            let dosage_strength = $("#dosage_strength").dxNumberBox('instance').option('value');
            let pack_type = $('#pack_type').dxSelectBox("instance").option("value");
            let pack_qty = $("#pack_qty").dxNumberBox('instance').option('value');
            let exp = $('#exp').dxSelectBox("instance").option("value");
            let order_lvl = $("#order_lvl").dxNumberBox('instance').option('value');
            let distributor = $("#distributor").val();
            let importer = $("#importer").val();

            if (phm_name == "") {
                toastr.error("Pharmacy Name Required");
                $("#btn_save_item").attr("disabled", false);
            } else if (chm_name == "") {
                toastr.error("Chemical Name Required");
                $("#btn_save_item").attr("disabled", false);
            } else if (supplier == null) {
                toastr.error("Supplier Required");
                $("#btn_save_item").attr("disabled", false);
            } else if (category == null) {
                toastr.error("Category Required");
                $("#btn_save_item").attr("disabled", false);
            }

            $("#btn_save_item").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('add_pharmacy_stock_item')); ?>",
                "method": "POST",
                "data": {
                    "code": code,
                    "phm_name": phm_name,
                    "chm_name":chm_name,
                    "brand_name":brand_name,
                    "supplier":supplier,
                    "move_type":move_type,
                    "category":category,
                    "group":group,
                    "dosage":dosage,
                    "dosage_strength":dosage_strength,
                    "pack_type":pack_type,
                    "pack_qty":pack_qty,
                    "exp":exp,
                    "order_lvl":order_lvl,
                    "distributor":distributor,
                    "importer":importer
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Add Item Successfully");
                        otable_stk_item.ajax.reload();
                        $("#add_item_modal").modal("hide");
                        clear_form();
                        $("#btn_save_item").attr("disabled", false);
                        load_next_item_code();
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_item").attr("disabled", false);
                    }
                },
            });
        };

        function clear_form() {
            $("#code").val('');
            $("#phm_name").val('');
            $("#chm_name").val('');
            $("#brand_name").val('');
            $('#supplier').dxSelectBox("instance").option("value",'');
            $("#move_type").val('');
            $('#category').dxSelectBox("instance").option("value",'');
            $('#group').dxSelectBox("instance").option("value",'');
            $('#dosage').dxSelectBox("instance").option("value",'');
            $("#dosage_strength").dxNumberBox('instance').option('value',0);
            $('#pack_type').dxSelectBox("instance").option("value",'');
            $("#pack_qty").dxNumberBox('instance').option('value',0);
            $('#exp').dxSelectBox("instance").option("value",'');
            $("#order_lvl").dxNumberBox('instance').option('value',0);
            $("#distributor").val('');
            $("#importer").val('');
        };

        $('#otable_stk_item tbody').on('click', '.btn-edit', function() {

            var data = otable_stk_item.row($(this).parents('tr')).data();
            console.log(data);

            $("#edit_code").val(data.Code);
            $("#edit_phm_name").val(data.Pharma_name);
            $("#edit_chm_name").val(data.Chemical_Name);
            $("#edit_brand_name").val(data.Brand_Name);
            $('#edit_supplier').dxSelectBox("instance").option("value",data.FKSupplier_ID);
            $("#edit_move_type").val(data.Move_Type);
            $('#edit_category').dxSelectBox("instance").option("value",data.FKCatrgory);
            $('#edit_group').dxSelectBox("instance").option("value",data.FKGruop);
            $('#edit_dosage').dxSelectBox("instance").option("value",data.DosageType);
            $("#edit_dosage_strength").dxNumberBox('instance').option('value',data.DosageStrength);
            $('#edit_pack_type').dxSelectBox("instance").option("value",data.Pack_Type);
            $("#edit_pack_qty").dxNumberBox('instance').option('value',data.Pack_Qty);
            $('#edit_exp').dxSelectBox("instance").option("value",data.Exp);
            $("#edit_order_lvl").dxNumberBox('instance').option('value',data.ReorderLevel);
            $("#edit_distributor").val(data.Distributor);
            $("#edit_importer").val(data.Importer);

            $("#update_item_modal").modal("show");
        });

        function update_item() {
            let edit_code = $("#edit_code").val();
            let edit_phm_name = $("#edit_phm_name").val();
            let edit_chm_name = $("#edit_chm_name").val();
            let edit_brand_name = $("#edit_brand_name").val();
            let edit_supplier = $('#edit_supplier').dxSelectBox("instance").option("value");
            let edit_move_type = $("#edit_move_type").val();
            let edit_category = $('#edit_category').dxSelectBox("instance").option("value");
            let edit_group = $('#edit_group').dxSelectBox("instance").option("value");
            let edit_dosage = $('#edit_dosage').dxSelectBox("instance").option("value");
            let edit_dosage_strength = $("#edit_dosage_strength").dxNumberBox('instance').option('value');
            let edit_pack_type = $('#edit_pack_type').dxSelectBox("instance").option("value");
            // let edit_pack_qty = $("#edit_pack_qty").dxNumberBox('instance').option('value');
            let edit_exp = $('#edit_exp').dxSelectBox("instance").option("value");
            let edit_order_lvl = $("#edit_order_lvl").dxNumberBox('instance').option('value');
            let edit_distributor = $("#edit_distributor").val();
            let edit_importer = $("#edit_importer").val();

            if (edit_phm_name == "") {
                toastr.error("Pharmacy Name Required");
                $("#btn_update_item").attr("disabled", false);
            } else if (edit_chm_name == "") {
                toastr.error("Chemical Name Required");
                $("#btn_update_item").attr("disabled", false);
            } else if (edit_supplier == null) {
                toastr.error("Supplier Required");
                $("#btn_update_item").attr("disabled", false);
            } else if (edit_category == null) {
                toastr.error("Category Required");
                $("#btn_update_item").attr("disabled", false);
            }

            $("#btn_update_item").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_pharmacy_stock_item')); ?>",
                "method": "POST",
                "data": {
                    "edit_code": edit_code,
                    "edit_phm_name": edit_phm_name,
                    "edit_chm_name":edit_chm_name,
                    "edit_brand_name":edit_brand_name,
                    "edit_supplier":edit_supplier,
                    "edit_move_type":edit_move_type,
                    "edit_category":edit_category,
                    "edit_group":edit_group,
                    "edit_dosage":edit_dosage,
                    "edit_dosage_strength":edit_dosage_strength,
                    "edit_pack_type":edit_pack_type,
                    // "edit_pack_qty":edit_pack_qty,
                    "edit_exp":edit_exp,
                    "edit_order_lvl":edit_order_lvl,
                    "edit_distributor":edit_distributor,
                    "edit_importer":edit_importer
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Item Updated Successfully");
                        otable_stk_item.ajax.reload();
                        $("#update_item_modal").modal("hide");
                        clear_update_form();
                        $("#btn_update_item").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_item").attr("disabled", false);
                    }
                },
            });
        };

        function clear_update_form() {
            $("#edit_code").val('');
            $("#edit_phm_name").val('');
            $("#edit_chm_name").val('');
            $("#edit_brand_name").val('');
            $('#edit_supplier').dxSelectBox("instance").option("value",'');
            $("#edit_move_type").val('');
            $('#edit_category').dxSelectBox("instance").option("value",'');
            $('#edit_group').dxSelectBox("instance").option("value",'');
            $('#edit_dosage').dxSelectBox("instance").option("value",'');
            $("#edit_dosage_strength").dxNumberBox('instance').option('value',0);
            $('#edit_pack_type').dxSelectBox("instance").option("value",'');
            $("#edit_pack_qty").dxNumberBox('instance').option('value',0);
            $('#edit_exp').dxSelectBox("instance").option("value",'');
            $("#edit_order_lvl").dxNumberBox('instance').option('value',0);
            $("#edit_distributor").val('');
            $("#edit_importer").val('');
        };

        var glob_item_id = null;

        $('#otable_stk_item tbody').on('click', '.btn-add', function() {

            var data = otable_stk_item.row($(this).parents('tr')).data();
            console.log(data);
            glob_item_id = data.ID;

            $.post('<?php echo e(route('load_stock_lot_grid')); ?>',
            {
                "item_id":glob_item_id,
            },
            function(res){
                otable_stk_lot.clear();
                otable_stk_lot.rows.add(res.data);
                otable_stk_lot.draw();

                $("#selected_item").val(glob_item_id);
                $("#view_lot_modal").modal("show");
            })
        });

        var otable_stk_lot = $("#otable_stk_lot").DataTable({
            columnDefs: [
                {
                    targets: -1,
                    data: null,
                    defaultContent: '<button class="btn btn-info btn-sm waves-effect waves-light editBtn">Edit</button> <button class="btn btn-danger btn-sm waves-effect waves-light deleteBtn">Delete</button>',
                },
                // {
                //     targets: -2,
                //     data: null,
                //     defaultContent: '<button class="btn btn-danger btn-sm waves-effect waves-light btn-delete">Delete</button>',
                // },
            ],
            columns: [
                {
                    data: 'FKStock_ID',
                    name: 'FKStock_ID',
                },
                {
                    data: 'QTY',
                    name: 'QTY',
                },
                {
                    data: 'Cost',
                    name: 'Cost',
                    "className": "text-right",
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
                    data: 'Price',
                    name: 'Price',
                    "className": "text-right",
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
                    data: 'DisCount',
                    name: 'DisCount',
                    "className": "text-right",
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
                    data: 'Exp_date',
                    name: 'Exp_date',
                },
                {
                    data: 'supplier.Company',
                    name: 'supplier.Company',
                    "width": "200px",
                },
                {
                    data: 'action',
                    name: 'action',
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

        $("#btn_add_new_lot").on('click', function() {

            lot_item_id = $("#selected_item").val();
            $("#lot_item_id").val(lot_item_id);

            $("#add_lot_modal").modal("show");
        });

        function add_lot() {
            let lot_item_id = $("#lot_item_id").val();
            let lot = $("#lot").dxNumberBox('instance').option('value');
            let batch = $("#batch").val();
            let exp_date = $("#exp_date").dxDateBox("instance").option("value");
            let supplier = $('#lot_supplier').dxSelectBox("instance").option("value");
            let price = $("#price").dxNumberBox('instance').option('value');
            let cost = $("#cost").dxNumberBox('instance').option('value');
            let discount = $("#discount").dxNumberBox('instance').option('value');
            let qty = $("#lot_qty").dxNumberBox('instance').option('value');

            if (qty == 0) {
                toastr.error("Lot Qty Required");
                $("#btn_add_lot").attr("disabled", false);
            } else if (supplier == "") {
                toastr.error("Supplier Required");
                $("#btn_add_lot").attr("disabled", false);
            } else if (price == 0) {
                toastr.error("Price Required");
                $("#btn_add_lot").attr("disabled", false);
            } else if (cost == 0) {
                toastr.error("Cost Required");
                $("#btn_add_lot").attr("disabled", false);
            }

            $("#btn_add_lot").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('add_phm_stock_lot')); ?>",
                "method": "POST",
                "data": {
                    "lot_item_id":lot_item_id,
                    "lot": lot,
                    "batch": batch,
                    "exp_date":exp_date,
                    "supplier":supplier,
                    "price":price,
                    "cost":cost,
                    "discount":discount,
                    "qty":qty
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Lot Added Successfully");
                        // otable_stk_lot.ajax.reload();
                        $("#add_lot_modal").modal("hide");
                        $.post('<?php echo e(route('load_stock_lot_grid')); ?>',
                        {
                            "item_id":glob_item_id,
                        },
                        function(res){
                            otable_stk_lot.clear();
                            otable_stk_lot.rows.add(res.data);
                            otable_stk_lot.draw();
                        })
                        clear_lot_form();
                        $("#btn_add_lot").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_add_lot").attr("disabled", false);
                    }
                },
            });
        };

        function clear_lot_form() {
            $("#lot").dxNumberBox('instance').option('value',0);
            $("#batch").val('');
            $('#lot_supplier').dxSelectBox("instance").option("value",'');
            $("#price").dxNumberBox('instance').option('value',0);
            $("#cost").dxNumberBox('instance').option('value',0);
            $("#discount").dxNumberBox('instance').option('value',0);
            $("#lot_qty").dxNumberBox('instance').option('value',0);
        };

        $('#otable_stk_lot tbody').on('click', '.editBtn', function() {

            var data = otable_stk_lot.row($(this).parents('tr')).data();
            // console.log(data);

            let discount = data.DisCount / 100;

            $("#lot_id").val(data.ID);
            $("#edit_lot").dxNumberBox('instance').option('value',data.Lot);
            $("#edit_batch").val(data.Batch);
            $('#edit_lot_supplier').dxSelectBox("instance").option("value",data.Supplier_ID);
            $("#edit_price").dxNumberBox('instance').option('value',parseFloat(data.Price));
            $("#edit_cost").dxNumberBox('instance').option('value',parseFloat(data.Cost));
            $("#edit_discount").dxNumberBox('instance').option('value',discount);
            $("#edit_lot_qty").dxNumberBox('instance').option('value',data.QTY);
            $("#edit_exp_date").dxDateBox("instance").option("value", data.Exp_date);

            $("#update_lot_modal").modal("show");
            
        });

        function update_lot() {
            let lot_id = $("#lot_id").val();
            let edit_lot = $("#edit_lot").dxNumberBox('instance').option('value');
            let edit_batch = $("#edit_batch").val();
            let edit_lot_supplier = $('#edit_lot_supplier').dxSelectBox("instance").option("value");
            let edit_price = $("#edit_price").dxNumberBox('instance').option('value');
            let edit_cost = $("#edit_cost").dxNumberBox('instance').option('value');
            let edit_discount = $("#edit_discount").dxNumberBox('instance').option('value');
            let edit_lot_qty = $("#edit_lot_qty").dxNumberBox('instance').option('value');
            let edit_exp_date = $("#edit_exp_date").dxDateBox("instance").option("value");

            if (edit_lot_qty == 0) {
                toastr.error("Lot Qty Required");
                $("#btn_update_lot").attr("disabled", false);
            } else if (edit_lot_supplier == "") {
                toastr.error("Supplier Required");
                $("#btn_update_lot").attr("disabled", false);
            } else if (edit_price == 0) {
                toastr.error("Price Required");
                $("#btn_update_lot").attr("disabled", false);
            } else if (edit_cost == 0) {
                toastr.error("Cost Required");
                $("#btn_update_lot").attr("disabled", false);
            }

            $("#btn_update_lot").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('update_phm_stock_lot')); ?>",
                "method": "POST",
                // processData:false,
                "data": {
                    "lot_id":lot_id,
                    "edit_lot": edit_lot,
                    "edit_batch": edit_batch,
                    "edit_exp_date":edit_exp_date,
                    "edit_supplier":edit_lot_supplier,
                    "edit_price":edit_price,
                    "edit_cost":edit_cost,
                    "edit_discount":edit_discount,
                    "edit_lot_qty":edit_lot_qty
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Lot Updated Successfully");
                       
                        $("#update_lot_modal").modal("hide");
                        clear_lot_update_form();
                        $("#btn_update_lot").attr("disabled", false);

                        $.post('<?php echo e(route('load_stock_lot_grid')); ?>',
                        {
                            "item_id":glob_item_id,
                        },
                        function(res){
                            otable_stk_lot.clear();
                            otable_stk_lot.rows.add(res.data);
                            otable_stk_lot.draw();
                        })
                        // otable_stk_lot.ajax.reload();
                    } else {
                        toastr.error(response.message);
                        $("#btn_update_lot").attr("disabled", false);
                    }
                },
            });
        };

        function clear_lot_update_form() {
            $("#lot_id").val('');
            $("#edit_lot").dxNumberBox('instance').option('value',0);
            $("#edit_batch").val('');
            $('#edit_lot_supplier').dxSelectBox("instance").option("value",'');
            $("#edit_price").dxNumberBox('instance').option('value',0);
            $("#edit_cost").dxNumberBox('instance').option('value',0);
            $("#edit_discount").dxNumberBox('instance').option('value',0);
            $("#edit_lot_qty").dxNumberBox('instance').option('value',0);
        };

        $('#otable_stk_lot tbody').on('click', '.deleteBtn', function() {

            var data = otable_stk_lot.row($(this).parents('tr')).data();
            console.log(data);

            $("#delete_lot_id").val(data.ID);
            $("#ask_delete_modal").modal("show");
        });

        function delete_lot() {
            let delete_lot_id = $("#delete_lot_id").val();

            $.ajax({
                "url": "<?php echo e(route('delete_phm_stock_lot')); ?>",
                "method": "POST",
                // processData:false,
                "data": {
                    "delete_lot_id":delete_lot_id
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Lot Deleted Successfully");
                        $("#delete_lot_id").val('');
                        $("#ask_delete_modal").modal("hide");

                        $.post('<?php echo e(route('load_stock_lot_grid')); ?>',
                        {
                            "item_id":glob_item_id,
                        },
                        function(res){
                            otable_stk_lot.clear();
                            otable_stk_lot.rows.add(res.data);
                            otable_stk_lot.draw();
                        })
                        // otable_stk_lot.ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
            });
        }

        $('#otable_stk_item tbody').on('click', '.btn-active', function() {

            var data = otable_stk_item.row($(this).parents('tr')).data();

            if (data.IsDelete == 0) {
                $("#item_id").val(data.ID);
                $("#ask_inactive_modal").modal("show");
            } else if (data.IsDelete == 1) {
                $("#item_id").val(data.ID);
                $("#ask_active_modal").modal("show");
            }
        });

        function active_item() {
            let item_id = $("#item_id").val();

            $.ajax({
                url:"<?php echo e(route('active_item_from_id')); ?>",
                method:"POST",
                data:{
                    "item_id":item_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Activated Successfully !');
                        otable_stk_item.ajax.reload();
                        $("#ask_active_modal").modal("hide");
                        $("#item_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };
        function inactive_item() {
            let item_id = $("#item_id").val();

            $.ajax({
                url:"<?php echo e(route('inactive_item_from_id')); ?>",
                method:"POST",
                data:{
                    "item_id":item_id
                },
                success:function(response){
                    if(response.success){

                        toastr.success('Inactivated Successfully !');
                        otable_stk_item.ajax.reload();
                        $("#ask_inactive_modal").modal("hide");
                        $("#item_id").val("");

                    }else{
                        toastr.error(response.message);
                    }
                }
            })
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\BIT\Project\Project\SAHANYA\CuraSys\resources\views/Stock/stockMaster/item.blade.php ENDPATH**/ ?>