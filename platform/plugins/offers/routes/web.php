<?php

Route::group(['namespace' => 'Botble\Offers\Http\Controllers', 'middleware' => 'web'], function () {

    Route::group(['prefix' => BaseHelper::getAdminPrefix(), 'middleware' => 'auth'], function () {

        Route::group(['prefix' => 'offers', 'as' => 'offers.'], function () {
            Route::resource('', 'OffersController')->parameters(['' => 'offers']);
            Route::delete('items/destroy', [
                'as'         => 'deletes',
                'uses'       => 'OffersController@deletes',
                'permission' => 'offers.destroy',
            ]);
        });
    });

});
