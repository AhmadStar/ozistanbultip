<?php

Route::group(['namespace' => 'Botble\Rendevu\Http\Controllers', 'middleware' => ['web', 'core']], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'rendevus', 'as' => 'rendevu.'], function () {
            Route::resource('', 'RendevuController')->parameters(['' => 'rendevu']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'RendevuController@deletes',
                'permission' => 'rendevu.destroy',
            ]);
        });
    });

});
