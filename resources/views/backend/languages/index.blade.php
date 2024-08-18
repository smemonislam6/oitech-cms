@extends('backend.layouts.app')
@section('site-title')
{{__('Language Settings')}}
@endsection
@section('admin_content')
<div class="col-lg-12 col-md-12">
    <div class="row">
        <!-- basic form start -->
        <div class="col-lg-12">
            <div class="margin-top-40"></div>
            @include('backend.partials.message')
            @include('backend.partials.error')
        </div>
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body table-responsive">
                    <h4 class="header-title">{{__('All Languages')}}</h4>
                    <table class="table table-default">
                        <thead >
                        <th >{{__('ID')}}</th>
                        <th >{{__('Name')}}</th>
                        <th >{{__('Direction')}}</th>
                        <th >{{__('Slug')}}</th>
                        <th >{{__('Status')}}</th>
                        <th >{{__('Default')}}</th>
                        <th >{{__('Action')}}</th>
                        </thead>
                        <tbody >
                            @foreach($all_lang as $data)
                            <tr >
                                <td >{{$data->id}}</td>
                                <td >{{$data->name}}</td>
                                <td >{{strtoupper($data->direction)}}</td>
                                <td >{{$data->slug}}</td>
                                <td >{{$data->status}}</td>
                                <td >
                                    @if($data->default == 1)
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm mb-3 mr-1">{{__("Default")}}</a>
                                    @else
                                        @include('backend.partials.change-default-lang', ['url' => route('admin.languages.default',$data->id)])
                                    @endif
                                </td>
                                <td >
                                    <div class="mb-2">
                                        @if($data->default != 1)
                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.languages.destroy', $data->id)])
                                        @endif
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#language_item_edit_modal" class="btn btn-primary btn-sm me-1 lang_edit_btn" data-id="{{$data->id}}" data-name="{{$data->name}}" data-slug="{{$data->slug}}" data-status="{{$data->status}}" data-direction="{{$data->direction}}">
                                        <i class="ri-pencil-line"></i>
                                        </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#language_item_clone_modal" class="btn btn-dark btn-sm me-1 lang_clone_btn" data-id="{{$data->id}}">
                                        <i class="ri-file-copy-line"></i>
                                        </a>
                                        <a href="{{route('admin.languages.words.backend',$data->slug)}}" title="{{__('Edit Admin Panel Words')}}" class="btn btn-secondary btn-sm" style="color: #fff;">
                                            <i class="ri-pencil-line"></i> {{__('Edit Admin Words')}}
                                        </a>
                                    </div>   
                                    <div class="d-flex justify-content-between">                                    
                                        <a href="{{route('admin.languages.words.frontend',$data->slug)}}" title="{{__('Edit Frontend Words')}}" class="btn btn-info btn-sm" style="color: #fff;">
                                            <i class="ri-pencil-line"></i> {{__('Edit Frontend Words')}}
                                        </a>    
                                    </div>                                                            
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">{{__('Add New Language')}}</h4>
                    <form action="{{route('admin.languages.store')}}" method="post" class="new_language_form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Language')}}</label>
                            <input type="hidden" name="name">
                            {!! get_language_country_field('language_select','country','form-control') !!}
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="direction">{{__('Direction')}}</label>
                            <select name="direction" id="direction" class="form-control">
                                <option value="ltr">{{__('LTR')}}</option>
                                <option value="rtl">{{__("RTL")}}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status">{{__('Status')}}</label>
                            <select name="status" class="form-select" id="language_status">
                                <option value="publish">{{__('Publish')}}</option>
                                <option value="draft">{{__("Draft")}}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="slug">{{__('Slug')}}</label>
                            <input type="text" class="form-control" readonly name="slug">
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="language_item_edit_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Edit Language')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.languages.update')}}" class="edit_language_form" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" id="lang_id" value="">
                    <div class="mb-3">
                        <label class="form-label" for="edit_name">{{__('Languages')}}</label>
                        <input type="hidden" name="name">
                        {!! get_language_country_field('language_select','country','form-control') !!}
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="direction">{{__('Direction')}}</label>
                        <select name="direction" id="edit_direction" class="form-control">
                            <option value="ltr">{{__('LTR')}}</option>
                            <option value="rtl">{{__("RTL")}}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit_status">{{__('Status')}}</label>
                        <select name="status" id="edit_status" class="form-control">
                            <option value="publish">{{__('Publish')}}</option>
                            <option value="draft">{{__("Draft")}}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit_slug">{{__('Slug')}}</label>
                        <input type="text" class="form-control" id="edit_slug" name="slug" readonly>
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
<div class="modal fade" id="language_item_clone_modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('Clone To New Languages')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <p class="alert alert-info">{{__('it will copy all content of all static sections, header slider, key features, contact info, support info, pages, menus')}}</p>
            <form action="{{route('admin.languages.clone')}}" id="contact_info_edit_modal_form" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="id" value="">

                    <div class="mb-3">
                        <label class="form-label" for="edit_name">{{__('Name')}}</label>
                        <input type="hidden" name="name">
                        {!! get_language_country_field('language_select','country','form-control') !!}
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="direction">{{__('Direction')}}</label>
                        <select name="direction" class="form-control">
                            <option value="ltr">{{__('LTR')}}</option>
                            <option value="rtl">{{__("RTL")}}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit_status">{{__('Status')}}</label>
                        <select name="status" class="form-control">
                            <option value="publish">{{__('Publish')}}</option>
                            <option value="draft">{{__("Draft")}}</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="edit_slug">{{__('Slug')}}</label>
                        <input type="text" class="form-control" name="slug" readonly>
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
    $(document).ready(function () {

        $(document).on('change', 'select[name="language_select"]', function () {
            var el = $(this);
            var name = el.parent().find('select[name="language_select"] option[value="'+el.val()+'"]' ).text()
            el.parent().find('input[name="name"]').val(name)
            el.parent().parent().find('input[name="slug"]').val(el.val())
        });

        $(document).on('click', '.lang_edit_btn', function () {
            var el = $(this);
            var id = el.data('id');
            var name = el.data('name');
            var slug = el.data('slug');
            var form = $('#language_item_edit_modal');
            form.find('#lang_id').val(id);
            form.find('input[name="name"]').val(name);
            form.find('select[name="language_select"] option[value="'+slug+'"]').attr('selected',true);
            form.find('#edit_slug').val(slug);
            form.find('#edit_direction option[value="' + el.data('direction') + '"]').prop('selected', true);
            form.find('#edit_status option[value="' + el.data('status') + '"]').prop('selected', true);
        });

        $(document).on('click', '.lang_clone_btn', function () {
            var el = $(this);
            var id = el.data('id');
            var form = $('#language_item_clone_modal');
            form.find('input[name="id"]').val(id);
        });

       
    });
</script>
@endpush
