@extends('backend.layouts.app')
@section('site-title')
    {{__('Add New Admin')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between">
                           <h4 class="header-title">{{__('New User')}}</h4>
                           <a href="{{route('admin.all.user')}}" class="btn btn-primary">{{__('All Admin')}}</a>
                       </div>
                        @include('backend.partials.message')
                        @include('backend.partials.error')
                        <form action="{{route('admin.user.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Enter name')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">{{__('Email')}}</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="{{__('Email')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">{{__('Password')}}</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="{{__('Password')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password_confirmation">{{__('Password Confirm')}}</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('Password Confirmation')}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="role">{{'Role'}}</label>
                                <select name="admin_role_id" id="role" class="form-control">
                                    @foreach( $all_admin_role as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 add">
                                <img src="{{ asset('uploads/default_image.jpg') }}" alt="Default Image" class="image-preview-container max-height-img">                                
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Change Photo') }}</label>
                                <input type="file" class="form-control" id="add_image" name="image">
                                <div >{{__('Recommended image size 200x200')}}</div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary pr-4 pl-4">{{__('Add New User')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection