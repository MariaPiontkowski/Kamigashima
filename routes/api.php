<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(["prefix" => "patient"], function () {
    Route::get('data', 'Admin\PatientController@getPatientsData')->name('api.patient.data');
    Route::get('document', 'Admin\PatientController@getPatientsByDocument')
        ->name('api.patient.document');
});
