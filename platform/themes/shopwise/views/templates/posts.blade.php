<div class="section page-content-first">
    <div class="container">
    @if ($posts->count() > 0)
        <div class="row col-equalH">
            @foreach($posts as $post)
            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-card-photo">
                        <a href="{{ $post->url }}"><img src="{{ RvMedia::getImageUrl($post->image, 'doctor', false, RvMedia::getDefaultImage()) }}" class="img-fluid" alt="{{ $post->name }}"></a>
                    </div>
                    <h5 class="service-card-name"><a href="{{ $post->url }}">{{ $post->name }}</a></h5>
                    <!-- <div class="h-decor"></div> -->
                    <p>{{ $post->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="page-pagination text-right">
            {!! $posts->links() !!}
        </div>
    @else
    <div class="alert alert-warning">
        <p>{{ __('There is no data to display!') }}</p>
    </div>
    @endif
    </div>
</div>
