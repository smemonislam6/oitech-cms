@extends('backend.layouts.app')
@section('site-title')
    {{ __('Price Plan') }}
@endsection
@push('style')
    <link href="{{ asset('assets/backend/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/backend/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
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
                        <h4 class="header-title">{{__('Price Plan Items')}}</h4>
                        <div class="input-group mb-3 w-25">
                            <select class="form-select" name="bulk_option" id="bulk_option">
                                <option value="">{{{__('Bulk Action')}}}</option>
                                <option value="delete">{{{__('Delete')}}}</option>
                            </select>
                            <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($all_price_plan as $key => $plan)
                                <li class="nav-$all_price_plan">
                                    <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab" href="#slider_tab_{{$key}}" role="tab" aria-controls="home" aria-selected="true">{{ get_language_by_slug($key) }}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content mt-4" id="myTabContent">
                            @foreach($all_price_plan as $key => $plan)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="slider_tab_{{$key}}" role="tabpanel">
                                    <div class="table-wrap table-responsive">
                                        <table class="table table-default">
                                            <thead >
                                                <th class="no-sort">
                                                    <div class="mark-all-checkbox">
                                                        <input type="checkbox" class="all-checkbox">
                                                    </div>
                                                </th>
                                                <th >{{__('ID')}}</th>
                                                <th >{{__('Title')}}</th>
                                                <th >{{__('Price')}}</th>
                                                <th >{{__('Category')}}</th>
                                                <th >{{__('Status')}}</th>
                                                <th >{{__('Type')}}</th>
                                                <th >{{__('Action')}}</th>
                                            </thead>
                                        <tbody >
                                            @foreach($plan as $data)
                                                <tr >
                                                    <td >
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td >{{ $data->id }}</td>
                                                    <td >{{ $data->title }}</td>
                                                    <td >{{ $data->price }}</td>
                                                    <td >{{ $data->price_plan_category->name }}</td>
                                                    <td >
                                                        <span class="alert alert-{{ $data->status == 'draft' ? 'warning' : 'success' }}">
                                                            {{ $data->status == 'draft' ? __('Draft') : __('Publish') }}
                                                        </span>
                                                    </td>
                                                    <td >{{ $data->type }}</td>
                                                    <td >
                                                        @include('backend.partials.delete-with-swal', ['url' => route('admin.price-plans.destroy', $data->id)])
                                                    
                                                        <a href="{{ route('admin.price-plans.edit', $data->id) }}" class="btn btn-primary btn-sm me-1"> <i class="ri-pencil-line"></i></a>
                                                        <form action="{{route('admin.price-plans.clone', $data->id)}}" method="post" style="display: inline-block">
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

                    axios.delete(route('admin.price-plans.bulk.action'), {
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

            $(document).on('change','select[name="icon_type"]',function (e){
                e.preventDefault();
                var iconType = $(this).val();
                iconTypeFieldVal(iconType);
            });
            defaultIconType();

            function defaultIconType(){
                var iconType = $('select[name="icon_type"]').val();
                iconTypeFieldVal(iconType);
            }

            function iconTypeFieldVal(iconType){
                if (iconType == 'icon'){
                    $('input[name="img_icon"]').parent().hide();
                    $('input[name="icon"]').parent().show();
                }else if(iconType == 'image'){
                    $('input[name="icon"]').parent().hide();
                    $('input[name="img_icon"]').parent().show();
                }
            }

            $('.icp-dd').iconpicker();
            $('.icp-dd').on('iconpickerSelected', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
            });

            $(document).on('change','input[name="url_status"]',function (e) {
                e.preventDefault();
                if($('input[name="url_status"]').is(":checked")){
                    $(this).parent().parent().next().hide();
                }else{
                    $(this).parent().parent().next().show();
                }
            });

            $(document).on('change', '#language', function(e) {
                e.preventDefault();
                const selectedLang = $(this).val();
                axios.post(route('admin.price-plans.lang.cat'), {
                        _token: '{{ csrf_token() }}',
                        lang: selectedLang
                    })
                    .then(function(response) {
                        $('#category').html('<option value="">Select Category</option>');
                        $.each(response.data, function(index, value) {
                            $('#category').append('<option value="' + value.id + '">' + value.name + '</option>')
                        });

                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });
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
