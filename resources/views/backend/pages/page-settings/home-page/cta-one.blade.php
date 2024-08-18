@extends('backend.layouts.app')
@section('site-title')
    {{__('Call To Action Area One')}}
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
                        <h4 class="header-title">{{__('Call To Action Area One Settings')}}</h4>

                        <form action="{{route('admin.home-page.cta.one')}}" method="post" enctype="multipart/form-data">
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
                                            <label class="form-label" for="cta_one_section_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="cta_one_section_{{$lang->slug}}_title" class="form-control" value="{{get_static_option('cta_one_section_'.$lang->slug.'_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="cta_one_section_{{$lang}}_sub_title">{{__('Sub Title')}}</label>
                                            <input type="text" name="cta_one_section_{{$lang->slug}}_sub_title" class="form-control" value="{{get_static_option('cta_one_section_'.$lang->slug.'_sub_title')}}">
                                        </div>                                        
                                        <div class="mb-3">
                                            <label class="form-label" for="cta_one_section_{{$lang}}_btn_txt">{{__('Button Text')}}</label>
                                            <input type="text" name="cta_one_section_{{$lang->slug}}_btn_txt" class="form-control" value="{{get_static_option('cta_one_section_'.$lang->slug.'_btn_txt')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="cta_one_section_{{$lang}}_btn_url">{{__('Button URL')}}</label>
                                            <input type="text" name="cta_one_section_{{$lang->slug}}_btn_url" class="form-control" value="{{get_static_option('cta_one_section_'.$lang->slug.'_btn_url')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="cta_one_section_{{$lang}}_video_url">{{__('Video URL')}}</label>
                                            <input type="text" name="cta_one_section_{{$lang->slug}}_video_url" class="form-control" value="{{get_static_option('cta_one_section_'.$lang->slug.'_video_url')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                           
                            <div class="mb-3 edit">  
                                <label class="form-label d-block">{{__('Background Image')}}</label>
                                @php
                                    $leftImage = get_static_option('cta_one_bg_image');
                                @endphp    
                                @if($leftImage)
                                    <img src="{{ asset($leftImage) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                @else
                                    <img src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                @endif                          
                            </div>
                            <div class="mb-3">
                                <label for="edit_image" class="form-label">{{ __('Change Photo') }}</label>
                                <input type="file" class="form-control" id="edit_image" name="cta_one_bg_image">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

