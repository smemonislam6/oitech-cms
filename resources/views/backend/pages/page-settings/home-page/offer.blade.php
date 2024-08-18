@extends('backend.layouts.app')
@section('site-title')
    {{__('Offer Area')}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/select2/css/select2.min.css')}}">
@endpush
@section('admin_content')
<div class="col-lg-12 col-ml-12">
    <div class="row">
        <div class="col-lg-12">
            @include('backend.partials.message')
            @include('backend.partials.error')
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Offer Area Settings')}}</h4>
                    <form action="{{route('admin.home-page.offer')}}" method="post" enctype="multipart/form-data">
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
                                        <label class="form-label" for="offer_section_{{$lang}}_title">{{__('Title')}}</label>
                                        <input type="text" name="offer_section_{{$lang->slug}}_title" class="form-control" value="{{get_static_option('offer_section_'.$lang->slug.'_title')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_section_{{$lang}}_sub_title">{{__('Sub Title')}}</label>
                                        <input type="text" name="offer_section_{{$lang->slug}}_sub_title" class="form-control" value="{{get_static_option('offer_section_'.$lang->slug.'_sub_title')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_section_{{$lang}}_description">{{__('Description')}}</label>
                                        <textarea name="offer_section_{{$lang->slug}}_description" class="form-control" id="offer_section_{{$lang}}_description" cols="30" rows="7">{{get_static_option('offer_section_'.$lang->slug.'_description')}}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_section_{{$lang}}_btn_text">{{__('Button Text')}}</label>
                                        <input type="text" name="offer_section_{{$lang->slug}}_btn_text" class="form-control" value="{{get_static_option('offer_section_'.$lang->slug.'_btn_text')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_section_{{$lang}}_btn_url">{{__('Button URL')}}</label>
                                        <input type="text" name="offer_section_{{$lang->slug}}_btn_url" class="form-control" value="{{get_static_option('offer_section_'.$lang->slug.'_btn_url')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_section_{{$lang}}_counter_title">{{__('Counter Title')}}</label>
                                        <input type="text" name="offer_section_{{$lang->slug}}_counter_title" class="form-control" value="{{get_static_option('offer_section_'.$lang->slug.'_counter_title')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="offer_section_{{$lang}}_counter">{{__('Counter')}}</label>
                                        <input type="text" name="offer_section_{{$lang->slug}}_counter" class="form-control" value="{{get_static_option('offer_section_'.$lang->slug.'_counter')}}">
                                    </div>
                                </div>
                            @endforeach
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Offer Item')}}</label>
                                <select name="offer_section_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple" id="tagsInput">
                                    @php
                                        $offerItems = 'offer_section_' . get_static_option('home_page_variant') . '_id';
                                        $offerItems = json_decode(get_static_option($offerItems), true) ?? [];
                                    @endphp
                                    @foreach ($all_items as $item)
                                        <option value="{{ $item->id }}" @selected(in_array($item->id, $offerItems))>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 edit_1">
                                        <label for="offer_image_one" class="form-label d-block">{{__('Image 01')}}</label>
                                        @php
                                            $leftImage = get_static_option('offer_image_one');
                                        @endphp
                                        @if($leftImage)
                                            <img id="bgImagePreview" src="{{ asset($leftImage) }}" alt="Default Background" class="image-preview-container max-height-img">
                                        @else
                                            <img id="bgImagePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_1" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control edit_image" id="edit_image_1" name="offer_image_one">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 edit_2">
                                        <label for="offer_image_two" class="form-label d-block">{{__('Image 02')}}</label>
                                        @php
                                            $leftImage = get_static_option('offer_image_two');
                                        @endphp
                                        @if($leftImage)
                                            <img id="bgShapePreview" src="{{ asset($leftImage) }}" alt="Default Background" class="image-preview-container max-height-img">
                                        @else
                                            <img id="bgShapePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_2" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control edit_image" id="edit_image_2" name="offer_image_two">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Add Offer Item')}}</h4>
                    <div class="right-cotnent margin-bottom-40"><a class="btn btn-primary" data-bs-target="#add_fun_fact" data-bs-toggle="modal" href="#">{{__('Add New Offer Item')}}</a></div>

                    <ul class="nav nav-tabs mt-4 mb-4" id="myTab" role="tablist">
                        @foreach($all_offer as $key => $fun_fact)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($all_offer as $key => $offer)
                            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                <div class="table-wrap table-responsive">
                                    <table class="table table-default align-middle">
                                        <thead >
                                            <th >{{__('ID')}}</th>
                                            <th >{{__('Icon')}}</th>
                                            <th >{{__('Title')}}</th>
                                            <th >{{__('Action')}}</th>
                                        </thead>
                                        <tbody >
                                            @foreach($offer as $data)
                                                <tr >
                                                    <td >{{$data->id}}</td>
                                                    <td ><i class="{{$data->icon}}"></i></td>
                                                    <td >{{$data->title}}</td>
                                                    <td >
                                                        @include('backend.partials.delete-with-swal', ['url' => route('admin.offer-items.destroy', $data->id)])
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#fun_fact_item_edit_modal" class="btn btn-xs btn-primary btn-sm me-1 fun_fact_item_edit_btn" data-id="{{$data->id}}" data-lang="{{$data->lang}}" data-title="{{$data->title}}" data-icon="{{$data->icon}}">
                                                        <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add_fun_fact" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Add Offer Item')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.offer-items.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="language"><strong >{{__('Language')}}</strong></label>
                        <select name="lang" id="language" class="form-control">
                            <option value="">{{__('Select Language')}}</option>
                            @foreach(get_all_language() as $lang)
                            <option value="{{$lang->slug}}" @selected($lang->slug == get_default_language())>{{$lang->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block" for="icon">{{__('Icon')}}</label>
                        <div class="btn-group ">
                            <button type="button" class="btn btn-primary iconpicker-component">
                                <i class="fas fa-exclamation-triangle"></i>
                            </button>
                            <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu"></div>
                        </div>
                        <input type="hidden" class="form-control" id="icon" value="fas fa-exclamation-triangle" name="icon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="">{{__('Title')}}</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Add Offer Item')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="fun_fact_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Social Item')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.offer-items.update') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="fun_fact_item_id" value="">
                    <div class="mb-3">
                        <label class="form-label" for="language">{{__('Language')}}</label>
                        <select name="lang" id="language" class="form-control">
                            @foreach(get_all_language() as $language)
                                <option value="{{$language->slug}}">{{$language->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block" for="fun_fact_item_icon">{{__('Icon')}}</label>
                        <div class="btn-group ">
                            <button type="button" class="btn btn-primary iconpicker-component">
                                <i class="fas fa-exclamation-triangle"></i>
                            </button>
                            <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                            </button>
                            <div class="dropdown-menu"></div>
                        </div>
                        <input type="hidden" class="form-control" id="fun_fact_item_icon" value="fas fa-exclamation-triangle" name="icon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="fun_fact_item_title">{{__('Title')}}</label>
                        <input type="text" name="title" id="fun_fact_item_title" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{asset('assets/backend/vendor/select2/js/select2.min.js')}}"></script>
    <script >
        (function($){
            "use strict";

            function previewImage(input, previewId) {
                var file = input.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + previewId).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

            $('#edit_image_1').change(function() {
                previewImage(this, 'bgImagePreview');
            });

            $('#edit_image_2').change(function() {
                previewImage(this, 'bgShapePreview');
            });

            $('.icp-dd').iconpicker();
            $('body').on('iconpickerSelected','.icp-dd', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
                $('body .dropdown-menu.iconpicker-container').removeClass('show');
            });

            $(document).ready(function () {

                $(document).on('click','.fun_fact_item_edit_btn',function(){
                    var el = $(this);
                    var id = el.data('id');
                    var title = el.data('title');
                    var icon = el.data('icon');
                    var lang = el.data('lang');

                    var form = $('#fun_fact_item_edit_modal');
                    form.find('#fun_fact_item_id').val(id);
                    form.find('#language').val(lang);
                    form.find('#fun_fact_item_title').val(title);
                    form.find('#fun_fact_item_icon').val(icon);
                    form.find('.icp-dd').attr('data-selected',el.data('icon'));
                    form.find('.iconpicker-component i').attr('class',el.data('icon'));
                });
                $('.icp-dd').iconpicker();
                $('.icp-dd').on('iconpickerSelected', function (e) {
                    var selectedIcon = e.iconpickerValue;
                    $(this).parent().parent().children('input').val(selectedIcon);
                });
            });

            $(".select2_tags").select2({
                tags: true,
                multiple: true,
            });

        })(jQuery);
    </script>
@endpush
