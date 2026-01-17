<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

<!--section testimonials-->
<div class="section bg-grey py-0">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-sm-8 col-lg-6 mt-2 mt-lg-0 order-1 order-sm-0">
                <div class="reviews-wrap ml-auto d-flex flex-column justify-content-center">
                    <div class="title-wrap text-center text-md-right">
                        <div class="h-sub">{{ __("What People Says") }}</div>
                        <h2 class="h1">{{ __("Patient")}} <span class="theme-color">{{ __("Testimonials")}}</span></h2>
                    </div>
                    <div class="js-reviews-carousel reviews-carousel text-center text-md-right">
                        @foreach ($testimonials as $testimonial)
                            <div class="review">
                                <p class="review-text">
                                    {!! $testimonial->content !!}
                                </p>
                                <p>
                                    <span class="review-author">-{{ $testimonial->name }}</span>
                                    {{-- <span class="review-author-position">{{ $testimonial->company }}</span> --}}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-6 order-0 order-sm-1 reviews-photo">
                <img src="{{ RvMedia::getImageUrl($shortcode->image , 'default') }}" alt="{{ $testimonial->name }}">
            </div>
        </div>
    </div>
</div>
<!--//section testimonials-->
