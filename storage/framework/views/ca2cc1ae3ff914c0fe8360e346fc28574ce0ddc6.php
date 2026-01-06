
<?php $__env->startSection('title'); ?>
    Appointment
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
            Appointment
        <?php $__env->endSlot(); ?>
        <?php $__env->slot('title'); ?>
            Selected Appointment
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row g-2">
                        <input type="hidden" class="form-control" id="appointment_id" value="<?php echo e($appointment->ID); ?>">
                        <input type="hidden" class="form-control" id="que_id" value="<?php echo e($que_id); ?>">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Appointment :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="que_id" value="<?php echo e($appointment->ID); ?>"
                                        disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Doctor :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="doctor"
                                        value="<?php echo e($appointment->doctor->Name); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Patient :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="patient_name"
                                        value="<?php echo e($appointment->patient->FullName); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Type :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="type"
                                        value="<?php echo e($appointment->Pt_Table); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Date :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="date"
                                        value="<?php echo e($appointment->Date); ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-4 col-form-label">Complaint :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="complaint"
                                        value="<?php echo e($appointment->Complain); ?>" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-5 d-grid text-right">
                            <button id="btn_history"
                                class="btn rounded-pill btn-md btn-info waves-effect waves-light">History</button>
                        </div>
                        <div class="col-md-4 mt-5 d-grid text-right">
                            <button id="btn_add"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">Add</button>
                        </div>
                        <div class="col-md-4 mt-5 d-grid text-right">
                            <button id="btn_record"
                                class="btn rounded-pill btn-md btn-warning waves-effect waves-light">Record Invoice</button>
                        </div>

                        <div class="col-md-12 mt-3 d-grid text-right">
                            <button class="btn btn-md btn-light" onclick="history.back();">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

    <!-- view_history_modal -->
    <div id="view_history_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="recipe-tab" data-bs-toggle="tab"
                                data-bs-target="#prescription" type="button" role="tab"
                                aria-controls="prescription" aria-selected="true">Prescription History</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#note"
                                type="button" role="tab" aria-controls="note" aria-selected="false">Note
                                History</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#investigation" type="button" role="tab"
                                aria-controls="investigation" aria-selected="false">Investigation History</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="prescription" role="tabpanel"
                            aria-labelledby="prescription-tab">
                            <br>
                            <div id="grid_prescription" class="dx-header-row mt-3"></div>
                            
                        </div>
                        
                        <div class="tab-pane fade show" id="note" role="tabpanel" aria-labelledby="note-tab">
                            <br>
                            
                            <div class="row" id="note-view">
                                <div class="col-6">
                                    <div class="card border card-border-success">
                                        <div class="card-header">
                                            <span class="float-end">75%</span>
                                            <h6 class="card-title mb-0">Handle to Forcast <span
                                                    class="badge bg-danger align-middle fs-10">Poor</span></h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">Whether article spirits new her covered hastily sitting
                                                her. Money witty books nor son add build on the card Chicken age had evening
                                                believe but proceed pretend mrs.</p>
                                            <div class="text-end">
                                                <a href="javascript:void(0);" class="link-primary fw-medium">Read More <i
                                                        class="ri-arrow-right-line align-middle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade show" id="investigation" role="tabpanel"
                            aria-labelledby="investigation-tab">
                            <br>
                            <div id="grid_result_view" class="dx-header-row mt-3"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    
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
                    <h5 class="modal-title" id="myModalLabel">Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="recipe-tab" data-bs-toggle="tab"
                                data-bs-target="#add_prescription" type="button" role="tab"
                                aria-controls="add_prescription" aria-selected="true">Prescription</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#add_note"
                                type="button" role="tab" aria-controls="add_note" aria-selected="false">Clinical
                                Note</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#add_investigation" type="button" role="tab"
                                aria-controls="add_investigation" aria-selected="false">Investigation Order</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#investigation_result" type="button" role="tab"
                                aria-controls="investigation_result" aria-selected="false">Investigation Result</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                                data-bs-target="#add_opdservice" type="button" role="tab"
                                aria-controls="add_opdservice" aria-selected="false">OPD Service</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        
                        <div class="tab-pane fade show active" id="add_prescription" role="tabpanel"
                            aria-labelledby="add_prescription-tab">
                            <br>
                            <button type="button" id="btn_add_prescription"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add Prescription</button>

                            <form id="add_image_form" method="POST" enctype="multipart/form-data">
                                <div class="col-lg-6 mt-4">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Image : </label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="file" id="pres_image" name="image">
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="grid_add_prescription" class="dx-header-row mt-3"></div>

                            <div class="row g-2 mt-3 text-right">
                                <div class="col-lg-6">
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6 mt-1 d-grid text-right">
                                            <button type="button" id="btn_save_prescription"
                                                onclick="save_prescription()" class="btn btn-info">Save
                                                Prescription</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="tab-pane fade show" id="add_note" role="tabpanel" aria-labelledby="add_note-tab">
                            <br>
                            <button type="button" id="btn_add_note"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add Note</button>

                            <div id="grid_add_note" class="dx-header-row mt-3"></div>

                            <div class="row g-2 mt-3 text-right">
                                <div class="col-lg-6">
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6 mt-1 d-grid text-right">
                                            <button type="button" id="btn_save_note" onclick="save_note()"
                                                class="btn btn-info">Save Note</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade show" id="add_investigation" role="tabpanel"
                            aria-labelledby="add_investigation-tab">
                            <br>

                            <button type="button" id="btn_add_order"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add Order</button>

                            <div id="grid_add_order" class="dx-header-row mt-3"></div>

                            <div class="row g-2 mt-3 text-right">
                                <div class="col-lg-6">
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6 mt-1 d-grid text-right">
                                            <button type="button" id="btn_save_order" onclick="save_order()"
                                                class="btn btn-info">Save Order</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade show" id="investigation_result" role="tabpanel"
                            aria-labelledby="investigation_result-tab">
                            <br>

                            <div class="row g-2">
                                <div class="col-lg-4">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 col-form-label">Type :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="result_type"
                                                placeholder="Enter Investigation Type">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 ps-3 col-form-label">MLT :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="result_mlt"
                                                placeholder="Enter MLT">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-2 ps-3 col-form-label">Date :</label>
                                        <div class="col-sm-10">
                                            <div id="result_date" class="form-control-sm"></div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="mt-3 mb-2">Investigation Result</h5>
                                <hr>

                                <div class="col-lg-3">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 col-form-label">Narration :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="result_narration"
                                                placeholder="Narration">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Result :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="result_result"
                                                placeholder="Result">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Range :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="result_range"
                                                placeholder="Normal Range">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-8 mt-1 d-grid text-right">
                                            <button type="button" id="btn_add_result_grid" onclick="add_result_grid()"
                                                class="btn btn-info">Add</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="grid_add_result" class="dx-header-row mt-3"></div>

                            <div class="row g-2 mt-3 text-right">
                                <div class="col-lg-6">
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6 mt-1 d-grid text-right">
                                            <button type="button" id="btn_save_result" onclick="save_result()"
                                                class="btn btn-info">Save Result</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade show" id="add_opdservice" role="tabpanel"
                            aria-labelledby="add_opdservice-tab">
                            <br>

                            <button type="button" id="btn_add_service"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">
                                <i class="las la-plus-circle"></i> Add Service</button>

                            

                            <div id="grid_add_service" class="dx-header-row mt-3"></div>

                            <div class="row g-2 mt-3 text-right">
                                <div class="col-lg-6">
                                    <div class="row">

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6 mt-1 d-grid text-right">
                                            <button type="button" id="btn_save_service" onclick="save_service()"
                                                class="btn btn-info">Save Service</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    
                </div>


            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_new_prescription_modal -->
    <div id="add_new_prescription_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Prescription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Item :</label>
                                <div class="col-sm-10">
                                    <div id="item" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <hr>
                        <h5 class="mt-2 mb-2">Dosage Information</h5>

                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Dose :</label>
                                <div class="col-sm-8">
                                    <div id="dose" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Unit :</label>
                                <div class="col-sm-8">
                                    <div id="unit" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Freq :</label>
                                <div class="col-sm-8">
                                    <div id="frequency" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Period :</label>
                                <div class="col-sm-8">
                                    <div id="period" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Qty :</label>
                                <div class="col-sm-8">
                                    <div id="dose_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_prescription" onclick="add_prescription()"
                        class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_new_note_modal -->
    <div id="add_new_note_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Clinical Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Category :</label>
                                <div class="col-sm-9">
                                    <div id="note_category" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Note :</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="note_body" rows="5"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_note" onclick="add_note()" class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_new_service_modal -->
    <div id="add_new_service_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New OPD Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Service :</label>
                                <div class="col-sm-10">
                                    <div id="opd_service" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Price :</label>
                                <div class="col-sm-8">
                                    <div id="serv_price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Qty :</label>
                                <div class="col-sm-8">
                                    <div id="serv_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Total :</label>
                                <div class="col-sm-8">
                                    <div id="serv_total" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_service" onclick="add_service()"
                        class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- add_new_order_modal -->
    <div id="add_new_order_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Investigation Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Type :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inves_type"
                                        placeholder="Enter Investigation Type">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Narration :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inves_narra"
                                        placeholder="Enter Investigation Narration">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Speciman :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inves_speciman"
                                        placeholder="Enter Investigation Speciman">
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_order" onclick="add_order()" class="btn btn-success">Add</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ask_record_modal -->
    <div id="ask_record_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Record Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="app_id">
                    <h5 class="modal-title">Do You Want to Record this Appointment ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_record" onclick="record()" class="btn btn-warning">Record</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- view_result_modal -->
    <div id="view_result_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Investigation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div id="grid_view_resultBody" class="dx-header-row mt-3"></div>
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
        var item = [];
        var lot = [];
        var opd_service = [];
        var frequency = [];
        var unit = [];
        var selected_appointment = null;

        var ds_pres = [];
        var ds_note = [];
        var ds_service = [];
        var ds_order = [];
        var ds_result = [];

        var ds_pres_view = [];
        var ds_result_view = [];
        var ds_result_Bodyview = [];

        var deleteItems_pres = [];
        var deleteItems_note = [];
        var deleteItems_service = [];
        var deleteItems_result = [];
        var deleteItems_order = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_item();
        load_opd_service();
        load_frequency();
        load_unit();

        $('#item').dxSelectBox({
            dataSource: item,
            displayExpr: 'Brand_Name',
            // valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Brand_Name ;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Pharma_name", "Brand_Name"],
            onValueChanged: function(e) {
            },
        });
        $('#frequency').dxSelectBox({
            // items: ['TDS','BD','NOCTE','VESPA','MANE','6Hr','8Hr','5Hr','EOD','SOS'],
            dataSource: frequency,
            displayExpr: 'Freq_Name',
            // valueExpr: 'Id',
            itemTemplate: function(data) {
                return data.Id + " - " + data.Freq_Name;
            },
            searchEnabled: true,
            searchExpr: ["Id", "Freq_Name"],
        });
        $('#unit').dxSelectBox({
            // items: ['A/M','B/M','**'],
            dataSource: unit,
            displayExpr: 'Name',
            // valueExpr: 'Id',
            itemTemplate: function(data) {
                return data.Id + " - " + data.Name;
            },
            searchEnabled: true,
            searchExpr: ["Id", "Name"],
        });
        $('#opd_service').dxSelectBox({
            dataSource: opd_service,
            displayExpr: 'Name',
            // valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Name;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Name"],
            onValueChanged: function(e) {
                load_service_details(e);
            },
        });
        $('#lot').dxSelectBox({
            dataSource: lot,
            displayExpr: 'ID',
            // valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + "LKR. "+data.Price + " - " + "EXP : "+data.Exp_date;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Exp_date", "Price"],
            onValueChanged: function(e) {
                load_lot_price(e);
            },

        });
        $('#note_category').dxSelectBox({
            items: ['OPD Note', 'Clinical Note', 'Alergy Note'],
        });
        $("#price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#dose").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let period = $("#period").dxNumberBox('instance').option('value');
                let dose = e.value;

                let qty = period * dose;
                $("#dose_qty").dxNumberBox('instance').option('value', qty);
            },
        });
        $("#period").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let dose = $("#dose").dxNumberBox('instance').option('value');
                let period = e.value;
                let qty = period * dose;
                $("#dose_qty").dxNumberBox('instance').option('value', qty);
            },
        });
        $("#dose_qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
        });
        $("#cons_fee").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 300.00,
            valueChangeEvent: "keyup",
        });

        $("#serv_qty").dxNumberBox({
            format: '#,##0.00',
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let price = $("#serv_price").dxNumberBox('instance').option('value');
                let qty = e.value;

                let total = qty * price;
                $("#serv_total").dxNumberBox('instance').option('value', total);

            },
        });
        $("#serv_price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#serv_total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $('#result_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
        });

        function load_item() {
            $.ajax({
                url: "<?php echo e(route('load_stock_item_grn')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    item = response.data
                    $('#item').dxSelectBox("instance").option("dataSource", item);
                }
            })
        }

        function load_frequency() {
            $.ajax({
                url: "<?php echo e(route('load_frequency_appoi')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    frequency = response.data
                    $('#frequency').dxSelectBox("instance").option("dataSource", frequency);
                }
            })
        }

        function load_unit() {
            $.ajax({
                url: "<?php echo e(route('load_unit_appoi')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    unit = response.data
                    $('#unit').dxSelectBox("instance").option("dataSource", unit);
                }
            })
        }

        // function load_lot() {
        //     let item_id = $('#item').dxSelectBox("instance").option("value");

        //     $.ajax({
        //         url: "<?php echo e(route('load_lot_details')); ?>",
        //         method: "POST",
        //         "data": {
        //             "item_id": item_id.ID,
        //         },
        //         success: function(response) {
        //             // console.log(response.data);
        //             lot = response.data
        //             $('#lot').dxSelectBox("instance").option("dataSource", lot);
        //         }
        //     });
        // }

        function load_lot_price() {
            let lot_id = $('#lot').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_lot_price')); ?>",
                method: "POST",
                "data": {
                    "lot_id": lot_id.ID,
                },
                success: function(response) {
                    console.log(response.data);
                    if (response.data == null) {
                        $("#price").dxNumberBox('instance').option('value', parseFloat(0));
                        $("#qty").dxNumberBox('instance').option('value', 0);
                    } else {
                        $("#price").dxNumberBox('instance').option('value', parseFloat(response.data?.Price));
                        $("#qty").dxNumberBox('instance').option('value', response.data.QTY);
                        // $("#rate").dxNumberBox('instance').option('value',parseFloat(response.data?.Cost));
                    }
                }
            });
        }

        function load_opd_service() {
            $.ajax({
                url: "<?php echo e(route('load_opd_service')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    opd_service = response.data
                    $('#opd_service').dxSelectBox("instance").option("dataSource", opd_service);
                }
            })
        }

        function load_service_details() {
            let service = $('#opd_service').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_service_details')); ?>",
                method: "POST",
                "data": {
                    "service_id": service.ID,
                },
                success: function(response) {
                    console.log(response.data);
                    if (response.data == null) {
                        $("#serv_price").dxNumberBox('instance').option('value', parseFloat(0));
                    } else {
                        $("#serv_price").dxNumberBox('instance').option('value', parseFloat(response.data
                            ?.Price));
                    }
                }
            });
        }

        $("#btn_history").on('click', function() {

            let appointment_id = $("#appointment_id").val();

            $.post('<?php echo e(route('load_history_data')); ?>', {
                    "appointment_id": appointment_id
                },
                function(res) {
                    ds_result_view = [];
                    ds_pres_view = [];

                    //----------------PRESCRIPTION---------------
                    $.each(res.pres_body, function(k, v) {
                        ds_pres_view.push({
                            "ID": v.Id,
                            "Name": v.item.Pharma_name,
                            "Dose": v.Dose,
                            "Freq": v.Freq,
                            "Period": v.Period,
                            "Date": v.Date
                        });
                    });
                    $("#grid_prescription").dxDataGrid("instance").option("dataSource", ds_pres_view);


                    //----------------NOTE---------------
                    var template = ``;
                    $("#note-view").empty()
                    $.each(res.note_body, function(k, v) {
                        template += `<div class="col-6">
                                    <div class="card border card-border-info">
                                        <div class="card-header">
                                            <span class="float-end">${v.Narration}</span>
                                            <h6 class="card-title mb-0">${v.Type}</h6>
                                        </div>
                                        <div class="card-body">
                                            <p class="card-text">${v.Description}</p>
                                        </div>
                                    </div>
                                </div>`;

                    })
                    $("#note-view").append(template)

                    //----------------INVESTIGATION---------------
                    $.each(res.investigation, function(k, v) {
                        ds_result_view.push({
                            "ID": v.Id,
                            "Investigation": v.Ix,
                            "Date": v.Date
                        });
                    });
                    $("#grid_result_view").dxDataGrid("instance").option("dataSource", ds_result_view);

                });

            $("#view_history_modal").modal("show");
        });

        var otable_note = $("#otable_note").DataTable({

            columns: [{
                    data: 'Id',
                    name: 'Id',
                },
                {
                    data: 'Description',
                    name: 'Description',
                },
                {
                    data: 'head.Date',
                    name: 'head.Date',
                },
            ],
            order: [
                [0, 'desc']
            ],
        });

        var otable_investigation = $("#otable_investigation").DataTable({

            columns: [{
                    data: 'Id',
                    name: 'Id',
                },
                {
                    data: 'head.Date',
                    name: 'head.Date',
                },
                {
                    data: 'Narration',
                    name: 'Narration',
                },
                {
                    data: 'Results',
                    name: 'Results',
                },
            ],
            order: [
                [0, 'desc']
            ],
        });


        var dataGrid_prescription = $('#grid_add_prescription').dxDataGrid({
            dataSource: ds_pres,
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
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                // {
                //     dataField: 'Lot_Id',
                //     caption: 'LOT',
                //     width: 50,
                //     allowEditing: false,
                // },
                {
                    dataField: 'Name',
                    caption: 'NAME',
                    allowEditing: false,
                    width: 300,
                },
                {
                    dataField: 'Dose',
                    caption: 'DOSE',
                    allowEditing: true,
                },
                {
                    dataField: 'Period',
                    caption: 'PERIOD',
                    allowEditing: true,
                },
                {
                    dataField: 'Freq',
                    caption: 'FREQUENCY',
                    allowEditing: false,
                },
                {
                    dataField: 'Unit',
                    caption: 'UNIT',
                    allowEditing: false,
                },
                {
                    dataField: 'Qty',
                    caption: 'QTY',
                    format: '#,##0.000',
                    allowEditing: true,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
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
                let Dose = e.oldData.Dose;
                let Qty = e.oldData.Qty;

                if (e.newData.Dose) {
                    Dose = e.newData.Dose;
                }
                if (e.newData.Qty) {
                    Qty = e.newData.Qty;
                }

                if (e.oldData.status == "exist_data") {
                    e.newData.status = "old_updated";
                }
            },
            onRowUpdated(e) {
                if (e.status == "exist_data") {
                    e.status = "old_updated";

                }
            },
            onRowRemoving(e) {
                // console.log("Deleteing..1");
                // console.log(e.key);
                // console.log("Deleteing..1");
                if (e.key.status === "exist_data") {
                    deleteItems_pres.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_pres.push(e.key);

                }
                // console.log(deleteItems);
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);
                if (e.key.status === "exist_data") {
                    deleteItems_pres.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_pres.push(e.key);

                }

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        var dataGrid_note = $('#grid_add_note').dxDataGrid({
            dataSource: ds_note,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            editing: {
                mode: 'row',
                allowUpdating: false,
                allowDeleting: true,
                allowAdding: true,
            },
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'Category',
                    caption: 'CATEGORY',
                    allowEditing: false,
                    width: 300,
                },
                {
                    dataField: 'Note',
                    caption: 'DESCRIPTION',
                    allowEditing: false,
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
                let Note = e.oldData.Note;

                if (e.newData.Note) {
                    Note = e.newData.Note;
                }


                if (e.oldData.status == "exist_data") {
                    e.newData.status = "old_updated";
                }
            },
            onRowUpdated(e) {
                if (e.status == "exist_data") {
                    e.status = "old_updated";

                }
            },
            onRowRemoving(e) {
                // console.log("Deleteing..1");
                // console.log(e.key);
                // console.log("Deleteing..1");
                if (e.key.status === "exist_data") {
                    deleteItems_note.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_note.push(e.key);

                }
                // console.log(deleteItems);
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);
                if (e.key.status === "exist_data") {
                    deleteItems_note.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_note.push(e.key);

                }

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        var dataGrid_service = $('#grid_add_service').dxDataGrid({
            dataSource: ds_service,
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
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'Name',
                    caption: 'NAME',
                    width: 300,
                    allowEditing: false,
                },
                {
                    dataField: 'Unit_price',
                    caption: 'PRICE',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    allowEditing: true,
                },
                {
                    dataField: 'Qty',
                    caption: 'QTY',
                    format: '#,##0.000',
                    allowEditing: true,
                },
                {
                    dataField: 'Total',
                    caption: 'TOTAL',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
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
                let Qty = e.oldData.Qty;
                let Unit_price = e.oldData.Unit_price;

                if (e.newData.Qty) {
                    Qty = e.newData.Qty;
                }
                if (e.newData.Unit_price) {
                    Unit_price = e.newData.Unit_price;
                }

                if (e.oldData.status == "exist_data") {
                    e.newData.status = "old_updated";
                }

                e.newData.Total = parseFloat(Unit_price) * parseFloat(Qty);
            },
            onRowUpdated(e) {
                if (e.status == "exist_data") {
                    e.status = "old_updated";

                }
            },
            onRowRemoving(e) {
                if (e.key.status === "exist_data") {
                    deleteItems_service.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_service.push(e.key);

                }
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);
                if (e.key.status === "exist_data") {
                    deleteItems_service.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_service.push(e.key);

                }

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        var dataGrid_order = $('#grid_add_order').dxDataGrid({
            dataSource: ds_order,
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
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                    // validationRules: [{
                    //     type: 'required'
                    // }],
                },
                {
                    dataField: 'Type',
                    caption: 'INVESTIGATION TYPE',
                    allowEditing: true,
                    width: 300,
                },
                {
                    dataField: 'Narrarion',
                    caption: 'NARRATION',
                    allowEditing: true,
                },
                {
                    dataField: 'Speciman',
                    caption: 'SPECIMAN',
                    allowEditing: true,
                },

            ],

            toolbar: {
                items: [

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
                let Type = e.oldData.Type;
                let Narrarion = e.oldData.Narrarion;
                let Speciman = e.oldData.Speciman;

                if (e.newData.Type) {
                    Type = e.newData.Type;
                }
                if (e.newData.Narrarion) {
                    Narrarion = e.newData.Narrarion;
                }
                if (e.newData.Speciman) {
                    Speciman = e.newData.Speciman;
                }

                if (e.oldData.status == "exist_data") {
                    e.newData.status = "old_updated";
                }
            },
            onRowUpdated(e) {
                if (e.status == "exist_data") {
                    e.status = "old_updated";

                }
            },
            onRowRemoving(e) {
                if (e.key.status === "exist_data") {
                    deleteItems_order.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_order.push(e.key);

                }
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);
                if (e.key.status === "exist_data") {
                    deleteItems_order.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_pres.push(e.key);

                }

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        var dataGrid_result = $('#grid_add_result').dxDataGrid({
            dataSource: ds_result,
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
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                },
                {
                    dataField: 'Narration',
                    caption: 'NARRATION',
                    allowEditing: true,
                    width: 300,
                },
                {
                    dataField: 'Result',
                    caption: 'RESULT',
                    allowEditing: true,
                },
                {
                    dataField: 'Range',
                    caption: 'NORMAL RANGE',
                    allowEditing: true,
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
                let Result = e.oldData.Result;
                let Narrarion = e.oldData.Narrarion;
                let Range = e.oldData.Range;

                if (e.newData.Result) {
                    Result = e.newData.Result;
                }
                if (e.newData.Narrarion) {
                    Narrarion = e.newData.Narrarion;
                }
                if (e.newData.Range) {
                    Range = e.newData.Range;
                }

                if (e.oldData.status == "exist_data") {
                    e.newData.status = "old_updated";
                }
            },
            onRowUpdated(e) {
                if (e.status == "exist_data") {
                    e.status = "old_updated";

                }
            },
            onRowRemoving(e) {
                if (e.key.status === "exist_data") {
                    deleteItems_result.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_result.push(e.key);

                }
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);
                if (e.key.status === "exist_data") {
                    deleteItems_result.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems_result.push(e.key);

                }

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');


        //--------HISTORY VIEW GRIDS------------
        var dataGrid_prescription_view = $('#grid_prescription').dxDataGrid({
            dataSource: ds_pres_view,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                },
                {
                    dataField: 'Name',
                    caption: 'NAME',
                    allowEditing: false,
                    width: 300,
                },
                {
                    dataField: 'Dose',
                    caption: 'DOSE',
                    allowEditing: false,
                },
                {
                    dataField: 'Freq',
                    caption: 'FREQUENCY',
                    allowEditing: false,
                },
                {
                    dataField: 'Period',
                    caption: 'PERIOD',
                    allowEditing: false,
                },
                {
                    dataField: 'Date',
                    caption: 'ISSUE DATE',
                    allowEditing: false,
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

            },
            onRowUpdated(e) {

            },
            onRowRemoving(e) {
                // console.log("Deleteing..1");
                // console.log(e.key);
                // console.log("Deleteing..1");

                // console.log(deleteItems);
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        var result_ID = [];

        var dataGrid_result_view = $('#grid_result_view').dxDataGrid({
            dataSource: ds_result_view,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            selection: {
                // mode: 'multiple',
                mode: 'single',
            },
            // editing: {
            //     mode: 'row',
            //     allowUpdating: true,
            //     allowDeleting: true,
            //     allowAdding: true,
            // },
            // filterRow: {
            //     visible: true
            // },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                },
                {
                    dataField: 'Date',
                    caption: 'DATE',
                    allowEditing: true,
                    width: 300,
                },
                {
                    dataField: 'Investigation',
                    caption: 'INVESTIGATION',
                    allowEditing: true,
                },

            ],

            toolbar: {
                items: [

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

            },
            onRowUpdated(e) {

            },
            onRowRemoving(e) {

            },
            onRowRemoved(e) {

            },
            onSaved(e) {
                console.log(e);
            },
            onRowClick: function(e) {
                console.log(e.data);
                result_ID = e.data.ID;

                view_result_body();
            }

        }).dxDataGrid('instance');

        var dataGrid_result_body = $('#grid_view_resultBody').dxDataGrid({
            dataSource: ds_result_Bodyview,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
            },
            columns: [{
                    dataField: 'ID',
                    caption: 'ID',
                    width: 50,
                    allowEditing: false,
                },
                {
                    dataField: 'Narration',
                    caption: 'NARRATION',
                    allowEditing: true,
                    width: 300,
                },
                {
                    dataField: 'Result',
                    caption: 'RESULT',
                    allowEditing: true,
                },
                {
                    dataField: 'Range',
                    caption: 'RANGE',
                    allowEditing: true,
                },

            ],

            toolbar: {
                items: [

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

            },
            onRowUpdated(e) {

            },
            onRowRemoving(e) {

            },
            onRowRemoved(e) {

            },
            onSaved(e) {
                console.log(e);
            },
            onRowClick: function(e) {
                console.log(e.data);
                result_body = e.data;

                view_result_body();
            }

        }).dxDataGrid('instance');

        function view_result_body() {

            $.post('<?php echo e(route('load_result_bodyHistory')); ?>', {
                "result_ID": result_ID
            },
            function(res) {
                ds_result_Bodyview = [];

                $.each(res.inves_body, function(k, v) {
                    ds_result_Bodyview.push({
                        "ID": v.Id,
                        "Narration": v.Narration,
                        "Result": v.Results,
                        "Range": v.Normal_range
                    });
                });
                $("#grid_view_resultBody").dxDataGrid("instance").option("dataSource", ds_result_Bodyview);


            });
            $("#view_result_modal").modal("show");
        }

        function load_exist_data() {
            selected_appointment = $("#appointment_id").val();

            $.ajax({
                url: "<?php echo e(route('load_exist_appointment_details')); ?>",
                method: "POST",
                "data": {
                    "selected_appointment": selected_appointment,
                },
                success: function(response) {

                    ds_pres = [];
                    ds_note = [];
                    ds_service = [];
                    ds_order = [];

                    console.log(response);

                    //PRESCRIPTION
                    $.each(response.pres_body, function(k, v) {
                        ds_pres.push({
                            "ID": v.Id,
                            "Lot_Id": v.Lot_Id,
                            "Name": v.item.Pharma_name,
                            "Dose": v.Dose,
                            "Period": v.Period,
                            "Freq": v.Freq,
                            "Unit": v.Unit,
                            "Qty": v.Qty,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_prescription").dxDataGrid("instance").option("dataSource", ds_pres);
                    //CLINICAL NOTE
                    $.each(response.note_body, function(k, v) {
                        ds_note.push({
                            "Category": v.Type,
                            "Note": v.Description,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_note").dxDataGrid("instance").option("dataSource", ds_note);

                    //INVESTIGATION ORDER
                    $.each(response.inves_order, function(k, v) {
                        ds_order.push({
                            "ID": v.Id,
                            "Type": v.Ix_type,
                            "Narrarion": v.Narrations,
                            "Speciman": v.Speciman,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_order").dxDataGrid("instance").option("dataSource", ds_order);

                    //OPD SERVICE
                    $.each(response.opd_service, function(k, v) {
                        ds_service.push({
                            "ID": v.StockServiceID,
                            "Name": v.Description,
                            "Unit_price": v.Unit_Price,
                            "Qty": v.Qty,
                            "Total": v.Total,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_service").dxDataGrid("instance").option("dataSource", ds_service);
                }
            });
        }

        $("#btn_add").on('click', function() {
            selected_appointment = $("#appointment_id").val();

            $.ajax({
                url: "<?php echo e(route('load_exist_appointment_details')); ?>",
                method: "POST",
                "data": {
                    "selected_appointment": selected_appointment,
                },
                success: function(response) {

                    ds_pres = [];
                    ds_note = [];
                    ds_service = [];
                    ds_order = [];

                    console.log(response);

                    //PRESCRIPTION
                    $.each(response.pres_body, function(k, v) {
                        ds_pres.push({
                            "ID": v.Id,
                            "Lot_Id": v.Lot_Id,
                            "Name": v.item.Pharma_name,
                            "Dose": v.Dose,
                            "Period": v.Period,
                            "Freq": v.Freq,
                            "Unit": v.Unit,
                            "Qty": v.Qty,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_prescription").dxDataGrid("instance").option("dataSource", ds_pres);

                    //CLINICAL NOTE
                    $.each(response.note_body, function(k, v) {
                        ds_note.push({
                            "Category": v.Type,
                            "Note": v.Description,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_note").dxDataGrid("instance").option("dataSource", ds_note);

                    //INVESTIGATION ORDER
                    $.each(response.inves_order, function(k, v) {
                        ds_order.push({
                            "ID": v.Id,
                            "Type": v.Ix_type,
                            "Narrarion": v.Narrations,
                            "Speciman": v.Speciman,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_order").dxDataGrid("instance").option("dataSource", ds_order);

                    //OPD SERVICE
                    $.each(response.opd_service, function(k, v) {
                        ds_service.push({
                            "ID": v.StockServiceID,
                            "Name": v.Description,
                            "Unit_price": v.Unit_Price,
                            "Qty": v.Qty,
                            "Total": v.Total,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_service").dxDataGrid("instance").option("dataSource", ds_service);
                }
            });
            $("#add_item_modal").modal("show");
        });

        function load_inves_order() {
            selected_appointment = $("#appointment_id").val();

            $.ajax({
                url: "<?php echo e(route('load_exist_appointment_details')); ?>",
                method: "POST",
                "data": {
                    "selected_appointment": selected_appointment,
                },
                success: function(response) {

                    ds_order = [];

                    console.log(response);

                    //INVESTIGATION ORDER
                    $.each(response.inves_order, function(k, v) {
                        ds_order.push({
                            "ID": v.Id,
                            "Type": v.Ix_type,
                            "Narrarion": v.Narrations,
                            "Speciman": v.Speciman,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_order").dxDataGrid("instance").option("dataSource", ds_order);
                }
            });
        }

        function load_result() {
            selected_appointment = $("#appointment_id").val();

            $.ajax({
                url: "<?php echo e(route('load_exist_appointment_details')); ?>",
                method: "POST",
                "data": {
                    "selected_appointment": selected_appointment,
                },
                success: function(response) {

                    ds_order = [];

                    console.log(response);

                    //INVESTIGATION RESULT
                    $.each(response.inves_body, function(k, v) {
                        ds_result.push({
                            "ID": v.Id,
                            "Narration": v.Narration,
                            "Result": v.Results,
                            "Range": v.Normal_range,
                            "status": "exist_data",
                        });
                    });
                    $("#grid_add_result").dxDataGrid("instance").option("dataSource", ds_result);
                }
            });
        }

        $("#btn_add_prescription").on('click', function() {
            $("#add_new_prescription_modal").modal("show");
        });

        function add_prescription() {
            let item = $('#item').dxSelectBox("instance").option("value");
            let item_id = item.ID;
            let item_name = item.Pharma_name;
            // let lot = $('#lot').dxSelectBox("instance").option("value");
            // let lot_id = lot.ID;

            let dose = $("#dose").dxNumberBox('instance').option('value');
            let unit = $('#unit').dxSelectBox("instance").option("value");
            let unit_name = unit.Name;

            let frequency = $('#frequency').dxSelectBox("instance").option("value");
            let frequency_name = frequency.Freq_Name;

            let period = $("#period").dxNumberBox('instance').option('value');
            let dose_qty = $("#dose_qty").dxNumberBox('instance').option('value');

            if (item == null) {
                toastr.error("Item Required");
            } else if (dose_qty == 0) {
                toastr.error("Dose Quentity Required");
            }

            let data = {
                "ID": item_id,
                // "Lot_Id": lot_id,
                "Name": item_name,
                "Dose": dose,
                "Period": period,
                "Freq": frequency_name,
                "Unit": unit_name,
                "Qty": dose_qty,
                "status": "new_add",
            };

            var dataSource = dataGrid_prescription.getDataSource();

            dataSource.store().insert(data).then(function() {
                dataSource.reload();
            })
            $("#add_new_prescription_modal").modal("hide");

            reset_elements();

        };

        function reset_elements() {
            $('#item').dxSelectBox("instance").option("value", '');
            // $('#lot').dxSelectBox("instance").option("value", '');

            $("#dose").dxNumberBox('instance').option('value', 0);
            $('#unit').dxSelectBox("instance").option("value", '');
            $('#frequency').dxSelectBox("instance").option("value", '');
            $("#period").dxNumberBox('instance').option('value', 0);
            $("#dose_qty").dxNumberBox('instance').option('value', 0);
        }

        function save_prescription() {
            let app_id = selected_appointment;
            // console.log(app_id);
            let body_data = JSON.stringify(ds_pres);

            let data = {
                "app_id": app_id,
                "body_data": body_data,
                "deleted_items": JSON.stringify(deleteItems_pres)
            }

            //get image
            var formData = new FormData();
            for (var key in data) {
                formData.append(key, data[key]);
            }

            if ($("#pres_image")[0].files[0]) {
                console.log("select");
                formData.append('pres_image', $("#pres_image")[0].files[0]);
            } else {
                formData.append('pres_image', 'not');
            }

            $("#btn_save_prescription").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_prescription')); ?>",
                "method": "POST",
                "data": formData,
                processData: false,
                contentType: false,
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Prescription Added Successfully");
                        $("#pres_image").val('');
                        load_exist_data();

                        $("#btn_save_prescription").attr("disabled", false);

                    } else {
                        toastr.error(response.message);
                        $("#btn_save_prescription").attr("disabled", false);
                    }
                },
            });
        }

        $("#btn_add_note").on('click', function() {
            $("#add_new_note_modal").modal("show");
        });

        function add_note() {
            let category = $('#note_category').dxSelectBox("instance").option("value");
            let note = $("#note_body").val();

            if (category == null) {
                toastr.error("Category Required");
            } else if (note == '') {
                toastr.error("Note Required");
            }

            let data = {
                "Category": category,
                "Note": note,
                "status": "new_add",
            };

            var dataSource = dataGrid_note.getDataSource();

            dataSource.store().insert(data).then(function() {
                dataSource.reload();
            })
            $("#add_new_note_modal").modal("hide");

            reset_note();
        };

        function reset_note() {
            $('#note_category').dxSelectBox("instance").option("value", '');
            $("#note_body").val('');
        };

        function save_note() {
            let app_id = selected_appointment;
            let body_data = JSON.stringify(ds_note);

            $("#btn_save_note").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_clinical_note')); ?>",
                "method": "POST",
                "data": {
                    "app_id": app_id,
                    "body_data": body_data,
                    "deleted_items": JSON.stringify(deleteItems_note),
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Note Added Successfully");
                        load_exist_data();
                        $("#btn_save_note").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_note").attr("disabled", false);
                    }
                },
            });
        }

        $("#btn_add_service").on('click', function() {
            $("#add_new_service_modal").modal("show");
        });

        function add_service() {
            let service = $('#opd_service').dxSelectBox("instance").option("value");
            let service_id = service.ID;
            let service_name = service.Name;

            let price = $("#serv_price").dxNumberBox('instance').option('value');
            let qty = $("#serv_qty").dxNumberBox('instance').option('value');
            let total = $("#serv_total").dxNumberBox('instance').option('value');

            if (qty == 0) {
                toastr.error("Service Quentity Required");
            } else {
                let data = {
                    "ID": service_id,
                    "Name": service_name,
                    "Unit_price": price,
                    "Qty": qty,
                    "Total": total,
                    "status": "new_add",
                };

                var dataSource = dataGrid_service.getDataSource();

                dataSource.store().insert(data).then(function() {
                    dataSource.reload();
                })
                $("#add_new_service_modal").modal("hide");

                reset_service();
            }

        }

        function reset_service() {
            $('#opd_service').dxSelectBox("instance").option("value", '');
            $("#serv_price").dxNumberBox('instance').option('value', 0);
            $("#serv_qty").dxNumberBox('instance').option('value', 0);
            $("#serv_total").dxNumberBox('instance').option('value', 0);
        }

        $("#btn_save_cons_fee").on('click', function() {
            let cons_fee = $("#cons_fee").dxNumberBox('instance').option('value');

            if (cons_fee == 0) {
                toastr.error("Consultant Fee Required");
            }

            let data = {
                "ID": 0,
                "Name": "Consultant Fee",
                "Unit_price": cons_fee,
                "Qty": 1,
                "Total": cons_fee
            };

            var dataSource = dataGrid_service.getDataSource();

            dataSource.store().insert(data).then(function() {
                dataSource.reload();
            })

        });

        function save_service() {
            let app_id = selected_appointment;
            let body_data = JSON.stringify(ds_service);

            $("#btn_save_service").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_opd_service_appointment')); ?>",
                "method": "POST",
                "data": {
                    "app_id": app_id,
                    "body_data": body_data,
                    "deleted_items": JSON.stringify(deleteItems_service),
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Service Added Successfully");
                        load_exist_data();
                        $("#btn_save_service").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_service").attr("disabled", false);
                    }
                },
            });
        }

        $("#btn_add_order").on('click', function() {
            $("#add_new_order_modal").modal("show");
        });

        function add_order() {

            let type = $("#inves_type").val();
            let narration = $("#inves_narra").val();
            let speciman = $("#inves_speciman").val();

            if (type == "") {
                toastr.error("Investigation Type Required");
            } else if (narration == "") {
                toastr.error("Investigation Narration Required");
            } else if (speciman == "") {
                toastr.error("Investigation Speciman Required");
            }

            let data = {
                "ID": null,
                "Type": type,
                "Narrarion": narration,
                "Speciman": speciman,
                "status": "new_add",
            };

            var dataSource = dataGrid_order.getDataSource();

            dataSource.store().insert(data).then(function() {
                dataSource.reload();
            })
            $("#add_new_order_modal").modal("hide");

            clear_order_form();
        }

        function clear_order_form() {
            $("#inves_type").val('');
            $("#inves_narra").val('');
            $("#inves_speciman").val('');
        }

        function save_order() {
            let app_id = selected_appointment;
            let body_data = JSON.stringify(ds_order);

            $("#btn_save_order").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_invest_order')); ?>",
                "method": "POST",
                "data": {
                    "app_id": app_id,
                    "body_data": body_data,
                    "deleted_items": JSON.stringify(deleteItems_order),
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Order Added Successfully");
                        load_inves_order();
                        // load_exist_data();
                        $("#btn_save_order").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_order").attr("disabled", false);
                    }
                },
            });
        }

        function add_result_grid() {
            let narration = $("#result_narration").val();
            let result = $("#result_result").val();
            let range = $("#result_range").val();

            if (narration == "") {
                toastr.error("Investigation Narration Required");
            } else if (result == "") {
                toastr.error("Investigation Result Required");
            } else if (range == "") {
                toastr.error("Investigation Result Required");
            }

            let data = {
                "ID": null,
                "Narration": narration,
                "Result": result,
                "Range": range,
                "status": "new_add",
            };

            var dataSource = dataGrid_result.getDataSource();

            dataSource.store().insert(data).then(function() {
                dataSource.reload();
            })
            clear_form();
        }

        function clear_form() {
            $("#result_narration").val('');
            $("#result_result").val('');
            $("#result_range").val('');
        }

        function save_result() {
            let app_id = selected_appointment;
            let body_data = JSON.stringify(ds_result);

            let type = $("#result_type").val();
            let mlt = $("#result_mlt").val();
            let date = $("#result_date").dxDateBox('instance').option('value');

            // console.log(body_data);

            if (type == "") {
                toastr.error("Investigation Type Required");
            } else if (mlt == "") {
                toastr.error("Investigation MLT Required");
            }

            $("#btn_save_result").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('save_invest_result')); ?>",
                "method": "POST",
                "data": {
                    "app_id": app_id,
                    "body_data": body_data,
                    "type": type,
                    "mlt": mlt,
                    "date": date,
                    "deleted_items": JSON.stringify(deleteItems_result),
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Result Added Successfully");
                        clear_result();
                        $("#btn_save_result").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_save_result").attr("disabled", false);
                    }
                },
            });
        }

        function clear_result() {
            $("#result_type").val('');
            $("#result_mlt").val('');
        }

        $("#btn_record").on('click', function() {
            let appointment_id = $("#appointment_id").val();
            // console.log(appointment_id);
            $("#app_id").val(appointment_id);
            $("#ask_record_modal").modal("show");
        });

        function record() {
            let appointment_id = $("#app_id").val();
            let que_id = $("#que_id").val();

            $("#btn_record").attr("disabled", true);

            $.ajax({
                "url": "<?php echo e(route('record_appointment')); ?>",
                "method": "POST",
                "data": {
                    "appointment_id": appointment_id,
                    "que_id": que_id
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Appointment Record Successfully");
                        $("#ask_record_modal").modal("hide");
                        $("#app_id").val('');
                        $("#btn_record").attr("disabled", false);

                        $("#btn_add").attr("hidden", true);
                        $("#btn_record").attr("hidden", true);

                        location.href = '/load_appointment_page';
                        // window.location.href = '/appointment/appointment/new_appointment';
                    } else {
                        toastr.error(response.message);
                        $("#btn_record").attr("disabled", false);
                    }
                },
            });
        }


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/appointment/appointment/select_app.blade.php ENDPATH**/ ?>