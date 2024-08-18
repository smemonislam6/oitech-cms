@extends('backend.layouts.app')
@section('site-title')
    {{__('Cookie Consent')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Cookie Consent Settings")}}</h4>
                        <form action="{{route('admin.general.cookie.settings')}}" method="POST" enctype="multipart/form-data">
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
                                            <label class="form-label" for="general_cookie_{{$lang}}_message">{{__('Title')}}</label>
                                            <textarea name="general_cookie_{{$lang->slug}}_message" class="form-control h_70" cols="30" rows="10">{{get_static_option('general_cookie_'.$lang->slug.'_message')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('Text Color') }}</label>
                                            <input type="text" name="general_cookie_text_color" class="form-control jscolor" value="{{ get_static_option('general_cookie_text_color') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('Background Color') }}</label>
                                            <input type="text" name="general_cookie_bg_color" class="form-control jscolor" value="{{ get_static_option('general_cookie_bg_color') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('Button Text Color') }}</label>
                                            <input type="text" name="general_cookie_button_text_color" class="form-control jscolor" value="{{ get_static_option('general_cookie_button_text_color') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('Button Background Color') }}</label>
                                            <input type="text" name="general_cookie_button_bg_color" class="form-control jscolor" value="{{ get_static_option('general_cookie_button_bg_color') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('Button Text') }}</label>
                                            <input type="text" name="general_cookie_button_text" class="form-control" value="{{ get_static_option('general_cookie_button_text') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ __('Status') }}</label>
                                            <select name="general_cookie_status" class="form-select">
                                                <option value="show" @selected(get_static_option('general_cookie_status') == 'show')>{{ __('show') }}</option>
                                                <option value="hide" @selected(get_static_option('general_cookie_status') == 'hide')>{{ __('hide') }}</option>
                                            </select>
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
@endpush