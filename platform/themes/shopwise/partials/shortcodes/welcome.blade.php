<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

<!--section welcome-->
<div class="section">
    <div class="container pt-lg-2">
        <div class="title-wrap text-center text-md-left d-lg-none mb-lg-2">
            <div class="h-sub">{{ $shortcode->experince }}</div>
            <h2 class="h1">{{ $shortcode->welcome }}<br class="d-sm-none"> <span class="theme-color">{{ theme_option('site_title') }}</span></h2>
        </div>
        <div class="row mt-2 mt-md-3 mt-lg-0">
            <div class="col-md-6">
                <div class="title-wrap hidden d-none d-lg-block text-center text-md-left">
                    <div class="h-sub">{{ $shortcode->experince }}</div>
                    <h2 class="h1">{{ $shortcode->welcome }}<span class="theme-color"> {{ theme_option('site_title') }}</span></h2>
                </div>
                <div>
                    {!! $shortcode->text !!}
                </div>
                <div class="mt-2 mt-md-4"></div>
                <a href="/{{ $lang }}/contact" class="btn-link" data-toggle="modal" data-target="#modalBookingForm">{{ __("Booking a visit") }}<i class="icon-{{$dir}}-arrow"></i></a>
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
                <div class="video-wrap embed-responsive embed-responsive-16by9">
                    <iframe width="560" height="315" src="{{ $shortcode->youtube }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!--//section welcome-->
