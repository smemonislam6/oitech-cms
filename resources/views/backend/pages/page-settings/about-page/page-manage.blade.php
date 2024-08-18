@extends('backend.layouts.app')
@section('site-title')
    {{__('About Page Section Manage')}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/select2/css/select2.min.css')}}">
@endpush
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('About Page Section Manage')}}</h4>
                        <form action="{{route('admin.about.page.manage')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="about_page_status"><strong >{{__('About Us Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="about_page_status" @if(!empty(get_static_option('about_page_status'))) checked @endif id="about_page_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="about_page_service_status"><strong >{{__('Service Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="about_page_service_status" @if(!empty(get_static_option('about_page_service_status'))) checked @endif id="about_page_service_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="about_page_testimonial_status"><strong >{{__('Testimonial Section Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="about_page_testimonial_status" @if(!empty(get_static_option('about_page_testimonial_status'))) checked @endif id="about_page_testimonial_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="title">{{__('Service Items')}}</label>
                                    <select name="service_about_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple">
                                        @php
                                            $serviceItems = 'service_about_' . get_static_option('home_page_variant') . '_id';
                                            $serviceItems = json_decode(get_static_option($serviceItems), true) ?? [];
                                        @endphp
                                        @foreach ($all_service_items as $item)
                                            <option value="{{ $item->id }}" @selected(in_array($item->id, $serviceItems))>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="title">{{__('Testimonial Items')}}</label>
                                    <select name="testimonial_about_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple">
                                        @php
                                            $testimonailItems = 'testimonial_about_' . get_static_option('home_page_variant') . '_id';
                                            $testimonailItems = json_decode(get_static_option($testimonailItems), true) ?? [];
                                        @endphp
                                        @foreach ($all_testimonial_items as $item)
                                            <option value="{{ $item->id }}" @selected(in_array($item->id, $testimonailItems))>{{ $item->name }}</option>
                                        @endforeach
                                    </select>
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

@push('scripts')
    <script src="{{asset('assets/backend/vendor/select2/js/select2.min.js')}}"></script>
    <script >
        $(document).ready(function () {
            $(".select2_tags").select2({
                tags: true,
                multiple: true,
            });
        });
    </script>
@endpush
