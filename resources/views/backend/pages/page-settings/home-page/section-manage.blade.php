@extends('backend.layouts.app')
@section('site-title')
    {{__('Section Manage')}}
@endsection
@section('admin_content')
<div class="col-lg-12 col-md-12">
    <div class="row">
        <div class="col-lg-12">
            @include('backend.partials.message')
            @include('backend.partials.error')
        </div>
        <div class="col-lg-12 mt-t">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Section Manage')}}</h4>
                    <form action="{{route('admin.home-page.section-manage')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="slider_section_status"><strong >{{__('Slider Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="slider_section_status" @if(!empty(get_static_option('slider_section_status'))) checked @endif id="slider_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="feature_section_one_status"><strong >{{__('Feature Section One Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="feature_section_one_status" @if(!empty(get_static_option('feature_section_one_status'))) checked @endif id="feature_section_one_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="feature_section_two_status"><strong >{{__('Feature Section Two Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="feature_section_two_status" @if(!empty(get_static_option('feature_section_two_status'))) checked @endif id="feature_section_two_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="about_section_one_status"><strong >{{__('About Section One Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="about_section_one_status" @if(!empty(get_static_option('about_section_one_status'))) checked @endif id="about_section_one_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="about_section_two_status"><strong >{{__('About Section Two Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="about_section_two_status" @if(!empty(get_static_option('about_section_two_status'))) checked @endif id="about_section_two_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="service_section_one_status"><strong >{{__('Service Section One Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="service_section_one_status" @if(!empty(get_static_option('service_section_one_status'))) checked @endif id="service_section_one_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="service_section_two_status"><strong >{{__('Service Section Two Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="service_section_two_status" @if(!empty(get_static_option('service_section_two_status'))) checked @endif id="service_section_two_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="info_banner_section_status"><strong >{{__('Info Banner Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="info_banner_section_status" @if(!empty(get_static_option('info_banner_section_status'))) checked @endif id="info_banner_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="cta_section_one_status"><strong >{{__('CTA Section One Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="cta_section_one_status" @if(!empty(get_static_option('cta_section_one_status'))) checked @endif id="cta_section_one_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="cta_section_two_status"><strong >{{__('CTA Section Two Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="cta_section_two_status" @if(!empty(get_static_option('cta_section_two_status'))) checked @endif id="cta_section_two_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="cta_section_three_status"><strong >{{__('CTA Section Three Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="cta_section_three_status" @if(!empty(get_static_option('cta_section_three_status'))) checked @endif id="cta_section_three_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="work_step_section_status"><strong >{{__('Working Step Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="work_step_section_status" @if(!empty(get_static_option('work_step_section_status'))) checked @endif id="work_step_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="fun_fact_section_status"><strong >{{__('Fun Fact Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="fun_fact_section_status" @if(!empty(get_static_option('fun_fact_section_status'))) checked @endif id="fun_fact_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="project_section_status"><strong >{{__('Project Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="project_section_status" @if(!empty(get_static_option('project_section_status'))) checked @endif id="project_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="why_choose_section_one_status"><strong >{{__('Why Choose Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="why_choose_section_one_status" @if(!empty(get_static_option('why_choose_section_one_status'))) checked @endif id="why_choose_section_one_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="why_choose_section_two_status"><strong >{{__('Why Choose Two Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="why_choose_section_two_status" @if(!empty(get_static_option('why_choose_section_two_status'))) checked @endif id="why_choose_section_two_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="testimonial_section_status"><strong >{{__('Testimonial Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="testimonial_section_status" @if(!empty(get_static_option('testimonial_section_status'))) checked @endif id="testimonial_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="team_member_section_status"><strong >{{__('Team Member Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="team_member_section_status" @if(!empty(get_static_option('team_member_section_status'))) checked @endif id="team_member_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="offer_section_status"><strong >{{__('Offer Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="offer_section_status" @if(!empty(get_static_option('offer_section_status'))) checked @endif id="offer_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="blog_section_status"><strong >{{__('Latest News Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="blog_section_status" @if(!empty(get_static_option('blog_section_status'))) checked @endif id="blog_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label" for="brand_section_status"><strong >{{__('Brand Section Show/Hide')}}</strong></label>
                                    <label class="switch">
                                        <input type="checkbox" name="brand_section_status" @if(!empty(get_static_option('brand_section_status'))) checked @endif id="brand_section_status">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

