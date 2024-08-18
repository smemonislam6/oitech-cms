@extends('backend.layouts.app')
@section('site-title')
    {{__('Site Identity')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Site Identity Settings")}}</h4>
                        <form action="{{route('admin.general.site.identity')}}" method="POST" enctype="multipart/form-data">
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
                                            <label class="form-label" for="general_site_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="general_site_{{$lang->slug}}_title" class="form-control" value="{{get_static_option('general_site_'.$lang->slug.'_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="general_site_{{$lang}}_tag_line">{{__('Site Tag Line')}}</label>
                                            <input type="text" name="general_site_{{$lang->slug}}_tag_line" class="form-control" value="{{get_static_option('general_site_'.$lang->slug.'_tag_line')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="general_site_{{$lang}}_copyright">{{__('Footer Copyright')}}</label>
                                            <input type="text" name="general_site_{{$lang->slug}}_copyright" class="form-control" value="{{get_static_option('general_site_'.$lang->slug.'_copyright')}}">
                                            <div class="form-text text-muted">{{__('{copy} Will replace by &copy; and {year} will be replaced by current year.')}}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">{{ __('Layout Direction') }}</label>
                                <select name="generl_site_layout_direction" class="form-select">
                                    <option value="LTR" @selected(get_static_option('generl_site_layout_direction') == 'LTR')>{{ __('LTR') }}</option>
                                    <option value="RTL" @selected(get_static_option('generl_site_layout_direction') == 'RTL')>{{ __('RTL') }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="general_site_color">{{__('Site Color')}}</label>
                                <input type="text" name="general_site_color" class="form-control jscolor" value="{{get_static_option('general_site_color')}}">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 edit_1">
                                        <label for="general_site_logo" class="form-label d-block">{{__('Site Logo')}}</label>
                                        @php
                                            $logo = get_static_option('general_site_logo');
                                        @endphp
                                        @if($logo)
                                            <img id="logoPreview" src="{{ asset($logo) }}" alt="Default Background" class="image-preview-container max-height-img">
                                        @else
                                            <img id="logoPreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_1" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control edit_image" id="edit_image_1" name="general_site_logo">
                                        <div class="form-text">{{ __('Recommended image size 150x40') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 edit_2">
                                        <label for="general_site_dark_logo" class="form-label d-block">{{__('Admin Site Logo')}}</label>
                                        @php
                                            $logo = get_static_option('general_site_dark_logo');
                                        @endphp
                                        @if($logo)
                                            <img id="darkLogoPreview" src="{{ asset($logo) }}" alt="Default Background" class="image-preview-container max-height-img">
                                        @else
                                            <img id="darkLogoPreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_2" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control edit_image" id="edit_image_2" name="general_site_dark_logo">
                                        <div class="form-text">{{ __('Recommended image size 150x40') }}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 edit_3">
                                        <label for="general_site_favicon" class="form-label d-block">{{__('Favicon')}}</label>
                                        @php
                                            $favicon = get_static_option('general_site_favicon');
                                        @endphp
                                        @if($favicon)
                                            <img id="faviconPreview" src="{{ asset($favicon) }}" alt="Default Background" class="image-preview-container max-height-img">
                                        @else
                                            <img id="faviconPreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_3" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control edit_image" id="edit_image_3" name="general_site_favicon">
                                        <div class="form-text">{{ __('Recommended image size 60x60') }}</div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets/backend/js/jscolor.js') }}"></script>
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
                previewImage(this, 'logoPreview');
            });

            $('#edit_image_2').change(function() {
                previewImage(this, 'darkLogoPreview');
            });

            $('#edit_image_3').change(function() {
                previewImage(this, 'faviconPreview');
            });

        })(jQuery);
    </script>
@endpush
