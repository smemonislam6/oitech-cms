@extends('backend.layouts.app')
@section('site-title')
    {{__('About Area Two')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('About Area Two Settings')}}</h4>

                        <form action="{{route('admin.home-page.about.two')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav >
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a @class(['nav-item nav-link', 'active' => $loop->first]) id="nav-home-tab" data-bs-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content mt-4" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div @class(['tab-pane fade', 'show active' => $loop->first]) id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="mb-3">
                                            <label class="form-label" for="about_section_two_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="about_section_two_{{$lang->slug}}_title" class="form-control" value="{{get_static_option('about_section_two_'.$lang->slug.'_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="about_section_two_{{$lang}}_sub_title">{{__('Sub Title')}}</label>
                                            <input type="text" name="about_section_two_{{$lang->slug}}_sub_title" class="form-control" value="{{get_static_option('about_section_two_'.$lang->slug.'_sub_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="about_section_two_{{$lang}}_description">{{__('Description')}}</label>
                                            <textarea name="about_section_two_{{$lang->slug}}_description" id="about_section_two_{{$lang->slug}}_desciption" class="form-control editor" cols="30" rows="10">{{get_static_option('about_section_two_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label" for="about_section_two_{{$lang}}_progress_title">{{__('Progress Title')}}</label>
                                                    <input type="text" name="about_section_two_{{$lang->slug}}_progress_title" class="form-control" value="{{get_static_option('about_section_two_'.$lang->slug.'_progress_title')}}">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label" for="about_section_two_{{$lang}}_rating">{{__('Rating')}}</label>
                                                    <input type="text" name="about_section_two_{{$lang->slug}}_rating" class="form-control" value="{{get_static_option('about_section_two_'.$lang->slug.'_rating')}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="form-label" for="about_section_two_{{$lang}}_name">{{__('Founder Name')}}</label>
                                                    <input type="text" name="about_section_two_{{$lang->slug}}_name" class="form-control" value="{{get_static_option('about_section_two_'.$lang->slug.'_name')}}">
                                                </div>
                                                <div class="col">
                                                    <label class="form-label" for="about_section_two_{{$lang}}_designation">{{__('Designation')}}</label>
                                                    <input type="text" name="about_section_two_{{$lang->slug}}_designation" class="form-control" value="{{get_static_option('about_section_two_'.$lang->slug.'_designation')}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block" for="icon">{{__('Icon')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="{{get_static_option('about_section_two_icon') ?? 'fas fa-exclamation-triangle'}}" data-bs-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="icon" value="{{get_static_option('about_section_two_icon') ?? 'fas fa-exclamation-triangle'}}" name="about_section_two_icon">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 edit_4">         
                                        <label for="about_two_founder_image" class="form-label d-block">{{__('Founder Image')}}</label>
                                        @php
                                            $founderImage = get_static_option('about_two_founder_image');
                                        @endphp                                             
                                        @if($founderImage)
                                            <img id="FounderImagePreview" src="{{ asset($founderImage) }}" alt="Default Background" class="image-preview-container max-height-img">
                                        @else
                                            <img id="FounderImagePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                        @endif                             
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_4" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control" id="edit_image_4" name="about_two_founder_image">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 edit_1">  
                                        <label for="about_two_image_one" class="form-label d-block">{{__('Image One')}}</label>
                                        @php
                                            $imageOne = get_static_option('about_two_image_one');
                                        @endphp    
                                        @if($imageOne)
                                            <img id="bgImagePreview" src="{{ asset($imageOne) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                        @else
                                            <img id="bgImagePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                        @endif                                                    
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_1" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control edit_image" id="edit_image_1" name="about_two_image_one">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 edit_2">  
                                        <label for="about_two_image_two" class="form-label d-block">{{__('Image Two')}}</label>
                                        @php
                                            $imageTwo = get_static_option('about_two_image_two');
                                        @endphp    
                                        @if($imageTwo)
                                            <img id="bgShapePreview" src="{{ asset($imageTwo) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                        @else
                                            <img id="bgShapePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                        @endif                                                    
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_2" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control edit_image" id="edit_image_2" name="about_two_image_two">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3 edit_3">         
                                        <label for="about_two_float_image" class="form-label d-block">{{__('Float Image')}}</label>
                                        @php
                                            $floatImage = get_static_option('about_two_float_image');
                                        @endphp                                             
                                        @if($floatImage)
                                            <img id="floatImagePreview" src="{{ asset($floatImage) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                        @else
                                            <img id="floatImagePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                        @endif                             
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_3" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control" id="edit_image_3" name="about_two_float_image">
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

@push('scripts')
    <script >
        (function($){
            "use strict";
            
            function previewImage(input, previewId) {
                var file = input.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + previewId).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

            $('#edit_image_1').change(function() {
                previewImage(this, 'bgImagePreview');
            });

            $('#edit_image_2').change(function() {
                previewImage(this, 'bgShapePreview');
            });

            $('#edit_image_3').change(function() {
                previewImage(this, 'floatImagePreview');
            });

            $('#edit_image_4').change(function() {
                previewImage(this, 'FounderImagePreview');
            });

                
            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });
            
        })(jQuery);
    </script>
@endpush