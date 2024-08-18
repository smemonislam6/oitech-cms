@extends('backend.layouts.app')
@section('site-title')
    {{__('New Price Plan')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body ">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('New Price Plan')}}</h4>
                            <a href="{{route('admin.price-plans.index')}}" class="btn btn-primary">{{__('All Price Plan')}}</a>
                        </div>

                        <form action="{{ route('admin.price-plans.update', $price_plan->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_language">{{__('Languages')}}</label>
                                    <select name="lang" id="edit_language" class="form-control">
                                        @foreach(get_all_language() as $lang)
                                            <option value="{{ $lang->slug }}" @selected($lang->slug == $price_plan->lang)>{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_title">{{__('Title')}}</label>
                                    <input type="text" class="form-control" id="edit_title" name="title" value="{{ $price_plan->title }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_price">{{__('Price')}}</label>
                                    <input type="text" class="form-control" id="edit_price" name="price" value="{{ $price_plan->price }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_type">{{__('Type')}}</label>
                                    <input type="text" class="form-control" id="edit_type" name="type" value="{{ $price_plan->type }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_icon_type">{{__('Icon Type')}}</label>
                                    <select name="icon_type" class="form-control" id="edit_icon_type">
                                        <option value="icon" @selected('icon' == $price_plan->icon_type)>{{__("Font Icon")}}</option>
                                        <option value="image" @selected('image' == $price_plan->icon_type)>{{__("Image Icon")}}</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="icon" class="d-block">{{__('Icon')}}</label>
                                    <div class="btn-group ">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="{{ $price_plan->icon }}"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="{{ $price_plan->icon }}" data-bs-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control" id="icon" value="{{ $price_plan->icon }}" name="icon">
                                </div>

                                <div class="mb-3">
                                    <div class="mb-3 edit">
                                        <img src="{{ asset($price_plan->ImageUrl) }}" alt="Default Image" class="image-preview-container max-width-img">
                                    </div>
                                    <label for="img_icon">{{__('Image Icon')}}</label>
                                    <input type="file" class="form-control" id="edit_image" name="img_icon">
                                    <div class="form-text">{{__('Recommended image size 256x256')}}</div>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_features">{{__('Features')}}</label>
                                    <textarea class="form-control" id="edit_features" name="features" cols="30" rows="10">{{ $price_plan->features }}</textarea>
                                    <small class="info=text">{{__('Separate feature by new line')}}</small>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_btn_text">{{__('Button Text')}}</label>
                                    <input type="text" class="form-control" id="edit_btn_text" name="btn_text" value="{{ $price_plan->btn_text }}">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_btn_url">{{__('Button URL')}}</label>
                                    <input type="text" class="form-control" id="edit_btn_url" name="btn_url" value="{{ $price_plan->btn_url }}">
                                </div>
                                <div class="mb-3">
                                    <label for="category">{{__('Category')}}</label>
                                    <select name="price_plan_category_id" class="form-control" id="category">
                                        @foreach($all_categories as $cat)
                                            <option value="{{$cat->id}}" @selected($cat->id == $price_plan->price_plan_category_id)>{{$cat->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_status">{{__('Status')}}</label>
                                    <select name="status" class="form-control" id="edit_status">
                                        <option value="publish" @selected('publish' == $price_plan->status)>{{__('Publish')}}</option>
                                        <option value="draft" @selected('draft' == $price_plan->status)>{{__('Draft')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

    <script >
        $(document).ready(function () {
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

            $(document).on('change', '#language', function(e) {
                e.preventDefault();
                const selectedLang = $(this).val();
                axios.post(route('admin.price-plans.lang.cat'), {
                        _token: '{{ csrf_token() }}',
                        lang: selectedLang
                    })
                    .then(function(response) {
                        $('#category').html('<option value="">Select Category</option>');
                        $.each(response.price_plan, function(index, value) {
                            $('#category').append('<option value="' + value.id + '">' + value.name + '</option>')
                        });

                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
@endpush
