@extends('backend.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/vendor/select2/css/select2.min.css')}}">
@endpush
@section('site-title')
    {{__('New Blog Post')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <form action="{{route('admin.blog.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card">
                        <div class="card-body">
                            <div class="header-wrap d-flex justify-content-between">
                                <h4 class="header-title">{{__('Add New Blog Post')}}</h4>
                                <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New Post')}}</button>
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="mb-3">
                                        <label class="form-label" for="language"><strong >{{__('Language')}}</strong></label>
                                        <select name="lang" id="language" class="form-control">
                                            <option value="">{{__('Select Language')}}</option>
                                            @foreach(get_all_language() as $lang)
                                            <option value="{{$lang->slug}}" @selected($lang->slug == get_default_language())>{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" value="{{old('title')}}" name="title" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">{{__('Content')}}</label>
                                        <textarea name="content" class="form-control editor" cols="30" rows="10">{{ old('content') }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="meta_tags">{{__('Meta Tags')}}</label>
                                        <select name="meta_tags[]" class="form-select select2_tags" id="meta_tags"></select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="meta_description">{{__('Meta Description')}}</label>
                                        <textarea name="meta_description" class="form-control" rows="5" id="meta_description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('Excerpt')}}</label>
                                        <textarea name="excerpt" id="excerpt" class="form-control max-height-150" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="category">{{ __('Category') }}</label>
                                        <select name="blog_category_id[]" id="category_id" class="select2 form-control select2-multiple" multiple data-toggle="select2" data-placeholder="Choose Category...">
                                            @foreach (get_blog_category_all() as $category)
                                            <option value="{{ $category->id }}"
                                                @if (old('blog_category_id') && in_array($category->id, old('blog_category_id')))
                                                    selected
                                                @elseif ($category->name == 'Uncategorized' && isset($blog) && $blog->categories->contains($category->id))
                                                    selected
                                                @endif>
                                                {{ $category->name }}
                                            </option>
                                            @endforeach                                        
                                        </select>
                                        <span class="form-text">{{ __('select language to get category by language') }}</span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('Tags')}}</label>
                                        <select class="form-select select2_tags" name="tags[]" multiple="multiple" id="tagsInput">
                                            @foreach (get_blog_tag_all() as $tag)
                                                <option value="{{ $tag->name }}">
                                                    {{ $tag->name }}
                                                </option>
                                            @endforeach 
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="author">{{__('Author Name')}}</label>
                                        <input type="text" class="form-control" name="author" id="author" value="{{old('author')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="video_url">{{__('Video Url')}}</label>
                                        <input type="text" class="form-control" name="video_url" value="{{old('video_url')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="breaking_news"><strong >{{__('Is Breaking News')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="breaking_news">
                                            <span class="slider onff"></span>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="status">{{__('Status')}}</label>
                                        <select name="status" id="blog_status" class="form-control">
                                            <option value="publish">{{__('Publish')}}</option>
                                            <option value="draft">{{__('Draft')}}</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 add">                                                      
                                        <img src="{{ asset(get_placeholder_image_path('Blog')) }}" alt="Default Image" class="image-preview-container max-height-img">                              
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">{{ __('Change Photo') }}</label>
                                        <input type="file" class="form-control" id="add_image" name="image">
                                        <div class="form-text">{{__('Recommended image size 1980x1280')}}</div>
                                    </div>
                                    
                                </div>
                            </div>                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{asset('assets/backend/vendor/select2/js/select2.min.js')}}"></script>
    <script >
        $(document).ready(function () {     
            $('.select2_tags').select2({
                tags: true,
                multiple: true,
            });

            $(document).on('click','.category_edit_btn',function(){
                const el = $(this);
                const id = el.data('id');
                const name = el.data('name');
                const status = el.data('status');
                const modal = $('#category_edit_modal');
                modal.find('#category_id').val(id);
                modal.find('#edit_status option[value="'+status+'"]').attr('selected',true);
                modal.find('#edit_name').val(name);
            });

            $(document).on('change','#language',function(e){
                e.preventDefault();
                const selectedLang = $(this).val();
                axios.post(route("admin.blog.lang.cat"), {
                        _token: '{{ csrf_token() }}',
                        lang: selectedLang
                    })
                    .then(function (response) {
                        $('#category_id').empty(); 
                        $('#tagsInput').empty(); 
                        response.data.all_category.forEach(function (value) {
                            var option = $('<option>').attr('value', value.id).text(value.name);
                            if (value.name === 'Uncategorized') {
                                option.attr('selected', 'selected');
                            }
                            $('#category_id').append(option);
                        });

                        response.data.all_tag.forEach(function (value) {
                            $('#tagsInput').append('<option value="' + value.name + '">' + value.name + '</option>');
                        });                         
                        
                    })
                    .catch(function (error) {
                        console.error('Error:', error);
                    });
            });

        });
    </script>
@endpush
