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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('senha/recuperar', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('senha/recuperar', 'Auth\ResetPasswordController@reset');
Route::get('senha/recuperar/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('senha/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'Admin\ConsultController@index')->name('admin.dashboard');

    Route::resource('paciente', 'Admin\PatientController', ['except' => ['show']]);
    Route::resource('paciente.prontuario', 'Admin\PatientRecordController', ['except' => ['show']]);
    Route::get('paciente/{patient}/prontuario/{record}/clone', 'Admin\PatientRecordController@twin')->name('paciente.prontuario.clone');
    Route::resource('convenio', 'Admin\AgreementController', ['except' => ['show']]);
    Route::resource('cid', 'Admin\CidController', ['except' => ['show']]);

    Route::resource('agenda', 'Admin\ConsultController', ['except' => ['show', 'create']]);
    Route::get('agenda/marcar/{date}/{hour}', 'Admin\ConsultController@create')->name('agenda.create');
    Route::get('agenda/{date}', 'Admin\ConsultController@index')->name('agenda.index');
    Route::get('agenda/presenca/{id}', 'Admin\ConsultController@presence')->name('agenda.presence');
});