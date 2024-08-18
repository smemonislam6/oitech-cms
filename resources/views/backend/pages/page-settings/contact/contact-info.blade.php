@extends('backend.layouts.app')
@section('site-title')
    {{__('Contact Info')}}
@endsection
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
                        <h4 class="header-title">{{__('Contact Area Settings')}}</h4>
                        <form action="{{route('admin.contact.info.detail')}}" method="post" enctype="multipart/form-data">
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
                                            <label class="form-label" for="contact_page_item_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="contact_page_item_{{$lang->slug}}_title" class="form-control" value="{{get_static_option('contact_page_item_'.$lang->slug.'_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="contact_page_item_{{$lang}}_sub_title">{{__('Sub Title')}}</label>
                                            <input type="text" name="contact_page_item_{{$lang->slug}}_sub_title" class="form-control" value="{{get_static_option('contact_page_item_'.$lang->slug.'_sub_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="contact_page_item_{{$lang}}_description">{{__('Description')}}</label>
                                            <textarea name="contact_page_item_{{$lang->slug}}_description" class="form-control" id="description" cols="10" rows="5">{{get_static_option('contact_page_item_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">                
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Contact Info')}}</h4>                        
                        <div class="d-flex justify-content-between">
                            <div class="input-group mb-3 w-25">
                                <select class="form-select" name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                            <div class="right-cotnent mb-3"><a class="btn btn-primary" data-bs-target="#add_contact_item" data-bs-toggle="modal" href="#">{{__('Add New Contact Info Item')}}</a></div>
                        </div>
                        
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_contact_info as $key => $contactinfo)
                                <li class="nav-item">
                                    <a @class(['nav-link', 'active' => $loop->first]) data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            @foreach($all_contact_info as $key => $contactinfo)
                                <div @class(['tab-pane fade', 'show active' => $loop->first]) id="slider_tab_{{$key}}" role="tabpanel">
                                    <table class="table table-default align-middle">
                                        <thead >
                                            <th >
                                                <div class="mark-all-checkbox">
                                                    <input type="checkbox" class="all-checkbox">
                                                </div>
                                            </th>
                                            <th >{{__('Title')}}</th>
                                            <th >{{__('Icon')}}</th>
                                            <th >{{__('Link')}}</th>
                                            <th >{{__('Display')}}</th>
                                            <th >{{__('Action')}}</th>
                                        </thead>
                                        <tbody >
                                            @foreach($contactinfo as $data)
                                                <tr >
                                                    <td >
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td ><i class="{{$data->icon}}"></i></td>
                                                    <td >{{$data->title}}</td>
                                                    <td >{{$data->link}}</td>
                                                    <td >{{$data->display}}</td>
                                                    <td >
                                                        @include('backend.partials.delete-with-swal', ['url' => route('admin.contact.info.destroy', $data->id)])
                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#contact_info_item_edit_modal" class="btn btn-primary btn-sm me-1 contact_info_edit_btn" data-id="{{$data->id}}" data-lang="{{$data->lang}}" data-title="{{$data->title}}" data-icon="{{$data->icon}}" data-link="{{$data->link}}" data-display="{{$data->display}}">
                                                            <i class="ti-pencil"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_contact_item" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="header-title">{{__('New Contact Info')}}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>                
                <form action="{{route('admin.contact.info.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="language">{{__('Languages')}}</label>
                            <select name="lang" id="language" class="form-control">
                                @foreach($all_languages as $lang)
                                <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="title">{{__('Title')}}</label>
                            <input type="text" class="form-control" name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block" for="icon">{{__('Icon')}}</label>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label" for="edit_link">{{__('Link')}}</label>
                            <input type="text" class="form-control" name="link" placeholder="{{__('Link')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_display">{{__('Display')}}</label>
                            <input type="text" class="form-control" name="display" placeholder="{{__('Display')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Add Contact Info Item')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contact_info_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Key Feature Item')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.contact.info.update')}}" id="contact_info_edit_modal_form" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="contact_info_id" value="">
                        <div class="mb-3">
                            <label class="form-label" for="edit_language">{{__('Languages')}}</label>
                            <select name="lang" id="edit_language" class="form-control">
                                @foreach($all_languages as $lang)
                                    <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_title">{{__('Title')}}</label>
                            <input type="text" class="form-control" id="edit_title" name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block" for="edit_icon">{{__('Icon')}}</label>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control" id="edit_icon" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_link">{{__('Link')}}</label>
                            <input type="text" class="form-control" id="edit_link" name="link" placeholder="{{__('Link')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_display">{{__('Display')}}</label>
                            <input type="text" class="form-control" id="edit_display" name="display" placeholder="{{__('Display')}}">
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
    <script >
        $(document).ready(function () {

            $(document).on('click', '#bulk_delete_btn', function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox = $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function (index, value) {
                    allIds.push($(this).val());
                });
                if (allIds.length > 0 && bulkOption == 'delete') {
                    $(this).text('{{__('Deleting...')}}');

                    axios.delete(route('admin.contact.info.bulk.action'), {
                        data: {
                            ids: allIds,
                            _token: "{{csrf_token()}}",
                        }
                    })
                    .then(function (response) {
                        location.reload();
                    })
                    .catch(function (error) {
                        console.error('Error:', error.response.data.message);
                    });
                }
            });


            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });


            $(document).on('click','.contact_info_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var icon = el.data('icon');
                var link = el.data('link');
                var display = el.data('display');
                var form = $('#contact_info_edit_modal_form');

                form.find('#contact_info_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_icon').val(icon);
                form.find('#edit_link').val(link);
                form.find('#edit_display').val(display);
                form.find('#edit_language option[value="'+el.data('lang')+'"]').attr('selected',true);
                form.find('.icp-dd').attr('data-selected', icon);
                form.find('.iconpicker-component i').attr('class', icon);
            });

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });
        });
    </script>
@endpush
