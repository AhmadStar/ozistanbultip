<!--section why choose us-->
<div class="section">
    <div class="container">
        <div class="title-wrap text-center">
            <div class="h-sub theme-color">{{ __("See the difference")}}</div>
            <h2 class="h1">{{ __("Why Choose Us?")}}</h2>
            <div class="h-decor"></div>
        </div>
        <div class="row js-icn-carousel icn-carousel flex-column flex-sm-row text-center text-sm-left" data-slick='{"slidesToShow": 3, "responsive":[{"breakpoint": 1024,"settings":{"slidesToShow": 2}}]}'>
            <div class="col-md">
                <div class="icn-text icn-text-wmax">
                    <div class="icn-text-circle"><i class="icon-tooth2"></i></div>
                    <div>
                        <h5 class="icn-text-title">{{ $shortcode->title1 }}</h5>
                        <p>{{ $shortcode->text1 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="icn-text icn-text-wmax">
                    <div class="icn-text-circle"><i class="icon-team"></i></div>
                    <div>
                        <h5 class="icn-text-title">{{ $shortcode->title2 }}</h5>
                        <p>{{ $shortcode->text2 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="icn-text">
                    <div class="icn-text-circle"><i class="icon-dental-chair"></i></div>
                    <div>
                        <h5 class="icn-text-title">{{ $shortcode->title3 }}</h5>
                        <p>{{ $shortcode->text3 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--//section why choose us-->
