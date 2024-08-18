
<html lang="en">
<head >
<meta charset="utf-8">
<title >{{ __('404 Page') }}</title>

@include('frontend.layouts.styles')

<link rel="shortcut icon" href="{{ asset(get_static_option('general_site_favicon')) }}" type="image/x-icon" />
<link rel="icon" href="{{ asset(get_static_option('general_site_favicon')) }}" type="image/x-icon" />

<!-- Responsive -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!--[if lt IE 9]><script src="js/html5shiv.js"></script><![endif]-->
<!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body >

<div class="page-wrapper">

	<!-- Preloader -->
	<div class="preloader"></div>

	<!-- 404 Section -->
	<section class="">
		<div class="auto-container pt-120 pb-70">
			<div class="row">
				<div class="col-xl-12">
					<div class="error-page__inner">
						<div class="error-page__title-box">
							<img src="{{ get_static_option('error_404_page_image') }}" alt="{{ get_static_option('error_404_page_' . get_default_language() . '_title') }}">
							<h3 class="error-page__sub-title">{{ get_static_option('error_404_page_' . get_default_language() . '_subtitle') }}</h3>
						</div>
						<p class="error-page__text">{{ get_static_option('error_404_page_' . get_default_language() . '_title') }}</p>
						<a href="{{ get_static_option('error_404_page_' . get_default_language() . '_button_url') ?? '#' }}" class="theme-btn btn-style-one shop-now"><span class="btn-title">{{ get_static_option('error_404_page_' . get_default_language() . '_button_text') }}</span></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--End 404 Section -->

</div><!-- End Page Wrapper -->


<!-- Scroll To Top -->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

@include('frontend.layouts.scripts')
</body>
</html>
