<?php
    $lang = app()->getLocale();
    $dir = app()->getLocale() == 'ar' ? $dir = "left" : "right";
?>


<!--section services-->
<div class="section">
    <div class="container-fluid px-0">
        <div class="title-wrap text-center">
            <div class="h-sub theme-color">{{ __("What we offer") }}</div>
            <h2 class="h1">{{ __("General Services") }}</h2>
            <div class="h-decor"></div>
        </div>
        <div class="row no-gutters services-box-wrap services-box-wrap-desktop">
            <div class="col-4 order-1">
                <div class="service-box-rotator js-service-box-rotator">
                    <div class="service-box service-box-greybg service-box--hiddenbtn">
                        <div class="service-box-caption text-center">
                            <div class="service-box-icon"><i class="icon-icon-whitening"></i></div>
                            <div class="service-box-icon-bg"><i class="icon-icon-whitening"></i></div>
                            <h3 class="service-box-title">{{ __("Cosmetic Dentistry") }}</h3>
                            <p>{{__("Cosmetic dentistry is concerned with the appearance of teeth and the enhancement of a person's smile")}}</p>
                            <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                        </div>
                    </div>
                    <div class="service-box service-box-greybg service-box--hiddenbtn">
                        <div class="service-box-caption text-center">
                            <div class="service-box-icon"><i class="icon-icon-orthodontics"></i></div>
                            <div class="service-box-icon-bg"><i class="icon-icon-orthodontics"></i></div>
                            <h3 class="service-box-title">{{ __("Orthodontics")}}</h3>
                            <p>{{ __("Diagnosis and treatment of improper bites")}}
                                <br>{{ __("and irregularity of teeth")}}</p>
                            <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 order-2">
                <div class="service-box">
                    <div class="service-box-image" data-bg="storage/general/service-03.jpg"></div>
                    <div class="service-box-caption text-center w-50 ml-auto">
                        <h3 class="service-box-title">{{ __("General Dentistry")}}</h3>
                        <p>{{ __("General dentists provide services related to the general maintenance of oral hygiene and tooth health")}}</p>
                        <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="col-8 order-3 order-lg-4 order-xl-3">
                <div class="service-box">
                    <div class="service-box-image" data-bg="storage/general/service-04.jpg"></div>
                    <div class="service-box-caption text-center w-50 ml-auto">
                        <h3 class="service-box-title">{{ __("Children's Dentistry")}}</h3>
                        <p>{{ __("Your child will receive state-of-the-art")}}
                            <br>{{ __("oral care from our team.")}} </p>
                        <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                    </div>
                </div>
            </div>
            <div class="col-4 order-5">
                <div class="service-box-rotator js-service-box-rotator">
                    <div class="service-box service-box-greybg service-box--hiddenbtn">
                        <div class="service-box-caption text-center">
                            <div class="service-box-icon"><i class="icon-icon-implant"></i></div>
                            <div class="service-box-icon-bg"><i class="icon-icon-implant"></i></div>
                            <h3 class="service-box-title">{{ __("Dental Implants")}}</h3>
                            <p>{{ __("When teeth are lost because of disease or an accident, dental implants may be a good option")}}</p>
                            <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                        </div>
                    </div>
                    <div class="service-box service-box-greybg service-box--hiddenbtn">
                        <div class="service-box-caption text-center">
                            <div class="service-box-icon"><i class="icon-emergency"></i></div>
                            <div class="service-box-icon-bg"><i class="icon-emergency"></i></div>
                            <h3 class="service-box-title">{{ __("Dental Emergency")}}</h3>
                            <p>{{ __("Helping thousands of people each year find")}}
                                <br>{{ __("immediate dental services")}}</p>
                            <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row no-gutters services-box-wrap services-box-wrap-mobile">
            <div class="service-box-rotator js-service-box-rotator">
                <div class="service-box service-box-greybg service-box--hiddenbtn">
                    <div class="service-box-caption text-center">
                        <div class="service-box-icon"><i class="icon-icon-whitening"></i></div>
                        <div class="service-box-icon-bg"><i class="icon-icon-whitening"></i></div>
                        <h3 class="service-box-title">{{ __("Cosmetic Dentistry")}}</h3>
                        <p>{{ __("Cosmetic dentistry is concerned with the appearance of teeth and the enhancement of a person's smile")}}</p>
                        <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                    </div>
                </div>
                <div class="service-box service-box-greybg service-box--hiddenbtn">
                    <div class="service-box-caption text-center">
                        <div class="service-box-icon"><i class="icon-icon-orthodontics"></i></div>
                        <div class="service-box-icon-bg"><i class="icon-icon-orthodontics"></i></div>
                        <h3 class="service-box-title">{{ __("Orthodontics")}}</h3>
                        <p>{{ __("Diagnosis and treatment of improper bites")}}
                            <br>{{ __("and irregularity of teeth")}}</p>
                        <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                    </div>
                </div>
                <div class="service-box service-box-greybg service-box--hiddenbtn">
                    <div class="service-box-caption text-center">
                        <div class="service-box-icon"><i class="icon-icon-implant"></i></div>
                        <div class="service-box-icon-bg"><i class="icon-icon-implant"></i></div>
                        <h3 class="service-box-title">{{ __("Dental Implants")}}</h3>
                        <p>{{ __("When teeth are lost because of disease or an accident, dental implants may be a good option")}}</p>
                        <div class="btn-wrap"><a href="/{{$lang}}/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                    </div>
                </div>
                <div class="service-box service-box-greybg service-box--hiddenbtn">
                    <div class="service-box-caption text-center">
                        <div class="service-box-icon"><i class="icon-emergency"></i></div>
                        <div class="service-box-icon-bg"><i class="icon-emergency"></i></div>
                        <h3 class="service-box-title">{{ __("Dental Emergency")}}</h3>
                        <p>{{ __("Helping thousands of people each year find")}}
                            <br>{{ __("immediate dental services")}}</p>
                        <div class="btn-wrap"><a href="/contact-us" class="btn"><i class="icon-{{ $dir }}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{ $dir }}-arrow"></i></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--//section services-->
