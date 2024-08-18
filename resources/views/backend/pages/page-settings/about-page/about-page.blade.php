@extends('backend.layouts.app')
@section('site-title')
    {{__('About Section')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('About Us Section Settings')}}</h4>

                        <form action="{{route('admin.about.page.about')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="about_page_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="about_page_{{$lang->slug}}_title" value="{{get_static_option('about_page_'.$lang->slug.'_title')}}" class="form-control" id="about_page_{{$lang->slug}}_title">
                                        </div> 
                                        <div class="mb-3">
                                            <label for="about_page_{{$lang}}_sub_title">{{__('Sub Title')}}</label>
                                            <input type="text" name="about_page_{{$lang->slug}}_sub_title" value="{{get_static_option('about_page_'.$lang->slug.'_sub_title')}}" class="form-control" id="about_page_{{$lang->slug}}_sub_title">
                                        </div>
                                        <div class="mb-3">
                                            <label for="about_page_{{$lang->slug}}_description">{{__('Description')}}</label>
                                            <textarea name="about_page_{{$lang->slug}}_description" class="form-control editor" cols="30" rows="10">{{get_static_option('about_page_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label d-block" for="icon">{{__('Experience Icon')}}</label>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary iconpicker-component">
                                                    <i class="{{get_static_option('about_page_'.$lang->slug.'_icon')}}"></i>
                                                </button>
                                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="{{get_static_option('about_page_'.$lang->slug.'_icon')}}" data-bs-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                                </button>
                                                <div class="dropdown-menu"></div>
                                            </div>
                                            <input type="hidden" class="form-control" id="icon" value="{{get_static_option('about_page_'.$lang->slug.'_icon')}}" name="about_page_{{$lang->slug}}_icon">
                                        </div>
                                        <div class="mb-3">
                                            <label for="about_page_{{$lang->slug}}_experience_year">{{__('Experience Year')}}</label>
                                            <input type="text" name="about_page_{{$lang->slug}}_experience_year" class="form-control" value="{{get_static_option('about_page_'.$lang->slug.'_experience_year')}}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="about_page_{{$lang->slug}}_experience_title">{{__('Experience Title')}}</label>
                                            <input type="text" name="about_page_{{$lang->slug}}_experience_title" class="form-control" value="{{get_static_option('about_page_'.$lang->slug.'_experience_title')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            
                            <div class="mb-3 edit">  
                                <label for="about_page_image_one" class="form-label d-block">{{__('Left Image')}}</label>
                                @php
                                    $leftImage = get_static_option('about_page_image_one');
                                @endphp    
                                @if($leftImage)
                                    <img src="{{ asset($leftImage) }}" alt="Default Background" class="image-preview-container max-height-img">
                                @else
                                    <img src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                @endif                                                        
                                                            
                            </div>
                            <div class="mb-3">
                                <label for="edit_image" class="form-label">{{ __('Change Photo') }}</label>
                                <input type="file" class="form-control" id="edit_image" name="about_page_image_one">
                            </div>
                            <div class="mb-3 add">         
                                <label for="about_page_image_two" class="form-label d-block">{{__('Right Image')}}</label>
                                @php
                                    $rightImage = get_static_option('about_page_image_two');
                                @endphp                                             
                                    @if($rightImage)
                                    <img src="{{ asset($rightImage) }}" alt="Default Background" class="image-preview-container max-height-img">
                                @else
                                    <img src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img">
                                @endif                             
                            </div>
                            <div class="mb-3">
                                <label for="add_image" class="form-label">{{ __('Change Photo') }}</label>
                                <input type="file" class="form-control" id="add_image" name="about_page_image_two">
                            </div>
                            <div class="mb-3 edit_3">         
                                <label for="about_page_float_image" class="form-label d-block">{{__('Float Image')}}</label>
                                @php
                                    $floatImage = get_static_option('about_page_float_image');
                                @endphp                                             
                                @if($floatImage)
                                    <img id="floatImagePreview" src="{{ asset($floatImage) }}" alt="Default Background" class="image-preview-container max-height-img" >
                                @else
                                    <img id="floatImagePreview" src="{{ asset('uploads/placeholder.png') }}" alt="Default Image" class="image-preview-container max-height-img" >
                                @endif                             
                            </div>
                            <div class="mb-3">
                                <label for="edit_image_3" class="form-label">{{ __('Change Photo') }}</label>
                                <input type="file" class="form-control" id="edit_image_3" name="about_page_float_image">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add About Item')}}</h4>
                        <div class="right-cotnent margin-bottom-40"><a class="btn btn-primary" data-bs-target="#add_about_item" data-bs-toggle="modal" href="#">{{__('Add New About Item')}}</a></div>

                        <ul class="nav nav-tabs mt-4 mb-4" id="myTab" role="tablist">
                            @foreach($all_about_items as $key => $about_item)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach($all_about_items as $key => $about_item)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default align-middle">
                                            <thead >
                                                <th >{{__('ID')}}</th>
                                                <th >{{__('Icon')}}</th>
                                                <th >{{__('Title')}}</th>
                                                <th >{{__('Status')}}</th>
                                                <th >{{__('Action')}}</th>
                                            </thead>
                                            <tbody >
                                                @foreach($about_item as $data)
                                                    <tr >
                                                        <td >{{$data->id}}</td>
                                                        <td ><i class="{{$data->icon}}"></i></td>
                                                        <td >{{$data->title}}</td>
                                                        <td >
                                                            <span class="alert alert-{{ $data->status == 'draft' ? 'warning' : 'success' }}">
                                                                {{ $data->status == 'draft' ? __('Draft') : __('Publish') }}
                                                            </span>
                                                        </td>
                                                        <td >
                                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.about.item.destroy', $data->id)])
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#about_item_edit_modal" class="btn btn-xs btn-primary btn-sm me-1 about_item_edit_btn" data-id="{{$data->id}}" data-lang="{{$data->lang}}" data-title="{{$data->title}}" data-icon="{{$data->icon}}" data-status="{{$data->status}}" data-description="{{$data->description}}">
                                                            <i class="ri-pencil-line"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_about_item" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Add Feature Item')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.about.item.store')}}" method="post">
                    <div class="modal-body">
                        @csrf
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
                            <label class="form-label d-block" for="icon">{{__('Icon')}}</label>
                            <div class="btn-group ">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control" id="icon" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="about_item_title1">{{__('Title')}}</label>
                            <input type="text" name="title" id="about_item_title1" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="about_item_description1">{{__('Description')}}</label>
                            <textarea name="description" class="form-control" id="about_item_description1" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="status">{{__('Status')}}</label>
                            <select name="status" id="about_status" class="form-control">
                                <option value="publish">{{__('Publish')}}</option>
                                <option value="draft">{{__('Draft')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Add Feature Item')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="about_item_edit_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Edit Social Item')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.about.item.update')}}" method="post">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="about_item_id" value="">
                        <div class="mb-3">
                            <label class="form-label" for="language">{{__('Language')}}</label>
                            <select name="lang" id="language" class="form-control">
                                @foreach(get_all_language() as $language)
                                    <option value="{{$language->slug}}">{{$language->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block" for="about_item_icon">{{__('Icon')}}</label>
                            <div class="btn-group ">
                                <button type="button" class="btn btn-primary iconpicker-component">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </button>
                                <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle" data-selected="fas fa-exclamation-triangle" data-bs-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">{{ __('Toggle Dropdown') }}</span>
                                </button>
                                <div class="dropdown-menu"></div>
                            </div>
                            <input type="hidden" class="form-control" id="about_item_icon" value="fas fa-exclamation-triangle" name="icon">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="about_item_title">{{__('Title')}}</label>
                            <input type="text" name="title" id="about_item_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="about_item_description">{{__('Description')}}</label>
                            <textarea name="description" class="form-control" id="about_item_description" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status">{{__('Status')}}</label>
                            <select name="status" class="form-control" id="edit_status">
                                <option value="publish">{{__("Publish")}}</option>
                                <option value="draft">{{__("Draft")}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save Changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script >
        (function($){
            "use strict";
                
            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });
            
            $(document).on('click','.about_item_edit_btn',function(){
                var el = $(this);
                var id = el.data('id');
                var icon = el.data('icon');
                var lang = el.data('lang');
                var title = el.data('title');
                var description = el.data('description');
                var status = el.data('status');
                
                var form = $('#about_item_edit_modal'); 
                form.find('#about_item_id').val(id);
                form.find('#language').val(lang);
                form.find('#about_item_title').val(title);
                form.find('#about_item_icon').val(icon);
                form.find('#about_item_description').val(description);
                form.find('#edit_status').val(status);
                form.find('.icp-dd').attr('data-selected',el.data('icon'));
                form.find('.iconpicker-component i').attr('class',el.data('icon'));
            });

            function previewImage(input, previewId) {
                var file = input.files[0];
                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#' + previewId).attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }

            $('#edit_image_3').change(function() {
                previewImage(this, 'floatImagePreview');
            });
        })(jQuery);
    </script>
@endpush