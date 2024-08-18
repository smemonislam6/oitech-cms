@php
    $siteTitle = get_static_option('general_site_' . get_default_language() . '_title');
    $tagLine = get_static_option('general_site_' . get_default_language() . '_tag_line');
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head >
        <meta charset="utf-8" />
        <title >{{ $siteTitle }} - {{ $tagLine }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
        <meta content="Techzaa" name="author" />
        <link rel="shortcut icon" href="{{ asset(get_static_option('general_site_favicon')) }}" type="image/x-icon" />
		<link rel="icon" href="{{ asset(get_static_option('general_site_favicon')) }}" type="image/x-icon" />
        @include('backend.layouts.styles')
        @routes
    </head>

    <body >
        <!-- Begin page -->
        <div class="wrapper">


            <!-- ========== Topbar Start ========== -->
            @include('backend.layouts.header')
            <!-- ========== Topbar End ========== -->


            <!-- ========== Left Sidebar Start ========== -->
            @include('backend.layouts.sidebar')
            <!-- ========== Left Sidebar End ========== -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('Home') }}</a></li>
                                            <li class="breadcrumb-item active">@yield('site-title')</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">@yield('site-title')</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
                        @yield('admin_content')

                    </div>
                    <!-- container -->

                </div>
                <!-- content -->

                @include('backend.layouts.footer')

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Theme Settings -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
            <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
                <h5 class="text-white m-0">{{ __('Theme Settings') }}</h5>
                <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body p-0">
                <div data-simplebar class="h-100">
                    <div class="p-3">
                        <h5 class="mb-3 fs-16 fw-bold">{{ __('Color Scheme') }}</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check form-switch card-switch mb-1">
                                    <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light" value="light">
                                    <label class="form-check-label" for="layout-color-light">
                                        <img src="{{ asset('assets/backend/images/layouts/light.png') }}" alt="" class="img-fluid">
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">{{ __('Light') }}</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check form-switch card-switch mb-1">
                                    <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark" value="dark">
                                    <label class="form-check-label" for="layout-color-dark">
                                        <img src="{{ asset('assets/backend/images/layouts/dark.png') }}" alt="" class="img-fluid">
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">{{ __('Dark') }}</h5>
                            </div>
                        </div>

                        <div id="layout-width">
                            <h5 class="my-3 fs-16 fw-bold">{{ __('Layout Mode') }}</h5>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check form-switch card-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-fluid" value="fluid">
                                        <label class="form-check-label" for="layout-mode-fluid">
                                            <img src="{{ asset('assets/backend/images/layouts/light.png') }}" alt="" class="img-fluid">
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">{{ __('Fluid') }}</h5>
                                </div>

                                <div class="col-4">
                                    <div id="layout-boxed">
                                        <div class="form-check form-switch card-switch mb-1">
                                            <input class="form-check-input" type="checkbox" name="data-layout-mode" id="layout-mode-boxed" value="boxed">
                                            <label class="form-check-label" for="layout-mode-boxed">
                                                <img src="{{ asset('assets/backend/images/layouts/boxed.png') }}" alt="" class="img-fluid">
                                            </label>
                                        </div>
                                        <h5 class="font-14 text-center text-muted mt-2">{{ __('Boxed') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h5 class="my-3 fs-16 fw-bold">{{ __('Topbar Color') }}</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check form-switch card-switch mb-1">
                                    <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-light" value="light">
                                    <label class="form-check-label" for="topbar-color-light">
                                        <img src="{{ asset('assets/backend/images/layouts/light.png') }}" alt="" class="img-fluid">
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">{{ __('Light') }}</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check form-switch card-switch mb-1">
                                    <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-dark" value="dark">
                                    <label class="form-check-label" for="topbar-color-dark">
                                        <img src="{{ asset('assets/backend/images/layouts/topbar-dark.png') }}" alt="" class="img-fluid">
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">{{ __('Dark') }}</h5>
                            </div>
                        </div>

                        <div >
                            <h5 class="my-3 fs-16 fw-bold">{{ __('Menu Color') }}</h5>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check form-switch card-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-light" value="light">
                                        <label class="form-check-label" for="leftbar-color-light">
                                            <img src="{{ asset('assets/backend/images/layouts/sidebar-light.png') }}" alt="" class="img-fluid">
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">{{ __('Light') }}</h5>
                                </div>

                                <div class="col-4">
                                    <div class="form-check form-switch card-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="data-menu-color" id="leftbar-color-dark" value="dark">
                                        <label class="form-check-label" for="leftbar-color-dark">
                                            <img src="{{ asset('assets/backend/images/layouts/light.png') }}" alt="" class="img-fluid">
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">{{ __('Dark') }}</h5>
                                </div>
                            </div>
                        </div>

                        <div id="sidebar-size">
                            <h5 class="my-3 fs-16 fw-bold">{{ __('Sidebar Size') }}</h5>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-check form-switch card-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-default" value="default">
                                        <label class="form-check-label" for="leftbar-size-default">
                                            <img src="{{ asset('assets/backend/images/layouts/light.png') }}" alt="" class="img-fluid">
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">{{ __('Default') }}</h5>
                                </div>

                                <div class="col-4">
                                    <div class="form-check form-switch card-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-compact" value="compact">
                                        <label class="form-check-label" for="leftbar-size-compact">
                                            <img src="{{ asset('assets/backend/images/layouts/compact.png') }}" alt="" class="img-fluid">
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">{{ __('Compact') }}</h5>
                                </div>

                                <div class="col-4">
                                    <div class="form-check form-switch card-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-small" value="condensed">
                                        <label class="form-check-label" for="leftbar-size-small">
                                            <img src="{{ asset('assets/backend/images/layouts/sm.png') }}" alt="" class="img-fluid">
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">{{ __('Condensed') }}</h5>
                                </div>


                                <div class="col-4">
                                    <div class="form-check form-switch card-switch mb-1">
                                        <input class="form-check-input" type="checkbox" name="data-sidenav-size" id="leftbar-size-full" value="full">
                                        <label class="form-check-label" for="leftbar-size-full">
                                            <img src="{{ asset('assets/backend/images/layouts/full.png') }}" alt="" class="img-fluid">
                                        </label>
                                    </div>
                                    <h5 class="font-14 text-center text-muted mt-2">{{ __('Full Layout') }}</h5>
                                </div>
                            </div>
                        </div>

                        <div id="layout-position">
                            <h5 class="my-3 fs-16 fw-bold">{{ __('Layout Position') }}</h5>

                            <div class="btn-group checkbox" role="group">
                                <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed" value="fixed">
                                <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">{{ __('Fixed') }}</label>

                                <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-scrollable" value="scrollable">
                                <label class="btn btn-soft-primary w-sm ms-0" for="layout-position-scrollable">{{ __('Scrollable') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-footer border-top p-3 text-center">
                <div class="row">
                    <div class="col-6">
                        <button type="button" class="btn btn-light w-100" id="reset-layout">{{ __('Reset') }}</button>
                    </div>
                    <div class="col-6">
                        <a href="#" target="_blank" role="button" class="btn btn-primary w-100">{{ __('Buy Now') }}</a>
                    </div>
                </div>
            </div>
        </div>

        @include('backend.layouts.scripts')
        <script >
            (function($){
                "use strict";

                $(document).ready(function ($) {
                    $(document).on('click','.swal_delete_button',function(e){
                      e.preventDefault();
                        Swal.fire({
                          title: '{{__("Are you sure?")}}',
                          text: '{{__("You would not be able to revert this item!")}}',
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#3085d6',
                          cancelButtonColor: '#d33',
                          confirmButtonText: "{{__('Yes, delete it!')}}",
                          cancelButtonText: "{{__('cancel')}}",
                        }).then((result) => {
                          if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                          }
                        });
                    });

                });

                $(document).on('click','.swal_change_language_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '{{__("Are you sure to make this language as a default language?")}}',
                        text: '{{__("Languages will be turn changed as default")}}',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, Change it!')}}",
                    cancelButtonText: "{{__('cancel')}}",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('change', '#edit_image', function() {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('.edit .image-preview-container').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(this.files[0]);
                    }
                });

                $(document).on('change', '#add_image', function() {
                    if (this.files && this.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('.add .image-preview-container').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(this.files[0]);
                    }
                });

            })(jQuery);
        </script>

    </body>
</html>
