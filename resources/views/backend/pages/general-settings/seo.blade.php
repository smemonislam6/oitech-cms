@extends('backend.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endpush
@section('site-title')
    {{__('SEO Settings')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("SEO Settings")}}</h4>
                        <form action="{{route('admin.general.seo.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content mt-4" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="mb-3">
                                            <label for="site_meta_{{$lang->slug}}_tags">{{__('Site Meta Tags')}}</label>
                                            <input type="text" name="site_meta_{{$lang->slug}}_tags"  class="form-control" data-role="tagsinput" value="{{get_static_option('site_meta_'.$lang->slug.'_tags')}}" id="site_meta_{{$lang->slug}}_tags">
                                        </div>
                                        <div class="mb-3">
                                            <label for="site_meta_{{$lang->slug}}_description">{{__('Site Meta Description')}}</label>
                                            <textarea name="site_meta_{{$lang->slug}}_description"  class="form-control" id="site_meta_{{$lang->slug}}_description">{{get_static_option('site_meta_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
@endpush
