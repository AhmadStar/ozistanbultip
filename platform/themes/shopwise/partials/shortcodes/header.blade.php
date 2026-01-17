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
	</div>
	<!--//section-->
</div>
