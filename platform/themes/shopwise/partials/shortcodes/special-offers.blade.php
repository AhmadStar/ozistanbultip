<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

<!--section special offers-->
<div class="section" id="specialOffer">
    <div class="container">
        <div class="title-wrap text-center">
            <div class="h-sub theme-color">{{ $shortcode->title1 }}</div>
            <h2 class="h1">{{ $shortcode->title2 }}</h2>
            <div class="h-decor"></div>
        </div>
        <div class="special-carousel js-special-carousel row">
            @foreach ($offers as $offer)
            <div class="col-6">
                <div class="special-card">
                    <div class="special-card-photo">
                        <img src="{{ RvMedia::getImageUrl($offer->image , 'default') }}" alt="{{ $offer->name }}">
                    </div>
                    <div class="special-card-caption text-left">
                        <div class="special-card-txt1 transparent_background1">{{ $offer->name }}</div>
                        <div><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{$dir}}-arrow"></i><span>{{ __("Contact US")}}</span><i class="icon-{{$dir}}-arrow"></i></a></div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!--//section special offers-->
