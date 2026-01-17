<div class="page-content">
	<!--section-->
	<div class="section page-content-first">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 aside">
					<div class="blog-post blog-post-single">
						<div class="blog-post-info">
							<div class="post-date">{{ date("d", strtotime($post->created_at)) }}<span>{{ date("M", strtotime($post->created_at)) }}</span></div>
							<div>
								<h2 class="post-title"><a href="{{ $post->url }}">{{ $post->name }}</a></h2>
								<div class="post-meta">
									<div class="post-meta-social">
										<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"><i class="icon-facebook-logo"></i></a>
										<a target="_blank" href="https://twitter.com/share?url={{ urlencode(url()->current()) }}&text={{ $post->description }}"><i class="icon-twitter-logo"></i></a>
										<a href="javascript:window.open('https://t.me/share/url?url={{ url()->current() }}')"><i class="fa fa-telegram"></i></i></a>
										<a target="_blank" href="whatsapp://send?text={{ url()->current() }}" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
									</div>
								</div>
							</div>
						</div>

						@if($post->show_image != 0)
						<div class="post-image">
							<img src="{{ RvMedia::getImageUrl($post->image, 'post_main', false, RvMedia::getDefaultImage()) }}" alt="">
						</div>
						@endif
						<div class="post-text">
							{!! clean($post->content) !!}
								<div class="slider-gallery post-carousel js-post-carousel" style="max-height:600px">
									@if (defined('GALLERY_MODULE_SCREEN_NAME') && !empty($galleries = gallery_meta_data($post)))
										{!! render_object_gallery($galleries) !!}
									@endif
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--//section-->

</div>
