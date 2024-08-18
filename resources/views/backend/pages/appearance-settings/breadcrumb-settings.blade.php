@extends('backend.layouts.app')
@section('site-title')
    {{__('Breadcrumb Settings')}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/spectrum.min.css')}}">
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
                        <h4 class="header-title">{{__('Breadcrumb Settings')}}</h4>
                        <form action="{{route('admin.breadcrumb.setting.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 edit"> 
                                @php
                                    $breadcrumb_bg = get_static_option('site_breadcrumb_bg');
                                @endphp
                                @if($breadcrumb_bg)
                                    <img src="{{ asset($breadcrumb_bg) }}" alt="Breadcrumb Background" class="image-preview-container max-height-img">
                                @else
                                    <img src="{{ asset(get_placeholder_image_path('AppearanceSetting')) }}" alt="Default Image" class="image-preview-container max-height-img">
                                @endif                         
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control" id="edit_image" name="site_breadcrumb_bg">
                                <div class="form-text">{{__('Recommended image size 1920x1280')}}</div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection