@extends('backend.layouts.app')
@section('site-title')
    {{__('Faq')}}
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
                        <h4 class="header-title">{{__('Faq Items')}}</h4>
                        <div class="input-group mb-3 w-25">
                            <select class="form-select" name="bulk_option" id="bulk_option">
                                <option value="">{{{__('Bulk Action')}}}</option>
                                <option value="delete">{{{__('Delete')}}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_faqs as $key => $blog)
                                <li class="nav-item">
                                    <a @class(['nav-link', 'active' => $loop->first]) data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            @foreach($all_faqs as $key => $faq)
                                <div @class(['tab-pane fade', 'show active' => $loop->first]) id="slider_tab_{{$key}}" role="tabpanel">
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
                                                <th >{{__('Status')}}</th>
                                                <th >{{__('Action')}}</th>
                                            </thead>
                                            <tbody >
                                                @foreach($faq as $data)
                                                    <tr >
                                                        <td >
                                                            <div class="bulk-checkbox-wrapper">
                                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                            </div>
                                                        </td>
                                                        <td >{{$data->id}}</td>
                                                        <td >{{$data->title}}</td>
                                                        <td >@if($data->status == 'publish') <span class="alert alert-success">{{__('Publish')}}</span> @else <span class="alert alert-warning">{{__('Draft')}}</span> @endif</td>
                                                        <td >
                                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.faqs.destroy', $data->id)])
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#faq_item_edit_modal" class="btn btn-primary btn-sm me-1 faq_edit_btn" data-id="{{$data->id}}" data-title="{{$data->title}}" data-lang="{{$data->lang}}" data-is_open="{{$data->is_open}}" data-description="{{$data->description}}" data-status="{{$data->status}}">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                            <form action="{{route('admin.faqs.clone', $data->id)}}" method="post" style="display: inline-block">
                                                                @csrf
                                                                <button type="submit" title="clone this to new draft" class="btn btn-secondary btn-sm me-1"><i class="ri-file-copy-line"></i></button>
                                                            </form>
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
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('New Faq')}}</h4>
                        <form action="{{route('admin.faqs.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="language"><strong >{{__('Language')}}</strong></label>
                                <select name="lang" id="language" class="form-control">
                                    @foreach($all_languages as $lang)
                                        <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="{{__('Title')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="is_open">{{__('Is Open')}}</label>
                                <label class="switch">
                                    <input type="checkbox" name="is_open" id="is_open">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">{{__('Description')}}</label>
                                <textarea name="description" class="form-control editor" cols="30" rows="10"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="status">{{__('Status')}}</label>
                                <select name="status" id="faq_status" class="form-control">
                                    <option value="publish">{{__('Publish')}}</option>
                                    <option value="draft">{{__('Draft')}}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Faq')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="faq_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Faq Item')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.faqs.update') }}" id="faq_edit_modal_form" enctype="multipart/form-data" method="post">
                    <div class="modal-body">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" id="faq_id" value="">
                        <div class="mb-3">
                            <label class="form-label" for="edit_language"><strong >{{__('Language')}}</strong></label>
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
                            <label class="form-label" for="edit_is_open">{{__('Is Open')}}</label>
                            <label class="switch">
                                <input type="checkbox" name="is_open" id="edit_is_open">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_description">{{__('Description')}}</label>
                            <textarea name="description" id="edit_description" class="form-control editor" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_status">{{__('Status')}}</label>
                            <select name="status" id="edit_status" class="form-control">
                                <option value="publish">{{__('Publish')}}</option>
                                <option value="draft">{{__('Draft')}}</option>
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

                    axios.delete(route('admin.faqs.bulk.action'), {
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

            $(document).on('click', '.faq_edit_btn', function() {
                var el = $(this);
                var id = el.data('id');
                var title = el.data('title');
                var description = el.data('description');
                var status = el.data('status');
                var lang = el.data('lang');
                var isOpen = el.data('is_open');
                var form = $('#faq_edit_modal_form');
                
                // Populate form fields
                form.find('#faq_id').val(id);
                form.find('#edit_title').val(title);
                form.find('#edit_status').val(status);
                form.find('#edit_language').val(lang);

                tinymce.get('edit_description').setContent(description);
                
                // Set checkbox state
                form.find('#edit_is_open').prop('checked', isOpen);
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
