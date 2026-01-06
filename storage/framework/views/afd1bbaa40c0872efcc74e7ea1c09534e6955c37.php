
<?php $__env->startSection('title'); ?>
    Sales
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
            Sales
        <?php $__env->endSlot(); ?>
    <?php echo $__env->renderComponent(); ?>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <button type="button" id="btn_new_invoice"
                                class="btn rounded-pill btn-md btn-primary waves-effect waves-light">
                                <i class="las la-plus-circle"></i> New Invoice</button>
                        </div>
                    </div>
                    <table id="otable_sales" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Invoice</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <!-- add_invoice_modal -->
    <div id="add_invoice_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="myModalLabel">New Invoice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Invoice :</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="<?php echo e($next_inv_no); ?>" id="next_invoice" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-5 col-form-label">Customer :</label>
                                <div class="col-sm-9">
                                    <div id="customer" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Date :</label>
                                <div class="col-sm-10">
                                    <div id="date" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-2 col-form-label">Item :</label>
                                <div class="col-sm-10">
                                    <div id="item" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-5 col-form-label">Lot :</label>
                                <div class="col-sm-9">
                                    <div id="lot" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 col-form-label">Price :</label>
                                <div class="col-sm-9">
                                    <div id="price" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Qty :</label>
                                <div class="col-sm-9">
                                    <div id="qty" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Discount:</label>
                                <div class="col-sm-9">
                                    <div id="discount" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-3 ps-3 col-form-label">Total :</label>
                                <div class="col-sm-9">
                                    <div id="total" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                        </div>
                        <div class="col-lg-4">
                            <div class="row text-right">
                                <div class="col-sm-9">
                                </div>
                                <div class="col-sm-3 d-grid">
                                    <button type="button" id="btn_add_toGrid" onclick="add_toGrid()"
                                        class="btn btn-primary">Add</button>
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
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Discount :</label>
                                <div class="col-sm-8">
                                    <div id="final_discount" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <label for="colFormLabel" class="col-sm-4 ps-5 col-form-label">Gross :</label>
                                <div class="col-sm-8">
                                    <div id="final_gross" class="form-control-sm"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_save_invoice" onclick="save_invoice()"
                        class="btn btn-primary">Save</button>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- payment_ask_modal -->
    <div id="payment_ask_modal" class="modal fade bg-primary" tabindex="-1" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-xl">
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
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btn_pay_invoice" onclick="pay_invoice()"
                        class="btn btn-primary">Submit</button>
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
        var item = [];
        var lot = [];
        var customer = [];
        var branch = [];

        var ds = [];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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
                $("#pay_paid").dxNumberBox('instance').option('value', paid_amt);
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

        load_item();
        next_inv_no();
        load_customer();

        $('#date').dxDateBox({
            type: 'date',
            displayFormat: 'yyyy-MMM-dd',
            dateSerializationFormat: 'yyyy-MM-dd',
            value: "<?php echo date('Y-m-d'); ?>",
            valueChangeEvent: 'keyup',
            onValueChanged: function(e) {
                const newValue = e.value;
            },
        });
        $('#type').dxSelectBox({
            items: ['Cash', "Credit", "Bank Card"],
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
            format: '#,##0.##',
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let price = $("#price").dxNumberBox('instance').option('value');
                let discount = $("#discount").dxNumberBox('instance').option('value');
                let qty = e.value;
                let net = price * qty;
                let dis_val = net * discount;

                let total = net - dis_val;
                $("#total").dxNumberBox('instance').option('value', total);

            },
        });
        $("#discount").dxNumberBox({
            format: '#0.## %',
            value: 0,
            valueChangeEvent: "keyup",
            onValueChanged: function(e) {
                let price = $("#price").dxNumberBox('instance').option('value');
                let qty = $("#qty").dxNumberBox('instance').option('value');
                let net = price * qty;
                let discount = e.value;
                let dis_val = net * discount;

                let total = net - dis_val;
                $("#total").dxNumberBox('instance').option('value', parseFloat(total));

            },
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
                $("#final_gross").dxNumberBox('instance').option('value', parseFloat(gross));

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

        $('#item').dxSelectBox({
            dataSource: item,
            displayExpr: 'Brand_Name',
            // valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.Pharma_name + " - " + data.Brand_Name;
            },
            searchEnabled: true,
            searchExpr: ["ID", "Pharma_name", "Brand_Name"],
            onValueChanged: function(e) {
                load_lot(e);
            },
        });

        $('#lot').dxSelectBox({
            dataSource: lot,
            displayExpr: 'ID',
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

        $('#customer').dxSelectBox({
            dataSource: customer,
            displayExpr: 'FullName',
            valueExpr: 'ID',
            itemTemplate: function(data) {
                return data.ID + " - " + data.FullName;
            },
            searchEnabled: true,
            searchExpr: ["ID", "FullName"],
        });

        function load_lot() {
            let item_id = $('#item').dxSelectBox("instance").option("value");

            $.ajax({
                url: "<?php echo e(route('load_lot_details')); ?>",
                method: "POST",
                "data": {
                    "item_id": item_id.ID,
                },
                success: function(response) {
                    // console.log(response.data);
                    lot = response.data
                    $('#lot').dxSelectBox("instance").option("dataSource", lot);
                }
            });
        }

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

        function load_customer() {
            $.ajax({
                url: "<?php echo e(route('load_customer_to_invoice')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    customer = response.data
                    $('#customer').dxSelectBox("instance").option("dataSource", customer);
                }
            })
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
                    } else {
                        $("#price").dxNumberBox('instance').option('value', parseFloat(response.data?.Price));
                    }
                }
            });
        }

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

        $("#btn_new_invoice").on('click', function() {
            $("#add_invoice_modal").modal("show");
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
                    dataField: 'Lot_Id',
                    caption: 'LOT ID',
                    width: 100,
                    allowEditing: false,
                },
                {
                    dataField: 'Code',
                    caption: 'CODE',
                    allowEditing: false,
                    width: 150,
                },
                {
                    dataField: 'Name',
                    caption: 'ITEM',
                    allowEditing: false,
                },
                {
                    dataField: 'Qty',
                    caption: 'QTY',
                    format: '#,##0.000',
                    allowEditing: true,
                    width: 100,
                },
                {
                    dataField: 'Unit_Pice',
                    caption: 'RATE',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 100,
                    allowEditing: true,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'Discount',
                    caption: 'DISCOUNT',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 130,
                    allowEditing: true,
                    validationRules: [{
                        type: 'required'
                    }],
                },
                {
                    dataField: 'Total',
                    caption: 'TOTAL',
                    dataType: 'number',
                    format: 'LKR #,##0.00',
                    width: 100,
                    allowEditing: false,
                    validationRules: [{
                        type: 'required'
                    }],
                },

            ],

            toolbar: {
                items: [
                    
                ]
            },
            onRowPrepared: function(info) {
                if (info.rowType == 'header') {
                    info.rowElement.addClass('bg-primary')
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
                let Unit_Pice = e.oldData.Unit_Pice;
                let Discount = e.oldData.Discount;
                let Qty = e.oldData.Qty;

                if (e.newData.Unit_Pice) {
                    Unit_Pice = e.newData.Unit_Pice;
                }
                if (e.newData.Qty) {
                    Qty = e.newData.Qty;
                }
                if (e.newData.Discount) {
                    Discount = e.newData.Discount;
                }

                if (e.oldData.status == "old") {
                    e.newData.status = "old_updated";
                }

                e.newData.Total = parseFloat(Unit_Pice) * parseFloat(Qty) - parseFloat(Discount);
                process_total(ds)
            },
            onRowUpdated(e) {
                if (e.status == "old") {
                    e.status = "old_updated";


                }
                process_total(ds)
            },
            onRowRemoving(e) {
                // console.log("Deleteing..1");
                // console.log(e.key);
                // console.log("Deleteing..1");
                if (e.key.status === "old") {
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
                if (e.key.status === "old") {
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

        function add_toGrid() {
            let item_obj = $('#item').dxSelectBox("instance").option("value");
            let item_id = item_obj.ID;
            let item_code = item_obj.Code;
            let item_name = item_obj.Pharma_name;

            let lot_obj = $('#lot').dxSelectBox("instance").option("value");
            let lot_id = lot_obj.ID;

            let qty = $("#qty").dxNumberBox('instance').option('value');
            let total = $("#total").dxNumberBox('instance').option('value');
            let price = $("#price").dxNumberBox('instance').option('value');
            let discount = $("#discount").dxNumberBox('instance').option('value');

            let net = qty * price;
            let dis_val = discount * net;

            let data = {
                "ID": item_id,
                "Lot_Id": lot_id,
                "Code": item_code,
                "Name": item_name,
                "Unit_Pice": price,
                "Qty": qty,
                "Discount": dis_val,
                "Total": total
            };

            let exist_qty = lot_obj.QTY;
            if (qty > exist_qty) {
                toastr.error('Quentity Level Exceeded');
            } else {
                var dataSource = dataGrid.getDataSource();
    
                dataSource.store().insert(data).then(function() {
                    dataSource.reload();
                    process_total(ds); //calculate total
                })
                reset_elements();
            }

        }

        function reset_elements() {
            $('#item').dxSelectBox("instance").option("value", '');
            $("#qty").dxNumberBox('instance').option('value', 0);
            $("#total").dxNumberBox('instance').option('value', 0);
            $("#price").dxNumberBox('instance').option('value', 0);
            $("#discount").dxNumberBox('instance').option('value', 0);
        };

        $("#add_invoice_modal").on('keydown', function(e) {
            var key = e.which || e.keyCode;
            if (key == 13) {
                add_toGrid();
                // reset_elements(); // <----use the DOM click this way!!!
            }
        });

        function next_inv_no() {
            $("#next_invoice").val('');

            $.ajax({
                url: "<?php echo e(route('load_next_inv')); ?>",
                method: "GET",
                success: function(response) {
                    // console.log(response)
                    console.log(response.data);
                    $("#next_invoice").val(response.data);
                }
            })
        }

        function save_invoice() {
            let net = $("#final_gross").dxNumberBox('instance').option('value');
            let discount = $("#final_discount").dxNumberBox('instance').option('value');
            let total = $("#final_total").dxNumberBox('instance').option('value');

            if (total == 0) {
                toastr.error("Bill Values Missed");
            } else {
                $("#pay_total").dxNumberBox('instance').option('value', net);
                $("#payment_ask_modal").modal("show");
            }

        }

        function pay_invoice() {
            let invoice_number = $("#next_invoice").val();
            let inv_date = $("#date").dxDateBox('instance').option('value');
            let customer_id = $("#customer").dxSelectBox("instance").option('value');
            let net = $("#final_gross").dxNumberBox('instance').option('value');
            let discount = $("#final_discount").dxNumberBox('instance').option('value');
            let total = $("#final_total").dxNumberBox('instance').option('value');
            
            let dis_val = total*discount;
            
            let inv_bodies = JSON.stringify(ds);

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
            // let acc_transfer = acc_id;

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
    
                    'invoice_number':invoice_number,
                    'inv_date':inv_date,
                    'customer_id': customer_id,
                    'invoice_bodies': inv_bodies,
                    'total': total,
                    'dis_val': dis_val,
                    'gross': net,
                    'paid_amount':paid_amt,
                    "pay_amt":pay_amt,
    
                    'cash_amount': cash_pay,
                    'cash_account_id': cash_ledger_acc,
    
                    'cheque_amount': chq_pay,
                    'cheque_date': chq_date,
                    'cheque_bank': chq_bank,
                    'cheque_number': chq_no,
    
                    'bank_amount': bank_pay,
                    'bank_transfer_branch': bank_transfer_branch,
                    "banc_acc":banc_acc,
                    'deposit_date': deposit_date,
    
                    'card_amount': card_pay,
                    'card_type': card_type,
                    'card_number': card_number,
    
                    'credit_acc_ID':credit_acc_ID,
                    "credit_amount":credit_pay,
    
                };
                // console.log(data);
    
                $("#btn_pay_invoice").attr("disabled", true);
                $.ajax({
                    url: "<?php echo e(route('pay_invoice')); ?>",
                    method: 'POST',
                    data: data,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            toastr.success("Payment Success!");
                        } else {
                            toastr.error("Invalid data");
                        }
                        otable_sales.ajax.reload();
                        reset_inputs();
                        next_inv_no();
    
                        $("#invoice_number").val(invoice_number);
                        print_ask();
    
    
                        $("#add_invoice_modal").modal("hide");
                        $("#payment_ask_modal").modal("hide");
    
                        $("#btn_pay_invoice").attr("disabled", false)
                    },
                    error: function(err) {
                        $("#btn_pay_invoice").attr("disabled", false)
                        console.log("");
                    }
                })
            }
        }

        function reset_inputs() {
            ds = [];
            $("#grid_container").dxDataGrid("instance").option('dataSource',ds);
            $("#next_invoice").val('');
            $("#customer").dxSelectBox("instance").option('value','');
            $("#final_gross").dxNumberBox('instance').option('value',0);
            $("#final_discount").dxNumberBox('instance').option('value',0);
            $("#final_total").dxNumberBox('instance').option('value',0);

            $("#pay_total").dxNumberBox('instance').option('value',0);
            $("#pay_paid").dxNumberBox('instance').option('value',0);

            // cash
            $("#pay_cash_amount").dxNumberBox('instance').option('value',0);
            $("#pay_account").dxSelectBox('instance').option('value','');
            //card
            $("#pay_card_amount").dxNumberBox('instance').option('value',0);
            $("#card_type").dxSelectBox("instance").option('value','');
            $("#card_no").dxTextBox("instance").option('value','');
            $("#card_institute").dxSelectBox("instance").option('value','');
            //cheque

            $("#pay_chq_bank").dxSelectBox("instance").option('value','');
            $("#pay_chq_amount").dxNumberBox('instance').option('value',0);
            $("#pay_chq_no").dxTextBox('instance').option('value','');
            $("#pay_bank_tranfer_amount").dxNumberBox('instance').option('value',0);
            $('#branch_bank').dxSelectBox("instance").option("value",'');
        }

        var otable_sales = $("#otable_sales").DataTable({
            processing: true,
            serverSide: true,
            responsive: false,
            scrollX: true,
            height: "40vh",
            ajax: {
                url: "<?php echo e(route('load_sales_invoice')); ?>",
                method: "GET",
                data: function(d) {
                    $.extend(d, myData);
                }
            },
            columns: [{
                    data: 'invno',
                    name: 'invno',
                    "width": "25px",
                },
                {
                    data: 'customer.FullName',
                    name: 'customer.FullName',
                    render:function(data, type){
                        if(data==null){
                            return '-';
                        }else {
                            return data;
                        }
                        return data
                    },
                },
                {
                    data: 'date',
                    name: 'date',
                },
                {
                    data: 'type',
                    name: 'type',
                },
                {
                    data: 'total',
                    name: 'total',
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

        $('#otable_sales tbody').on('click', '.btn-print', function() {

            var data = otable_sales.row($(this).parents('tr')).data();
            console.log(data);

            $("#invoice_number").val(data.invno);
            $("#ask_print_modal").modal("show");

        });

        function print_ask() {
            $("#ask_print_modal").modal("show");
        }

        function print_invoice() {
            let print_size = $("#print_size option:selected").val();
            let invoice_number = $("#invoice_number").val();

            printJS("/invoice/"+print_size+"/"+invoice_number);
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\BIT\Project\Project\CuraSys\resources\views/cashier/sales/sales.blade.php ENDPATH**/ ?>