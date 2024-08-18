@extends('backend.layouts.auth')
@section('title', 'Forgot Password')
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
                                    <h4 class="fs-20">{{ __('Forgot Password?') }}</h4>
                                    <p class="text-muted mb-3">{{ __('Enter your email address and we\'ll send you an email with instructions to reset your password.') }}</p>
                                    @include('backend.partials.message')
                                    @include('backend.partials.error')
                                    <!-- form -->
                                    <form method="POST" action="{{ route('admin.forget.password') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">{{ __('Email address') }}</label>
                                            <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email">
                                        </div>
                                        
                                        <div class="mb-0 text-start">
                                            <button class="btn btn-soft-primary w-100" type="submit"><i class="ri-loop-left-line me-1 fw-bold"></i> <span class="fw-bold">{{ __('Reset Password') }}</span> </button>
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
        <div class="row">
            <div class="col-12 text-center">
                <p class="text-dark-emphasis">{{ __('Back To') }}<a href="{{ route('admin.login') }}" class="text-dark fw-bold ms-1 link-offset-3 text-decoration-underline"><b >{{ __('Log In') }}</b></a></p>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
@endsection