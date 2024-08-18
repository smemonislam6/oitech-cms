@extends('backend.layouts.auth')
@section('title', 'Login')
@section('auth_content')
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-lg-6">
                <div class="card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="d-flex flex-column h-100">
                                <div class="auth-brand p-4 pb-0 text-center">
                                    <a href="{{ route('admin.login') }}" class="logo-light">
                                        <img src="{{ asset(get_static_option('general_site_logo')) }}}" alt="logo">
                                    </a>
                                    <a href="{{ route('admin.login') }}" class="logo-dark">
                                        <img src="{{ asset(get_static_option('general_site_logo')) }}" alt="dark logo">
                                    </a>
                                </div>
                                <div class="p-4 my-auto">
                                    <h3 class="fs-20 text-center">{{ __('Sign In') }}</h3>
                                    @include('backend.partials.message')
                                    @include('backend.partials.error')
                                    <form action="{{ route('admin.login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="emailaddress" class="form-label">{{ __('Email address') }}</label>
                                            <input type="email" class="form-control" name="email" id="emailaddress" placeholder="Enter your email" value="super_admin@gmail.com" required>
                                        </div>
                                        <div class="mb-3">
                                            <a href="{{ route('admin.forget.password') }}" class="text-muted float-end"><small >{{ __('Forgot your password?') }}</small></a>
                                            <label for="password" class="form-label">{{ __('Password') }}</label>
                                            <input type="password" class="form-control" name="password" placeholder="Enter your password" value="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                                                <label class="form-check-label" for="checkbox-signin">{{ __('Remember me') }}</label>
                                            </div>
                                        </div>
                                        <div class="mb-0 text-start">
                                            <button class="btn btn-soft-primary w-100" type="submit" id="form_submit">
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
