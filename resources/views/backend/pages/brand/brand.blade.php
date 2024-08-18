@extends('backend.layouts.app')
@section('site-title')
    {{__('Brand Settings')}}
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
                        <h4 class="header-title">{{__('All Brand Items')}}</h4>
                        <div class="input-group mb-3 w-25">
                            <select class="form-select" name="bulk_option" id="bulk_option">
                                <option value="">{{{__('Bulk Action')}}}</option>
                                <option value="delete">{{{__('Delete')}}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default align-middle">
                                <thead >
                                    <th class="no-sort">
                                        <div class="mark-all-checkbox">
                                            <input type="checkbox" class="all-checkbox">
                                        </div>
                                    </th>
                                    <th >{{__('ID')}}</th>
                                    <th >{{__('Title')}}</th>
                                    <th >{{__('Url')}}</th>
                                    <th >{{__('Image')}}</th>
                                    <th >{{__('Action')}}</th>
                                </thead>
                                <tbody >
                                    @foreach($all_brand as $data)
                                    <tr >
                                        <td >
                                            <div class="bulk-checkbox-wrapper">
                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                            </div>
                                        </td>
                                        <td >{{$data->id}}</td>
                                        <td >{{$data->title}}</td>
                                        <td >{{$data->url}}</td>
                                        <td >
                                            <div class="photo-container">
                                                <a href="{{ asset($data->BrandImageUrl) }}" class="magnific">
                                                    <img src="{{ asset($data->BrandImageUrl) }}" alt="{{ $data->title }}">
                                                </a>
                                            </div>
                                        </td>
                                        <td >
                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.brands.destroy', $data->id)])
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#brand_item_edit_modal" class="btn btn-primary btn-sm me-1 brand_edit_btn" data-id="{{$data->id}}" data-title="{{$data->title}}" data-url="{{$data->url}}" data-image="{{$data->BrandImageUrl}}">
                                            <i class="ri-pencil-line"></i>
                                            </a>
                                            <form action="{{route('admin.brands.clone', $data->id)}}" method="post" style="display: inline-block">
                                                @csrf
                                                <button type="submit" title="clone this to new draft" class="btn btn-secondary btn-sm me-1"><i class="far fa-copy"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('New Brand')}}</h4>
                        <form action="{{route('admin.brands.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="{{__('Title')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="url">{{__('URl')}}</label>
                                <input type="text" class="form-control" id="url" name="url" placeholder="{{__('Url')}}">
                            </div>
                            <div class="mb-3 add">                                                      
                                <img src="{{ asset(get_placeholder_image_path('Brand')) }}" alt="Default Image" class="image-preview-container max-width-img">                              
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control" id="add_image" name="image">
                                <div class="form-text">{{__('Recommended image size 210x95')}}</div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="brand_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Brand Item')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.brands.update')}}" id="brand_edit_modal_form" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" class="form-control" name="id" id="brand_id">
                        <div class="mb-3">
                            <label class="form-label" for="edit_title">{{__('Title')}}</label>
                            <input type="text" class="form-control" id="edit_title" name="title" placeholder="{{__('Title')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_url">{{__('URl')}}</label>
                            <input type="text" class="form-control" id="edit_url" name="url" placeholder="{{__('Url')}}">
                        </div>
                        <div class="mb-3 edit">                                                      
                            <img src="" id="previewImage" alt="Default Image" class="image-preview-container max-width-img">                              
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="image">{{__('Image')}}</label>
                            <input type="file" class="form-control" id="edit_image" name="brand_image">
                            <small >{{__('Recommended image size 160x80')}}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
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

                    axios.delete(route('admin.brands.bulk.action'), {
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

            $(document).on('click','.brand_edit_btn',function(){
                const el = $(this);
                const id = el.data('id');
                const title = el.data('title');
                const url = el.data('url');
                const image = el.data('image');
                const form = $('#brand_edit_modal_form');

                form.find('#brand_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_url').val(url);
                form.find('#previewImage').attr('src', image);
            });
        });
    </script>
@endpush
