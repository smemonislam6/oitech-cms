@extends('backend.layouts.app')
@section('site-title')
    {{__('New Page')}}
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
                            <h4 class="header-title">{{__('Add New Page')}}</h4>
                            <a href="{{route('admin.page.index')}}" class="btn btn-primary">{{__('All Pages')}}</a>
                        </div>
                        <form action="{{route('admin.page.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('Language')}}</label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="{{__('Title')}}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">{{__('Content')}}</label>
                                        <textarea name="content" class="form-control editor" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('Status')}}</label>
                                        <select name="status" id="status_page" class="form-control">
                                            <option value="publish">{{__('Publish')}}</option>
                                            <option value="draft">{{__('Draft')}}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{__('Visibility')}}</label>
                                        <select name="visibility" class="form-control">
                                            <option value="all">{{__('All')}}</option>
                                            <option value="user">{{__('Only Logged In User')}}</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="meta_tags">{{__('Page Meta Tags')}}</label>
                                        <select name="meta_tags[]" class="form-select select2_tags" id="meta_tags"></select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="meta_description">{{__('Page Meta Description')}}</label>
                                        <textarea name="meta_description" class="form-control" id="meta_description"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Page')}}</button>
                                </div>
                            </div>
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
