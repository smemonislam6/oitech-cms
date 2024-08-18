@extends('backend.layouts.app')
@section('site-title')
    {{__('All Pages')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('All Pages')}}</h4>
                        <div class="input-group mb-3 w-25">
                            <select class="form-select" name="bulk_option" id="bulk_option">
                                <option value="">{{{__('Bulk Action')}}}</option>
                                <option value="delete">{{{__('Delete')}}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_page as $key => $page)
                                <li class="nav-item">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            @foreach($all_page as $key => $pages)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                    <div class="table-wrap table-responsive">
                                        <table class="table align-middle">
                                        <thead >
                                            <th class="no-sort">
                                                <div class="mark-all-checkbox">
                                                    <input type="checkbox" class="all-checkbox">
                                                </div>
                                            </th>
                                            <th >{{__('ID')}}</th>
                                            <th >{{__('Title')}}</th>
                                            <th >{{__('Date')}}</th>
                                            <th >{{__('Status')}}</th>
                                            <th >{{__('Action')}}</th>
                                        </thead>
                                        <tbody >
                                        @foreach($pages as $data)
                                            <tr >
                                                <td >
                                                    <div class="bulk-checkbox-wrapper">
                                                        <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                    </div>
                                                </td>
                                                <td >{{$data->id}}</td>
                                                <td >{{$data->title}}</td>
                                                <td >{{$data->created_at->diffForHumans()}}</td>
                                                <td >
                                                    @if($data->status === 'publish')
                                                        <span class="alert alert-success">{{__('Publish')}}</span>
                                                    @else
                                                        <span class="alert alert-warning">{{__('Draft')}}</span>
                                                    @endif
                                                </td>
                                                <td >
                                                    @include('backend.partials.delete-with-swal', ['url' => route('admin.page.destroy', $data->id)])
                                                    <a class="btn btn-primary btn-sm me-1" href="{{route('admin.page.edit',$data->id)}}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                    <form action="{{route('admin.page.clone', $data->id)}}" method="post" style="display: inline-block">
                                                        @csrf
                                                        <button type="submit" title="clone this to new draft" class="btn btn-secondary btn-sm me-1"><i class="far fa-copy"></i></button>
                                                    </form>
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
@endsection

@push('scripts')
    <!-- Start datatable js -->
    <script >
        $(document).ready(function() {

            $(document).on('click','#bulk_delete_btn',function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox =  $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function(index,value){
                    allIds.push($(this).val());
                });
                if(allIds != '' && bulkOption == 'delete'){
                    $(this).text('{{__('Deleting...')}}');
                    $.ajax({
                        'type' : "POST",
                        'url' : "{{route('admin.page.bulk.action')}}",
                        'data' : {
                            _token: "{{csrf_token()}}",
                            ids: allIds
                        },
                        success:function (data) {
                            location.reload();
                        }
                    });
                }

            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek =$(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                if( value == true){
                    allChek.prop('checked',true);
                }else{
                    allChek.prop('checked',false);
                }
            });


            $('.table-wrap > table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );
        } );
    </script>
@endpush
