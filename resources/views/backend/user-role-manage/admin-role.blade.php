@extends('backend.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
@endpush
@section('site-title')
    {{__('All Admin Role')}}
@endsection
@section('admin_content')

@php
    $all_permission_list = array(
        "Appearance Settings",
        "Admin Manage",
        "About Page Manage",
        "Users Manage",
        "Newsletter Manage",
        "Dynamic Pages",
        "Blogs Manage",
        "Home Variant",
        "Topbar Settings",
        "Home Page Manage",
        "Contact Page Manage",
        "Services",
        "404 Page Manage",
        "FAQ",
        "Price Plan",
        "Team Members",
        "Testimonials",
        "Brand Logos",
        "General Settings",
        "Languages",
        "Email Templates",
        "Page Settings",
        "Portfolios",
        "Slider Manage"
    );
@endphp

    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend/partials/message')
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Admin Role')}}</h4>
                        <table id="all_user_table" class="table table-striped">
                            <thead class="text-capitalize bg-primary">
                            <tr >
                                <th class="text-white">{{__('ID')}}</th>
                                <th class="text-white">{{__('Role')}}</th>
                                <th class="text-white">{{__('Permissions')}}</th>
                                <th class="text-white">{{__('Action')}}</th>
                            </tr>
                            </thead>
                            <tbody >
                                @foreach($all_role as $data)
                                    <tr >
                                        <td >{{$data->id}}</td>
                                        <td >{{$data->name}}</td>
                                        <td >
                                            <div class="permission-show">
                                                @foreach($data->permission as $index => $per)
                                                    <span class="text text-success">{{ ucwords(str_replace('_', ' ', $per)) }}</span>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td >
                                            <div class="d-flex">
                                                @include('backend.partials.delete-with-swal', ['url' => route('admin.user.destory.role', $data->id)])
                                                <a href="#" data-id="{{$data->id}}" data-name="{{$data->name}}" data-permission="{{ json_encode($data->permission) }}" data-bs-toggle="modal" data-bs-target="#user_edit_modal" class="btn btn-primary btn-sm mr-1 user_edit_btn">
                                                <i class="ri-pencil-line"></i>
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
                        <h4 class="header-title">{{__('Add New Admin Role')}}</h4>

                       @include('backend.partials.message')
                       @include('backend.partials.error')
                        <form action="{{route('admin.user.store.role')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{__('Role Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Enter Role name')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="permission">{{__('Permissions')}}</label>
                                <select name="permission[]" multiple id="permission" class="form-control nice-select wide">
                                    @foreach($all_permission_list as $per)
                                    <option value="{{strtolower(str_replace(' ','_',$per))}}">{{$per}}</option>
                                    @endforeach
                                </select>
                                <div class="form-text">{{__('assign permission to role, which page can seen by the this role')}}</div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Role')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Admin Role Edit')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.user.role.edit')}}" id="user_edit_modal_form" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="admin_role_id" id="admin_role_id">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="edit_name">{{__('Role Name')}}</label>
                            <input type="text" class="form-control" id="edit_name" name="name" placeholder="{{__('Enter Role name')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="edit_permission">{{__('Permissions')}}</label>
                            <select name="permission[]" multiple id="edit_permission" class="form-control nice-select wide">
                                @foreach($all_permission_list as $per)
                                    <option value="{{strtolower(str_replace(' ','_',$per))}}">{{$per}}</option>
                                @endforeach
                            </select>
                            <div class="info-text">{{__('assign permission to role, which page can seen by the this role')}}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script >
        $(document).ready(function () {

            $(document).on('click','.user_edit_btn',function(){
                var el = $(this);
                var form = $('#user_edit_modal_form');
                var permission = el.data('permission');
                form.find('#admin_role_id').val(el.data('id'));
                form.find('#edit_name').val(el.data('name'));
                $.each(permission,function (index,value) {
                    form.find('#edit_permission option[value="'+value+'"]').attr('selected',true);
                });
                $('#edit_permission').niceSelect('update');
            });

            if($('.nice-select').length > 0){
                $('.nice-select').niceSelect();
            }
        });
    </script>
@endpush
