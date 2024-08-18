@extends('backend.layouts.app')
@section('site-title')
    {{__('Email Template')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Email Template")}}</h4>
                        @include('backend.partials.message')
                        @include('backend.partials.error')
                        <form action="{{route('admin.general.email.template')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="site_global_email">{{__('Global Email')}}</label>
                                <input type="text" name="site_global_email" class="form-control" value="{{get_static_option('site_global_email')}}" id="site_global_email">
                                <small class="form-text text-muted">{{ __('use your web mail here') }}</small>
                            </div>
                            <div class="form-group">
                                <label for="site_global_email_template">{{__('Email Template')}}</label>
                                <label for="site_global_email_template">{{__('Email Template')}}</label>
                                <textarea name="site_global_email_template" class="form-control editor" id="site_global_email_template" cols="30" rows="10">{{get_static_option('site_global_email_template')}}</textarea>
                                <small class="form-text text-muted">@username {{__('Will replace by username of user and')}} @company {{__('will be replaced by site title also')}} @message {{__('will be replaced by dynamically with message.')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

