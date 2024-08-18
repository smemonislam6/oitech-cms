@extends('backend.layouts.app')
@section('site-title')
    {{__('Edit Words Settings')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12 ">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                @include('backend.partials.error')
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp">
                            <h4 class="header-title">
                                {{__("Change All Words")}}
                            </h4>
                            <div class="header-title">

                                <a class="btn btn-secondary btn-sm margin-bottom-30 mr-1" href="{{ route('admin.languages')}}">  <i class="fa fa-backward" aria-hidden="true"></i> {{__('All Languages')}}</a>
                                <button class="btn btn-info btn-sm margin-bottom-30 add_new_string_btn" data-bs-toggle="modal" data-bs-target="#add_new_string_modal"> <i class="fas fa-plus mr-1"></i> {{__('Add New String')}}</button>
                            </div>
                        </div>
                        <p class="text-info margin-bottom-20">{{__('select any source text to translate it, then enter your translated text in textarea hit update')}}</p>
                        <div class="language-word-translate-box">
                            <div class="search-box-wrapper">
                                <input type="text" name="word_search" id="word_search" placeholder="{{__('Search Source Text...')}}">
                            </div>
                            <div class="top-part">
                                <div class="single-string-wrap">
                                    <div class="string-part">{{__('Source Text')}}</div>
                                    <div class="translated-part">{{__('Translation')}}</div>
                                </div>
                            </div>
                            <div class="middle-part">
                                @foreach($all_word as $key => $value)
                                    <div class="single-string-wrap">
                                        <div class="string-part" data-key="{{$key}}">{{$key}}</div>
                                        <div class="translated-part" data-trans="{{$value}}">{{$key === $value ? '' : $value}}</div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="footer-part">
                                <h6 id="selected_source_text"><span >{{__('Source Text:')}}</span> <strong class="text"></strong></h6>
                                <form action="{{route('admin.languages.words.update',$lang_slug)}}" method="POST" id="langauge_translate_form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="type" value="{{$type}}">
                                    <input type="hidden" name="string_key">
                                    <div class="from-group">
                                        <label class="form-label" for="">{{__('Translate To')}} <strong >{{$language->name}}</strong></label>
                                        <textarea name="translate_word" cols="30" rows="5" class="form-control" placeholder="{{__('enter your translate words')}}"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                                </form>
                            </div>
                        </div>

                        {{--<div class="button-wrap">
                        </div>
                        <form action="{{route('admin.languages.words.update',$lang_slug)}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="type" value="{{$type}}">
                            @csrf
                            <div class="row">

                                @foreach($all_word as $key => $value)
                                    <div class="col-lg-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="{{Str::slug(($key))}}">{{$key}}</label>
                                            <input type="text" name="word[{{$key}}]"  class="form-control" value="{{$value}}" id="{{Str::slug(($key))}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_new_string_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add New Translate String')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.languages.add.string')}}" id="add_new_string_modal_form" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="slug" value="{{$lang_slug}}">
                        <input type="hidden" name="type" value="{{$type}}">
                        <div class="mb-3">
                            <label class="form-label" for="string">{{__('String')}}</label>
                            <input type="text" class="form-control" name="string" placeholder="{{__('String')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="translate_string">{{__('Translated String')}}</label>
                            <input type="text" class="form-control" name="translate_string" placeholder="{{__('Translated String')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script >
        (function($){
            "use strict";

            $(document).ready(function (){
                $(document).on('click','.language-word-translate-box .middle-part .single-string-wrap .string-part',function (e){
                    e.preventDefault();
                    let langKey = $(this).data('key');
                    let langValue = $(this).next().data('trans');
                    let formContainer = $('#langauge_translate_form');
                    $('#selected_source_text strong').text(langKey);
                    formContainer.find('input[name="string_key"]').val(langKey);
                    formContainer.find('textarea[name="translate_word"]').val(langValue);
                });
                //search source text
                $(document).on('keyup','#word_search',function (e){
                    e.preventDefault();
                    let searchText = $(this).val();
                    var allSourceText = $('.language-word-translate-box .middle-part .single-string-wrap .string-part');
                    $.each(allSourceText,function (index,value){
                        var text = $(this).text();
                        var found = text.toLowerCase().match(searchText.toLowerCase().trim());
                        if (!found){
                            $(this).parent().hide();
                        }else{
                            $(this).parent().show();
                        }
                    });
                });

            });
        })(jQuery);
    </script>
@endpush
