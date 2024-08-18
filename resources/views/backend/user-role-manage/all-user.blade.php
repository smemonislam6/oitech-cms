@extends('backend.layouts.app')
@section('site-title')
    {{__('All Admins')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    @include('backend.partials.message')
                                    @include('backend.partials.error')
                                    <h4 class="header-title">{{__('All Admin Created By Super Admin')}}</h4>
                                    <table id="all_user_table" class="table table-striped w-100 nowrap align-middle">
                                        <thead >
                                            <tr >
                                                <th >{{__('ID')}}</th>
                                                <th >{{__('Name')}}</th>
                                                <th >{{__('Image')}}</th>
                                                <th >{{__('Role')}}</th>
                                                <th >{{__('Email')}}</th>
                                                <th >{{__('Action')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @foreach($all_user as $data)
                                                <tr >
                                                    <td >{{$data->id}}</td>
                                                    <td >{{$data->name}}</td>
                                                    <td >
                                                        <div class="photo-container">
                                                            <a href="{{ asset($data->AdminImageUrl) }}" class="magnific">
                                                                <img src="{{ asset($data->AdminImageUrl) }}" alt="{{ $data->name }}">
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td >{{$data->role->name}}</td>
                                                    <td >{{$data->email}}</td>
                                                    <td >
                                                        @include('backend.partials.delete-with-swal', ['url' => route('admin.user.destroy', $data->id)])
                                                        <a href="#" data-id="{{$data->id}}" data-name="{{$data->name}}" data-role="{{$data->role->name}}" data-email="{{$data->email}}" data-image="{{ asset($data->AdminImageUrl) }}" data-bs-toggle="modal" data-bs-target="#user_edit_modal" class="btn btn-primary btn-sm mr-1 user_edit_btn">
                                                        <i class="ri-pencil-line"></i>
                                                        </a>
                                                        <a href="#" data-id="{{$data->id}}" data-bs-toggle="modal" data-bs-target="#user_change_password_modal" class="btn btn-info btn-sm mr-1 user_change_password_btn">
                                                            {{__("Change Password")}}
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('User Details Edit')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.user.update')}}" id="user_edit_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Enter name')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"for="email">{{__('Email')}}</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="{{__('Email')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"for="role">{{__('Role')}}</label>
                            <select name="admin_role_id" id="role" class="form-control">
                                @foreach($all_admin_role as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 edit">
                            <img src="{{ asset('uploads/default_image.jpg') }}" alt="Default Image" class="image-preview-container max-height-img">                                
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('Change Photo') }}</label>
                            <input type="file" class="form-control" id="edit_image" name="image">
                            <small >{{__('Recommended image size 200x200')}}</small>
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

    <div class="modal fade" id="user_change_password_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Change Admin Password')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @include('backend.partials.error')
                <form action="{{route('admin.user.password.change')}}" id="user_password_change_modal_form" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="ch_user_id" id="ch_user_id">
                        <div class="mb-3">
                            <label class="form-label"for="password">{{__('Password')}}</label>
                            <input type="password" class="form-control" name="password" placeholder="{{__('Enter Password')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Change Password')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
@endsection

@push('scripts')
    <script >
        $(document).ready(function() {

            $(document).on('click','.user_change_password_btn',function(e){
                e.preventDefault();
                var el = $(this);
                var form = $('#user_password_change_modal_form');
                form.find('#ch_user_id').val(el.data('id'));
            });

            $('#all_user_table').DataTable( {
                "order": [[ 0, "desc" ]]
            } );

            $(document).on('click','.user_edit_btn',function(e){
                e.preventDefault();
                var form = $('#user_edit_modal_form');
                var el = $(this);
                var image = el.data('image');

                form.find('#user_id').val(el.data('id'));
                form.find('#name').val(el.data('name'));
                form.find('#email').val(el.data('email'));
                form.find('.image-preview-container').attr('src',el.data('image'));
                form.find('#role option').each(function() {
                    if ($(this).text() === el.data('role')) {
                        $(this).prop('selected', true);
                    } else {
                        $(this).prop('selected', false);
                    }
                });
            });
        } );
    </script>
@endpush
