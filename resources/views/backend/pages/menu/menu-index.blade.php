@extends('backend.layouts.app')
@section('site-title')
    {{__('All Menus')}}
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
                        <h4 class="card-title">{{__('All Menus')}}</h4>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_menu as $key => $menu)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach($all_menu as $key => $menu)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                    <table class="table table-default">
                                        <thead >
                                        <th >{{__('ID')}}</th>
                                        <th >{{__('Title')}}</th>
                                        <th >{{__('Status')}}</th>
                                        <th >{{__('Created At')}}</th>
                                        <th >{{__('Action')}}</th>
                                        </thead>
                                        <tbody >
                                        @foreach($menu as $data)
                                            <tr >
                                                <td >{{$data->id}}</td>
                                                <td >{{$data->title}}</td>
                                                <td >
                                                    @if($data->status == 'default')
                                                        <span class="alert alert-success">{{__('Default Menu')}}</span>
                                                    @else
                                                        <form action="{{route('admin.menu.default',$data->id)}}" method="post">
                                                            @csrf
                                                            <button type="submit" class="btn btn-info btn-sm mb-3 mr-1 set_default_menu">{{__('Set Default')}}</button>
                                                        </form>
                                                    @endif
                                                </td>
                                                <td >{{$data->created_at->diffForHumans()}}</td>
                                                <td >
                                                    @if($data->status != 'default')
                                                    @include('backend.partials.delete-with-swal', ['url' => route('admin.menu.destroy', $data->id)])
                                                    @endif
                                                    <a class="btn btn-primary btn-sm me-1" href="{{route('admin.menu.edit',$data->id)}}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Add New Menu')}}</h4>
                        <form action="{{route('admin.menu.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('Language')}}</label>
                                        <select name="lang" id="language" class="form-control">
                                            @foreach($all_languages as $lang)
                                                <option value="{{$lang->slug}}">{{$lang->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="title">{{__('Title')}}</label>
                                        <input type="text" class="form-control" id="title" name="title" placeholder="{{__('Title')}}">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Create Menu')}}</button>
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
