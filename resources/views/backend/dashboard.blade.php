@extends('backend.layouts.app')
@section('site-title', 'Dashboard')
@section('admin_content')
    <div class="row">
        @if(check_page_permission_by_string('Admin Manage'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-admin-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{__('Total Admin')}}</h6>
                    <h2 class="my-2">{{$total_admin}}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Blogs Manage'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-article-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{__('Total Blog')}}</h6>
                    <h2 class="my-2">{{ $total_blogs }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Testimonials'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-chat-quote-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{ __('Total Testimonial') }}</h6>
                    <h2 class="my-2">{{ $total_testimonial }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Team Members'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-primary">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-team-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{ __('Total Team Member') }}</h6>
                    <h2 class="my-2">{{ $total_team_member }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Price Plan'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-exchange-dollar-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{__('Total Price Plan')}}</h6>
                    <h2 class="my-2">{{$total_price_plan}}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('FAQ'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-question-answer-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{ __('Total FAQ') }}</h6>
                    <h2 class="my-2">{{ $total_faq }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Services'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-briefcase-4-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{__('Total Service')}}</h6>
                    <h2 class="my-2">{{ $total_services }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Brand Logos'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-primary">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-award-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{__('Total Brand')}}</h6>
                    <h2 class="my-2">{{$total_brand}}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Slider Manage'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-pink">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-slideshow-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{__('Total Slider')}}</h6>
                    <h2 class="my-2">{{ $total_sliders }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Dynamic Pages'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-purple">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-pages-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{ __('Total Page') }}</h6>
                    <h2 class="my-2">{{ $total_pages }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif

        @if(check_page_permission_by_string('Portfolios'))
        <div class="col-xxl-3 col-sm-6">
            <div class="card widget-flat text-bg-info">
                <div class="card-body">
                    <div class="float-end">
                        <i class="ri-briefcase-line widget-icon"></i>
                    </div>
                    <h6 class="text-uppercase mt-0" title="Customers">{{ __('Total Portfolio') }}</h6>
                    <h2 class="my-2">{{ $total_portfolio }}</h2>
                </div>
            </div>
        </div> <!-- end col-->
        @endif
    </div>
@endsection
