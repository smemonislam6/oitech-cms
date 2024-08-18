@extends('backend.layouts.app')
@section('site-title')
    {{__('Slider Area')}}
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
                    <h4 class="header-title">{{__('Slider Area Settings')}}</h4>
                    <form action="{{route('admin.home-page.slider')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Sliders Item')}}</label>
                                <select name="slider_section_{{get_static_option('home_page_variant')}}_id[]" class="form-select select2_tags" multiple="multiple" id="tagsInput">
                                    @php
                                        $sliderItems = 'slider_section_' . get_static_option('home_page_variant') . '_id';
                                        $sliderItems = json_decode(get_static_option($sliderItems), true) ?? [];
                                    @endphp
                                    @foreach ($all_sliders as $slider)
                                        <option value="{{ $slider->id }}" @selected(in_array($slider->id, $sliderItems))>{{ $slider->title }}</option>
                                    @endforeach
                                </select>
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
