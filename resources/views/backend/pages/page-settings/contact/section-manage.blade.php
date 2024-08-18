@extends('backend.layouts.app')
@section('site-title')
    {{__('Contact Page Section Manage')}}
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
                        <h4 class="header-title">{{__('Contact Page Section Manage')}}</h4>
                        <form action="{{route('admin.contact.page.section.manage')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="contact_page_info_section_status"><strong >{{__('Contact Info Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="contact_page_info_section_status" @if(!empty(get_static_option('contact_page_info_section_status'))) checked @endif id="contact_page_info_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="contact_page_section_status"><strong >{{__('Contact Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="contact_page_section_status" @if(!empty(get_static_option('contact_page_section_status'))) checked @endif id="contact_page_section_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="contact_page_google_map_status"><strong >{{__('Google Map Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="contact_page_google_map_status" @if(!empty(get_static_option('contact_page_google_map_status'))) checked @endif id="contact_page_google_map_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

