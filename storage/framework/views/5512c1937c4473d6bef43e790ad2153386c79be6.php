
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
                    <div class="row g-2">
                        <input type="hidden" class="form-control" id="appointment_id" value="<?php echo e($appointment->ID); ?>">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Appointment ID:</label>
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
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Invoice Date:</label>
                                <div class="col-sm-9">
                                    <div id="invoice_date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-4 col-form-label">View Prescription :</label>
                                <div class="col-sm-8 d-grid">
                                    <button id="btn_view" onclick="view_pres()" class="btn btn-md btn-info">View</button>
                                </div>
                            </div>
                        </div>

                        <div id="grid_container" class="dx-header-row mt-3"></div>

                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Total :</label>
                                <div class="col-sm-8">
                                    <div id="final_total" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Discount :</label>
                                <div class="col-sm-8">
                                    <div id="final_discount" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Gross :</label>
                                <div class="col-sm-8">
                                    <div id="final_gross" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-3 d-grid text-right">
                            <button class="btn rounded-pill btn-md btn-dark waves-effect waves-light"
                                onclick="history.back();">Back</button>
                        </div>
                        
                        <div class="col-md-6 mt-3 d-grid text-right">
                            <button id="btn_invoice"
                                class="btn rounded-pill btn-md btn-success waves-effect waves-light">Invoice</button>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <!-- payment_ask_modal -->
    <div id="payment_ask_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Pay Bill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row mb-1 pb-1 px-0 " style="background-color: #3b3b3b;">
                        <div class="col-md-4">
                            <div class="form-group my-0 ">
                                <label for="exampleInputEmail1"
                                    class="mb-0 col-form-label col-form-label my-0 py-0 text-light">GROSS</label>
                                <div id="pay_total" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="mb-0 col-form-label col-form-label my-0 py-0 text-light">PAID</label>
                                <div id="pay_paid" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="mb-0 col-form-label col-form-label my-0 py-0 text-light">BALANCE</label>
                                <div id="pay_balance" class="form-control"></div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0 mb-1">
                    
                    <div class="row cash_mode my-0">
                        <div class="col-md-12 my-0">
                            <p class="my-0"><b><u>CASH</u></b></p>
                        </div>
                    </div>
                    <div class="row cash_mode">
                        <div class="col-md-3 ">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="mb-0 col-form-label col-form-label my-0 py-0 ">Account</label>
                                <div id="pay_account" class="form-control"></div>
                            </div>
                        </div>

                        <div class="col-md-3 my-0">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="mb-0 col-form-label col-form-label my-0 py-0 ">Amount</label>
                                <div id="pay_cash_amount" class="form-control"></div>
                            </div>
                        </div>

                    </div>
                    <hr class="mt-1 mb-1">
                    
                    <div class="row cash_mode my-0">
                        <div class="col-md-12 my-0">
                            <p class="my-0"><b><u>CARD</u></b></p>
                        </div>
                    </div>
                    <div class="row card_mode">
                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="col-form-label col-form-label my-0 py-0 ">No</label>
                                <div id="card_no" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="col-form-label col-form-label my-0 py-0 ">Type</label>
                                <div id="card_type" class="form-control"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="col-form-label col-form-label my-0 py-0 ">Institute</label>
                                <div id="card_institute" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="col-form-label col-form-label my-0 py-0 ">Amount</label>
                                <div id="pay_card_amount" class="form-control"></div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-1 mb-1">
                    
                    <div class="row cash_mode my-0">
                        <div class="col-md-12 my-0">
                            <p class="my-0"><b><u>CHEQUE</u></b></p>
                        </div>
                    </div>
                    <div class="row chq_mode">
                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1" class="col-form-label col-form-label my-0 py-0 ">Cheque
                                    No</label>
                                <div id="pay_chq_no" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="col-form-label col-form-label my-0 py-0 ">Date</label>
                                <div id="pay_chq_date" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="col-form-label col-form-label my-0 py-0 ">Bank</label>
                                <div id="pay_chq_bank" class="form-control bank"></div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class=" col-form-label col-form-label my-0 py-0 ">Amount</label>
                                <div id="pay_chq_amount" class="form-control"></div>
                            </div>
                        </div>

                    </div>

                    <hr class="mt-1 mb-1">
                    
                    <div class="row cash_mode my-0">
                        <div class="col-md-12 my-0 ">
                            <p class="my-0"><b><u>CREDIT</u></b></p>
                        </div>
                    </div>
                    <div class="row acc_mode my-0">
                        <div class="col-md-3 my-0">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class=" col-form-label col-form-label my-0 py-0 ">Account</label>
                                <div id="debtor_acc_list" class="form-control"></div>
                            </div>
                        </div>

                        <div class="col-md-3 my-0">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="mb-0 col-form-label col-form-label my-0 py-0 ">Account ID</label>
                                <div id="pay_credit_acc_code" class="form-control"></div>
                            </div>
                        </div>
                        <div class="col-md-3 my-0">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="mb-0 col-form-label col-form-label my-0 py-0 ">Amount</label>
                                <div id="pay_credit_amount" class="form-control"></div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-1 mb-1">
                    <div class="row cash_mode my-0">
                        <div class="col-md-12 my-0">
                            <p class="my-0"><b><u>BANK DEPOSIT</u></b></p>
                        </div>
                    </div>

                    <div class="row bank_mode my-0 py-0">
                        <div class="col-md-3 my-0">
                            <div class="form-group">
                                <label for="exampleInputEmail1"
                                    class="col-form-label col-form-label my-0 py-0 ">Branch</label>
                                <div id="branch_bank" class="form-control branch"></div>
                            </div>
                        </div>
                        <div class="col-md-3 my-0">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class=" col-form-label col-form-label my-0 py-0 ">Deposit
                                    Date</label>
                                <div id="deposit_date" class="form-control branch"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group my-0">
                                <label for="exampleInputEmail1"
                                    class="mb-0 col-form-label col-form-label my-0 py-0 ">Amount</label>
                                <div id="pay_bank_tranfer_amount" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_pay_invoice" onclick="pay_invoice()"
                        class="btn btn-success">Submit</button>
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
                    <input type="hidden" class="form-control" id="invoice_number">

                    <p>Do you want to print this Invoice ?</p>
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Print Size :</label>
                                <div class="col-sm-9">
                                    <select id="print_size" class="form-select mb-3" aria-label="Default select example">
                                        <option selected>Select Print Size..</option>
                                        <option value="A4">A4 Size - Normal</option>
                                        <option value="A5">A5 Size - Small(Half of A4)</option>
                                        <option selected value="Epson">EPSON</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_print_invoice" onclick="print_invoice()"
                        class="btn btn-success">Print</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- update_outlet_modal -->
    <div id="prescription_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Appointment Prescription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="appointment_id">
                    <div class="row g-2">
                        <table id="otable_pres" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Dose</th>
                                    <th>Freq</th>
                                    <th>Preiod</th>
                                    <th>Qty</th>
                                    <th>Qty taken</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- select_lot_modal -->
    <div id="select_lot_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">Select Lot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="item_name" placeholder="Enter name" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Required Qty :</label>
                                <div class="col-sm-8">
                                    <div id="req_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 ps-3 col-form-label">Lot :</label>
                                <div class="col-sm-10">
                                    <div id="lot" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Price :</label>
                                <div class="col-sm-8">
                                    <div id="price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-3 col-form-label">Avb.Qty :</label>
                                <div class="col-sm-8">
                                    <div id="avb_qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-6 ps-4 col-form-label">Qty to Take</label>
                                <div class="col-sm-6">
                                    <div id="qty_take" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_add_to_cart" onclick="add_to_cart()"
                        class="btn btn-success">Add To Cart</button>
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

    
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

    <script>
        var myData = {};

        var ds = [];
        var branch = [];
        var deleteItems = [];
        var lot = [];
        // var ds1 = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // load_app_data();
        load_ajax_app_data();
        load_lot();

        $("#req_qty").dxNumberBox({
            format: '#,##0.##',
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#qty_take").dxNumberBox({
            format: '#,##0.##',
            valueChangeEvent: "keyup",
        });
        $("#avb_qty").dxNumberBox({
            format: '#,##0.##',
            valueChangeEvent: "keyup",
            readOnly:true,
        });

        $('#lot').dxSelectBox({
            dataSource: lot,
            displayExpr: 'Exp_date',
            // valueExpr: 'ID',
            itemTemplate: function(data) {
                return "QTY - "+data.QTY + " - " + "LKR. "+data.Price + " - " + "EXP : "+data.Exp_date;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Exp_date", "Price"],
            onValueChanged: function(e) {
                load_lot_price(e);
            },

        });
        $("#price").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });


        $('#invoice_date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
        });
        $('#Invoice_type').dxSelectBox({
            items: ['Cash', "Credit", "Bank Card"],
        });
        $("#final_total").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
            onValueChanged: function(e) {
                let discount = $("#final_discount").dxNumberBox('instance').option('value');
                let total = e.value;
                let dis_val = total * discount;

                let gross = total - dis_val;
                $("#final_gross").dxNumberBox('instance').option('value', gross);

            },
        });
        $("#final_gross").dxNumberBox({
            format: 'LKR #,##0.00',
            value: 0,
            valueChangeEvent: "keyup",
            readOnly: true,
        });
        $("#final_discount").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let net = $("#final_total").dxNumberBox('instance').option('value');
                let discount = e.value;
                let dis_val = net * discount;

                let gross = net - dis_val;
                $("#final_gross").dxNumberBox('instance').option('value', gross);

            },
        });
        load_debtor_accounts();
        load_banks();
        load_cash_ledgers_to_select_box();

        $("#pay_amount").dxNumberBox({
            format: 'LKR #,##0.##',
            readOnly: true,
            value: 0,
        });

        $("#pay_advance").dxNumberBox({
            format: 'LKR #,##0.##',
            readOnly: true,
            value: 0,
        });
        $("#pay_total").dxNumberBox({
            format: 'LKR #,##0.##',
            readOnly: true,
            value: 0,
        });
        $("#pay_paid").dxNumberBox({
            format: 'LKR #,##0.##',
            readOnly: true,
            value: 0,
        });

        $("#pay_balance").dxNumberBox({
            format: 'LKR #,##0.##',
            readOnly: true,
            value: 0,
        });
        $("#pay_card_amount").dxNumberBox({
            format: 'LKR #,##0.##',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let paid_amt = 0;
                let amt = $("#pay_total").dxNumberBox('instance').option('value');
                let cash_amt = $("#pay_cash_amount").dxNumberBox('instance').option('value');
                let pay_credit_amt = $("#pay_credit_amount").dxNumberBox('instance').option('value');
                let card_amt = e.value;
                let cheque_amt = $("#pay_chq_amount").dxNumberBox('instance').option('value');
                let bank_amt = $("#pay_bank_tranfer_amount").dxNumberBox('instance').option('value');

                let balance = 0
                paid_amt = cash_amt + pay_credit_amt + card_amt + cheque_amt + bank_amt;
                balance = amt - paid_amt;

                if (balance < 0) {
                    $("#pay_balance").dxNumberBox('instance').option('value', balance * (-1))
                } else {
                    $("#pay_balance").dxNumberBox('instance').option('value', balance)
                }
                $("#pay_paid").dxNumberBox('instance').option('value', paid_amt)

            }
        });

        $("#card_type").dxSelectBox({
            dataSource: ["Visa", "Master", "Amex", "Other"],
            value: "Visa",
        });

        $("#card_no").dxTextBox({});

        $("#card_institute").dxSelectBox({
            dataSource: [
                'Amana Bank',
                "Bank of Ceylon",
                "Cargills Bank",
                "Citibank",
                "Commercial Bank",
                "DFCC",
                "Hatton National Bank",
                "HSBC",
                "HDFC",
                "Regional Development Bank",
                "Nations Trust Bank",
                "National Development Bank",
                "NDB",
                "NSB",
                "Pan Asia Bank",
                "Peoples Bank",
                "Sampth Bank",
                "Sanasa Development Bank",
                "Seylan Bank",
                "Sri Lanka Savings Bank",
                "Standard Chartered Bank",
                "State Mortgage and Investment Bank",
                "Union Bank of Colombo",
                "Other",
            ]
        });

        $("#pay_credit_acc_code").dxTextBox({
            readOnly: true,
        })

        $("#pay_credit_amount").dxNumberBox({
            format: 'LKR #,##0.##',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let paid_amt = 0;

                let amt = $("#pay_total").dxNumberBox('instance').option('value');

                let cash_amt = $("#pay_cash_amount").dxNumberBox('instance').option('value');
                let pay_credit_amt = e.value;
                let card_amt = $("#pay_card_amount").dxNumberBox('instance').option('value');
                let cheque_amt = $("#pay_chq_amount").dxNumberBox('instance').option('value');
                let bank_amt = $("#pay_bank_tranfer_amount").dxNumberBox('instance').option('value');


                let balance = 0
                paid_amt = cash_amt + pay_credit_amt + card_amt + cheque_amt + bank_amt;
                balance = amt - paid_amt;
                $("#pay_paid").dxNumberBox('instance').option('value', paid_amt)
                $("#pay_balance").dxNumberBox('instance').option('value', balance)

            }
        });

        $("#pay_cash_amount").dxNumberBox({
            format: 'LKR #,##0.##',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let paid_amt = 0;
                let amt = $("#pay_total").dxNumberBox('instance').option('value');
                let cash_amt = e.value;
                let pay_credit_amt = $("#pay_credit_amount").dxNumberBox('instance').option('value');
                let card_amt = $("#pay_card_amount").dxNumberBox('instance').option('value');
                let cheque_amt = $("#pay_chq_amount").dxNumberBox('instance').option('value');
                let bank_amt = $("#pay_bank_tranfer_amount").dxNumberBox('instance').option('value');


                let balance = 0
                paid_amt = cash_amt + pay_credit_amt + card_amt + cheque_amt + bank_amt;
                balance = amt - paid_amt;

                if (balance < 0) {
                    $("#pay_balance").dxNumberBox('instance').option('value', balance * (-1))
                } else {
                    $("#pay_balance").dxNumberBox('instance').option('value', balance)
                }
                $("#pay_paid").dxNumberBox('instance').option('value', paid_amt)
            }
        });

        $("#pay_balance").dxNumberBox({
            format: 'LKR #,##0.##',
            value: 0,
        });

        $("#pay_account").dxSelectBox({
            displayExpr: 'Acc',
            valueExpr: 'ID',
            dataSource: [],
            searchEnabled: true,

        });
        $("#pay_bank_tranfer_amount").dxNumberBox({
            format: 'LKR #,##0.##',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let paid_amt = 0;
                let amt = $("#pay_total").dxNumberBox('instance').option('value');
                let cash_amt = $("#pay_cash_amount").dxNumberBox('instance').option('value');
                let pay_credit_amt = $("#pay_credit_amount").dxNumberBox('instance').option('value');
                let card_amt = $("#pay_card_amount").dxNumberBox('instance').option('value');
                let cheque_amt = $("#pay_chq_amount").dxNumberBox('instance').option('value');
                let bank_amt = e.value;


                let balance = 0
                paid_amt = cash_amt + pay_credit_amt + card_amt + cheque_amt + bank_amt;
                balance = amt - paid_amt;
                $("#pay_paid").dxNumberBox('instance').option('value', paid_amt)
                $("#pay_balance").dxNumberBox('instance').option('value', balance)
            }
        });

        $("#branch_bank").dxSelectBox({
            dataSource: branch,
            displayExpr: 'BankCode',
            // valueExpr: 'BankCode',
            searchEnabled: true,
            itemTemplate: function(data) {
                return data.ID + " - " + data.BankCode;
            },
            searchEnabled: true,
            searchExpr: ["ID", "BankCode"],
        });

        $("#debtor_acc_list").dxSelectBox({
            displayExpr: 'Acc',
            valueExpr: 'ID',
            searchEnabled: true,
            itemTemplate: function(data) {
                return data.ID + " - " + data.Acc;
            },
            onValueChanged: function(e) {
                $("#pay_credit_acc_code").dxTextBox("instance").option("value", e.value);
            }
        });

        $("#pay_chq_amount").dxNumberBox({
            format: 'LKR #,##0.##',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let paid_amt = 0;
                let amt = $("#pay_total").dxNumberBox('instance').option('value');
                let cash_amt = $("#pay_cash_amount").dxNumberBox('instance').option('value');
                let pay_credit_amt = $("#pay_credit_amount").dxNumberBox('instance').option('value');
                let card_amt = $("#pay_card_amount").dxNumberBox('instance').option('value');
                let cheque_amt = e.value;
                let bank_amt = $("#pay_bank_tranfer_amount").dxNumberBox('instance').option('value');


                let balance = 0
                paid_amt = cash_amt + pay_credit_amt + card_amt + cheque_amt + bank_amt;
                balance = amt - paid_amt;
                $("#pay_paid").dxNumberBox('instance').option('value', paid_amt)
                $("#pay_balance").dxNumberBox('instance').option('value', balance)
            }
        });

        $("#pay_chq_no").dxTextBox({

        });

        $("#pay_chq_date").dxDateBox({
            displayFormat: 'yyyy-MMM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            dateSerializationFormat: "yyyy-MM-dd",
        });
        $("#deposit_date").dxDateBox({
            displayFormat: 'yyyy-MMM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            dateSerializationFormat: "yyyy-MM-dd",
        });

        $(".bank").dxSelectBox({
            dataSource: [
                'Amana Bank',
                "Bank of Ceylon",
                "Cargills Bank",
                "Citibank",
                "Commercial Bank",
                "DFCC",
                "Hatton National Bank",
                "HSBC",
                "HDFC",
                "Regional Development Bank",
                "Nations Trust Bank",
                "National Development Bank",
                "NDB",
                "NSB",
                "Pan Asia Bank",
                "Peoples Bank",
                "Sampth Bank",
                "Sanasa Development Bank",
                "Seylan Bank",
                "Sri Lanka Savings Bank",
                "Standard Chartered Bank",
                "State Mortgage and Investment Bank",
                "Union Bank of Colombo",
                "Other"
            ]
        });


        $("#inv_date").dxDateBox({
            displayFormat: 'yyyy-MMM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            dateSerializationFormat: "yyyy-MM-dd",
        });

        function load_debtor_accounts() {
            $.ajax({
                "method": "GET",
                "url": "<?php echo e(route('ajax_get_debotor_accs')); ?>",
                "success": function(response) {
                    // $("#branch_acc").dxSelectBox('instance').option('dataSource', response.data);
                    $("#debtor_acc_list").dxSelectBox('instance').option('dataSource', response.data);
                }
            })
        }

        function load_banks() {
            $.ajax({
                "method": "GET",
                "url": "<?php echo e(route('ajax_get_banks')); ?>",
                "success": function(response) {
                    branch = response.data;
                    // $("#branch_acc").dxSelectBox('instance').option('dataSource', response.data);
                    $("#branch_bank").dxSelectBox('instance').option('dataSource', branch);
                }
            })
        }

        function load_cash_ledgers_to_select_box() {
            $.ajax({
                "method": "GET",
                "url": "<?php echo e(route('ajax_get_cash_ledgers')); ?>",
                "success": function(response) {
                    $("#pay_account").dxSelectBox('instance').option('dataSource', response.data);
                }
            })
        }

        // process_total(ds);

        var dataGrid = $('#grid_container').dxDataGrid({
            dataSource: ds,
            // keyExpr: 'ID',
            showBorders: true,
            paging: {
                enabled: false,
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
                    dataField: 'Name',
                    caption: 'ITEM',
                    width: 300,
                    allowEditing: false,
                },
                {
                    dataField: 'Rate',
                    caption: 'RATE',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    allowEditing: false,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'Qty',
                    caption: 'QTY',
                    format: '#,##0.000',
                    allowEditing: false,
                },
                {
                    dataField: 'Total',
                    caption: 'TOTAL',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    allowEditing: false,
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
                let Rate = e.oldData.Rate;
                let Qty = e.oldData.Qty;

                if (e.newData.Qty) {
                    Qty = e.newData.Qty;
                }
                if (e.oldData.status == "exist_data") {
                    e.newData.status = "old_updated";
                }

                e.newData.Total = parseFloat(Rate) * parseFloat(Qty);
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
                if (e.key.status === "exist_data") {
                    deleteItems.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems.push(e.key);

                }
                process_total(ds)
                // console.log(deleteItems);
            },
            onRowRemoved(e) {
                console.log("Deleted");
                // console.log(e.data);
                if (e.key.status === "exist_data") {
                    deleteItems.push(e.key);

                }
                if (e.key.status === "old_updated") {
                    deleteItems.push(e.key);

                }
                process_total(ds)

            },
            onSaved(e) {
                console.log(e);
            },

        }).dxDataGrid('instance');

        function process_total(ds1) {
            let total = 0;
            if (ds1.length != 0) {
                $.each(ds1, function(k, v) {
                    total += parseFloat(v.Total);
                });
                $("#final_total").dxNumberBox('instance').option('value', total);
            } else {
                $("#final_total").dxNumberBox('instance').option('value', 0);
            }
        }

        // function load_app_data() {

        //     <?php $__currentLoopData = $app_body; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        //         <?php if($value->Type != 'TblStock_Pharma'): ?>
                    
        //             ds.push({
        //                 "ID": '<?php echo e($value->ID); ?>',
        //                 "Name": "<?php echo e(trim($value->service->Name)); ?>",
        //                 "Rate": '<?php echo e($value->Unit_Price); ?>',
        //                 "Qty": '<?php echo e($value->Qty_taken); ?>',
        //                 "Total": '<?php echo e($value->Total); ?>',
        //                 "status": "exist_data",
        //             });
                
        //         <?php else: ?>
        //             <?php if($value->Qty_taken != null): ?>
        //                 ds.push({
        //                     "ID": '<?php echo e($value->ID); ?>',
        //                     "Name": "<?php echo e(trim($value->item->Brand_Name)); ?>",
        //                     "Rate": '<?php echo e($value->Unit_Price); ?>',
        //                     "Qty": '<?php echo e($value->Qty_taken); ?>',
        //                     "Total": '<?php echo e($value->Total); ?>',
        //                     "status": "exist_data",
        //                 });
        //             <?php endif; ?>
        //         <?php endif; ?>
        //     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        // }

        function load_ajax_app_data() {
            let appointment_id = $("#appointment_id").val();
            $.ajax({
                method:"GET",
                url:"/load_selected_due_inv_data/"+appointment_id,
                success:function(res){
                    ds=[];
                    $.each(res.app_body, function(k, v){
                        if(v.Type!='TblStock_Pharma'){
                            ds.push({
                                "ID": v.ID,
                                "Name": v.service.Name,
                                "Rate": v.Unit_Price,
                                "Qty": v.Qty_taken,
                                "Total": v.Total,
                                "status": "exist_data",
                            });
                        } else {
                            if (v.Qty_taken != null) {
                                ds.push({
                                    "ID": v.ID,
                                    "Name": v.item.Brand_Name,
                                    "Rate": v.Unit_Price,
                                    "Qty": v.Qty_taken,
                                    "Total": v.Total,
                                    "status": "exist_data",
                                });
                            }
                        }
                    });

                    $('#grid_container').dxDataGrid("instance").option("dataSource", ds);
                    process_total(ds);
                    
                }
            })
        }

        $("#btn_update").on('click', function() {
            let appointment_id = $("#appointment_id").val();
            let app_body = JSON.stringify(ds);

            $("#btn_update").attr("disabled", true);

            $.ajax({
                url: "<?php echo e(route('save_exist_dueinv')); ?>",
                method: "POST",
                "data": {
                    "appointment_id": appointment_id,
                    "app_body": app_body,
                    "deleted_items": JSON.stringify(deleteItems),
                },
                "success": function(response) {
                    if (response.success) {
                        // console.log(data);
                        toastr.success("Appointment Update Successfully");
                        ds = [];
                        load_ajax_app_data();

                        $("#btn_update").attr("disabled", false);
                    } else {
                        toastr.error(response.message);
                        $("#btn_update").attr("disabled", false);
                    }
                },
            });
        });

        $("#btn_invoice").on('click', function() {
            let total = $("#final_total").dxNumberBox('instance').option('value');
            let discount = $("#final_discount").dxNumberBox('instance').option('value');
            let gross = $("#final_gross").dxNumberBox('instance').option('value');

            if (total == 0) {
                toastr.error("Bill Values Missed");
            } else {
                $("#pay_total").dxNumberBox('instance').option('value', gross);
                $("#payment_ask_modal").modal("show");
            }
        });

        function pay_invoice() {
            let appointment_id = $("#appointment_id").val();
            let inv_date = $("#invoice_date").dxDateBox('instance').option('value');

            let net = $("#final_gross").dxNumberBox('instance').option('value');
            let discount = $("#final_discount").dxNumberBox('instance').option('value');
            let total = $("#final_total").dxNumberBox('instance').option('value');

            let dis_val = total * discount;

            let pay_amt = $("#pay_total").dxNumberBox('instance').option('value');
            let paid_amt = $("#pay_paid").dxNumberBox('instance').option('value');

            // cash
            let cash_pay = $("#pay_cash_amount").dxNumberBox('instance').option('value');
            let cash_ledger_acc = $("#pay_account").dxSelectBox('instance').option('value');
            //card
            let card_pay = $("#pay_card_amount").dxNumberBox('instance').option('value');
            let card_type = $("#card_type").dxSelectBox("instance").option('value');
            let card_number = $("#card_no").dxTextBox("instance").option('value');
            let card_institute = $("#card_institute").dxSelectBox("instance").option('value');
            //cheque
            let chq_date = $("#pay_chq_date").dxDateBox('instance').option('value');
            let chq_bank = $("#pay_chq_bank").dxSelectBox("instance").option('value');
            let chq_pay = $("#pay_chq_amount").dxNumberBox('instance').option('value');
            let chq_no = $("#pay_chq_no").dxTextBox('instance').option('value');

            //tranfer/ bank deposit
            let bank_pay = $("#pay_bank_tranfer_amount").dxNumberBox('instance').option('value');
            let bank_obj = $('#branch_bank').dxSelectBox("instance").option("value");
            let bank_transfer_branch = null;
            let banc_acc = null;

            if (bank_obj != null) {
                bank_transfer_branch = bank_obj.BankCode;
                banc_acc = bank_obj.ledgeracc;
            } else {
                bank_transfer_branch = null;
                banc_acc = null;
            }

            let deposit_date = $("#deposit_date").dxDateBox('instance').option('value');

            //credit
            let credit_pay = $("#pay_credit_amount").dxNumberBox('instance').option('value');
            let credit_acc_ID = $("#debtor_acc_list").dxSelectBox('instance').option('value');

            if (pay_amt > paid_amt) {
                toastr.error("Paid amount is mismatch")
            } else {

                if (pay_amt > 0) {
    
                    // if (pay_amt.toFixed(2) !== paid_amt.toFixed(2)) {
                    //     toastr.error("Paid amount is mismatch")
                    //     return
                    // }
                    //if cash need cash ledger
                    if (cash_pay > 0) {
                        if (!cash_ledger_acc) {
                            toastr.error("Please select a Cash account")
                            return
                        }
                    }
                    // if ((bank_pay + chq_pay + card_pay + credit_pay + cash_pay).toFixed(2) > pay_amt.toFixed(2)) {
    
                    //     toastr.error("Insufficient amount")
                    //     return
    
                    // }
                    // if ((bank_pay + chq_pay + card_pay + credit_pay + cash_pay).toFixed(2) < pay_amt.toFixed(2)) {
    
                    //     toastr.error("Insufficient amount")
                    //     return
                    // }
                    if (ds.length === 0) {
                        toastr.error("Invoice items are empty");
                        return;
                    }
                } else {
                    // if (gross.toFixed(2) !== paid_amt.toFixed(2)) {
                    //     toastr.error("Paid amount is mismatch")
                    //     return
                    // }
                }
    
                let data = {
    
                    'appointment_id': appointment_id,
                    'inv_date': inv_date,
    
                    'total': total,
                    'dis_val': dis_val,
                    'gross': net,
                    'paid_amount': paid_amt,
                    "pay_amt": pay_amt,
    
                    'cash_amount': cash_pay,
                    'cash_account_id': cash_ledger_acc,
    
                    'cheque_amount': chq_pay,
                    'cheque_date': chq_date,
                    'cheque_bank': chq_bank,
                    'cheque_number': chq_no,
    
                    'bank_amount': bank_pay,
                    'bank_transfer_branch': bank_transfer_branch,
                    "banc_acc": banc_acc,
                    'deposit_date': deposit_date,
    
                    'card_amount': card_pay,
                    'card_type': card_type,
                    'card_number': card_number,
    
                    'credit_acc_ID': credit_acc_ID,
                    "credit_amount": credit_pay,
                };
    
                $("#btn_pay_invoice").attr("disabled", true);
                $.ajax({
                    url: "<?php echo e(route('pay_invoice_appointment')); ?>",
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            toastr.success("Payment Success!");
                            $("#invoice_number").val(response.Invoice_no);
                            print_ask();
                        } else {
                            toastr.error("Invalid data");
                        }
                        // otable_due_inv.ajax.reload();
                        // ask_print()
                        reset_inputs();
                        $("#payment_ask_modal").modal("hide");
                        $("#btn_pay_invoice").attr("disabled", false)
                    },
                    error: function(err) {
                        $("#btn_pay_invoice").attr("disabled", false)
                        // console.log("");
                    }
                })
            }
        }

        function print_ask() {
            $("#ask_print_modal").modal("show");
        }

        function print_invoice() {
            let print_size = $("#print_size option:selected").val();
            let invoice_number = $("#invoice_number").val();

            printJS("/invoice/" + print_size + "/" + invoice_number);

            // location.href = '/load_due_inv_page';
        }

        function reset_inputs() {
            $("#appointment_id").val('');

            $("#final_gross").dxNumberBox('instance').option('value', 0);
            $("#final_discount").dxNumberBox('instance').option('value', 0);
            $("#final_total").dxNumberBox('instance').option('value', 0);

            $("#pay_total").dxNumberBox('instance').option('value', 0);
            $("#pay_paid").dxNumberBox('instance').option('value', 0);

            // cash
            $("#pay_cash_amount").dxNumberBox('instance').option('value', 0);
            $("#pay_account").dxSelectBox('instance').option('value', '');
            //card
            $("#pay_card_amount").dxNumberBox('instance').option('value', 0);
            $("#card_type").dxSelectBox("instance").option('value', '');
            $("#card_no").dxTextBox("instance").option('value', '');
            $("#card_institute").dxSelectBox("instance").option('value', '');
            //cheque
            $("#pay_chq_bank").dxSelectBox("instance").option('value', '');
            $("#pay_chq_amount").dxNumberBox('instance').option('value', 0);
            $("#pay_chq_no").dxTextBox('instance').option('value', '');

            //tranfer/ bank deposit
            $("#pay_bank_tranfer_amount").dxNumberBox('instance').option('value', 0);
            $('#branch_bank').dxSelectBox("instance").option("value", '');
        }

        function view_pres() {
            let app_id = $("#appointment_id").val();

            $.post('<?php echo e(route('load_taken_prescription')); ?>', {
                    "app_id": app_id
                },
                function(response) {
                    otable_pres.clear();
                    otable_pres.rows.add(response.data);
                    otable_pres.draw();
                });
            setTimeout(function() {
                otable_pres.columns.adjust().draw();
            }, 500);

            $("#appointment_id").val(app_id);
            $("#prescription_modal").modal("show");
        };

        var otable_pres = $("#otable_pres").DataTable({

            // dom: 'Bfrtip',
            columnDefs: [{
                targets: -1,
                data: null,
                defaultContent: '<button class="btn btn-success btn-sm waves-effect waves-light cartBtn">Add to Cart</button>',
            }, ],

            columns: [{
                    data: 'ID',
                    name: 'ID',
                },
                {
                    data: 'item.Brand_Name',
                    name: 'item.Brand_Name',
                    "width": "500px",
                },
                {
                    data: 'Unit',
                    name: 'Unit',
                },
                {
                    data: 'Dose',
                    name: 'Dose',
                },
                {
                    data: 'Freq',
                    name: 'Freq',
                },
                {
                    data: 'Period',
                    name: 'Period',
                },
                {
                    data: 'Qty',
                    name: 'Qty',
                    "className": "text-end",
                    render: function(data, type, row, meta) {
                        var qty = parseFloat(data);
                        if (!isNaN(qty)) {
                            return qty.toFixed(2);
                        } else {
                            return '0.00';
                        }
                    }
                },
                {
                    data: 'Qty_taken',
                    name: 'Qty_taken',
                    "className": "text-end",
                    render: function(data, type, row, meta) {
                        var taken_qty = parseFloat(data);
                        if (!isNaN(taken_qty)) {
                            return taken_qty.toFixed(2);
                        } else {
                            return '0.00';
                        }
                    }
                },
                {
                    data: '',
                    name: '',

                },

            ],
            order: [
                [0, 'desc']
            ],

        });

        var pharm_item = null;
        var body_id = null;

        $('#otable_pres tbody').on('click', '.cartBtn', function() {
            var data = otable_pres.row($(this).parents('tr')).data();

            console.log(data);
            pharm_item = data.item.ID;
            body_id = data.ID;
            $("#item_name").val(data.item.Brand_Name);
            $("#req_qty").dxNumberBox('instance').option('value', data.Qty);
            load_lot();

            $("#select_lot_modal").modal("show");
        });

        function load_lot() {
            let item_id = pharm_item;
            console.log(pharm_item);

            $.ajax({
                url: "<?php echo e(route('load_lot_details')); ?>",
                method: "POST",
                "data": {
                    "item_id": item_id,
                },
                success: function(response) {
                    // console.log(response.data);
                    lot = response.data
                    $('#lot').dxSelectBox("instance").option("dataSource", lot);
                }
            });
        }
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
                        $("#avb_qty").dxNumberBox('instance').option('value', parseFloat(0));
                        
                    } else {
                        $("#price").dxNumberBox('instance').option('value', parseFloat(response.data?.Price));
                        $("#avb_qty").dxNumberBox('instance').option('value', parseFloat(response.data?.QTY));
                    }
                }
            });
        }

        function add_to_cart() {
            let appointment_id = $("#appointment_id").val();
            let lot = $('#lot').dxSelectBox("instance").option("value");
            let taken_qty = $("#qty_take").dxNumberBox('instance').option('value');
            let app_body_id = body_id;

            if (lot == null) {
                toastr.error("Lot Required");
            }else if (taken_qty == 0) {
                toastr.error("Qty Required");
            } else {
                $.ajax({
                    url: "<?php echo e(route('save_lot_to_body')); ?>",
                    method: "POST",
                    "data": {
                        "appointment_id": appointment_id,
                        "lot_id":lot.ID,
                        "taken_qty":taken_qty,
                        "app_body_id":app_body_id,
                        "pharm_item":pharm_item
                    },
                    success: function(response) {
                        console.log(response);
                        toastr.success("Add To Cart Successfully");
                        view_pres();
                        clear_lot_form();
                        ds=[];
                        load_ajax_app_data();
                        $("#select_lot_modal").modal("hide");
                    }
                });
            }

        }

        function clear_lot_form() {
            $('#lot').dxSelectBox("instance").option("value", '');
            $("#qty_take").dxNumberBox('instance').option('value', 0);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/cashier/sales/select_dueinv.blade.php ENDPATH**/ ?>