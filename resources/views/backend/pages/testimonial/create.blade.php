@extends('backend.layouts.app')
@section('site-title')
    {{__('Testimonial')}}
@endsection
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
                        <div class="header-wrap">
                            <h4 class="header-title">{{__('New Testimonial')}}</h4>                                
                        </div>
                        <form action="{{route('admin.testimonials.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
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
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="designation">{{__('Designation')}}</label>
                                <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation') }}">
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">{{ __('Rating') }}</label>
                                <select name="rating" id="rating" class="form-select">
                                    @for($i=1; $i<=5; $i++)
                                        <option value="{{ $i }}" @selected(old('rating')==$i)>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">{{ __('Descritpion') }}</label>
                                <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description') }}</textarea>
                            </div>
                            <div class="mb-3 add">                                                      
                                <img src="{{ asset(get_placeholder_image_path('Testimonial')) }}" alt="Default Image" class="image-preview-container max-heiht-img">                              
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control" id="add_image" name="image">
                                <div class="form-text">{{__('Recommended image size 71x71')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="label" for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="add_status">
                                    <option value="publish">{{__('Publish')}}</option>
                                    <option value="draft">{{__('Draft')}}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary ms-1">{{__('Add New')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
