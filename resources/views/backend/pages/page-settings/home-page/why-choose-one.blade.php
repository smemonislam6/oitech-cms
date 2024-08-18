@extends('backend.layouts.app')
@section('site-title')
    {{__('Why Choose One Section')}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/select2/css/select2.min.css')}}">
@endpush
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Why Choose One Section Settings')}}</h4>

                        <form action="{{route('admin.home-page.why-choose.one')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="why_choose_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="why_choose_{{$lang->slug}}_title" value="{{get_static_option('why_choose_'.$lang->slug.'_title')}}" class="form-control" id="why_choose_{{$lang->slug}}_title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="why_choose_{{$lang}}_sub_title">{{__('Sub Title')}}</label>
                                            <input type="text" name="why_choose_{{$lang->slug}}_sub_title" value="{{get_static_option('why_choose_'.$lang->slug.'_sub_title')}}" class="form-control" id="why_choose_{{$lang->slug}}_sub_title">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Why Choose Item')}}</label>
                                <select name="why_choose_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple" id="tagsInput">
                                    @php
                                        $whyChooseItems = 'why_choose_' . get_static_option('home_page_variant') . '_id';
                                        $whyChooseItems = json_decode(get_static_option($whyChooseItems), true) ?? [];
                                    @endphp
                                    @foreach ($all_items as $item)
                                        <option value="{{ $item->id }}" @selected(in_array($item->id, $whyChooseItems))>{{ $item->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3 edit_1">
                                        <label for="why_choose_bg_image" class="form-label d-block">{{__('Backround Image')}}</label>
                                        @php
                                            $leftImage = get_static_option('why_choose_bg_image');
                                        @endphp
                                        @if($leftImage)
                                            <img id="bgImagePreview" src="{{ asset($leftImage) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                        @else
                                            <img id="bgImagePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_1" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control edit_image" id="edit_image_1" name="why_choose_bg_image">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3 edit_3">
                                        <label for="why_choose_float_image" class="form-label d-block">{{__('Float Image')}}</label>
                                        @php
                                            $rightImage = get_static_option('why_choose_float_image');
                                        @endphp
                                        @if($rightImage)
                                            <img id="floatImagePreview" src="{{ asset($rightImage) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                        @else
                                            <img id="floatImagePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image_3" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control" id="edit_image_3" name="why_choose_float_image">
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
                        <h4 class="header-title">{{__('Add Feature Item')}}</h4>
                        <div class="right-cotnent margin-bottom-40"><a class="btn btn-primary" data-bs-target="#add_why_choose_item" data-bs-toggle="modal" href="#">{{__('Add New Why Choose Item')}}</a></div>

                        <ul class="nav nav-tabs mt-4 mb-4" id="myTab" role="tablist">
                            @foreach($all_why_choose as $key => $why_choose)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach($all_why_choose as $key => $why_choose)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default align-middle">
                                            <thead >
                                                <th >{{__('ID')}}</th>
                                                <th >{{__('Icon')}}</th>
                                                <th >{{__('Title')}}</th>
                                                <th >{{__('Status')}}</th>
                                                <th >{{__('Action')}}</th>
                                            </thead>
                                            <tbody >
                                                @foreach($why_choose as $data)
                                                    <tr >
                                                        <td >{{$data->id}}</td>
                                                        <td ><i class="{{$data->icon}}"></i></td>
                                                        <td >{{$data->title}}</td>
                                                        <td >
                                                            <span class="alert alert-{{ $data->status == 'draft' ? 'warning' : 'success' }}">
                                                                {{ $data->status == 'draft' ? __('Draft') : __('Publish') }}
                                                            </span>
                                                        </td>
                                                        <td >
                                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.why-choose.item.destroy', $data->id)])
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#why_choose_item_edit_modal" class="btn btn-xs btn-primary btn-sm me-1 why_choose_item_edit_btn" data-id="{{$data->id}}" data-lang="{{$data->lang}}" data-title="{{$data->title}}" data-icon="{{$data->icon}}" data-status="{{$data->status}}" data-description="{{$data->description}}">
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
    <div class="modal fade" id="add_why_choose_item" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add Feature Item')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.why-choose.item.store')}}" method="post">
                    <div class="modal-body">
                        @csrf
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
                            <label class="form-label" for="why_choose_item_title1">{{__('Title')}}</label>
                            <input type="text" name="title" id="why_choose_item_title1" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="why_choose_item_description1">{{__('Description')}}</label>
                            <textarea name="description" class="form-control" id="why_choose_item_description1" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status">{{__('Status')}}</label>
                            <select name="status" id="why_choose_status" class="form-control">
                                <option value="publish">{{__('Publish')}}</option>
                                <option value="draft">{{__('Draft')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Add Feature Item')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="why_choose_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Social Item')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.why-choose.item.update')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="why_choose_item_id" value="">
                        <div class="mb-3">
                            <label class="form-label" for="language">{{__('Language')}}</label>
                            <select name="lang" id="language" class="form-control">
                                @foreach(get_all_language() as $language)
                                    <option value="{{$language->slug}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block" for="why_choose_item_icon">{{__('Icon')}}</label>
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
                            <input type="hidden" class="form-control" id="why_choose_item_icon" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="why_choose_item_title">{{__('Title')}}</label>
                            <input type="text" name="title" id="why_choose_item_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="why_choose_item_description">{{__('Description')}}</label>
                            <textarea name="description" class="form-control" id="why_choose_item_description" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status">{{__('Status')}}</label>
                            <select name="status" class="form-control" id="edit_status">
                                <option value="publish">{{__("Publish")}}</option>
                                <option value="draft">{{__("Draft")}}</option>
                            </select>
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

            $('#edit_image_3').change(function() {
                previewImage(this, 'floatImagePreview');
            });

            $('#edit_image_4').change(function() {
                previewImage(this, 'arrowImagePreview');
            });


            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

            $(document).on('click','.why_choose_item_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var icon = el.data('icon');
                var lang = el.data('lang');
                var title = el.data('title');
                var description = el.data('description');
                var status = el.data('status');

                var form = $('#why_choose_item_edit_modal');
                form.find('#why_choose_item_id').val(id);
                form.find('#language').val(lang);
                form.find('#why_choose_item_title').val(title);
                form.find('#why_choose_item_icon').val(icon);
                form.find('#why_choose_item_description').val(description);
                form.find('#edit_status').val(status);
                form.find('.icp-dd').attr('data-selected',el.data('icon'));
                form.find('.iconpicker-component i').attr('class',el.data('icon'));
            });

            $(".select2_tags").select2({
                tags: true,
                multiple: true,
            });
        })(jQuery);
    </script>
@endpush
