@extends('backend.layouts.app')
@section('site-title')
    {{__('Page Settings')}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endpush
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Page Name & Slug Settings")}}</h4>
                        <form action="{{route('admin.general.page.settings.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    @php
                                        $pages_list = ['home_01', 'home_02', 'about', 'blog', 'contact', 'faq', 'price_plan', 'service','team','testimonial', 'portfolio'];
                                    @endphp
                                    @foreach($pages_list as $page)
                                        <div class="mb-3">
                                            <label class="form-label" for="{{$page}}_page_slug">{{__(ucfirst(str_replace('_',' ',$page)))}} {{__('Page Slug')}}</label>
                                            <input type="text" class="form-control" value="{{get_static_option($page.'_page_slug',\Illuminate\Support\Str::slug($page))}}" name="{{$page}}_page_slug" placeholder="{{__('Slug')}}">
                                            <small >{{__('slug example:')}} {{$page}}</small>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-lg-6">
                                    <nav >
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            @foreach($all_languages as $key => $lang)
                                                <a class="nav-item nav-link {{ $loop->first ? 'active' : '' }}" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                            @endforeach
                                        </div>
                                    </nav>
                                    <div class="tab-content mt-4" id="nav-tabContent">
                                        @foreach($all_languages as $key => $lang)
                                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                                <div class="accordion-wrapper">
                                                    <div id="accordion-{{$lang->slug}}">
                                                        @foreach($pages_list as $page)
                                                        <div class="card">
                                                            <div class="card-header" id="{{$page}}_page_{{$lang->slug}}">
                                                                <h5 class="mb-0">
                                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#{{$page}}_page_content_{{$lang->slug}}" aria-expanded="true">
                                                                        <span class="page-title">
                                                                            {{ get_static_option($page.'_page_'.$lang->slug.'_name') ?: __(ucfirst(str_replace('_', ' ', $page))) }}
                                                                        </span>
                                                                    </button>
                                                                </h5>
                                                            </div>
                                                            <div id="{{$page}}_page_content_{{$lang->slug}}" class="collapse" data-parent="#accordion-{{$lang->slug}}">
                                                                <div class="card-body">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="{{$page}}_page_{{$lang->slug}}_name">{{__('Name')}}</label>
                                                                        <input type="text" class="form-control" name="{{$page}}_page_{{$lang->slug}}_name" value="{{ get_static_option($page.'_page_'.$lang->slug.'_name') ?: __(ucfirst(str_replace('_', ' ', $page))) }}" placeholder="{{__('Name')}}">
                                                                    </div>
                                                                    <div class="mb-3 margin-top-20">
                                                                        <label class="form-label" for="{{$page}}_page_{{$lang->slug}}_meta_tags">{{__('Meta Tags')}}</label>
                                                                        <input type="text" name="{{$page}}_page_{{$lang->slug}}_meta_tags" class="form-control" data-role="tagsinput" value="{{get_static_option($page.'_page_'.$lang->slug.'_meta_tags')}}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="about_page_{{$lang->slug}}_meta_description">{{__('Meta Description')}}</label>
                                                                        <textarea name="{{$page}}_page_{{$lang->slug}}_meta_description" class="form-control" rows="5">{{get_static_option($page.'_page_'.$lang->slug.'_meta_description')}}</textarea>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="{{$page}}_page_{{$lang->slug}}_header" class="form-label">{{ __('Header Variant') }}</label>
                                                                        <select name="{{$page}}_page_{{$lang->slug}}_header" id="" class="form-select">
                                                                            <option value="">{{ __('Select Header') }}</option>
                                                                            <option value="01" @selected(get_static_option("{$page}_page_{$lang->slug}_header") == "01")>{{ __('Header One') }}</option>
                                                                            <option value="02" @selected(get_static_option("{$page}_page_{$lang->slug}_header") == "02")>{{ __('Header Two') }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="{{$page}}_page_{{$lang->slug}}_footer" class="form-label">{{ __('Footer Variant') }}</label>
                                                                        <select name="{{$page}}_page_{{$lang->slug}}_footer" id="" class="form-select">
                                                                            <option value="">{{ __('Select Footer') }}</option>
                                                                            <option value="01" @selected(get_static_option("{$page}_page_{$lang->slug}_footer") == "01")>{{ __('Footer One') }}</option>
                                                                            <option value="02" @selected(get_static_option("{$page}_page_{$lang->slug}_footer") == "02")>{{ __('Footer Two') }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                @php
                                                                                    $page_image = get_static_option($page . '_page_image');
                                                                                @endphp
                                                                                @if($page_image)
                                                                                    <img src="{{ asset($page_image) }}" alt="{{$page}}" class="image-preview-container max-height-img" id="{{$page}}_image_preview">
                                                                                @else
                                                                                    <img id="{{$page}}_image_preview" src="{{ asset(get_placeholder_image_path('GeneralSetting')) }}" alt="Meta Image" class="image-preview-container max-height-img">
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="{{$page}}_image" class="form-label">{{ __('Meta Photo') }}</label>
                                                                                <input type="file" class="form-control" id="{{$page}}_image" name="{{$page}}_image[]" onchange="previewImage(this, '{{$page}}_image_preview')">
                                                                                <div class="form-text">{{__('Recommended image size 1920x1280')}}</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="mb-3">
                                                                                @php
                                                                                    $page_banner_image = get_static_option($page . '_page_banner_image');
                                                                                @endphp
                                                                                @if($page_banner_image)
                                                                                    <img src="{{ asset($page_banner_image) }}" alt="{{$page}}" class="image-preview-container max-height-img" id="{{$page}}_banner_image_preview">
                                                                                @else
                                                                                    <img id="{{$page}}_banner_image_preview" src="{{ asset(get_placeholder_image_path('GeneralSetting')) }}" alt="Banner Image" class="image-preview-container max-height-img">
                                                                                @endif
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="{{$page}}_banner_image" class="form-label">{{ __('Page Banner Photo') }}</label>
                                                                                <input type="file" class="form-control" id="{{$page}}_banner_image" name="{{$page}}_banner_image[]" onchange="previewImage(this, '{{$page}}_banner_image_preview')">
                                                                                <div class="form-text">{{__('Recommended image size 1920x1280')}}</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script >
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#' + previewId).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
