<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

<div class="page-content about">
	<!--section-->
	<div class="section page-content-first">
		<div class="container">
			<div class="text-center mb-2  mb-md-3 mb-lg-4">
				<div class="h-sub theme-color">{{ $shortcode->title1 }}</div>
				<h1>{{ $shortcode->title2 }}</h1>
				<div class="h-decor"></div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 text-center text-lg-left pr-md-4">
					<img src="{{ RvMedia::getImageUrl($shortcode->image1 , 'default') }}" class="w-100" alt="{{ $shortcode->title1 }}">
					<div class="row mt-3">
						<div class="col-6">
							<img src="{{ RvMedia::getImageUrl($shortcode->image2 , 'default') }}" class="w-100" alt="{{ $shortcode->title1 }}">
						</div>
						<div class="col-6">
							<img src="{{ RvMedia::getImageUrl($shortcode->image3 , 'default') }}" class="w-100" alt="{{ $shortcode->title1 }}">
						</div>
					</div>
				</div>
				<div class="col-lg-6 mt-3 mt-lg-0">
					{{-- <p>For nearly 16 years, our financial district dentist, Adam Smith, DDS and the dental team at DentCo Dental Clinic have provided cosmetic dentistry as well as family dentistry services. Dr. Adam understands that patients have a variety of practices in the area to choose from.</p>
					<p>Come and experience dentistry carried out a little differently in our Private Practice. A practice where you will:</p>
					<ul class="marker-list-md">
						<li>Be involved in your care and treatment choices</li>
						<li>Be welcomed and feel relaxed and cared for</li>
						<li>Appreciate the well qualified, experienced team</li>
						<li>Want the best dentistry available</li>
					</ul> --}}
                    <p>{!! theme_option('abouttext') !!}</p>

					<div class="mt-3 mt-md-7"></div>
					<h3><span class="theme-color">{{ __("Mission / Vision")}}</span></h3>
					<div class="mt-0 mt-md-4"></div>
					<p>{{ $shortcode->mission }}</p>
					<p>{{ $shortcode->vision }}</p>
				</div>
			</div>
		</div>
	</div>
	<!--//section-->
</div>
