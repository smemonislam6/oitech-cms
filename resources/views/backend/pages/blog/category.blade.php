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
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Categories')}}</h4>
                        <div class="input-group mb-3 w-25">
                            <select class="form-select" name="bulk_option" id="bulk_option">
                                <option value="">{{__('Bulk Action')}}</option>
                                <option value="delete">{{__('Delete')}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                        </div>
                        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                            @foreach($all_category as $key => $category)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
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
                                                <th >{{__('Image')}}</th>
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
                                                            <div class="photo-container">
                                                                <a href="{{ asset($data->CategoryImageUrl) }}" class="magnific">
                                                                    <img src="{{ asset($data->CategoryImageUrl) }}" alt="{{ $data->name }}">
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td >
                                                            <span class="btn btn-{{ $data->status === 'publish' ? 'success' : 'warning' }} btn-sm">{{ ucfirst(__($data->status)) }}</span>
                                                        </td>
                                                        <td >
                                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.blog.category.destroy', $data->id)])
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#category_edit_modal" class="btn btn-sm btn-primary me-1 category_edit_btn" data-id="{{$data->id}}" data-name="{{$data->name}}" data-lang="{{$data->lang}}" data-status="{{$data->status}}" data-image="{{ asset($data->CategoryImageUrl) }}">
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
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Category')}}</h4>
                        <form action="{{route('admin.blog.category.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="language">{{__('Language')}}</label>
                                <select name="lang" id="language" class="form-control">                                    
                                    @foreach($all_languages as $language)
                                        <option value="{{$language->slug}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Name')}}">
                            </div>
                            <div class="mb-3 add">                            
                                <img src="{{ asset(get_placeholder_image_path('BlogCategory')) }}" alt="Default Image" class="image-preview-container max-height-img">                             
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Change Photo') }}</label>
                                <input type="file" class="form-control" id="add_image" name="image">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">{{__('Status')}}</label>
                                <select name="status" class="form-select" id="category_status">
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
    <div class="modal fade" id="category_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Update Category')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.blog.category.update')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="category_id">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="edit_language">{{__('Language')}}</label>
                            <select name="lang" id="edit_language" class="form-control">
                                @foreach($all_languages as $language)
                                    <option value="{{$language->slug}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_name">{{__('Name')}}</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="{{__('Name')}}">
                        </div>
                        <div class="mb-3 edit">                                                      
                            <img src="{{ asset(get_placeholder_image_path('BlogCategory')) }}" alt="Default Image" class="image-preview-container" style="width: 200px;">                              
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('Change Photo') }}</label>
                            <input type="file" class="form-control" id="edit_image" name="image">
                            <small >{{__('Recommended image size 200x200')}}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_status">{{__('Status')}}</label>
                            <select name="status" class="form-control" id="edit_status">
                                <option value="draft">{{__("Draft")}}</option>
                                <option value="publish">{{__("Publish")}}</option>
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

                    axios.delete(route('admin.blog.category.bulk.action'), {
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

            $(document).on('click','.category_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var name = el.data('name');
                var status = el.data('status');
                var modal = $('#category_edit_modal');

                var image = el.data('image');

                modal.find('#category_id').val(id);
                modal.find('#edit_status option[value="'+status+'"]').attr('selected',true);
                modal.find('#edit_name').val(name);
                modal.find('.image-preview-container').attr('src',el.data('image'));
                modal.find('#edit_language option[value="'+el.data('lang')+'"]').attr('selected',true);
                
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
