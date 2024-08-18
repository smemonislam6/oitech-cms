@extends('backend.layouts.app')
@section('site-title')
    {{__('Services')}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/select2/css/select2.min.css')}}">
@endpush
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('New Service')}}</h4>
                            <a href="{{route('admin.services.index')}}" class="btn btn-primary">{{__('All Services')}}</a>
                        </div>

                        <form action="{{route('admin.services.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="language">{{__('Language')}}</label>
                                <select name="lang" id="language" class="form-control">
                                    <option value="">{{__('Select Language')}}</option>
                                    @foreach(get_all_language() as $language)
                                        <option value="{{$language->slug}}" @selected(get_default_language() == $language->slug)>{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control" value="{{old('title')}}" name="title" placeholder="{{__('Title')}}">
                            </div>
                            <div class="mb-3">
                                <label for="edit_icon_type">{{__('Icon Type')}}</label>
                                <select name="icon_type" class="form-control" id="edit_icon_type">
                                    <option value="icon">{{__("Font Icon")}}</option>
                                    <option value="image">{{__("Image Icon")}}</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="icon" class="d-block">{{__('Icon')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="icon" value="fas fa-exclamation-triangle" name="icon">
                            </div>

                            <div class="mb-3">
                                <div class="mb-3 edit">
                                    <img src="{{ asset(get_placeholder_image_path('Service')) }}" alt="Default Image" class="image-preview-container max-height-img">
                                </div>
                                <label for="img_icon">{{__('Image Icon')}}</label>
                                <input type="file" class="form-control" id="edit_image" name="img_icon">
                                <div >{{__('Recommended image size 60x60')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="description">{{__('Description')}}</label>
                                <textarea name="description" class="form-control editor" cols="30" rows="10">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="excerpt">{{__('Excerpt')}}</label>
                                <textarea name="excerpt" id="excerpt" class="form-control max-height-150" placeholder="{{__('Excerpt')}}" cols="30" rows="10">{{ old('excerpt') }}</textarea>
                                <small class="info-text">{{__('it will show in home pages service item short details.')}}</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta_tags">{{__('Meta Tags')}}</label>
                                <select name="meta_tags[]" class="form-select select2_tags" id="meta_tags"></select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="meta_description">{{__('Meta Description')}}</label>
                                <textarea name="meta_description" class="form-control" rows="5" id="meta_description"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="category">{{__('Category')}}</label>
                                <select name="service_category_id[]" id="category" class="select2 form-control select2-multiple" multiple data-toggle="select2" data-placeholder="Choose Category...">
                                    @foreach (get_service_category_all() as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="info-text">{{__('select language to get category by language')}}</span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="price_plan">{{__('Price Plans')}}</label>
                                <select name="price_plan_id[]" multiple class="select2 form-control select2-multiple" data-toggle="select2" data-placeholder="Choose Plan..." id="price_plan_select">
                                    @if($price_plans != null )
                                        @foreach($price_plans as $data)
                                            <option value="{{$data->id}}">{{$data->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="info-text">{{__('select language to get price plan by language')}}</span>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="status">{{__('Status')}}</label>
                                <select name="status" id="service_status" class="form-control">
                                    <option value="publish">{{__('Publish')}}</option>
                                    <option value="draft">{{__('Draft')}}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sr_order">{{__('Order')}}</label>
                                <input type="number" class="form-control" value="{{old('sr_order')}}" name="sr_order" placeholder="{{__('eg: 1')}}">
                                <span class="info-text">{{__('if you set order for it, all service will show in frontend as a per this order')}}</span>
                            </div>

                            <div class="mb-3">
                                <label for="icon" class="d-block">{{__('Sidebar Icon')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" id="sidebar_icon" value="fas fa-exclamation-triangle" name="sideber_icon">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="sidebar_title">{{__('Sidebar Title')}}</label>
                                <input type="text" class="form-control" value="{{old('sidebar_title')}}" name="sidebar_title">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sidebar_phone">{{__('Sidebar Phone')}}</label>
                                <input type="text" class="form-control" value="{{old('sidebar_phone')}}" name="sidebar_phone">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sidebar_sub_title">{{__('Sidebar Sub Title')}}</label>
                                <input type="text" class="form-control" value="{{old('sidebar_sub_title')}}" name="sidebar_sub_title">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <img id="bgImagePreview" src="{{ asset(get_placeholder_image_path('Service')) }}" alt="Default Image" class="max-height-img">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="add_image_1">{{__('Image')}}</label>
                                        <input type="file" class="form-control" id="add_image_1" name="image">
                                        <div class="form-text" >{{__('Recommended image size 1920x1280')}}</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <img id="pdfImagePreview" src="{{ asset('uploads/no_pdf.png') }}" alt="Default PDF" class="max-height-img">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="add_image_2">{{__('Image')}}</label>
                                        <input type="file" class="form-control" id="add_image_2" name="pdf">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <img id="sidebarImagePreview" src="{{ asset(get_placeholder_image_path('Service')) }}" alt="Default Image" class="max-height-img">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="add_image_3">{{__('Sidebar Background Image')}}</label>
                                        <input type="file" class="form-control" id="add_image_3" name="sidebar_image">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add Service')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/backend/vendor/select2/js/select2.min.js')}}"></script>
    <script >

            function previewImage(input, previewId) {
                var file = input.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + previewId).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

            $('#add_image_1').change(function() {
                previewImage(this, 'bgImagePreview');
            });

            $('#add_image_2').change(function() {
                previewImage(this, 'pdfImagePreview');
            });

            $('#add_image_3').change(function() {
                previewImage(this, 'sidebarImagePreview');
            });

        $(document).ready(function () {
            $(".select2_tags").select2({
                tags: true,
                multiple: true,
            });

            $(document).on('change','select[name="icon_type"]',function (e){
                e.preventDefault();
                var iconType = $(this).val();
                iconTypeFieldVal(iconType);
            });
            defaultIconType();

            function defaultIconType(){
                var iconType = $('select[name="icon_type"]').val();
                iconTypeFieldVal(iconType);
            }

            function iconTypeFieldVal(iconType){
                if (iconType == 'icon'){
                    $('input[name="img_icon"]').parent().hide();
                    $('input[name="icon"]').parent().show();
                }else if(iconType == 'image'){
                    $('input[name="icon"]').parent().hide();
                    $('input[name="img_icon"]').parent().show();
                }
            }

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

            $(document).on('change','#language',function (e) {
                e.preventDefault();
                var selectedLang = $(this).val();
                axios.post(route('admin.service.category.by.slug'), {
                    _token: "{{csrf_token()}}",
                    lang: selectedLang
                })
                .then(function (response) {
                    $('#category').html('');
                    response.data.forEach(function (value) {
                        $('#category').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                })
                .catch(function (error) {
                    console.error('Error fetching data:', error);
                });

                axios.post(route('admin.service.price.plan.by.slug'), {
                    _token: "{{csrf_token()}}",
                    lang: selectedLang
                })
                .then(function (response) {
                    $('#price_plan_select').html('');
                    response.data.forEach(function (value) {
                        $('#price_plan_select').append('<option value="' + value.id + '">' + value.title + '</option>');
                    });
                })
                .catch(function (error) {
                    console.error('Error fetching data:', error);
                });

            });
        });
    </script>
@endpush
