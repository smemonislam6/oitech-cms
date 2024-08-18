@extends('backend.layouts.app')
@section('site-title', 'Edit Profile')
@section('admin_content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                @include('backend.partials.message')
                @include('backend.partials.error')
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-cols-sm-1 row-cols-1">
                        <div class="mb-3">
                            <label class="form-label" for="FullName">{{ __('Full Name') }}</label>
                            <input type="text" name="name" class="form-control" id="FullName" value="{{ old('name', Auth::guard('admin')->user()->name) }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="Email">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" id="Email" value="{{ old('email', Auth::guard('admin')->user()->email) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">{{ __('Existing Image') }}</label>
                            <div >
                                <img src="{{ asset(Auth::guard('admin')->user()->ProfileImageUrl) }}" alt="" class="image-preview-container max-height-img">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('Change Photo') }}</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="ri-save-line me-1 fs-16 lh-1"></i>{{ __('Save Chnages') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script >
    $(document).ready(function() {
        $('#image').change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-preview-container').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush