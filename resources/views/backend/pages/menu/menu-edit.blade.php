@extends('backend.layouts.app')
@push('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nestable.css')}}">
@endpush
@section('site-title')
    {{__('Edit Menu')}}
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
                        <div class="header-wrapper d-flex justify-content-between">
                            <h4 class="header-title">{{__('Edit Menu')}}</h4>
                            <div class="btn-wrapper">
                                <a href="{{route('admin.menu')}}" class="btn btn-primary btn-sm">{{__('All Menus')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.menu.update',$menu->id)}}" id="menu_update_form" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="menu_id" id="menu_id" value="{{$menu->id}}">
                            @csrf
                            @php
                                $menu_content = '';
                                if (!empty($menu->content)){
                                    $menu_content = $menu->content;
                                }else{
                                    $menu_content = '[{"ptype":"custom","pname":"Home","purl":"@url","id":1}]';
                                }
                            @endphp
                            <textarea id="menu_content" name="menu_content" class="form-control d-none">{{$menu_content}}</textarea>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label >{{__('Language')}}</label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option @if($lang->slug == $menu->lang) selected @endif value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" id="title" name="title" value="{{$menu->title}}">
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="menu-left-side-content">
                                        <h3 class="title">{{__('Add menu items')}}</h3>
                                        <div class="accordion accordion-wrapper" id="add_menu_item_accordion">
                                            <div class="card">
                                                <div class="card-header" id="page-list-items">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#page-list-items-content" aria-expanded="true" aria-controls="page-list-items-content">
                                                            {{__('Static Pages')}}
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="page-list-items-content" class="collapse show" aria-labelledby="page-list-items" data-parent="#add_menu_item_accordion">
                                                    <div class="card-body">
                                                        <ul class="page-list-ul">
                                                            <li data-ptype="custom" data-purl="@url" data-pname="{{__('Home')}}">
                                                                <label class="menu-item-title">
                                                                    <input type="checkbox" class="menu-item-checkbox">
                                                                    {{__('Home')}}
                                                                </label>
                                                            </li>
                                                            {!! render_pages_list($menu->lang) !!}
                                                        </ul>
                                                        <div class="mb-3">
                                                            <button type="button" id="add_page_to_menu" class="btn btn-primary btn-xs mt-4 pr-4 pl-4 add_page_to_menu">{{__('Add To Menu')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {!! render_dynamic_pages_list($menu->lang) !!}
                                            <div class="card">
                                                <div class="card-header" id="custom-links">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#custom-links-content" aria-expanded="false" aria-controls="custom-links-content">
                                                            {{__('Custom Links')}}
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="custom-links-content" class="collapse" aria-labelledby="custom-links" data-parent="#add_menu_item_accordion">
                                                    <div class="card-body">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="custom_url"><strong >{{__("URL")}}</strong></label>
                                                            <input type="text" name="custom_url" id="custom_url" class="form-control" placeholder="{{__('https://')}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label" for="custom_label_text"><strong >{{__("Link Text")}}</strong></label>
                                                            <input type="text" name="custom_label_text" id="custom_label_text" class="form-control" placeholder="{{__('label text')}}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <button type="button" id="add_custom_links" class="btn btn-primary btn-xs mt-4 pr-4 pl-4">{{__('Add To Menu')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                   <div class="menu-structure-wrapper">
                                       <div class="card">
                                           <div class="card-header">
                                               <h3 class="title">{{__('Menu Structure')}}</h3>
                                           </div>
                                           <div class="card-body">
                                               <section id="drop_down_menu_builder_wrapper">
                                                   <div class="dd" id="nestable">
                                                       <ol class="dd-list">
                                                           @if(!empty($menu->content))
                                                               {!! render_draggable_menu($menu->id) !!}
                                                           @else
                                                               <li class="dd-item" data-id="1" data-purl="@url" data-pname="{{__('Home')}}" data-ptype="custom">
                                                                   <div class="dd-handle">
                                                                       {{__('Home')}}
                                                                   </div>
                                                                   <span class="remove_item">{{ __('x') }}</span>
                                                               </li>
                                                           @endif
                                                       </ol>
                                                   </div>
                                               </section><!-- END #demo -->
                                           </div>
                                       </div>
                                   </div>
                                    <div class="mb-3">
                                        <button type="submit" id="menu_structure_submit_btn" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                                    </div>
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
    <script src="{{asset('assets/backend/js/jquery.nestable.js')}}"></script>
    <script >
        $(document).ready(function () {


            $('#nestable').nestable({
                group: 1,
                maxDepth:5
            }).on('change', function (e) {
            });

            $(document).on('click','.add_mega_menu_to_menu',function (e) {
                e.preventDefault();

                var allList = $(this).parent().prev().find('input[type="checkbox"]:checked');
                var draggAbleMenuWrap = $('#nestable > ol');

                $.each(allList,function (index,value) {
                    $(this).attr('checked',false);
                    var draggAbleMenuLength = $('#nestable ol li').length + 1;
                    var allDataAttr = '';
                    var menuType = $(this).parent().parent().data('ptype');
                    var itemSelectMarkup = '';
                    allDataAttr += ' data-ptype="'+menuType+'"';
                    var randomID = Math.floor((Math.random() * 99999999) + 1);
                    var oldRandomId  = randomID;
                    var AjaxRandomId  = randomID;
                    draggAbleMenuWrap.append('<li class="dd-item" data-uniqueid="'+oldRandomId+'" data-id="'+draggAbleMenuLength+'" '+ allDataAttr +'>\n' +
                        ' <div class="dd-handle">'+$(this).parent().text()+'</div>\n' +
                        '<span class="remove_item">x</span>'+
                        '<span class="expand"><i class="ti-angle-down"></i></span>'+
                        '<div class="dd-body hide">' +
                        '<p>loading items...</p>'+
                        '</div>'+
                        '</li>');

                        $.ajax({
                            type: 'POST',
                            url: "{{route('admin.mega.menu.item.select.markup')}}",
                            data:{
                                _token: "{{csrf_token()}}",
                                type : menuType,
                                lang : $('select[name="lang"]').val(),
                                menu_id : $('#menu_id').val(),
                            },
                            success:function (data) {
                                var html = data;
                                setTimeout(function () {
                                    $('li[data-uniqueid="'+AjaxRandomId+'"] .dd-body').html(html);
                                },1000);
                            }
                        });

                });

            });
            $(document).on('click','.add_page_to_menu',function (e) {
                e.preventDefault();
                //nestable
                var allList = $(this).parent().prev().find('input[type="checkbox"]:checked');
                var draggAbleMenuWrap = $('#nestable > ol');
                $.each(allList,function (index,value) {
                    $(this).attr('checked',false);
                    var draggAbleMenuLength = $('#nestable ol li').length + 1;
                    var allDataAttr = '';
                    var menuType = $(this).parent().parent().data('ptype');

                    if(menuType == 'static'){

                        var menuPslug = $(this).parent().parent().data('pslug');
                        var menuPname = $(this).parent().parent().data('pname');

                        allDataAttr += 'data-pname="'+menuPname+'"';
                        allDataAttr += ' data-pslug="'+menuPslug+'"';
                        allDataAttr += ' data-ptype="'+menuType+'"';

                    }else if(menuType == 'dynamic'){

                        var menuPid = $(this).parent().parent().data('pid');

                        allDataAttr += 'data-pid="'+menuPid+'"';
                        allDataAttr += ' data-ptype="'+menuType+'"';

                    }else if(menuType == 'custom'){

                        var menuPurl = $(this).parent().parent().data('purl');
                        var menuPName = $(this).parent().parent().data('pname');

                        allDataAttr += 'data-purl="'+menuPurl+'"';
                        allDataAttr += 'data-pname="'+menuPName+'"';
                        allDataAttr += ' data-ptype="'+menuType+'"';
                    }else{
                        var menuPid = $(this).parent().parent().data('pid');

                        allDataAttr += 'data-pid="'+menuPid+'"';
                        allDataAttr += ' data-ptype="'+menuType+'"';
                    }
                    draggAbleMenuWrap.append('<li class="dd-item" data-id="'+draggAbleMenuLength+'" '+ allDataAttr +'>\n' +
                        ' <div class="dd-handle">'+$(this).parent().text()+'</div>\n' +
                        '<span class="remove_item">x</span>'+
                        '<span class="expand"><i class="ti-angle-down"></i></span>'+
                        '<div class="dd-body hide">' +
                        '<input type="text" class="icon_picker" placeholder="eg: fas-fa-facebook"/>'+
                        '</div>'+
                        '</li>');
                });
            });

            $(document).on('click','#add_custom_links',function (e) {
                e.preventDefault();

                var draggAbleMenuWrap = $('#nestable > ol');

                    var draggAbleMenuLength = $('#nestable ol li').length + 1;

                    var menuType = $(this).parent().parent().data('ptype');
                    var menuName = $('#custom_label_text').val();//custom_label_text
                    var menuSlug = $('#custom_url').val();//custom_url

                    draggAbleMenuWrap.append('<li class="dd-item" data-id="'+draggAbleMenuLength+'" data-ptype="custom" data-purl="'+menuSlug+'" data-pname="'+menuName+'">\n' +
                        ' <div class="dd-handle">'+menuName+'</div>\n' +
                        '<span class="remove_item">x</span>'+
                        '<span class="expand"><i class="ti-angle-down"></i></span>'+
                        '<div class="dd-body hide"><input type="text" class="anchor_target" placeholder="eg: _blank"/><input type="text" class="icon_picker" placeholder="eg: fas-fa-facebook"/></div>'+
                        '</li>');
                $('#custom_label_text').val('');
                $('#custom_url').val('');
            });
            $(document).on('input','.icon_picker',function (e) {
                var el = $(this);
                var value = el.val();

                 if(value != '' ){
                    el.parent().parent().attr('data-icon',value);
                 }else{
                     el.parent().parent().removeAttr('data-icon');
                 }
            });
            $(document).on('input','.anchor_target',function (e) {
                var el = $(this);
                var value = el.val();

                if(value != '' ){
                    el.parent().parent().attr('data-antarget',value);
                }else{
                    el.parent().parent().removeAttr('data-antarget');
                }
            });
            $(document).on('input','.static_pname',function (e) {
                var el = $(this);
                var value = el.val();

                if(value != '' ){
                    el.parent().parent().attr('data-pname',value);
                }else{
                    el.parent().parent().removeAttr('data-pname');
                }
            });

            $(document).on('click', '.remove_item', function(e) {
                $(this).parent().remove();
            });

            $('body').on('change','select[name="items_id"]',function (e) {
                e.preventDefault();
                var el = $(this);
                var item_id = $(this).val();
                if(item_id != '' ){
                    el.parent().parent().attr('data-items_id',item_id);
                }else{
                    el.parent().parent().removeAttr('data-items_id');
                }
            });
            $('body').on('change','select[name="mega_menu_order"]',function (e) {
                e.preventDefault();
                var el = $(this);
                var item_id = $(this).val();
                if(item_id != '' ){
                    el.parent().parent().parent().attr('data-mega_menu_order',item_id);
                }else{
                    el.parent().parent().parent().removeAttr('data-mega_menu_order');
                }
            });

            $('body').on('change','select[name="mega_menu_orderby"]',function (e) {
                e.preventDefault();
                var el = $(this);
                var item_id = $(this).val();
                if(item_id != '' ){
                    el.parent().parent().parent().attr('data-mega_menu_orderby',item_id);
                }else{
                    el.parent().parent().parent().removeAttr('data-mega_menu_orderby');
                }
            });
            $('body').on('change','input[name="category_status"]',function (e) {
                e.preventDefault();
                var el = $(this);
                if(el.is(':checked') ){
                    el.parent().parent().parent().parent().attr('data-category_status','on');
                }else{
                    el.parent().parent().parent().parent().removeAttr('data-category_status');
                }
            });

            $(document).on('click','#menu_structure_submit_btn',function (e) {
                e.preventDefault();
                var alldata = $('#nestable').nestable('serialize');
                $('#menu_content').val(JSON.stringify(alldata));
                $(this).addClass("disabled")
                $(this).html('<i class="fas fa-spinner fa-spin mr-1"></i> {{__("Updating")}}');
                // console.log(alldata)
                $('#menu_update_form').submit();
            })

        });
    </script>
@endpush
