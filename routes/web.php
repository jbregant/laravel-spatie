<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');
//

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function() {
    Route::post('/loans/loanPrinter', 'ApiController@loanPrinter');
    Route::post('/incomes/dopayment', 'ApiController@dopayment');
    Route::post('/incomes/getclientinfo', 'ApiController@getclientinfo');
    Route::get('/reports/daily', 'ReportController@daily')->name('report.daily');
    Route::post('/reports/daily/report', 'ReportController@dailyreport')->name('report.dailyreport');
    Route::get('/reports/dailyz', 'ReportController@dailyz')->name('report.dailyz');
    Route::post('/reports/dailyz/report', 'ReportController@dailyzreport')->name('report.dailyzreport');
    Route::get('/feecheck/{id}', 'ApiController@feecheck');
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    Route::resource('zones','ZoneController');
    Route::resource('collectors','CollectorController');
    Route::resource('cities','CityController');
    Route::resource('clients','ClientController');
    Route::resource('loans','LoanController');
    Route::resource('loanstype','LoanTypeController');
    Route::resource('incomes','IncomeController');
    Route::resource('settings','AppSettingController');
});
