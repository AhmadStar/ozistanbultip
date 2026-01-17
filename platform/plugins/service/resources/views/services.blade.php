{!! do_shortcode('[page-title title="Services List" image='.theme_option("service_list_banner").'][/page-title]') !!}

@if ($services->count() > 0)
    <div class="wrapper" style="margin: 100px 0px;">
        <div class="root-blog">
            <div class="container">
                <div class="cards">
                    @foreach ($services as $service)
                        <a class="card team-item" href="/service/{{ $service->slug }}">
                            <div class="card-hero">
                                <img src="{{ RvMedia::getImageUrl($service->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                    width="288" />
                            </div>
                            <div class="card-header">
                                <h3>{{ $service->name }}</h3>
                            </div>
                            <div class="card-body">
                                <p>{{ $service->description }}</p>
                            </div>
                            <div class="card-footer">
                                <div class="footer-item">
                                    <img src="{{ RvMedia::getImageUrl($service->image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                        class="avatar" width="32" height="32" />
                                </div>
                                <div class="footer-item">
                                    <span class="muted">{{ $service->created_at->translatedFormat('M d, Y') }}</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                {{-- {!! $services->links() !!} --}}

            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <p>{{ __('There is no data to display!') }}</p>
    </div>
@endif
