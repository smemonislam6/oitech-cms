@extends('backend.layouts.app')
@section('site-title', 'Change Password')
@section('admin_content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                @include('backend.partials.message')
                @include('backend.partials.error')
                
                <form action="{{ route('admin.password.change') }}" method="POST">
                    @csrf
                    <div class="row row-cols-sm-1 row-cols-1">
                        <div class="mb-3">
                            <label class="form-label" for="old_password">{{__('Old Password')}}</label>
                            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="{{__('Old Password')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">{{__('New Password')}}</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="{{__('New Password')}}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('Confirm Password')}}" required>
                        </div>                        
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="ri-save-line me-1 fs-16 lh-1"></i>{{ __('Save Chnages') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection