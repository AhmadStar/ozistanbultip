<?php

Route::group(['namespace' => 'Botble\Clinic\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'clinics', 'as' => 'clinic.'], function () {
            Route::resource('', 'ClinicController')->parameters(['' => 'clinic']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'ClinicController@deletes',
                'permission' => 'clinic.destroy',
            ]);
        });
    });

});
