@extends('backend.layouts.app')
@section('site-title')
    {{__('Working Steps Area')}}
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
                    <h4 class="header-title">{{__('Working Steps Area Settings')}}</h4>
                    <form action="{{route('admin.home-page.working-steps')}}" method="post" enctype="multipart/form-data">
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
                                        <label class="form-label" for="working_steps_section_{{$lang}}_title">{{__('Title')}}</label>
                                        <input type="text" name="working_steps_section_{{$lang->slug}}_title" class="form-control" value="{{get_static_option('working_steps_section_'.$lang->slug.'_title')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="working_steps_section_{{$lang}}_sub_title">{{__('Sub Title')}}</label>
                                        <input type="text" name="working_steps_section_{{$lang->slug}}_sub_title" class="form-control" value="{{get_static_option('working_steps_section_'.$lang->slug.'_sub_title')}}">
                                    </div>
                                </div>
                            @endforeach
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Work Step Item')}}</label>
                                <select name="working_steps_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple" id="tagsInput">
                                    @php
                                        $workStepItems = 'working_steps_' . get_static_option('home_page_variant') . '_id';
                                        $workStepItems = json_decode(get_static_option($workStepItems), true) ?? [];
                                    @endphp
                                    @foreach ($all_items as $item)
                                        <option value="{{ $item->id }}" @selected(in_array($item->id, $workStepItems))>{{ $item->title }}</option>
                                    @endforeach
                                </select>
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
                    <h4 class="header-title">{{__('Add Work Step Item')}}</h4>
                    <div class="right-cotnent margin-bottom-40"><a class="btn btn-primary" data-bs-target="#add_work_step" data-bs-toggle="modal" href="#">{{__('Add New Work Step Item')}}</a></div>

                    <ul class="nav nav-tabs mt-4 mb-4" id="myTab" role="tablist">
                        @foreach($all_work_steps as $key => $work_step)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        @foreach($all_work_steps as $key => $work_steps)
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
                                            @foreach($work_steps as $data)
                                                <tr >
                                                    <td >{{$data->id}}</td>
                                                    <td ><i class="{{$data->icon}}"></i></td>
                                                    <td >{{$data->title}}</td>
                                                    <td >
                                                        @include('backend.partials.delete-with-swal', ['url' => route('admin.working-steps.destroy', $data->id)])
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#work_step_item_edit_modal" class="btn btn-xs btn-primary btn-sm me-1 work_step_item_edit_btn" data-id="{{$data->id}}" data-lang="{{$data->lang}}" data-title="{{$data->title}}" data-icon="{{$data->icon}}">
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
<div class="modal fade" id="add_work_step" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Add Work Step Item')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.working-steps.store') }}" method="post">
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
                    <button type="submit" class="btn btn-primary">{{__('Add Work Step Item')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="work_step_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Social Item')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.working-steps.update') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="work_step_item_id" value="">
                    <div class="mb-3">
                        <label class="form-label" for="language">{{__('Language')}}</label>
                        <select name="lang" id="language" class="form-control">
                            @foreach(get_all_language() as $language)
                                <option value="{{$language->slug}}">{{$language->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block" for="work_step_item_icon">{{__('Icon')}}</label>
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
                        <input type="hidden" class="form-control" id="work_step_item_icon" value="fas fa-exclamation-triangle" name="icon">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="work_step_item_title">{{__('Title')}}</label>
                        <input type="text" name="title" id="work_step_item_title" class="form-control">
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

            $('.icp-dd').iconpicker();
            $('body').on('iconpickerSelected','.icp-dd', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
                $('body .dropdown-menu.iconpicker-container').removeClass('show');
            });

            $(document).ready(function () {

                $(document).on('click','.work_step_item_edit_btn',function(){
                    var el = $(this);
                    var id = el.data('id');
                    var title = el.data('title');
                    var icon = el.data('icon');
                    var lang = el.data('lang');

                    var form = $('#work_step_item_edit_modal');
                    form.find('#work_step_item_id').val(id);
                    form.find('#language').val(lang);
                    form.find('#work_step_item_title').val(title);
                    form.find('#work_step_item_icon').val(icon);
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
