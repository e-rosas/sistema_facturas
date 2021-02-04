<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('insurers', 'InsurerController', ['except' => ['update']]);
    Route::resource('invoices', 'InvoiceController', ['except' => ['update']]);
    Route::resource('patients', 'PatientController');
    Route::resource('categories', 'CategoryController');
    Route::resource('items', 'ItemController');
    Route::resource('services', 'ServiceController');
    Route::resource('diagnoses', 'DiagnosisController');
    Route::patch('invoices/updatepatient', ['as' => 'invoice.updatepatient', 'uses' => 'InvoiceController@updatePatient']);
    Route::patch('invoice/update', ['as' => 'invoice.update', 'uses' => 'InvoiceController@update']);
    Route::post('invoice/services', 'DiagnosisServiceController@getInvoiceServices')->name('invoice.services');
    Route::post('invoice/diagnoses', 'InvoiceDiagnosisController@getInvoiceDiagnoses')->name('invoice.diagnoses');
    Route::post('invoice/dental', 'InvoiceController@getDentalDetails')->name('invoice.dental');
    Route::post('invoice/dental/services', 'DiagnosisServiceController@getInvoiceDentalServices')->name('invoice.dental.services');
    Route::post('invoice/dental/service', 'DiagnosisServiceController@findInvoiceDentalService')->name('dental.service');

    //Route::post('insurees/search', 'SearchPatientController@searchInsuree')->name('insurees.search');
    Route::post('patients/searchIndex', 'SearchPatientController@searchPatient')->name('patients.search');
    Route::post('patients/search', 'SearchPatientController@search')->name('patients.searchName');
    Route::post('services/search', 'SearchProductController@searchService')->name('services.search');
    Route::post('services/find', 'SearchProductController@findService')->name('services.find');
    Route::post('services/findname', 'SearchProductController@findServiceName')->name('services.findName');

    Route::post('diagnoses/search', 'SearchProductController@searchDiagnosis')->name('diagnoses.search');
    Route::post('diagnoses/find', 'SearchProductController@findDiagnosis')->name('diagnoses.find');
    //Route::post('invoices/search', 'InvoiceController@search')->name('invoices.search');
    Route::post('invoices/find', 'InvoiceController@find')->name('invoices.find');
    Route::patch('invoices/update_status', 'InvoiceController@updateStatus')->name('invoices.status');
    Route::patch('invoices/update_patient', 'InvoiceController@updatePatient')->name('invoices.patient');
    Route::patch('invoices/update_details', 'InvoiceController@updateDetails')->name('invoices.details');
    Route::post('invoices/search_number', 'InvoiceController@searchNumber')->name('invoices.searchNumber');

    Route::post('patients/find', 'SearchPatientController@findPatient')->name('patients.find');

    Route::post('files/invoice', 'InvoiceDocumentController@upload')->name('files.invoice.upload');

    Route::patch('files/invoice', 'InvoiceDocumentController@update')->name('files.invoice.update');
    Route::patch('files/patient', 'PatientDocumentController@update')->name('files.patient.update');

    Route::post('file/invoice', 'InvoiceDocumentController@find')->name('files.invoice.find');
    Route::post('file/patient', 'PatientDocumentController@find')->name('files.patient.find');

    Route::post('file/invoice/{document}', 'InvoiceDocumentController@download')->name('files.invoice.download');
    Route::post('file/patient/{document}', 'PatientDocumentController@download')->name('files.patient.download');

    Route::delete('files/invoice', 'InvoiceDocumentController@delete')->name('files.invoice.delete');
    Route::delete('files/patient', 'PatientDocumentController@delete')->name('files.patient.delete');

    Route::post('files/patient', 'PatientDocumentController@upload')->name('files.patient.upload');

    //Route::get('services/searchIndex', 'SearchProductController@searchServiceIndex')->name('services.searchIndex');

    //Route::get('items/searchIndex', 'SearchProductController@searchItemIndex')->name('items.searchIndex');

    Route::post('items/search', 'SearchProductController@searchItem')->name('items.search');
    Route::post('items/find', 'SearchProductController@findItem')->name('items.find');

    Route::post('diagnoses/find', 'SearchProductController@findDiagnosis')->name('diagnoses.find');

    Route::post('rates', 'RateController@rate')->name('rate.find');
    Route::post('rates/add', 'RateController@AddRate')->name('rate.add');

    //Route::get('updaterates', 'RateController@updateRates');

    Route::get('payments', 'PaymentController@index')->name('payments.index');
    Route::post('payments/add', 'PaymentController@store')->name('payments.store');
    Route::post('payments/find', 'PaymentController@find')->name('payments.find');
    Route::patch('payments/update', 'PaymentController@update')->name('payments.update');
    Route::delete('payments/destroy', 'PaymentController@delete')->name('payments.destroy');

    Route::get('credits', 'CreditController@index')->name('credits.index');
    Route::post('credits/add', 'CreditController@store')->name('credits.store');
    Route::post('credits/find', 'CreditController@find')->name('credits.find');
    Route::patch('credits/update', 'CreditController@update')->name('credits.update');
    Route::delete('credits/destroy', 'CreditController@delete')->name('credits.destroy');

    Route::get('calls', 'CallController@index')->name('calls.index');
    Route::post('calls/add', 'CallController@store')->name('calls.store');
    Route::post('calls/find', 'CallController@find')->name('calls.find');
    Route::patch('calls/update', 'CallController@update')->name('calls.update');
    Route::delete('calls/destroy', 'CallController@delete')->name('calls.destroy');

    Route::get('charges', 'ChargeController@index')->name('charges.index');
    Route::post('charges/add', 'ChargeController@store')->name('charges.store');
    Route::post('charges/find', 'ChargeController@find')->name('charges.find');
    Route::patch('charges/update', 'ChargeController@update')->name('charges.update');
    Route::delete('charges/destroy', 'ChargeController@delete')->name('charges.destroy');

    Route::get('letters', 'PatientLetterController@index')->name('letters.index');

    Route::post('letters/find', 'PatientLetterController@find')->name('letters.find');
    Route::patch('letters/update', 'PatientLetterController@update')->name('letters.update');
    Route::delete('letter/destroy', 'PatientLetterController@delete')->name('letters.destroy');

    //Route::post('reports/invoices', 'ReportController@personInvoicesReport')->name('reports.invoices');

    Route::patch('insurers/update', 'InsurerController@update')->name('insurers.update');
    Route::post('insurers/find', 'InsurerController@find')->name('insurers.find');

    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::post('reports/payments', 'ReportController@payments')->name('reports.payments');
    Route::post('reports/stats', 'ReportController@stats')->name('reports.stats');
    Route::get('reports', 'ReportController@index')->name('reports.index');

    Route::post('invoices/{invoice}/hospitalization', 'PDFController@hospitalization')->name('invoice.hospitalization');
    Route::post('invoices/{invoice}/categories', 'PDFController@categories')->name('invoice.categories');
    Route::post('invoices/{invoice}/pdf', 'PaymentFormController@fill')->name('invoice.pdf');
    Route::post('invoices/{invoice}/dental', 'PaymentFormController@fillDental')->name('invoice.pdf.dental');
    Route::get('patients/{patient}/letter', 'PDFController@letter')->name('patient.letter');
    Route::get('invoices/{invoice}/letter', 'PDFController@invoiceLetter')->name('invoice.letter');
    Route::get('patients/{patient}/letter/send', 'MailController@letter')->name('patient.letter.send');

    Route::post('insurees/search', 'SearchPatientController@searchInsuree')->name('insurees.search');
    Route::post('insurees/find', 'SearchPatientController@findInsuree')->name('insurees.find');

    Route::post('charts/stats', 'ReportController@invoiceStats')->name('charts.invoices');

    Route::resource('locations', 'LocationController');

    /* Route::get('/import_items', 'ImportController@getImportItems')->name('import.items');
    Route::post('/import_parse_items', 'ImportController@parseImportItems')->name('import.parse.items');
    Route::post('/import_process_items', 'ImportController@processImportItems')->name('import.process.items'); */

    /* Route::get('/import_rates', 'ImportController@getImportRates')->name('import.rates');
    Route::post('/import_parse_rates', 'ImportController@parseImportRates')->name('import.parse.rates');
    Route::post('/import_process_rates', 'ImportController@processImportRates')->name('import.process.rates'); */

    Route::get('/import_letters', 'ImportController@getImportLetters')->name('import.letters');
    Route::post('/import_parse_letters', 'ImportController@parseImportLetters')->name('import.parse.letters');
    //Route::post('/import_process_rates', 'ImportController@processImportRates')->name('import.process.rates');

    /* Route::get('/import_patients', 'ImportController@getImportPatients')->name('import.patients');
    Route::post('/import_parse_patients', 'ImportController@parseImportPatients')->name('import.parse.patients');
    Route::post('/import_process_patients', 'ImportController@processImportPatients')->name('import.process.patients');

    Route::get('/diagnosis_codes', 'DiagnosisController@updateCodes'); */
    Route::get('/update_patients_stats', 'PatientController@updateStats');
    //Route::get('/update_registered', 'InvoiceController@updateRegistered');

    Route::get('/update_insurees_phones', 'InsureeController@updateInsurerPhone');

    /* Route::get('/import_invoices', 'ImportController@getImportInvoices')->name('import.invoices');
    Route::post('/import_parse_invoices', 'ImportController@parseImportInvoices')->name('import.parse.invoices');
    Route::post('/import_process_invoices', 'ImportController@processImportInvoices')->name('import.process.invoices');

    Route::get('invoice/update_amount_due', 'InvoiceController@updateAmountDue');

    Route::get('invoice/update_services', 'InvoiceServiceController@updatePrices')->name('invoice.updateServices');
    Route::any('invoices_migrate_hm', 'InvoiceDiagnosisController@migrate')->name('invoices.migrate'); */
});