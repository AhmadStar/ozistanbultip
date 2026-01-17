<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

<!--section clients gallery-->
<div class="section">
    <div class="container">
        <div class="title-wrap text-center">
            <div class="h-sub theme-color">{{ $shortcode->title1 }}</div>
            <h2 class="h1">{{ $shortcode->title2 }}</h2>
            <div class="h-decor"></div>
        </div>
        <p class="text-center max-900">{{ $shortcode->text }}</p>
        <div class="mt-2 mt-md-3 mt-lg-5"></div>
        <div class="sm-gallery-row row no-gutters mx-lg-15">
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-01.jpg"><img src="/storage/smile/smile-gallery-01.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-02.jpg"><img src="/storage/smile/smile-gallery-02.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-03.jpg"><img src="/storage/smile/smile-gallery-03.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-04.jpg"><img src="/storage/smile/smile-gallery-04.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-05.jpg"><img src="/storage/smile/smile-gallery-05.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-06.jpg"><img src="/storage/smile/smile-gallery-06.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-07.jpg"><img src="/storage/smile/smile-gallery-07.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-08.jpg"><img src="/storage/smile/smile-gallery-08.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-09.jpg"><img src="/storage/smile/smile-gallery-09.jpg" alt="" class="img-fluid"></span></div>
            <div class="col"><span class="gallery-popover-link" data-full="/storage/smile/hover/smile-gallery-hover-10.jpg"><img src="/storage/smile/smile-gallery-10.jpg" alt="" class="img-fluid"></span></div>
        </div>
        <div class="text-center mt-3 mt-lg-4">
            {{-- <a href="gallery.html" class="btn-link">View more smiles<i class="icon-{{$dir}}-arrow"></i></a> --}}
        </div>
    </div>
</div>
<!--//section clients gallery-->
