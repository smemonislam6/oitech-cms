@php $home_page_variant = get_static_option('home_page_variant');@endphp
<div class="leftside-menu pt-2">

    <!-- Brand Logo Light -->
    <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
        <span class="logo-lg">
            <img src="{{ asset(get_static_option('general_site_dark_logo')) }}" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset(get_static_option('general_site_dark_logo')) }}" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
        <span class="logo-lg">
            <img src="{{ asset(get_static_option('general_site_dark_logo')) }}" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="{{ asset(get_static_option('general_site_dark_logo')) }}" alt="small logo">
        </span>
    </a>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">{{ __('Main') }}</li>

            <li class="side-nav-item @if(request()->is(['admin/dashboard/*'])) menuitem-active @endif">
                <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
                    <i class="ri-dashboard-3-line"></i>
                    <span >{{ __('Dashboard') }}</span>
                </a>
            </li>


            @if(check_page_permission_by_string('Admin Manage'))
            <li class="side-nav-item @if(request()->is(['admin/role/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarPages" aria-expanded="false" aria-controls="sidebarPages" class="side-nav-link">
                    <i class="ri-admin-line"></i>
                    <span >{{ __('Admin Manage') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.all.user') }}" class="{{active_menu('admin/all')}}">{{ __('All User') }}</a></li>
                        <li ><a href="{{ route('admin.user.create') }}" class="{{active_menu('admin/create')}}">{{ __('Add New') }}</a></li>
                        <li ><a href="{{route('admin.all.user.role')}}" class="{{active_menu('admin/role/all')}}">{{__('All Admin Role')}}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Users Manage'))
            <li class="side-nav-item @if(request()->is(['admin/user/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarPages2" aria-expanded="false" aria-controls="sidebarPages2" class="side-nav-link">
                    <i class="ri-shield-user-line"></i>
                    <span >{{ __('User Manage') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarPages2">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.all.frontend.user') }}" class="{{active_menu('admin/user/all')}}">{{ __('All User') }}</a></li>
                        <li ><a href="{{ route('admin.frontend.user.create') }}" class="{{active_menu('admin/user/create')}}">{{ __('Add New') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Blogs Manage'))
            <li class="side-nav-item @if(request()->is(['admin/blog/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarPages3" aria-expanded="@if(request()->is(['admin/blog/*'])) true @endif" aria-controls="sidebarPages3" class="side-nav-link">
                    <i class="ri-article-line"></i>
                    <span >{{ __('Blogs Manage') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/blog/*'])) show @endif" id="sidebarPages3">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.blog.index') }}" class="{{active_menu('admin/blog')}}">{{ __('All') }}</a></li>
                        <li ><a href="{{ route('admin.blog.create') }}" class="{{active_menu('admin/blog/create')}}">{{ __('Add New') }}</a></li>
                        <li ><a href="{{ route('admin.blog.category.index') }}" class="{{active_menu('admin/blog/category')}}">{{ __('Category') }}</a></li>
                        <li ><a href="{{ route('admin.blog.tags.index') }}" class="{{active_menu('admin/blog/tags')}}">{{ __('Tag') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Dynamic Pages'))
            <li class="side-nav-item @if(request()->is(['admin/page*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarPage" aria-expanded="@if(request()->is(['admin/price-plan/*'])) true @endif" aria-controls="sidebarPage" class="side-nav-link">
                    <i class="ri-pages-line"></i>
                    <span >{{ __('Dynamic Pages') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/page/*'])) show @endif" id="sidebarPage">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.page.index') }}" class="{{active_menu('admin/page')}}">{{__('All')}}</a></li>
                        <li ><a href="{{ route('admin.page.create') }}" class="{{active_menu('admin/page/create')}}">{{ __('Add New') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Price Plan'))
            <li class="side-nav-item @if(request()->is(['admin/price-plan/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarPages4" aria-expanded="@if(request()->is(['admin/price-plan/*'])) true @endif" aria-controls="sidebarPages4" class="side-nav-link">
                    <i class="ri-exchange-dollar-line"></i>
                    <span >{{ __('Price Plan') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/price-plan/*'])) show @endif" id="sidebarPages4">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.price-plans.index') }}" class="{{active_menu('admin/price-plans')}}">{{ __('All') }}</a></li>
                        <li ><a href="{{ route('admin.price-plans.create') }}" class="{{active_menu('admin/price-plans/create')}}">{{ __('Add New') }}</a></li>
                        <li ><a href="{{ route('admin.price-plan.categories.index') }}" class="{{active_menu('admin/price-plan/categories')}}">{{ __('Category') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Services'))
            <li class="side-nav-item @if(request()->is(['admin/services/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarPages5" aria-expanded="@if(request()->is(['admin/services/*'])) true @endif" aria-controls="sidebarPages5" class="side-nav-link">
                    <i class="ri-briefcase-4-line"></i>
                    <span >{{ __('Services') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/services/*'])) show @endif" id="sidebarPages5">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.services.index') }}" class="{{active_menu('admin/services/')}}">{{ __('All') }}</a></li>
                        <li ><a href="{{ route('admin.services.create') }}" class="{{active_menu('admin/services/create')}}">{{ __('Add New') }}</a></li>
                        <li ><a href="{{ route('admin.service-categories.index') }}" class="{{active_menu('admin/service-categories')}}">{{ __('Category') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Slider Manage'))
            <li class="side-nav-item @if(request()->is(['admin/sliders/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarSlider" aria-expanded="@if(request()->is(['admin/services/*'])) true @endif" aria-controls="sidebarSlider" class="side-nav-link">
                    <i class="ri-slideshow-line"></i>
                    <span >{{ __('Slider Manage') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/sliders/*'])) show @endif" id="sidebarSlider">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.sliders.index') }}" class="{{active_menu('admin/sliders/')}}">{{ __('All') }}</a></li>
                        <li ><a href="{{ route('admin.sliders.create') }}" class="{{active_menu('admin/sliders/create')}}">{{ __('Add New') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Newsletter Manage'))
            <li class="side-nav-item @if(request()->is(['admin/subscriber/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarSubscriber" aria-expanded="@if(request()->is(['admin/services/*'])) true @endif" aria-controls="sidebarSubscriber" class="side-nav-link">
                    <i class="ri-mail-add-line"></i>
                    <span >{{ __('Newsletter Manage') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/subscriber/*'])) show @endif" id="sidebarSubscriber">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.subscriber.index') }}" class="{{active_menu('admin/subscriber/')}}">{{ __('Subscriibe') }}</a></li>
                        <li ><a href="{{ route('admin.subscriber.send_message') }}" class="{{active_menu('admin/subscriber/send-message')}}">{{ __('Send Mail To All') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Team Members'))
            <li class="side-nav-item @if(request()->is(['admin/team-members/*'])) menuitem-active @endif">
                <a href="{{ route('admin.team-members.index') }}" class="side-nav-link">
                    <i class="ri-team-line"></i>
                    <span >{{ __('Team Members') }}</span>
                </a>
            </li>
            @endif

            @if(check_page_permission_by_string('Testimonials'))
            <li class="side-nav-item @if(request()->is(['admin/testimonials/*'])) menuitem-active @endif">
                <a href="{{ route('admin.testimonials.index') }}" class="side-nav-link">
                    <i class="ri-chat-quote-line"></i>
                    <span >{{ __('Testimonials') }}</span>
                </a>
            </li>
            @endif

            @if(check_page_permission_by_string('Portfolios'))
            <li class="side-nav-item @if(request()->is(['admin/portfolios/*'])) menuitem-active @endif">
                <a href="{{ route('admin.portfolios.index') }}" class="side-nav-link">
                    <i class="ri-briefcase-line"></i>
                    <span >{{ __('Portfolios') }}</span>
                </a>
            </li>
            @endif

            @if(check_page_permission_by_string('FAQ'))
            <li class="side-nav-item @if(request()->is(['admin/faqs/*'])) menuitem-active @endif">
                <a href="{{ route('admin.faqs.index') }}" class="side-nav-link">
                    <i class="ri-question-answer-line"></i>
                    <span >{{ __('FAQ') }}</span>
                </a>
            </li>
            @endif

            @if(check_page_permission_by_string('Brand Logos'))
            <li class="side-nav-item @if(request()->is(['admin/brands/*'])) menuitem-active @endif">
                <a href="{{ route('admin.brands.index') }}" class="side-nav-link">
                    <i class="ri-award-line"></i>
                    <span >{{ __('Brands') }}</span>
                </a>
            </li>
            @endif

            @if(check_page_permission_by_string('Page Settings'))
            <li class="side-nav-item @if(request()->is( [ 'admin/page-settings/*', 'admin/404-page-manage/*', ])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarPageSettings" aria-expanded="@if(request()->is(['admin/general-settings/*'])) true @endif" aria-controls="sidebarPageSettings" class="side-nav-link">
                    <i class="ri-settings-2-line"></i>
                    <span >{{ __('Page Settings') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/page-settings/*'])) show @endif" id="sidebarPageSettings">
                    <ul class="side-nav-second-level">
                        @if(check_page_permission_by_string('Home Page Manage'))
                        <li class="side-nav-item @if(request()->is(['admin/page-settings/home-page-01/*'])) menuitem-active @endif">
                            <a data-bs-toggle="collapse" href="#sidebarPagesHomePage" aria-expanded="@if(request()->is(['admin/page-settings/home-page-01/*'])) true @endif" aria-controls="sidebarPagesHomePage" class="side-nav-link">
                                <span >{{ __('Home Page Manage') }}</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse @if(request()->is(['admin/page-settings/home-page/*'])) show @endif" id="sidebarPagesHomePage">
                                <ul >
                                    <li ><a href="{{ route('admin.home-page.slider') }}" class="{{active_menu('admin/page-settings/slider-area')}}">{{ __('Slider Area') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.feature.one') }}" class="{{active_menu('admin/page-settings/feature-area-one')}}">{{ __('Feature Area One') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.feature.two') }}" class="{{active_menu('admin/page-settings/feature-area-two')}}">{{ __('Feature Area Two') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.about.one') }}" class="{{active_menu('admin/page-settings/about-area-one')}}">{{ __('About Area One') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.about.two') }}" class="{{active_menu('admin/page-settings/about-area-two')}}">{{ __('About Area Two') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.service.one') }}" class="{{active_menu('admin/page-settings/service-area-one')}}">{{ __('Service Area One') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.service.two') }}" class="{{active_menu('admin/page-settings/service-area-two')}}">{{ __('Service Area Two') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.info-banner') }}" class="{{active_menu('admin/page-settings/info-banner')}}">{{ __('Info Banner Area') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.cta.one') }}" class="{{active_menu('admin/page-settings/cta-area-one')}}">{{ __('Call To Action One') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.cta.two') }}" class="{{active_menu('admin/page-settings/cta-area-two')}}">{{ __('Call To Action Two') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.cta.three') }}" class="{{active_menu('admin/page-settings/cta-area-three')}}">{{ __('Call To Action Three') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.working-steps') }}" class="{{active_menu('admin/page-settings/working-steps')}}">{{ __('Working Steps') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.fun-facts') }}" class="{{active_menu('admin/page-settings/fun-facts')}}">{{ __('Fun Facts') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.portfolio') }}" class="{{active_menu('admin/page-settings/portfolio-area')}}">{{ __('Portfolio') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.why-choose.one') }}" class="{{active_menu('admin/page-settings/why-choose-area-one')}}">{{ __('Why Choose One') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.why-choose.two') }}" class="{{active_menu('admin/page-settings/why-choose-area-two')}}">{{ __('Why Choose Two') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.testimonial') }}" class="{{active_menu('admin/page-settings/testimonial-area')}}">{{ __('Testimonial') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.team') }}" class="{{active_menu('admin/page-settings/team-area')}}">{{ __('Team') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.blog') }}" class="{{active_menu('admin/page-settings/blog-area')}}">{{ __('Blog') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.offer') }}" class="{{active_menu('admin/page-settings/offer')}}">{{ __('Offer') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.brand') }}" class="{{active_menu('admin/page-settings/brand-area')}}">{{ __('Brand') }}</a></li>
                                    <li ><a href="{{ route('admin.home-page.section-manage') }}" class="{{active_menu('admin/page-settings/section-manage')}}">{{ __('Section Manage') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if(check_page_permission_by_string('Contact Page Manage'))
                        <li class="side-nav-item @if(request()->is(['admin/page-settings/contact/*'])) menuitem-active @endif">
                            <a data-bs-toggle="collapse" href="#sidebarPagesContact" aria-expanded="@if(request()->is(['admin/page-settings/contact/*'])) true @endif" aria-controls="sidebarPagesContact" class="side-nav-link">
                                <span >{{ __('Contact Page Manage') }}</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse @if(request()->is(['admin/page-settings/contact/*'])) show @endif" id="sidebarPagesContact">
                                <ul >
                                    <li ><a href="{{ route('admin.contact.info.index') }}" class="{{active_menu('admin/page-settings/contact/index')}}">{{ __('Contact Info') }}</a></li>
                                    <li ><a href="{{ route('admin.contact.page.form.area') }}" class="{{active_menu('admin/page-settings/contact/form-area')}}">{{ __('Form Area') }}</a></li>
                                    <li ><a href="{{ route('admin.contact.page.map') }}" class="{{active_menu('admin/page-settings/contact/map')}}">{{ __('Google Map Area') }}</a></li>
                                    <li ><a href="{{ route('admin.contact.page.section.manage') }}" class="{{active_menu('admin/page-settings/contact/section-manage')}}">{{ __('Setion Mangae') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        @if(check_page_permission_by_string('About Page Manage'))
                        <li class="side-nav-item @if(request()->is(['admin/page-settings/contact/*'])) menuitem-active @endif">
                            <a data-bs-toggle="collapse" href="#sidebarPagesAbout" aria-expanded="@if(request()->is(['admin/page-settings/contact/*'])) true @endif" aria-controls="sidebarPagesAbout" class="side-nav-link">
                                <span >{{ __('About Page Manage') }}</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse @if(request()->is(['admin/page-settings/contact/*'])) show @endif" id="sidebarPagesAbout">
                                <ul >
                                    <li ><a href="{{ route('admin.about.page.about') }}" class="{{active_menu('admin/page-settings/about-us')}}">{{ __('About Us Section') }}</a></li>
                                    <li ><a href="{{ route('admin.about.page.manage') }}" class="{{active_menu('admin/page-settings/about/page-manage')}}">{{ __('About Page Manage') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        @endif
                        <li ><a href="{{ route('admin.404.page.settings') }}" class="{{active_menu('admin/404-page-manage')}}">{{ __('404 Page') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('Appearance Settings'))
            <li class="side-nav-item @if(request()->is(['admin/appearance-settings/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarAppearanceSettings" aria-expanded="@if(request()->is(['admin/appearance-settings/*'])) true @endif" aria-controls="sidebarAppearanceSettings" class="side-nav-link">
                    <i class="ri-settings-2-line"></i>
                    <span >{{ __('Appearance Settings') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/appearance-settings/*'])) show @endif" id="sidebarAppearanceSettings">
                    <ul class="side-nav-second-level">
                        @if(check_page_permission_by_string('Home Variant'))
                        <li ><a href="{{ route('admin.header.settings') }}" class="{{active_menu('admin/appearance-settings/header-variant')}}">{{ __('Header Variant') }}</a></li>
                        <li ><a href="{{ route('admin.topbar.settings') }}" class="{{active_menu('admin/appearance-settings/topbar-settings')}}">{{ __('Topbar Settings') }}</a></li>
                        <li ><a href="{{ route('admin.menu') }}" class="{{active_menu('admin/appearance-settings/menu')}}">{{ __('Menus Manage') }}</a></li>
                        <li ><a href="{{ route('admin.breadcrumb.setting') }}" class="{{active_menu('admin/appearance-settings/breadcrumb-settings')}}">{{ __('Breadcumb Settings') }}</a></li>
                        <li ><a href="{{ route('admin.home.variant') }}" class="{{active_menu('admin/appearance-settings/header-home-variant')}}">{{ __('Home Variant') }}</a></li>
                        <li ><a href="{{ route('admin.footer.variant') }}" class="{{active_menu('admin/appearance-settings/footer-variant')}}">{{ __('Footer Variant') }}</a></li>
                        <li ><a href="{{ route('admin.footer.settings') }}" class="{{active_menu('admin/appearance-settings/footer.settings')}}">{{ __('Footer Settings') }}</a></li>
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission_by_string('General Settings'))
            <li class="side-nav-item @if(request()->is(['admin/general-settings/*'])) menuitem-active @endif">
                <a data-bs-toggle="collapse" href="#sidebarGeneralSettings" aria-expanded="@if(request()->is(['admin/general-settings/*'])) true @endif" aria-controls="sidebarGeneralSettings" class="side-nav-link">
                    <i class="ri-settings-2-line"></i>
                    <span >{{ __('General Settings') }}</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse @if(request()->is(['admin/general-settings/*'])) show @endif" id="sidebarGeneralSettings">
                    <ul class="side-nav-second-level">
                        <li ><a href="{{ route('admin.general.site.identity') }}" class="{{active_menu('admin/general-settings/site-identity')}}">{{ __('Site Identity') }}</a></li>
                        <li ><a href="{{ route('admin.general.page.settings') }}" class="{{active_menu('admin/general-settings/page-settings')}}">{{ __('Page Settings') }}</a></li>
                        <li ><a href="{{ route('admin.general.google.recaptcha') }}" class="{{active_menu('admin/general-settings/google-rechptcha')}}">{{ __('Google Recaptcha') }}</a></li>
                        <li ><a href="{{ route('admin.general.email.template') }}" class="{{active_menu('admin/general-settings/email-template')}}">{{ __('Email Template') }}</a></li>
                        <li ><a href="{{ route('admin.general.email.settings') }}" class="{{active_menu('admin/general-settings/email-settings')}}">{{ __('Email Message Settings') }}</a></li>
                        <li ><a href="{{ route('admin.general.cookie.settings') }}" class="{{active_menu('admin/general-settings/cookie-settings')}}">{{ __('Cookie Consent Settings') }}</a></li>
                        <li ><a href="{{ route('admin.general.preloader.settings') }}" class="{{active_menu('admin/general-settings/preloader-settings')}}">{{ __('Preloader Settings') }}</a></li>
                        <li ><a href="{{ route('admin.general.seo.settings') }}" class="{{active_menu('admin/general-settings/seo-settings')}}">{{ __('SEO Settings') }}</a></li>
                    </ul>
                </div>
            </li>
            @endif

            @if(check_page_permission('languages'))
            <li class="side-nav-item @if(request()->is(['admin/languages/*'])) menuitem-active @endif">
                <a href="{{ route('admin.languages') }}" class="side-nav-link">
                    <i class="ri-global-line"></i>
                    <span >{{ __('Languages') }}</span>
                </a>
            </li>
            @endif
        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
