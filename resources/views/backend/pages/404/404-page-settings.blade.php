@extends('backend.layouts.app')

@section('site-title')
    {{__('404 Error Page Settings')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('404 Error Pagte Settings')}}</h4>
                        <form action="{{route('admin.404.page.settings')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav >
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach( get_all_language() as $key => $value)
                                    <a @class(['nav-item nav-link', 'active' => $loop->first]) data-bs-toggle="tab" href="#nav_{{$key}}" role="tab" aria-selected="true">{{$value->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content mt-4" id="nav-tabContent">
                                @foreach( get_all_language() as $key => $value)
                                <div @class(['tab-pane fade', 'show active' => $loop->first]) id="nav_{{$key}}" role="tabpanel">
                                    <div class="mb-3">
                                        <label class="form-label" for="error_404_page_{{$value->slug}}_title">{{__('Title')}}</label>
                                        <input type="text" name="error_404_page_{{$value->slug}}_title" class="form-control" value="{{get_static_option('error_404_page_'.$value->slug.'_title')}}" id="error_404_page_{{$value->slug}}_title">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="error_404_page_{{$value->slug}}_subtitle">{{__('Subtitle')}}</label>
                                        <input type="text" name="error_404_page_{{$value->slug}}_subtitle" class="form-control" value="{{get_static_option('error_404_page_'.$value->slug.'_subtitle')}}" id="error_404_page_{{$value->slug}}_subtitle">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="error_404_page_{{$value->slug}}_button_text">{{__('Button Text')}}</label>
                                        <input type="text" name="error_404_page_{{$value->slug}}_button_text" class="form-control" value="{{get_static_option('error_404_page_'.$value->slug.'_button_text')}}" id="error_404_page_{{$value->slug}}_button_text">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="error_404_page_{{$value->slug}}_button_url">{{__('Button URL')}}</label>
                                        <input type="text" name="error_404_page_{{$value->slug}}_button_url" class="form-control" value="{{get_static_option('error_404_page_'.$value->slug.'_button_url')}}" id="error_404_page_{{$value->slug}}_button_url">
                                    </div>
                                </div>
                                @endforeach
                                <div class="mb-3 edit">
                                    @php
                                        $page_image = get_static_option('error_404_page_image');                                            
                                    @endphp
                                    @if($page_image)
                                        <img src="{{ asset($page_image) }}" alt="Error 404" class="image-preview-container max-height-img" >
                                    @else
                                        <img id="error_404_page_image_preview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                    @endif  
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">{{ __('Change Photo') }}</label>
                                    <input type="file" class="form-control" id="edit_image" name="error_404_page_image">
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

            $(document).ready(function () {

                var imgSelect = $('.img-select');
                var id = $('#header_type').val();
                imgSelect.removeClass('selected');
                $('img[data-header_type="'+id+'"]').parent().parent().addClass('selected');

                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#header_type').val($(this).data('header_type'));
                });

            })

        })(jQuery);
    </script>
@endpush
