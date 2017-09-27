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
    Route::get('data', 'Api\PatientApiController@getPatientsData')->name('api.patient.data');
    Route::get('document', 'Api\PatientApiController@getPatientsByDocument')
        ->name('api.patient.document');
});

Route::group(["prefix" => "agreement"], function () {
    Route::get('data', 'Api\AgreementApiController@getAgreementsData')->name('api.agreement.data');
});

