@extends('backend.layouts.app')
@section('site-title')
    {{__('Portfolio')}}
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
                            <h4 class="header-title">{{__('New Portfolio')}}</h4>   
                            <a href="{{route('admin.portfolios.index')}}" class="btn btn-primary">{{__('All Portfolio')}}</a>                              
                        </div>
                        <form action="{{route('admin.portfolios.store')}}" method="post" enctype="multipart/form-data">
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
                                <label class="form-label" for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sub_title">{{__('Sub Title ')}}</label>
                                <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('sub_title') }}">
                            </div>                            
                            <div class="mb-3">
                                <label class="form-label" for="date">{{__('Date')}}</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">{{ __('Descritpion') }}</label>
                                <textarea name="description" class="form-control editor" cols="30" rows="10">{{old('description')}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="client">{{__('Client')}}</label>
                                <input type="text" class="form-control" id="client" name="client" value="{{ old('client') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="website">{{__('Website')}}</label>
                                <input type="text" class="form-control" id="website" name="website" value="{{ old('website') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="location">{{__('Location')}}</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="value">{{__('Value')}}</label>
                                <input type="number" class="form-control" id="value" name="value" value="{{ old('value') }}">
                            </div>
                            <div class="mb-3 add">                                                      
                                <img src="{{ asset(get_placeholder_image_path('Portfolio')) }}" alt="Default Image" class="image-preview-container max-height-img">                              
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control" id="add_image" name="image">
                                <div class="form-text">{{__('Recommended image size 1980x1280')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="label" for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="add_status">
                                    <option value="publish">{{__('Publish')}}</option>
                                    <option value="draft">{{__('Draft')}}</option>
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
