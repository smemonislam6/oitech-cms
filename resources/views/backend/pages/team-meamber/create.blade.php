@extends('backend.layouts.app')
@section('site-title')
    {{__('Team Members')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <form action="{{route('admin.team-members.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                </div>
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="header-wrap">
                                <h4 class="header-title">{{__('New Members')}}</h4>                                
                            </div>
                                <div class="mb-3">
                                    <label class="form-label" for="languages">{{__('Languages')}}</label>
                                    <select name="lang" class="form-control" id="languages">
                                        @foreach($all_languages as $lang)
                                            <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="name">{{__('Name')}}</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Name')}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="designation">{{__('Designation')}}</label>
                                    <input type="text" class="form-control" id="designation" name="designation" placeholder="{{__('Designation')}}">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('Tagline') }}</label>
                                    <textarea name="tagline" class="form-control editor" cols="30" rows="10">{{ old('tagline') }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block" for="icon_one">{{__('Social Profile One')}}</label>
                                    <div class="btn-group ">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="fab fa-instagram"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fab fa-instagram" data-bs-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control" id="icon_one" value="fab fa-instagram" name="icon_one">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="icon_one_url">{{__('Social Profile One URL')}}</label>
                                    <input type="text" class="form-control" id="icon_one_url" name="icon_one_url" placeholder="{{__('Social Profile One URL')}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block" for="icon_two">{{__('Social Profile Two')}}</label>
                                    <div class="btn-group ">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="fab fa-twitter"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fab fa-twitter" data-bs-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control" id="icon_two" value="fab fa-twitter" name="icon_two">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="icon_two_url">{{__('Social Profile Two URL')}}</label>
                                    <input type="text" class="form-control" id="icon_two_url" name="icon_two_url" placeholder="{{__('Social Profile Two URL')}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block" for="icon_three">{{__('Social Profile Three')}}</label>
                                    <div class="btn-group ">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="fab fa-facebook-f"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fab fa-facebook-f" data-bs-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control" id="icon_three" value="fab fa-facebook-f" name="icon_three">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="icon_three_url">{{__('Social Profile Three URL')}}</label>
                                    <input type="text" class="form-control" id="icon_three_url" name="icon_three_url" placeholder="{{__('Social Profile Three URL')}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label d-block" for="icon_three">{{__('Social Profile Four')}}</label>
                                    <div class="btn-group ">
                                        <button type="button" class="btn btn-primary iconpicker-component">
                                            <i class="fab fa-facebook-f"></i>
                                        </button>
                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fab fa-pinterest-p" data-bs-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                        </button>
                                        <div class="dropdown-menu"></div>
                                    </div>
                                    <input type="hidden" class="form-control" id="icon_four" value="fab fa-pinterest-p" name="icon_four">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="icon_four_url">{{__('Social Profile Three URL')}}</label>
                                    <input type="text" class="form-control" id="icon_four_url" name="icon_four_url" placeholder="{{__('Social Profile Three URL')}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="ex_title">{{__('Experience Title')}}</label>
                                    <input type="text" class="form-control" id="ex_title" name="experience_title" placeholder="{{__('Experience Title')}}">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ __('Experience Text') }}</label>
                                    <textarea name="experience_text" class="form-control" cols="30" rows="10">{{ old('experience_text') }}</textarea>
                                </div>
                                <div class="mb-3 add">                                                      
                                    <img src="{{ asset(get_placeholder_image_path('TeamMember')) }}" alt="Default Image" class="image-preview-container max-height-img">                              
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="image">{{__('Image')}}</label>
                                    <input type="file" class="form-control" id="add_image" name="image">
                                    <div class="form-text">{{__('Recommended image size 570x530')}}</div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card shadow">                    
                        <div class="card-body">
                            <div class="header-wrap d-flex justify-content-end mb-3">
                                <a href="{{route('admin.team-members.index')}}" class="btn btn-primary">{{__('All Team Member')}}</a>
                                <button type="submit" class="btn btn-primary ms-1">{{__('Add New Team Member')}}</button>
                            </div>
                            <div class="repeater-wrapper">
                                <div class="all-field-wrap">
                                    <div class="tab-content mt-4" id="myTabContent">
                                        <div class="mb-3">
                                            <label class="form-label" for="progress_title">{{__('Progress Title')}}</label>
                                            <input type="text" class="form-control" id="progress_title" name="progress_title[]" placeholder="{{__('Progress title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="percentage">{{__('Percentage')}}</label>
                                            <input type="number" class="form-control" id="percentage" name="percentage[]" placeholder="{{__('Percentage')}}">
                                        </div>
                                    </div>
                                    <div class="action-wrap">
                                        <span class="add"><i class="ri-add-line"></i></span>
                                        <span class="remove"><i class="ri-delete-bin-line"></i></span>
                                    </div>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
<script >
    $(document).ready(function () {

        $('.icp-dd').iconpicker();
        $('.icp-dd').on('iconpickerSelected', function (e) {
            var selectedIcon = e.iconpickerValue;
            $(this).parent().parent().children('input').val(selectedIcon);
        });

        $(document).on('click', '.all-field-wrap .action-wrap .add', function (e) {
            e.preventDefault();

            var parent = $(this).parent().parent();
            var clonedData = parent.clone();
            parent.parent().append(clonedData);
        });

        $(document).on('click', '.all-field-wrap .action-wrap .remove', function (e) {
            e.preventDefault();
            var parent = $(this).parent().parent();
            var container = $('.all-field-wrap');

            if (container.length > 1) {
                parent.remove();
            }
        });

    });
</script>
@endpush
