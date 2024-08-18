@extends('backend.layouts.app')
@section('site-title')
    {{__('Form Section')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Form Section Settings')}}</h4>
                        <form action="{{ route('admin.contact.page.form.area') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach($all_languages as $key => $lang)
                                <li class="nav-item">
                                    <a @class(['nav-link', 'active' => $loop->first]) data-bs-toggle="tab" href="#home-{{$lang->slug}}" role="tab" aria-selected="true">{{$lang->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content mt-4" id="myTabContent">
                                @foreach($all_languages as $key => $lang)
                                <div @class(['tab-pane fade', 'show active' => $loop->first]) id="home-{{$lang->slug}}" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label" for="contact_page_{{$lang->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" name="contact_page_{{$lang->slug}}_title" value="{{get_static_option('contact_page_'.$lang->slug.'_title')}}" class="form-control" id="contact_page_{{$lang->slug}}_title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="contact_page_{{$lang->slug}}_sub_title">{{__('Sub Title')}}</label>
                                        <input type="text" name="contact_page_{{$lang->slug}}_sub_title" value="{{get_static_option('contact_page_'.$lang->slug.'_sub_title')}}" class="form-control" id="contact_page_{{$lang->slug}}_sub_title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="contact_page_{{$lang->slug}}_submit_btn_text">{{__('Submit Button Text')}}</label>
                                        <input type="text" name="contact_page_{{$lang->slug}}_submit_btn_text" value="{{get_static_option('contact_page_'.$lang->slug.'_submit_btn_text')}}" class="form-control" id="contact_page_{{$lang->slug}}_submit_btn_text">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="contact_page_{{$lang->slug}}_reset_btn_text">{{__('Reset Button Text')}}</label>
                                        <input type="text" name="contact_page_{{$lang->slug}}_reset_btn_text" value="{{get_static_option('contact_page_'.$lang->slug.'_reset_btn_text')}}" class="form-control" id="contact_page_{{$lang->slug}}_reset_btn_text">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="contact_page_receiving_mail">{{__('Contact Form Mail')}}</label>
                                <input type="text" name="contact_page_receiving_mail" value="{{get_static_option('contact_page_receiving_mail')}}" class="form-control" id="contact_page_receiving_mail">
                                <span class="info-text">{{__('you will get mail to this address. when anyone submit contact form.')}}</span>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
