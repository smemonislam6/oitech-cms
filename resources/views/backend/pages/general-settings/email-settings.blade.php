@extends('backend.layouts.app')
@section('site-title')
    {{__('Email Message Settings')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Email Message Settings")}}</h4>
                        @include('backend.partials.message')
                        @include('backend.partials.error')
                        <form action="{{route('admin.general.email.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <nav >
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content mt-4" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="mb-3">
                                            <label for="contact_mail_{{$lang->slug}}_success_message">{{__('Contact Mail Success Message')}}</label>
                                            <input type="text" name="contact_mail_{{$lang->slug}}_success_message" class="form-control" value="{{get_static_option('contact_mail_'.$lang->slug.'_success_message')}}" id="contact_mail_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when any one contact you via contact page form.')}}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
