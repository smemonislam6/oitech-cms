@extends('backend.layouts.app')
@section('site-title')
    {{__('Category Page')}}
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
                        <h4 class="header-title">{{__('All Categories')}}</h4>
                        <div class="input-group mb-3 w-25">
                            <select class="form-select" name="bulk_option" id="bulk_option">
                                <option value="">{{{__('Bulk Action')}}}</option>
                                <option value="delete">{{{__('Delete')}}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_category as $key => $slider)
                            <li class="nav-item">
                                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{ $key }}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            @foreach($all_category as $key => $category)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default align-middle">
                                            <thead >
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th >{{__('ID')}}</th>
                                                <th >{{__('Name')}}</th>
                                                <th >{{__('Status')}}</th>
                                                <th >{{__('Action')}}</th>
                                            </thead>
                                            <tbody >
                                                @foreach($category as $data)
                                                    <tr >
                                                        <td >
                                                            <div class="bulk-checkbox-wrapper">
                                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                            </div>
                                                        </td>
                                                        <td >{{$data->id}}</td>
                                                        <td >{{$data->name}}</td>
                                                        <td >
                                                            @if('publish' == $data->status)
                                                                <span class="btn btn-success btn-sm">{{ucfirst(__($data->status))}}</span>
                                                            @else
                                                                <span class="btn btn-warning btn-sm">{{ucfirst(__($data->status))}}</span>
                                                            @endif
                                                        </td>
                                                        <td >
                                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.service-categories.destroy', $data->id)])
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#category_edit_modal_{{ $loop->iteration }}" class="btn btn-primary btn-sm me-1 category_edit_btn" data-id="{{ $loop->iteration }}" data-icon_type="{{$data->icon_type}}">
                                                            <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <div class="modal fade" id="category_edit_modal_{{ $loop->iteration }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">{{__('Update Category')}}</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="{{ route('admin.service-categories.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-body">                                                                
                                                                        <div class="mb-3">
                                                                            <label for="edit_language">{{__('Language')}}</label>
                                                                            <select name="lang" id="edit_language" class="form-control">
                                                                                @foreach(get_all_language() as $language)
                                                                                    <option value="{{ $language->slug }}" @selected($language->slug == $data->lang)>{{$language->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="edit_name">{{__('Name')}}</label>
                                                                            <input type="text" class="form-control" id="edit_name" name="name" value="{{ $data->name }}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="icon_type">{{__('Icon Type')}}</label>
                                                                            <select name="icon_type" class="form-control" id="icon_type">
                                                                                <option value="icon">{{__("Font Icon")}}</option>
                                                                                <option value="image">{{__("Image Icon")}}</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3 icon">
                                                                            <label for="icon" class="d-block">{{__('Icon')}}</label>
                                                                            <div class="btn-group ">
                                                                                <button type="button" class="btn btn-primary iconpicker-component">
                                                                                    <i class="{{ $data->icon }}"></i>
                                                                                </button>
                                                                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="{{ $data->icon }}" data-bs-toggle="dropdown">
                                                                                    <span class="caret"></span>
                                                                                    <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                                                                </button>
                                                                                <div class="dropdown-menu"></div>
                                                                            </div>
                                                                            <input type="hidden" class="form-control" id="icon" value="{{ $data->icon }}" name="icon">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="image">{{__('Image')}}</label>
                                                                            <div class="mb-3 edit">                                                      
                                                                                <img src="{{ asset($data->ImageUrl) }}" alt="Default Image" class="image-preview-container" style="width: 200px;">                              
                                                                            </div>
                                                                            <label for="img_icon">{{__('Image Icon')}}</label>
                                                                            <input type="file" class="form-control" id="edit_image" name="img_icon">
                                                                            <small >{{__('Recommended image size 256x256')}}</small>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="edit_status">{{__('Status')}}</label>
                                                                            <select name="status" class="form-control" id="edit_status">
                                                                                <option value="publish" @selected('publish' == $data->status)>{{__("Publish")}}</option>
                                                                                <option value="draft" @selected('draft' == $data->status)>{{__("Draft")}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                                                                        <button type="submit" class="btn btn-primary">{{__('Save Change')}}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Category')}}</h4>
                        <form action="{{route('admin.service-categories.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="language">{{__('Language')}}</label>
                                <select name="lang" id="language" class="form-control">
                                    @foreach(get_all_language() as $language)
                                    <option value="{{$language->slug}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Name')}}">
                            </div>
                            <div class="mb-3">
                                <label for="icon_type">{{__('Icon Type')}}</label>
                                <select name="icon_type" class="form-control" id="icon_type">
                                    <option value="icon">{{__("Font Icon")}}</option>
                                    <option value="image">{{__("Image Icon")}}</option>
                                </select>
                            </div>
                            <div class="mb-3 icon">
                                <label for="icon" class="d-block">{{__('Icon')}}</label>
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
                                <label for="image">{{__('Image')}}</label>
                                <div class="mb-3 add">                                                      
                                    <img src="{{ asset(get_placeholder_image_path('ServiceCategory')) }}" alt="Default Image" class="image-preview-container" style="width: 200px;">                              
                                </div>
                                <label for="img_icon">{{__('Image Icon')}}</label>
                                <input type="file" class="form-control" id="add_image" name="img_icon">
                                <small >{{__('Recommended image size 256x256')}}</small>
                            </div>
                            <div class="mb-3">
                                <label for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="service_status">
                                    <option value="publish">{{__("Publish")}}</option>
                                    <option value="draft">{{__("Draft")}}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('scripts')
    <script >
        $(document).ready(function () {

            $(document).on('change', 'select[name="icon_type"]',function (e){
                e.preventDefault();
                var iconType = $(this).val();
                iconTypeFieldVal(iconType);
            });
            defaultIconType();

            function defaultIconType(){
                var iconType = $('select[name="icon_type"]').val();
                iconTypeFieldVal(iconType);
            }

            function iconTypeFieldVal(iconType){
                if (iconType == 'icon'){
                    $('input[name="img_icon"]').parent().hide();
                    $('input[name="icon"]').parent().show();
                }else if(iconType == 'image'){
                    $('input[name="icon"]').parent().hide();
                    $('input[name="img_icon"]').parent().show();
                }
            }

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

            $(document).on('click', '#bulk_delete_btn', function (e) {
                e.preventDefault();

                const bulkOption = $('#bulk_option').val();
                const allCheckbox = $('.bulk-checkbox:checked');
                const allIds = [];
                allCheckbox.each(function (index, value) {
                    allIds.push($(this).val());
                });
                if (allIds.length > 0 && bulkOption == 'delete') {
                    $(this).text('{{__('Deleting...')}}');

                    axios.delete(route('admin.service-categories.bulk.action'), {
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
                const value = $('.all-checkbox').is(':checked');
                const allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });

            $(document).on('click','.category_edit_btn',function(){
                const el = $(this);
                const id = el.data('id');
                const modal = $('#category_edit_modal_' + id);
                const iconType = el.data('icon_type') ? el.data('icon_type') : 'icon';

                if (iconType == 'icon'){
                    modal.find('input[name="img_icon"]').parent().hide();
                    modal.find('input[name="icon"]').show();
                }else if(iconType == 'image'){
                    modal.find('input[name="icon"]').parent().hide();
                    modal.find('input[name="img_icon"]').parent().show();
                }
            });
        });
    </script>   
    <script >
        $(document).ready(function() {
    
            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
        } );
    </script> 
@endpush
