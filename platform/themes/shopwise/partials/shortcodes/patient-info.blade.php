<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

<!--section faq-->
<div class="section bg-grey py-0">
    <div class="container-fluid px-0">
        <div class="row no-gutters">
            <div class="col-xl-6 banner-left bg-fullheight" style="background-image: url(/storage/general/banner-left.jpg)"></div>
            <div class="col-xl-6">
                <div class="faq-wrap">
                    <div class="title-wrap">
                        <h2 class="h1"><span class="theme-color">{{ __("Patient Information")}}</span></h2>
                    </div>
                    <div class="nav nav-pills" role="tablist">
                    @foreach($categories as $key => $category)
                        <a class="nav-link @if($key == 0) active @endif" data-toggle="pill" href="#tab-{{ $category->name }}" role="tab">{{ $category->name }}</a>
                    @endforeach
                    </div>
                    <div id="tab-content" class="tab-content mt-sm-1">
                        @foreach($categories as $key => $category)
                        <div id="tab-{{ $category->name }}" class="tab-pane fade @if($key == 0) active show @endif" role="tabpanel">
                            <div id="faqAccordion{{ $key }}" class="faq-accordion" data-children=".faq-item">
                                @foreach($category->faqs as $key1 => $faq)
                                <div class="faq-item">
                                    <a data-toggle="collapse" data-parent="#faqAccordion{{ $key }}" href="#faqItem{{$key}}{{$key1}}" aria-expanded="@if($key1 == 0) true @endif"><span>{{ $key1 + 1 }}.</span><span>{{ $faq->question }}</span></a>
                                    <div id="faqItem{{$key}}{{$key1}}" class="collapse @if($key1 == 0) show @endif faq-item-content" role="tabpane{{ $key1 }}">
                                        <div>
                                            <p>
                                                {!! $faq->answer !!}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <a href="/{{ $lang }}/contact-us" class="btn mt-15 mt-md-3" data-toggle="modal" data-target="#modalQuestionForm"><i class="icon-{{$dir}}-arrow"></i><span>{{ __("Contact Us")}}</span><i class="icon-{{$dir}}-arrow"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--//section faq-->
