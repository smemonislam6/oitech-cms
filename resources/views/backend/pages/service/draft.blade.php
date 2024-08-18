@extends('backend.layouts.app')
@section('site-title')
    {{__('Services')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                @include('backend.partials.message')
                @include('backend.partials.error')
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 blog-line-after">
                                            <div class="mb-3 blog-line-after">
                                                <a class="" href="{{ route('admin.services.index') }}"> All ({{ $counts['total'] ?? 0 }})</a>
                                                <a class="" href="{{ route('admin.services.publish') }}"> Publish ({{ $counts['publish'] ?? 0 }})</a>
                                                <a class="" href="{{ route('admin.services.draft') }}"> Daraft ({{ $counts['draft'] ?? 0 }})</a>
                                                <a class="" href="{{ route('admin.services.trashed') }}"> Trash  ({{ $counts['trashed'] ?? 0 }}) </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <select class="form-select" name="bulk_option" id="bulk_option">
                                                <option value="">{{__('Bulk Action')}}</option>
                                                <option value="delete">{{__('Delete')}}</option>
                                            </select>
                                            <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <form action="{{ route('admin.services.index') }}" method="GET" onchange="this.submit()">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <select name="service_category_id" class="form-control">
                                                        <option value="all">{{ __('All') }}</option>
                                                        @foreach (get_service_category_all() as $category)
                                                            <option value="{{ $category->id }}" {{ $selectedCategoryId == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_services as $key => $service)
                                <li class="nav-$all_price_plan">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            @foreach($all_services as $key => $service)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default align-middle">
                                            <thead >
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th >{{__('ID')}}</th>
                                                <th >{{__('Title')}}</th>
                                                <th >{{__('Status')}}</th>
                                                <th >{{__('Image')}}</th>
                                                <th >{{__('Icon')}}</th>
                                                <th >{{__('Category')}}</th>
                                                <th >{{__('Sorting Order')}}</th>
                                                <th >{{__('Date')}}</th>
                                                <th >{{__('Action')}}</th>
                                            </thead>
                                            <tbody >
                                                @foreach($service as $data)
                                                    <tr >
                                                        <td >
                                                            <div class="bulk-checkbox-wrapper">
                                                                <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                            </div>
                                                        </td>
                                                        <td >{{$data->id}}</td>
                                                        <td >
                                                            <a href="{{ route('admin.services.edit', $data->id) }}">{{ $data->title }}</a>
                                                        </td>
                                                        <td >
                                                            <span class="alert alert-{{ $data->status == 'draft' ? 'warning' : 'success' }}">
                                                                {{ $data->status == 'draft' ? __('Draft') : __('Publish') }}
                                                            </span>
                                                        </td>
                                                        <td >
                                                            <div class="photo-container">
                                                                <a href="{{ asset($data->FeatureImageUrl) }}" class="magnific">
                                                                    <img src="{{ asset($data->FeatureImageUrl) }}" alt="{{ $data->name }}">
                                                                </a>
                                                            </div>
                                                        </td>
                                                        <td >
                                                            @if($data->icon_type == 'icon' || $data->icon_type == '')
                                                                <i style="font-size: 40px;" class="{{$data->icon}}"></i>
                                                            @else
                                                                <div class="photo-container">
                                                                    <a href="{{ asset($data->ImageUrl) }}" class="magnific">
                                                                        <img src="{{ asset($data->ImageUrl) }}" alt="{{ $data->name }}">
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </td>
                                                        <td >
                                                            @foreach ($data->categories as $item)
                                                                <a href="{{ route('admin.services.category.filter', $item->id) }}">{{ $item->name }}<a >
                                                            @endforeach
                                                        </a></a></td>
                                                        <td >{{$data->sr_order}}</td>
                                                        <td >{{date_format($data->created_at,'d M Y')}}</td>
                                                        <td >
                                                            @include('backend.partials.delete-with-swal', ['url' => route('admin.services.destroy', $data->id)])
                                                            <a href="{{route('admin.services.edit',$data->id)}}" class="btn btn-primary btn-sm me-1">
                                                                <i class="ri-pencil-line"></i>
                                                            </a>
                                                            <form action="{{route('admin.services.clone', $data->id)}}" method="post" style="display: inline-block">
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
    <script >
        $(document).ready(function () {

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

                    axios.delete(route('admin.services.bulk.action'), {
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

        });
    </script>
    <script >
        $(document).ready(function() {

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
