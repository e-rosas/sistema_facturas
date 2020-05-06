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
    Route::post('invoice/services', 'InvoiceServiceController@getInvoiceServices')->name('invoice.services');
    //Route::post('insurees/search', 'SearchPatientController@searchInsuree')->name('insurees.search');
    Route::post('patients/searchIndex', 'SearchPatientController@searchPatient')->name('patients.search');
    Route::post('patients/search', 'SearchPatientController@search')->name('patients.searchName');
    Route::post('services/search', 'SearchProductController@searchService')->name('services.search');
    Route::post('services/find', 'SearchProductController@findService')->name('services.find');

    //Route::post('invoices/search', 'InvoiceController@search')->name('invoices.search');
    Route::post('invoices/find', 'InvoiceController@find')->name('invoices.find');
    Route::patch('invoices/update_status', 'InvoiceController@updateStatus')->name('invoices.status');
    Route::post('invoices/search_number', 'InvoiceController@searchNumber')->name('invoices.searchNumber');
    Route::post('patients/find', 'SearchPatientController@findPatient')->name('patients.find');
    //Route::get('services/searchIndex', 'SearchProductController@searchServiceIndex')->name('services.searchIndex');

    //Route::get('items/searchIndex', 'SearchProductController@searchItemIndex')->name('items.searchIndex');

    Route::post('items/search', 'SearchProductController@searchItem')->name('items.search');
    Route::post('items/find', 'SearchProductController@findItem')->name('items.find');

    Route::post('rates', 'RateController@rate')->name('rate.find');

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

    Route::post('insurees/search', 'SearchPatientController@searchInsuree')->name('insurees.search');

    Route::get('/import_items', 'ImportController@getImportItems')->name('import.items');
    Route::post('/import_parse_items', 'ImportController@parseImportItems')->name('import.parse.items');
    Route::post('/import_process_items', 'ImportController@processImportItems')->name('import.process.items');

    Route::get('/import_rates', 'ImportController@getImportRates')->name('import.rates');
    Route::post('/import_parse_rates', 'ImportController@parseImportRates')->name('import.parse.rates');
    Route::post('/import_process_rates', 'ImportController@processImportRates')->name('import.process.rates');

    Route::get('/import_patients', 'ImportController@getImportPatients')->name('import.patients');
    Route::post('/import_parse_patients', 'ImportController@parseImportPatients')->name('import.parse.patients');
    Route::post('/import_process_patients', 'ImportController@processImportPatients')->name('import.process.patients');

    Route::get('/import_invoices', 'ImportController@getImportInvoices')->name('import.invoices');
    Route::post('/import_parse_invoices', 'ImportController@parseImportInvoices')->name('import.parse.invoices');
    Route::post('/import_process_invoices', 'ImportController@processImportInvoices')->name('import.process.invoices');
});
