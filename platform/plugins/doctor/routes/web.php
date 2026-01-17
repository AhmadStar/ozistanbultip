<?php

Route::group(['namespace' => 'Botble\Doctor\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'doctors', 'as' => 'doctor.'], function () {
            Route::resource('', 'DoctorController')->parameters(['' => 'doctor']);
            Route::get('create-form', [
                'as'         => 'create-form',
                'uses'       => 'DoctorController@createForm',
                'permission' => 'doctor.create-form',
            ]);
            Route::get('edit-form/{id}', [
                'as'         => 'edit-form',
                'uses'       => 'DoctorController@editForm',
                'permission' => 'doctor.edit-form',
            ]);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'DoctorController@deletes',
                'permission' => 'doctor.destroy',
            ]);
        });


    });

});
