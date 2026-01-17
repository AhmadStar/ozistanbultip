<?php

Route::group(['namespace' => 'Theme\Shopwise\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::get('ajax/products', 'ShopwiseController@ajaxGetProducts')
            ->name('public.ajax.products');

        Route::get('ajax/featured-product-categories', 'ShopwiseController@getFeaturedProductCategories')
            ->name('public.ajax.featured-product-categories');

        Route::get('ajax/trending-products', 'ShopwiseController@ajaxGetTrendingProducts')
            ->name('public.ajax.trending-products');

        Route::get('ajax/featured-brands', 'ShopwiseController@ajaxGetFeaturedBrands')
            ->name('public.ajax.featured-brands');

        Route::get('ajax/clinic-list', 'ShopwiseController@ajaxGetClinicList')
            ->name('public.ajax.clinic-list');

        Route::get('ajax/clinic-doctor-list', 'ShopwiseController@ajaxGetClinicDoctorList')
            ->name('public.ajax.clinic-doctor-list');

        Route::get('ajax/clinic-service-list', 'ShopwiseController@ajaxGetClinicServiceList')
            ->name('public.ajax.clinic-service-list');

        Route::get('ajax/clinic-data', 'ShopwiseController@ajaxGetClinicData')
            ->name('public.ajax.clinic-data');

        Route::get('ajax/doctor-appointment-list', 'ShopwiseController@ajaxGetDoctorAppointmentList')
            ->name('public.ajax.doctor-appointment-list');

        Route::get('ajax/day-appointment-list', 'ShopwiseController@ajaxGetDayAppointmentList')
            ->name('public.ajax.day-appointment-list');

        Route::get('ajax/reservation', 'ShopwiseController@ajaxReservation')
            ->name('public.ajax.reservation');

        Route::get('ajax/featured-products', 'ShopwiseController@ajaxGetFeaturedProducts')
            ->name('public.ajax.featured-products');

        Route::get('ajax/top-rated-products', 'ShopwiseController@ajaxGetTopRatedProducts')
            ->name('public.ajax.top-rated-products');

        Route::get('ajax/on-sale-products', 'ShopwiseController@ajaxGetOnSaleProducts')
            ->name('public.ajax.on-sale-products');

        Route::get('ajax/cart', 'ShopwiseController@ajaxCart')
            ->name('public.ajax.cart');

        Route::get('ajax/quick-view/{id}', 'ShopwiseController@getQuickView')
            ->name('public.ajax.quick-view');

        Route::get('ajax/featured-posts', 'ShopwiseController@ajaxGetFeaturedPosts')
            ->name('public.ajax.featured-posts');

        Route::get('ajax/testimonials', 'ShopwiseController@ajaxGetTestimonials')
            ->name('public.ajax.testimonials');

        Route::get('ajax/product-reviews/{id}', 'ShopwiseController@ajaxGetProductReviews')
            ->name('public.ajax.product-reviews');

        Route::get('ajax/get-flash-sales', 'ShopwiseController@ajaxGetFlashSales')
            ->name('public.ajax.get-flash-sales');
    });

});

Theme::routes();

Route::group(['namespace' => 'Theme\Shopwise\Http\Controllers', 'middleware' => ['web', 'core']], function () {
    Route::group(apply_filters(BASE_FILTER_GROUP_PUBLIC_ROUTE, []), function () {

        Route::get('/', 'ShopwiseController@getIndex')
            ->name('public.index');

        Route::get('sitemap.xml', 'ShopwiseController@getSiteMap')
            ->name('public.sitemap');

        Route::get('{slug?}' . config('core.base.general.public_single_ending_url'), 'ShopwiseController@getView')
            ->name('public.single');

    });

});
