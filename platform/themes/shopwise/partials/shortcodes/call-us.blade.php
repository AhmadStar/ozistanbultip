<!--section call us-->
<div class="section mt-7">
    <div class="container">
        <div class="banner-call">
            <div class="row no-gutters">
                <div class="col-sm-5 col-lg-4 order-2 order-sm-1 mt-3 mt-md-0 text-center text-md-right">
                    <img src="storage/general/banner-callus.jpg" alt="" class="shift-left">
                </div>
                <div class="col-sm-7 col-lg-7 d-flex align-items-center order-1 order-sm-2">
                    <div class="text-center">
                        <h2>{{__("Looking for")}} <br class="d-lg-none"> {{__("a")}} <span class="theme-color">{{__("Certified Dentist?")}}</span></h2>
                        <div class="h-decor"></div>
                        <p class="mt-sm-1 mt-lg-4 text-left text-sm-center">
                            {{ $shortcode->text }}
                        </p>
                        <div class="mt-3 mt-lg-4">
                            <a href="call:{{ theme_option('hotline') }}" class="banner-call-phone"><i class="icon-telephone"></i>{{ theme_option('hotline') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--section call us-->
