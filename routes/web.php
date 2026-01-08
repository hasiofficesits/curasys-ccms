<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuViewController;

use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\OPDController;
use App\Http\Controllers\SystemUserController;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DosageController;
use App\Http\Controllers\FrequencyController;

use App\Http\Controllers\CashierAppointmentController;
use App\Http\Controllers\CompleteAppController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DueInvController;

use App\Http\Controllers\StockCategoryController;
use App\Http\Controllers\StockGroupController;
use App\Http\Controllers\StockItemController;
use App\Http\Controllers\StockLocationController;
use App\Http\Controllers\GrnController;
use App\Http\Controllers\ReturnNoteController;

use App\Http\Controllers\AccSettingsController;

use App\Http\Controllers\stockDashboardController;
use App\Http\Controllers\stockReportController;

Route::get('/', [LoginController::class,'index']);
Route::get('/login',[LoginController::class, "index"]);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function () {
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    //load_dashboard
    Route::get('load_dashboard', [DashboardController::class, 'load_dashboard'])->name('load_dashboard');
    //menu_view
    Route::get('menu_view', [MenuViewController::class, 'menu_view'])->name('menu_view');
    //load_management_view
    Route::get('load_management_view', [MenuViewController::class, 'load_management_view'])->name('load_management_view');
    //load_appointment_view
    Route::get('load_appointment_view', [MenuViewController::class, 'load_appointment_view'])->name('load_appointment_view');
    //load_cashier_view
    Route::get('load_cashier_view', [MenuViewController::class, 'load_cashier_view'])->name('load_cashier_view');
    //load_stock_view
    Route::get('load_stock_view', [MenuViewController::class, 'load_stock_view'])->name('load_stock_view');
    // load_report_view
    Route::get('load_report_view', [MenuViewController::class, 'load_report_view'])->name('load_report_view');
    
    //------------MANAGEMENT-------------
    Route::middleware(['role:0,1'])-> group(function () {
        // load_management_dashboard
        Route::get('load_management_dashboard', [DashboardController::class, 'load_management_dashboard'])->name('load_management_dashboard');
        Route::get('/get-patient-chart-data', [DashboardController::class, 'get_patient_chart_data'])->name('get.patient.chart.data');

        //load_doctor
        Route::get('load_doctor', [DoctorController::class, 'load_doctor'])->name('load_doctor');
        //load_doctor_grid
        Route::get('load_doctor_grid', [DoctorController::class, 'load_doctor_grid'])->name('load_doctor_grid');
        //save_new_doctor
        Route::post('save_new_doctor', [DoctorController::class, 'save_new_doctor'])->name('save_new_doctor');
        //update_exist_doctor
        Route::post('update_exist_doctor', [DoctorController::class, 'update_exist_doctor'])->name('update_exist_doctor');
        //active_doctor_from_id
        Route::post('active_doctor_from_id', [DoctorController::class, 'active_doctor_from_id'])->name('active_doctor_from_id');
        //inactive_doctor_from_id
        Route::post('inactive_doctor_from_id', [DoctorController::class, 'inactive_doctor_from_id'])->name('inactive_doctor_from_id');


        //load_patient
        Route::get('load_patient', [PatientController::class, 'load_patient'])->name('load_patient');
        //load_patient_grid
        Route::get('load_patient_grid', [PatientController::class, 'load_patient_grid'])->name('load_patient_grid');
        //add_patient_page
        Route::get('add_patient_page', [PatientController::class, 'add_patient_page'])->name('add_patient_page');
        //ajax_save_patient
        Route::post('ajax_save_patient', [PatientController::class, 'ajax_save_patient'])->name('ajax_save_patient');
        //load_update_patient_page
        Route::get('load_update_patient_page/{id}', [PatientController::class, 'load_update_patient_page'])->name('load_update_patient_page');
        //update_patient
        Route::post('ajax_update_patient', [PatientController::class, 'ajax_update_patient'])->name('ajax_update_patient');
        //active_patient
        Route::post('active_patient', [PatientController::class, 'active_patient'])->name('active_patient');
        //inactive_patient
        Route::post('inactive_patient', [PatientController::class, 'inactive_patient'])->name('inactive_patient');

        //load_opd_page
        Route::get('load_opd_page', [OPDController::class, 'load_opd_page'])->name('load_opd_page');
        //load_opdservice_grid
        Route::get('load_opdservice_grid', [OPDController::class, 'load_opdservice_grid'])->name('load_opdservice_grid');
        //save_new_service
        Route::post('save_new_service', [OPDController::class, 'save_new_service'])->name('save_new_service');
        //update_opd_service
        Route::post('update_opd_service',[OPDController::class, 'update_opd_service'])->name('update_opd_service');
        //active_service_from_id
        Route::post('active_service_from_id',[OPDController::class, 'active_service_from_id'])->name('active_service_from_id');
        //inactive_service_from_id
        Route::post('inactive_service_from_id',[OPDController::class, 'inactive_service_from_id'])->name('inactive_service_from_id');
        //load_rev_acc_service
        Route::get('load_rev_acc_service', [OPDController::class, 'load_rev_acc_service'])->name('load_rev_acc_service');

        //load_users
        Route::get('load_users', [SystemUserController::class, 'load_users'])->name('load_users');
        // load_exist_doctors
        Route::get('load_exist_doctors', [SystemUserController::class, 'load_exist_doctors'])->name('load_exist_doctors');
        // load_selected_doctors_data
        Route::post('load_selected_doctors_data', [SystemUserController::class, 'load_selected_doctors_data'])->name('load_selected_doctors_data');
        //load_user_grid
        Route::get('load_user_grid', [SystemUserController::class, 'load_user_grid'])->name('load_user_grid');
        //save_new_user
        Route::post('save_new_user', [SystemUserController::class, 'save_new_user'])->name('save_new_user');
        //update_user
        Route::post('update_user', [SystemUserController::class, 'update_user'])->name('update_user');
        //active_user_from_id
        Route::post('active_user_from_id', [SystemUserController::class, 'active_user_from_id'])->name('active_user_from_id');
        //inactive_user_from_id
        Route::post('inactive_user_from_id', [SystemUserController::class, 'inactive_user_from_id'])->name('inactive_user_from_id');

        //load_acc_set
        Route::get('load_acc_set', [AccSettingsController::class, 'load_acc_set'])->name('load_acc_set');
        //load_def_acc
        Route::get('load_def_acc', [AccSettingsController::class, 'load_def_acc'])->name('load_def_acc');
        //load_exist_def_acc
        Route::get('load_exist_def_acc', [AccSettingsController::class, 'load_exist_def_acc'])->name('load_exist_def_acc');
        //save_default_acc
        Route::post('save_default_acc', [AccSettingsController::class, 'save_default_acc'])->name('save_default_acc');
    });

    Route::middleware(['role:0,1,3'])-> group(function () {
        //------------APPOINTMENT-------------
        //load_appointment_page
        Route::get('load_appointment_page', [AppointmentController::class, 'load_appointment_page'])->name('load_appointment_page');
        //load_app_queue_grid
        Route::get('load_app_queue_grid', [AppointmentController::class, 'load_app_queue_grid'])->name('load_app_queue_grid');
        //select_chennel_page
        Route::get('select_chennel_page/{id}', [AppointmentController::class, 'select_chennel_page'])->name('select_chennel_page');
        //load_history_data
        Route::post('load_history_data', [AppointmentController::class, 'load_history_data'])->name('load_history_data');
        //save_appointment_table
        Route::post('save_appointment_table', [AppointmentController::class, 'save_appointment_table'])->name('save_appointment_table');
        //load_doctor_appo
        Route::get('load_doctor_appo', [AppointmentController::class, 'load_doctor_appo'])->name('load_doctor_appo');
        //save_prescription
        Route::post('save_prescription', [AppointmentController::class, 'save_prescription'])->name('save_prescription');
        //save_clinical_note
        Route::post('save_clinical_note', [AppointmentController::class, 'save_clinical_note'])->name('save_clinical_note');
        //load_opd_service
        Route::get('load_opd_service', [AppointmentController::class, 'load_opd_service'])->name('load_opd_service');
        //load_service_details
        Route::post('load_service_details', [AppointmentController::class, 'load_service_details'])->name('load_service_details');
        //save_opd_service_appointment
        Route::post('save_opd_service_appointment', [AppointmentController::class, 'save_opd_service_appointment'])->name('save_opd_service_appointment');
        //save_invest_order
        Route::post('save_invest_order', [AppointmentController::class, 'save_invest_order'])->name('save_invest_order');
        //save_invest_result
        Route::post('save_invest_result', [AppointmentController::class, 'save_invest_result'])->name('save_invest_result');
        //load_exist_appointment_details
        Route::post('load_exist_appointment_details', [AppointmentController::class, 'load_exist_appointment_details'])->name('load_exist_appointment_details');
        //record_appointment
        Route::post('record_appointment', [AppointmentController::class, 'record_appointment'])->name('record_appointment');
        //load_frequency_appoi
        Route::get('load_frequency_appoi', [AppointmentController::class, 'load_frequency_appoi'])->name('load_frequency_appoi');
        //load_unit_appoi
        Route::get('load_unit_appoi', [AppointmentController::class, 'load_unit_appoi'])->name('load_unit_appoi');
        //load_result_bodyHistory
        Route::post('load_result_bodyHistory', [AppointmentController::class, 'load_result_bodyHistory'])->name('load_result_bodyHistory');

        //load_dosage_page
        Route::get('load_dosage_page', [DosageController::class, 'load_dosage_page'])->name('load_dosage_page');
        //load_Dosage_unit_list
        Route::get('load_Dosage_unit_list', [DosageController::class, 'load_Dosage_unit_list'])->name('load_Dosage_unit_list');
        //active_dosage_list
        Route::post('active_dosage_list', [DosageController::class, 'active_dosage_list'])->name('active_dosage_list');
        //inactive_dosage_list
        Route::post('inactive_dosage_list', [DosageController::class, 'inactive_dosage_list'])->name('inactive_dosage_list');
        //save_new_dosage_unit
        Route::post('save_new_dosage_unit', [DosageController::class, 'save_new_dosage_unit'])->name('save_new_dosage_unit');
        //update_new_dosage_unit
        Route::post('update_new_dosage_unit', [DosageController::class, 'update_new_dosage_unit'])->name('update_new_dosage_unit');

        //load_frequency_page
        Route::get('load_frequency_page', [FrequencyController::class, 'load_frequency_page'])->name('load_frequency_page');
        //load_frequency_list
        Route::get('load_frequency_list', [FrequencyController::class, 'load_frequency_list'])->name('load_frequency_list');
        //active_frequency
        Route::post('active_frequency', [FrequencyController::class, 'active_frequency'])->name('active_frequency');
        //inactive_frequency
        Route::post('inactive_frequency', [FrequencyController::class, 'inactive_frequency'])->name('inactive_frequency');
        //save_new_frequency
        Route::post('save_new_frequency', [FrequencyController::class, 'save_new_frequency'])->name('save_new_frequency');
        //update_frequency
        Route::post('update_frequency', [FrequencyController::class, 'update_frequency'])->name('update_frequency');
    });
    

    Route::middleware(['role:0,1,2'])-> group(function () {
        //------------CASHIER APPOINTMENT-------------

        // load_cashier_dashboard
        Route::get('load_cashier_dashboard', [DashboardController::class, 'load_cashier_dashboard'])->name('load_cashier_dashboard');

        //cashier_appointment_page
        Route::get('cashier_appointment_page', [CashierAppointmentController::class, 'cashier_appointment_page'])->name('cashier_appointment_page');
        //next_app_number
        Route::get('next_app_number',[CashierAppointmentController::class, 'next_app_number'])->name('next_app_number');
        //load_patient_select_grid
        Route::get('load_patient_select_grid', [CashierAppointmentController::class, 'load_patient_select_grid'])->name('load_patient_select_grid');
        //save_patient_in_oppointment
        Route::post('save_patient_in_oppointment', [CashierAppointmentController::class, 'save_patient_in_oppointment'])->name('save_patient_in_oppointment');
        //load_opdqueue_grid
        Route::get('load_opdqueue_grid', [CashierAppointmentController::class, 'load_opdqueue_grid'])->name('load_opdqueue_grid');
        //save_oppointment
        Route::post('save_oppointment', [CashierAppointmentController::class, 'save_oppointment'])->name('save_oppointment');
        //cancel_appointment
        Route::post('cancel_appointment', [CashierAppointmentController::class, 'cancel_appointment'])->name('cancel_appointment');
        // send_sms_to_appointment
        Route::post('send_sms_to_appointment', [CashierAppointmentController::class, 'send_sms_to_appointment'])->name('send_sms_to_appointment');

        //load_complete_page
        Route::get('load_complete_page', [CompleteAppController::class, 'load_complete_page'])->name('load_complete_page');
        //load_complete_appointment
        Route::get('load_complete_appointment', [CompleteAppController::class, 'load_complete_appointment'])->name('load_complete_appointment');
        //appointment
        Route::get('appointment/{size}/{appointment_id}', [CompleteAppController::class, 'appointment'])->name('appointment');

        //load_sales_page
        Route::get('load_sales_page', [SalesController::class, 'load_sales_page'])->name('load_sales_page');
        //load_customer_to_invoice
        Route::get('load_customer_to_invoice', [SalesController::class, 'load_customer_to_invoice'])->name('load_customer_to_invoice');
        //load_next_inv
        Route::get('load_next_inv', [SalesController::class, 'load_next_inv'])->name('load_next_inv');
        //ajax_get_debotor_accs
        Route::get('ajax_get_debotor_accs', [SalesController::class, 'ajax_get_debotor_accs'])->name('ajax_get_debotor_accs');
        //ajax_get_banks
        Route::get('ajax_get_banks', [SalesController::class, 'ajax_get_banks'])->name('ajax_get_banks');
        //ajax_get_cash_ledgers
        Route::get('ajax_get_cash_ledgers', [SalesController::class, 'ajax_get_cash_ledgers'])->name('ajax_get_cash_ledgers');
        //pay_invoice
        Route::post('pay_invoice', [SalesController::class, 'pay_invoice'])->name('pay_invoice');
        //load_sales_invoice
        Route::get('load_sales_invoice', [SalesController::class, 'load_sales_invoice'])->name('load_sales_invoice');
        //grn_invo
        Route::get('invoice/{size}/{invoice_number}', [SalesController::class, 'invoice'])->name('invoice');
        // //check_lot_available
        // Route::post('check_lot_available', [SalesController::class, 'check_lot_available'])->name('check_lot_available');

        //load_due_inv_page
        Route::get('load_due_inv_page', [DueInvController::class, 'load_due_inv_page'])->name('load_due_inv_page');
        //load_due_invoices
        Route::get('load_due_invoices', [DueInvController::class, 'load_due_invoices'])->name('load_due_invoices');
        //load_selected_due_inv_page
        Route::get('load_selected_due_inv_page/{id}', [DueInvController::class, 'load_selected_due_inv_page'])->name('load_selected_due_inv_page');
        //save_exist_dueinv
        Route::post('save_exist_dueinv', [DueInvController::class, 'save_exist_dueinv'])->name('save_exist_dueinv');
        //pay_invoice_appointment
        Route::post('pay_invoice_appointment', [DueInvController::class, 'pay_invoice_appointment'])->name('pay_invoice_appointment');
        //load_taken_prescription
        Route::post('load_taken_prescription', [DueInvController::class, 'load_taken_prescription'])->name('load_taken_prescription');
        //save_lot_to_body
        Route::post('save_lot_to_body', [DueInvController::class, 'save_lot_to_body'])->name('save_lot_to_body');
        //remove_due_inv
        Route::post('remove_due_inv', [DueInvController::class, 'remove_due_inv'])->name('remove_due_inv');
        //load_selected_due_inv_data
        Route::get('load_selected_due_inv_data/{id}', [DueInvController::class, 'load_selected_due_inv_data'])->name('load_selected_due_inv_data');
    });


    //------------PHARMACY STOCK-------------
    Route::middleware(['role:0,1,4'])-> group(function () {
        // Dashboard
        Route::get('load_stock_dashboard', [DashboardController::class, 'load_stock_dashboard'])->name('load_stock_dashboard');
        Route::get('get-lot-chart-data', [DashboardController::class, 'get_lot_chart_data'])->name('get.lot.chart.data');

        // load_monthly_sales_data_chart
        Route::get('load_sales_to_chart', [stockDashboardController::class, 'load_sales_to_chart'])->name('load_sales_to_chart');

        //load_category_page
        Route::get('load_category_page', [StockCategoryController::class, 'load_category_page'])->name('load_category_page');
        //load_stock_category_grid
        Route::get('load_stock_category_grid', [StockCategoryController::class, 'load_stock_category_grid'])->name('load_stock_category_grid');
        //save_new_category
        Route::post('save_new_category', [StockCategoryController::class, 'save_new_category'])->name('save_new_category');
        //update_stock_category
        Route::post('update_stock_category', [StockCategoryController::class, 'update_stock_category'])->name('update_stock_category');
        //active_category_from_id
        Route::post('active_category_from_id', [StockCategoryController::class, 'active_category_from_id'])->name('active_category_from_id');
        //inactive_category_from_id
        Route::post('inactive_category_from_id', [StockCategoryController::class, 'inactive_category_from_id'])->name('inactive_category_from_id');

        //load_group_page
        Route::get('load_group_page', [StockGroupController::class, 'load_group_page'])->name('load_group_page');
        //load_stock_group_grid
        Route::get('load_stock_group_grid', [StockGroupController::class, 'load_stock_group_grid'])->name('load_stock_group_grid');
        //save_new_group
        Route::post('save_new_group', [StockGroupController::class, 'save_new_group'])->name('save_new_group');
        //update_stock_group
        Route::post('update_stock_group', [StockGroupController::class, 'update_stock_group'])->name('update_stock_group');
        //active_group_from_id
        Route::post('active_group_from_id', [StockGroupController::class, 'active_group_from_id'])->name('active_group_from_id');
        //inactive_group_from_id
        Route::post('inactive_group_from_id', [StockGroupController::class, 'inactive_group_from_id'])->name('inactive_group_from_id');

        //load_stock_item_page
        Route::get('load_stock_item_page', [StockItemController::class, 'load_stock_item_page'])->name('load_stock_item_page');
        //load_stock_item_grid
        Route::get('load_stock_item_grid', [StockItemController::class, 'load_stock_item_grid'])->name('load_stock_item_grid');
        //load_supplier_to_stock
        Route::get('load_supplier_to_stock', [StockItemController::class, 'load_supplier_to_stock'])->name('load_supplier_to_stock');
        //load_category_to_stock
        Route::get('load_category_to_stock', [StockItemController::class, 'load_category_to_stock'])->name('load_category_to_stock');
        //load_group_to_stock
        Route::get('load_group_to_stock', [StockItemController::class, 'load_group_to_stock'])->name('load_group_to_stock');
        //add_pharmacy_stock_item
        Route::post('add_pharmacy_stock_item', [StockItemController::class, 'add_pharmacy_stock_item'])->name('add_pharmacy_stock_item');
        //load_next_item_code
        Route::get('load_next_item_code',[StockItemController::class, 'load_next_item_code'])->name('load_next_item_code');
        //update_pharmacy_stock_item
        Route::post('update_pharmacy_stock_item', [StockItemController::class, 'update_pharmacy_stock_item'])->name('update_pharmacy_stock_item');
        //load_stock_lot_grid
        Route::post('load_stock_lot_grid', [StockItemController::class, 'load_stock_lot_grid'])->name('load_stock_lot_grid');
        //add_phm_stock_lot
        Route::post('add_phm_stock_lot', [StockItemController::class, 'add_phm_stock_lot'])->name('add_phm_stock_lot');
        //update_phm_stock_lot
        Route::post('update_phm_stock_lot', [StockItemController::class, 'update_phm_stock_lot'])->name('update_phm_stock_lot');
        //delete_phm_stock_lot
        Route::post('delete_phm_stock_lot', [StockItemController::class, 'delete_phm_stock_lot'])->name('delete_phm_stock_lot');
        //active_item_from_id
        Route::post('active_item_from_id', [StockItemController::class, 'active_item_from_id'])->name('active_item_from_id');
        //inactive_item_from_id
        Route::post('inactive_item_from_id', [StockItemController::class, 'inactive_item_from_id'])->name('inactive_item_from_id');


        //load_stock_location_page
        Route::get('load_stock_location_page', [StockLocationController::class, 'load_stock_location_page'])->name('load_stock_location_page');
        //load_stock_location_grid
        Route::get('load_stock_location_grid', [StockLocationController::class, 'load_stock_location_grid'])->name('load_stock_location_grid');
        //save_new_location
        Route::post('save_new_location', [StockLocationController::class, 'save_new_location'])->name('save_new_location');
        //update_location
        Route::post('update_location', [StockLocationController::class, 'update_location'])->name('update_location');
        //active_location_from_id
        Route::post('active_location_from_id', [StockLocationController::class, 'active_location_from_id'])->name('active_location_from_id');
        //inactive_location_from_id
        Route::post('inactive_location_from_id', [StockLocationController::class, 'inactive_location_from_id'])->name('inactive_location_from_id');

        //load_grn_page
        Route::get('load_grn_page', [GrnController::class, 'load_grn_page'])->name('load_grn_page');
        //load_grn_grid
        Route::get('load_grn_grid', [GrnController::class, 'load_grn_grid'])->name('load_grn_grid');
        //load_stock_item_grn
        Route::get('load_stock_item_grn', [GrnController::class, 'load_stock_item_grn'])->name('load_stock_item_grn');
        //load_item_details_to_grid
        Route::post('load_item_details_to_grid', [GrnController::class, 'load_item_details_to_grid'])->name('load_item_details_to_grid');
        //save_pharma_grn
        Route::post('save_pharma_grn', [GrnController::class, 'save_pharma_grn'])->name('save_pharma_grn');
        //grn_invo
        Route::get('grn_invo/{size}/{grn_no}', [GrnController::class, 'grn_invo'])->name('grn_invo');

        //load_return_note_page
        Route::get('load_return_note_page', [ReturnNoteController::class, 'load_return_note_page'])->name('load_return_note_page');
        //load_lot_details
        Route::post('load_lot_details', [ReturnNoteController::class, 'load_lot_details'])->name('load_lot_details');
        //load_lot_price
        Route::post('load_lot_price', [ReturnNoteController::class, 'load_lot_price'])->name('load_lot_price');
        //load_stock_item_from_supplier
        Route::get('load_stock_item_from_supplier', [ReturnNoteController::class, 'load_stock_item_from_supplier'])->name('load_stock_item_from_supplier');
        //save_return_note
        Route::post('save_return_note', [ReturnNoteController::class, 'save_return_note'])->name('save_return_note');
        //load_return_note_grid
        Route::get('load_return_note_grid', [ReturnNoteController::class, 'load_return_note_grid'])->name('load_return_note_grid');
        //return_note_invo
        Route::get('return_note_invo/{size}/{return_note_id}', [ReturnNoteController::class, 'return_note_invo'])->name('return_note_invo');
    });

    // REPORTS GENERATION
    Route::middleware(['role:0,1'])-> group(function () {
        // load_current_stock_report
        Route::get('load_current_stock_report', [stockReportController::class, 'load_current_stock_report'])->name('load_current_stock_report');
        // load_stock_report_grid
        Route::get('load_stock_report_grid', [stockReportController::class, 'load_stock_report_grid'])->name('load_stock_report_grid');
        // load_stock_item_to_dropdown
        Route::get('load_stock_item_to_dropdown', [stockReportController::class, 'load_stock_item_to_dropdown'])->name('load_stock_item_to_dropdown');
        // load_supplier_to_dropdown
        Route::get('load_supplier_to_dropdown', [stockReportController::class, 'load_supplier_to_dropdown'])->name('load_supplier_to_dropdown');
        // export_stock_report_excel
        Route::get('export_stock_report_excel', [stockReportController:: class, 'export_stock_report_excel'])->name('export_stock_report_excel');
        // export_expired_lot_stock
        Route::get('export_expired_lot_stock', [stockReportController::class, 'export_expired_lot_stock'])->name('export_expired_lot_stock');



        // load_expred_stock_report
        Route::get('load_expred_stock_report', [stockReportController::class, 'load_expred_stock_report'])->name('load_expred_stock_report');
        // load_expired_report_grid
        Route::get('load_expired_report_grid', [stockReportController::class, 'load_expired_report_grid'])->name('load_expired_report_grid');
    });
});
