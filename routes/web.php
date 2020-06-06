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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clients','ClientsController@index')->name('clients.index');

Route::get('/clients/new','ClientsController@create')->name('clients.create');

Route::post('/clients','ClientsController@store')->name('clients.store');

Route::delete('/clients/{id}','ClientsController@destroy')->name('clients.destroy');

Route::get('/clients/{id}/edit','ClientsController@edit')->name('clients.edit');

Route::patch('/clients/{id}/','ClientsController@update')->name('clients.update');

Route::get('/loans','LoansController@index')->name('loans.index');

Route::get('/loans/new','LoansController@create')->name('loans.create');

Route::post('/loans','LoansController@store')->name('loans.store');

Route::delete('/loans/{id}','LoansController@destroy')->name('loans.destroy');

Route::get('/payments','PaymentsController@index')->name('payments.index');


//payments
Route::get('/payments/{id}','PaymentsController@create')->name('payments.create');

Route::post('/payments/{id}/','PaymentsController@store')->name('payments.store');

Route::get('/payments/{id}/pay','PaymentsController@edit')->name('payments.pay');

Route::patch('/payments/{id}/','PaymentsController@update')->name('payments.update');