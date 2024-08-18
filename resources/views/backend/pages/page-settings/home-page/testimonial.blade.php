@extends('backend.layouts.app')
@section('site-title')
    {{__('Testimonail Area')}}
@endsection
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/select2/css/select2.min.css')}}">
@endpush
@section('admin_content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Testimonail Area Settings')}}</h4>

                        <form action="{{route('admin.home-page.testimonial')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav >
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a @class(['nav-item nav-link', 'active' => $loop->first]) id="nav-home-tab" data-bs-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content mt-4" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div @class(['tab-pane fade', 'show active' => $loop->first]) id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="mb-3">
                                            <label class="form-label" for="testimonial_section_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="testimonial_section_{{$lang->slug}}_title" class="form-control" value="{{get_static_option('testimonial_section_'.$lang->slug.'_title')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="testimonial_section_{{$lang}}_sub_title">{{__('Sub Title')}}</label>
                                            <input type="text" name="testimonial_section_{{$lang->slug}}_sub_title" class="form-control" value="{{get_static_option('testimonial_section_'.$lang->slug.'_sub_title')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Testimonial Item')}}</label>
                                <select name="testimonial_section_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple" id="tagsInput">
                                    @php
                                        $testimonialItems = 'testimonial_section_' . get_static_option('home_page_variant') . '_id';
                                        $testimonialItems = json_decode(get_static_option($testimonialItems), true) ?? [];
                                    @endphp
                                    @foreach ($all_items as $item)
                                        <option value="{{ $item->id }}" @selected(in_array($item->id, $testimonialItems))>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3 edit">
                                        <label class="form-label d-block">{{__('Background Image')}}</label>
                                        @php
                                            $leftImage = get_static_option('testimonial_bg_image');
                                        @endphp
                                        @if($leftImage)
                                            <img src="{{ asset($leftImage) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                        @else
                                            <img src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control" id="edit_image" name="testimonial_bg_image">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3 add">
                                        <label class="form-label d-block">{{__('Float Image')}}</label>
                                        @php
                                            $leftImage = get_static_option('testimonial_float_image');
                                        @endphp
                                        @if($leftImage)
                                            <img src="{{ asset($leftImage) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                        @else
                                            <img src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_image" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control" id="add_image" name="testimonial_float_image">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
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
        $(document).ready(function () {
            $(".select2_tags").select2({
                tags: true,
                multiple: true,
            });
        });
    </script>
@endpush
