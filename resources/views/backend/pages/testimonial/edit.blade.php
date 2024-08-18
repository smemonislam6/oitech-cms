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
                        <div class="header-wrap d-flex justify-content-between align-items-center">
                            <h4 class="header-title">{{__('Edit Testimonial')}}</h4>       
                            <a href="{{route('admin.testimonials.index')}}" class="btn btn-primary">{{__('All Testimonial')}}</a>                         
                        </div>
                        <form action="{{route('admin.testimonials.update', $testimonial->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="languages">{{__('Languages')}}</label>
                                <select name="lang" class="form-control" id="languages">
                                    @foreach($all_languages as $lang)
                                        <option value="{{$lang->slug}}" @selected($lang->slug == $testimonial->lang)>{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $testimonial->name) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="designation">{{__('Designation')}}</label>
                                <input type="text" class="form-control" id="designation" name="designation" value="{{ old('designation', $testimonial->designation) }}">
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">{{ __('Rating') }}</label>
                                <select name="rating" id="rating" class="form-select">
                                    @for($i=1; $i<=5; $i++)
                                        <option value="{{ $i }}" @selected(old('rating', $testimonial->rating) == $i)>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">{{ __('Descritpion') }}</label>
                                <textarea name="description" class="form-control" cols="30" rows="10">{{ old('description', $testimonial->description) }}</textarea>
                            </div>
                            <div class="mb-3 edit">                                                      
                                <img src="{{ asset($testimonial->TestimonialImageUrl) }}" alt="Default Image" class="image-preview-container max-height-img">                              
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control" id="edit_image" name="image">
                                <div class="form-text">{{__('Recommended image size 71x71')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="label" for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="add_status">
                                    <option value="publish" @selected($testimonial->status == 'publish')>{{__('Publish')}}</option>
                                    <option value="draft" @selected($testimonial->status == 'draft')>{{__('Draft')}}</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary ms-1">{{__('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
