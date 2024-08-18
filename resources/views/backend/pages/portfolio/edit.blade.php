@extends('backend.layouts.app')
@section('site-title')
    {{__('portfolio')}}
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
                            <h4 class="header-title">{{__('Edit portfolio')}}</h4>       
                            <a href="{{route('admin.portfolios.index')}}" class="btn btn-primary">{{__('All portfolio')}}</a>                         
                        </div>
                        <form action="{{route('admin.portfolios.update', $portfolio->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="languages">{{__('Languages')}}</label>
                                <select name="lang" class="form-control" id="languages">
                                    @foreach($all_languages as $lang)
                                        <option value="{{$lang->slug}}" @selected($lang->slug == $portfolio->lang)>{{$lang->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label" for="title">{{__('Title')}}</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $portfolio->title) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="sub_title">{{__('Sub Title ')}}</label>
                                <input type="text" class="form-control" id="sub_title" name="sub_title" value="{{ old('title', $portfolio->sub_title) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="date">{{__('Date')}}</label>
                                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $portfolio->date) }}">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">{{ __('Descritpion') }}</label>
                                <textarea name="description" class="form-control editor" cols="30" rows="10">{{ old('description', $portfolio->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="client">{{__('Client')}}</label>
                                <input type="text" class="form-control" id="client" name="client" value="{{ old('client', $portfolio->client) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="website">{{__('Website')}}</label>
                                <input type="text" class="form-control" id="website" name="website" value="{{ old('website', $portfolio->website) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="location">{{__('Location')}}</label>
                                <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $portfolio->location) }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="value">{{__('Value')}}</label>
                                <input type="number" class="form-control" id="value" name="value" value="{{ old('value', $portfolio->value) }}">
                            </div>
                            <div class="mb-3 edit">                                                      
                                <img src="{{ asset($portfolio->PortfolioImageUrl) }}" alt="Default Image" class="image-preview-container max-height-img">                              
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="image">{{__('Image')}}</label>
                                <input type="file" class="form-control" id="edit_image" name="image">
                                <div class="form-text">{{__('Recommended image size 1980x1280')}}</div>
                            </div>
                            <div class="mb-3">
                                <label class="label" for="status">{{__('Status')}}</label>
                                <select name="status" class="form-control" id="add_status">
                                    <option value="publish" @selected($portfolio->status == 'publish')>{{__('Publish')}}</option>
                                    <option value="draft" @selected($portfolio->status == 'draft')>{{__('Draft')}}</option>
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
