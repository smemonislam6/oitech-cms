@extends('backend.layouts.app')
@section('site-title')
    {{__('Portfolio')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <!-- basic form start -->
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Portfolio')}}</h4>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="input-group w-25">
                                <select class="form-select" name="bulk_option" id="bulk_option">
                                    <option value="">{{{__('Bulk Action')}}}</option>
                                    <option value="delete">{{{__('Delete')}}}</option>
                                </select>
                                <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                            </div>
                            <a href="{{ route('admin.portfolios.create') }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"> <i class="ri-add-line"></i>{{ __('Add Item') }}</a>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_portfolio as $key => $team)
                                <li class="nav-$all_price_plan">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{get_language_by_slug($key)}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            @foreach($all_portfolio as $key => $team)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default align-middle">
                                            <thead >
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th >{{__('Image')}}</th>
                                                <th >{{__('Title')}}</th>
                                                <th >{{__('Sub Title')}}</th>
                                                <th class="no-sort">{{__('Status')}}</th>
                                                <th >{{__('Action')}}</th>
                                            </thead>
                                            <tbody >
                                                @foreach($team as $data)                                                    
                                                    <tr >
                                                        <td >
                                                            <div class="bulk-checkbox-wrapper">
                                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                            </div>
                                                        </td>
                                                        <td >
                                                            <div class="photo-container">
                                                                <a href="{{ asset($data->PortfolioImageUrl) }}" class="magnific">
                                                                    <img src="{{ asset($data->PortfolioImageUrl) }}" alt="{{ $data->title }}">
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td >{{$data->title}}</td>
                                                        <td >{{$data->sub_title}}</td>
                                                        <td >
                                                            @if($data->status == 'draft')
                                                            <span class="alert alert-warning" style="margin-top: 20px;display: inline-block;">{{__('Draft')}}</span>
                                                            @else
                                                            <span class="alert alert-success" style="margin-top: 20px;display: inline-block;">{{__('Publish')}}</span>
                                                            @endif
                                                        </td>
                                                        <td >
                                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.portfolios.destroy', $data->id)])
                                                            <a href="{{route('admin.portfolios.edit',$data->id)}}" class="btn btn-primary btn-sm me-1">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                            <form action="{{ route('admin.portfolios.clone', $data->id) }}" method="post" style="display: inline-block">
                                                                @csrf
                                                                <button type="submit" title="{{__('Clone this to new draft')}}" class="btn btn-secondary btn-sm me-1"><i class="ri-file-copy-line"></i></button>
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
    <script >
        $(document).ready(function() {

            $(document).on('click', '#bulk_delete_btn', function (e) {
                e.preventDefault();

                var bulkOption = $('#bulk_option').val();
                var allCheckbox = $('.bulk-checkbox:checked');
                var allIds = [];
                allCheckbox.each(function (index, value) {
                    allIds.push($(this).val());
                });
                if (allIds.length > 0 && bulkOption == 'delete') {
                    $(this).text('{{__('Deleting...')}}');

                    axios.delete(route('admin.portfolios.bulk.action'), {
                        data: {
                            ids: allIds,
                            _token: "{{csrf_token()}}",
                        }
                    })
                    .then(function (response) {
                        location.reload();
                    })
                    .catch(function (error) {
                        console.error('Error:', error.response.data.message);
                    });
                }
            });

            $('.all-checkbox').on('change',function (e) {
                e.preventDefault();
                var value = $('.all-checkbox').is(':checked');
                var allChek = $(this).parent().parent().parent().parent().parent().find('.bulk-checkbox');
                //have write code here fr
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
