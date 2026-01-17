{!! do_shortcode('[page-title title='.$service->name.' image='.theme_option("service_banner").'][/page-title]') !!}

<div class="wrapper">
    <div class="container">
        <div class="news-content">
            <div class="news-content-inner">
                <div class="News-socials-wrapper">
                    <div>
                        <div class="post-share">
                            <h5 class="title-caption">Share with:</h5>
                            <ul>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank">Facebook</a></li>
                                <li><a href="whatsapp://send?text={{ url()->current() }}" data-action="share/whatsapp/share" target="_blank">Whatsapp</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="post-content">
                    <img class="w-100 has-top-bottom" src="{{ RvMedia::getImageUrl($service->image, 'default', false, RvMedia::getDefaultImage()) }}" alt="{{ $service->name }}">
                    {!! BaseHelper::clean($service->content) !!}
                </div>
            </div>
        </div>
    </div>

</div>
