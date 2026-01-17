<?php

use Botble\Theme\Theme;

return [

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials" and "views"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => [

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function (Theme $theme)
        {

            $version = '1.19.0';

            // <!-- Vendors -->
            $theme->asset()->container('footer')->usePath()->add('jquery', '/dental/vendor/jquery/jquery-3.2.1.min.js');
            $theme->asset()->container('footer')->usePath()->add('jquery-migrate', '/dental/vendor/jquery-migrate/jquery-migrate-3.0.1.min.js');
            $theme->asset()->container('footer')->usePath()->add('jquery-cookie', '/dental/vendor/cookie/jquery.cookie.js');
            $theme->asset()->container('footer')->usePath()->add('moment', '/dental/vendor/bootstrap-datetimepicker/moment.js');
            $theme->asset()->container('footer')->usePath()->add('bootstrap-datetimepicker', '/dental/vendor/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js');
            $theme->asset()->container('footer')->usePath()->add('popper', '/dental/vendor/popper/popper.min.js');
            $theme->asset()->container('footer')->usePath()->add('bootstrap', '/dental/vendor/bootstrap/bootstrap.min.js');

            // <!-- Custom Scripts -->

           $theme->asset()->usePath()->add('style', '/dental/css/style.css');
           $theme->asset()->usePath()->add('custom', '/dental/css/custom-style.css');

            if (BaseHelper::siteLanguageDirection() == 'rtl') {
                $theme->asset()->usePath()->add('rtl-style', 'css/rtl-style.css', [], [], $version);
                $theme->asset()->usePath()->add('ar-style', '/dental/css/ar-style.css', [], [], $version);
            }

            $theme->asset()->container('footer')->usePath()->add('vue-js', '/vue/vue.js', ['jquery'], [], $version);
            $theme->asset()->container('footer')->usePath()->add('axios', '/vue/axios.min.js');

            if (function_exists('shortcode')) {
                $theme->composer(['page', 'post', 'ecommerce.product'], function (\Botble\Shortcode\View\View $view) use ($theme, $version) {
                    $theme->asset()->container('footer')->usePath()->add('app-js', 'js/app.js', ['jquery', 'carousel-js'], [], $version);
                    $view->withShortcodes();
                });
            }

            app()->booted(function () use ($theme) {
                $theme->asset()->remove('language-css');
                $theme->asset()->remove('language-public-js');
            });
        },
    ]
];
