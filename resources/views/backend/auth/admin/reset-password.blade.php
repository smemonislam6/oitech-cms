@extends('backend.layouts.auth')
@section('title', 'Reset Password')
@section('auth_content')
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-lg-10">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-block p-2">
                            <img src="{{ asset('assets/backend/images/auth-img.jpg') }}" alt="" class="img-fluid rounded h-100">
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column h-100">
                                <div class="auth-brand p-4">
                                    <a href="index.html" class="logo-light">
                                        <img src="{{ asset('assets/backend/images/logo.png') }}" alt="logo" height="22">
                                    </a>
                                    <a href="index.html" class="logo-dark">
                                        <img src="{{ asset('assets/backend/images/logo-dark.png') }}" alt="dark logo" height="22">
                                    </a>
                                </div>
                                <div class="p-4 my-auto">
                                    @include('backend.partials.message')
                                    @include('backend.partials.error')
                                    
                                    <form action="{{ route('admin.reset.password', $token) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">                                            
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            <input class="form-control" name="password" type="password" id="password" placeholder="New Password" required>
                                        </div>
                                        <div class="mb-3">                                            
                                            <label for="password" class="form-label">{{ __('Confirm Password') }}</label>
                                            <input class="form-control" name="password_confirmation" type="password" id="password" placeholder="Confirm Password" required>
                                        </div>
    
                                        <div class="mb-0 text-start">
                                            <button class="btn btn-soft-primary w-100" type="submit">
                                                <i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">{{ __('Log In') }}</span> 
                                            </button>
                                        </div>
                                    </form>
                                    <!-- end form-->
                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection

@push('scripts')
<script >
    $(document).ready(function ($){            
        $(document).on('click','#form_submit',function (e){
            e.preventDefault();
            var el = $(this);
            var erContainer = $(".error-message");
            erContainer.html('');
            el.text('Please Wait..');
            axios.post(route('admin.login'), {
                _token : "{{csrf_token()}}",
                email: $('#emailaddress').val(),
                password: $('#password').val(),
                remember: $('#remember').val(),
            })
            .then(function (response) {
                $('.alert.alert-danger').remove();
                console.log(response.data.status)
                if (response.data.status == 'ok'){
                    el.text('Redirecting..');
                    erContainer.html('<div class="alert alert-'+response.data.type+'">'+response.data.msg+'</div>');
                    // location.reload();
                    window.location.href = route('home');
                }else{
                    erContainer.html('<div class="alert alert-'+response.data.type+'">'+response.data.msg+'</div>');
                    el.html('<i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log In</span>');
                }
            })
            .catch(function (error) {
                const errors = error.response.data;
                erContainer.html('<div class="alert alert-danger"></div>');
                $.each(errors.errors, function(index,value){
                    erContainer.find('.alert.alert-danger').append('<p>'+value+'</p>');
                });
                el.html('<i class="ri-login-circle-fill me-1"></i> <span class="fw-bold">Log In</span>');
            });
        });
    });
</script>
@endpush