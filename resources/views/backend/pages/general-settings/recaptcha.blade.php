@extends('backend.layouts.app')
@section('site-title')
    {{__('Google Recaptcha')}}
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
                        <form action="{{ route('admin.general.google.recaptcha.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('Recaptcha Site Key') }}</label>
                                    <input type="text" name="google_recaptcha_site_key" class="form-control" value="{{ get_static_option('google_recaptcha_site_key') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('Recaptcha Secret Key') }}</label>
                                    <input type="text" name="google_recaptcha_secret_key" class="form-control" value="{{ get_static_option('google_recaptcha_secret_key') }}">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('Status') }}</label>
                                    <select name="google_recaptcha_status" class="form-select">
                                        <option value="show" @selected(get_static_option('google_recaptcha_status') == 'show')>{{ __('Show') }}</option>
                                        <option value="hide" @selected(get_static_option('google_recaptcha_status') == 'hide')>{{ __('Hide') }}</option>
                                    </select>
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
