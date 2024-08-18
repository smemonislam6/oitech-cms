@extends('backend.layouts.app')
@section('site-title')
    {{__('Sliders')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <form action="{{route('admin.sliders.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="header-wrap">
                                <h4 class="header-title">{{__('New Sliders')}}</h4>
                            </div>
                                <div class="mb-3">
                                    <label class="form-label" for="languages">{{__('Languages')}}</label>
                                    <select name="lang" class="form-control" id="languages">
                                        @foreach($all_languages as $lang)
                                            <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="title">{{__('Title')}}</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="sub_title">{{__('Sub Title')}}</label>
                                    <input type="text" class="form-control" id="sub_title" name="sub_title">
                                </div>
                                <div class="mb-3">
                                    <label for="btn_text" class="form-label">{{ __('Button Text') }}</label>
                                    <input type="text" class="form-control" id="btn_text" name="btn_text">
                                </div>
                                <div class="mb-3">
                                    <label for="btn_url" class="form-label">{{ __('Button URL') }}</label>
                                    <input type="text" class="form-control" id="btn_url" name="btn_url">
                                </div>
                                <div class="mb-3 add">
                                    <img src="{{ asset(get_placeholder_image_path('Slider')) }}" alt="Default Image" class="image-preview-container max-height-img">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="image">{{__('Image')}}</label>
                                    <input type="file" class="form-control" id="add_image" name="image">
                                    <div class="form-text">{{__('Recommended image size 1920x1280')}}</div>
                                </div>
                                <div class="mb-3 edit">
                                    <label for="slider_float_image" class="form-label d-block">{{__('Float Image')}}</label>
                                    <img src="{{ asset(get_placeholder_image_path('Slider')) }}" alt="Default Image" class="image-preview-container max-height-img">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_image" class="form-label">{{ __('Change Photo') }}</label>
                                    <input type="file" class="form-control" id="edit_image" name="slider_float_image">
                                </div>
                            <button type="submit" class="btn btn-primary ms-1">{{__('Add Slider')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
