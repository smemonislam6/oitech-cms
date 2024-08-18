@extends('backend.layouts.app')
@section('site-title')
    {{__('Footer Color Settings')}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/select2/css/select2.min.css')}}">
@endpush
@section('admin_content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">

        <form action="{{ route('admin.footer.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">{{__('About Area Settings')}}</h4>
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
                                            <label class="form-label" for="footer_widget_{{$lang->slug}}_description">{{__('Description')}}</label>
                                            <textarea name="footer_widget_{{$lang->slug}}_description" class="form-control" id="footer_widget_{{$lang->slug}}_description" cols="4" rows="5">{{get_static_option('footer_widget_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="footer_widget_{{$lang->slug}}_button_text">{{__('Button Text')}}</label>
                                            <input type="text" name="footer_widget_{{$lang->slug}}_button_text" class="form-control" id="footer_widget_{{$lang->slug}}_button_text" value="{{get_static_option('footer_widget_'.$lang->slug.'_button_text')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="footer_widget_{{$lang->slug}}_button_url">{{__('Button URL')}}</label>
                                            <input type="text" name="footer_widget_{{$lang->slug}}_button_url" class="form-control" id="footer_widget_{{$lang->slug}}_button_url" value="{{get_static_option('footer_widget_'.$lang->slug.'_button_url')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="footer_widget_{{$lang->slug}}_service_title">{{__('Service Title')}}</label>
                                            <input type="text" name="footer_widget_{{$lang->slug}}_service_title" class="form-control" id="footer_widget_{{$lang->slug}}_service_title" value="{{get_static_option('footer_widget_'.$lang->slug.'_service_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="footer_widget_{{$lang->slug}}_link_title">{{__('Useful Links')}}</label>
                                            <input type="text" name="footer_widget_{{$lang->slug}}_link_title" class="form-control" id="footer_widget_{{$lang->slug}}_link_title" value="{{get_static_option('footer_widget_'.$lang->slug.'_link_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="footer_widget_{{$lang->slug}}_newsletter_title">{{__('Newsletter')}}</label>
                                            <input type="text" name="footer_widget_{{$lang->slug}}_newsletter_title" class="form-control" id="footer_widget_{{$lang->slug}}_newsletter_title" value="{{get_static_option('footer_widget_'.$lang->slug.'_newsletter_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="footer_widget_{{$lang->slug}}_newsletter_description">{{__('Newsletter Description')}}</label>
                                            <textarea name="footer_widget_{{$lang->slug}}_newsletter_description" class="form-control" id="footer_widget_{{$lang->slug}}_description" cols="4" rows="5">{{get_static_option('footer_widget_'.$lang->slug.'_newsletter_description')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Service Items')}}</label>
                                <select name="service_items_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple">
                                    @php
                                        $serviceItems = 'service_items_' . get_static_option('home_page_variant') . '_id';
                                        $serviceItems = json_decode(get_static_option($serviceItems), true) ?? [];
                                    @endphp
                                    @foreach ($all_services as $item)
                                        <option value="{{ $item->id }}" @selected(in_array($item->id, $serviceItems))>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Useful Link')}}</label>
                                    @php
                                        $linkItems = 'link_items_' . get_static_option('home_page_variant') . '_id';
                                        $linkItems = json_decode(get_static_option($linkItems), true) ?? [];
                                    @endphp
                                <select name="link_items_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple">
                                    @foreach ($all_pages as $slug => $page)
                                        <option value="{{ Str::slug($slug) }}" @selected(in_array($slug, $linkItems))>{{ ucwords($page) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3 edit">
                                        <label for="footer_logo" class="form-label d-block">{{__('Footer Logo')}}</label>
                                        @php
                                            $footer_logo = get_static_option('footer_logo');
                                        @endphp
                                        @if($footer_logo)
                                            <img src="{{ asset($footer_logo) }}" alt="Default Background" class="image-preview-container max-width-img">
                                        @else
                                            <img src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-width-img">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control" id="edit_image" name="footer_logo">
                                        <div class="form-text">{{__('Recommended image size 150x40')}}</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 add">
                                        <label for="footer_bg" class="form-label d-block">{{__('Footer Background Image')}}</label>
                                        @php
                                            $footer_bg = get_static_option('footer_bg');
                                        @endphp
                                        @if($footer_bg)
                                            <img src="{{ asset($footer_bg) }}" alt="Default Background" class="image-preview-container max-height-img">
                                        @else
                                            <img src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="add_image" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control" id="add_image" name="footer_bg">
                                        <div class="form-text">{{__('Recommended image size 1920x1280')}}</div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
