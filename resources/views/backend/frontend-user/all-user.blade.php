@extends('backend.layouts.app')
@section('site-title')
    {{__('All Users')}}
@endsection
@section('admin_content')
    <div class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @include('backend.partials.message')
                                    @include('backend.partials.error')
                                    <h4 class="header-title">{{__('All Users')}}</h4>
                                    <div class="input-group mb-3 w-25">
                                        <select class="form-select" name="bulk_option" id="bulk_option">
                                            <option value="">{{{__('Bulk Action')}}}</option>
                                            <option value="delete">{{{__('Delete')}}}</option>
                                        </select>
                                        <button class="btn btn-primary btn-sm input-group-text" id="bulk_delete_btn">{{__('Apply')}}</button>
                                    </div>
                                    <table id="all_user_table" class="table table-striped w-100 nowrap align-middle">
                                        <thead class="bg-primary">
                                            <th class="no-sort">
                                                <div class="mark-all-checkbox">
                                                    <input type="checkbox" class="all-checkbox">
                                                </div>
                                            </th>
                                            <th class="text-white">{{__('ID')}}</th>
                                            <th class="text-white">{{__('Name')}}</th>
                                            <th class="text-white">{{__('Email')}}</th>
                                            <th class="text-white">{{__('Action')}}</th>
                                        </thead>
                                        <tbody >
                                            @foreach($all_user as $data)
                                                <tr >
                                                    <td >
                                                        <div class="bulk-checkbox-wrapper">
                                                            <input type="checkbox" class="bulk-checkbox" name="bulk_delete[]" value="{{$data->id}}">
                                                        </div>
                                                    </td>
                                                    <td >{{$data->id}}</td>
                                                    <td >{{$data->name}}</td>
                                                    <td >{{$data->email}}</td>
                                                    <td >
                                                       <div class="d-flex">
                                                        @include('backend.partials.delete-with-swal', ['url' => route('admin.frontend.user.destroy', $data->id)])
                                                        <a href="#" data-id="{{$data->id}}" data-name="{{$data->name}}" data-email="{{$data->email}}" data-phone="{{$data->phone}}" data-address="{{$data->address}}" data-state="{{$data->state}}" data-city="{{$data->city}}" data-zipcode="{{$data->zipcode}}" data-country="{{$data->country}}" data-image="{{asset($data->UserImageUrl)}}" data-bs-toggle="modal" data-bs-target="#user_edit_modal" class="btn btn-primary btn-sm me-1 user_edit_btn">
                                                        <i class="ri-pencil-line"></i>
                                                        </a>
                                                        <a href="#" data-id="{{$data->id}}" data-bs-toggle="modal" data-bs-target="#user_change_password_modal" class="btn btn-info btn-sm me-1 user_change_password_btn">
                                                            {{__("Change Password")}}
                                                        </a>
                                                        <form action="{{route('admin.all.frontend.user.email.status')}}" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{$data->id}}" name="user_id">
                                                            <input type="hidden" value="{{$data->email_verified === "0" ? 1 : 0}}" name="email_verified">
                                                            <button type="submit" class="btn btn-sm @if($data->email_verified === "1") btn-dark @else btn-warning @endif">
                                                                @if($data->email_verified === "1") {{__('Enable Email Verify')}} @else {{__('Disable Email Verify')}} @endif
                                                            </button>
                                                        </form> 
                                                       </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Primary table end -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="user_edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('User Details Edit')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.frontend.user.update')}}" id="user_edit_modal_form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="user_id" id="user_id">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">{{__('Name')}}</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="{{__('Enter name')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="email">{{__('Email')}}</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="{{__('Email')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="phone">{{__('Phone')}}</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="{{__('Phone')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="country">{{__('Country')}}</label>
                            {!! get_country_field('country','country','form-control') !!}
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="state">{{__('State')}}</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder="{{__('State')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="city">{{__('City')}}</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder="{{__('City')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="zipcode">{{__('Zipcode')}}</label>
                            <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="{{__('Zipcode')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="address">{{__('Address')}}</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="{{__('Address')}}">
                        </div>
                        <div class="mb-3 edit">                                                      
                            <img src="{{ asset(get_placeholder_image_path('User')) }}" alt="Default Image" class="image-preview-container max-height-img">                              
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('Change Photo') }}</label>
                            <input type="file" class="form-control" id="edit_image" name="image">
                            <div class="form-text">{{__('Recommended image size 200x200')}}</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Save changes')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="user_change_password_modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Change Admin Password')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @include('backend.partials.error')
                <form action="{{route('admin.frontend.user.password.change')}}" id="user_password_change_modal_form" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="ch_user_id" id="ch_user_id" value="">
                        <div class="mb-3">
                            <label class="form-label" for="password">{{__('Password')}}</label>
                            <input type="password" class="form-control" name="password" placeholder="{{__('Enter Password')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="password_confirmation">{{__('Confirm Password')}}</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{{__('Confirm Password')}}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{__('Change Password')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
    
@endsection

@push('scripts')
    <script >
        $(document).ready(function() {

            $(document).on('click','.user_change_password_btn',function(e){
                e.preventDefault();
                var el = $(this);
                var form = $('#user_password_change_modal_form');
                form.find('#ch_user_id').val(el.data('id'));
            });

            $('#all_user_table').DataTable( {
                "order": [[ 1, "desc" ]],
                'columnDefs' : [{
                    'targets' : 'no-sort',
                    'orderable' : false
                }]
            } );


            $(document).on('click','.user_edit_btn',function(e){
                e.preventDefault();
                var form = $('#user_edit_modal_form');
                var el = $(this);
                var image = el.data('image');

                form.find('#user_id').val(el.data('id'));
                form.find('#name').val(el.data('name'));
                form.find('#email').val(el.data('email'));
                form.find('#phone').val(el.data('phone'));
                form.find('#state').val(el.data('state'));
                form.find('#city').val(el.data('city'));
                form.find('#zipcode').val(el.data('zipcode'));
                form.find('#address').val(el.data('address'));
                form.find('.image-preview-container').attr('src',el.data('image'));
                form.find('#country option').each(function() {
                    if ($(this).text() === el.data('country')) {
                        $(this).prop('selected', true);
                    } else {
                        $(this).prop('selected', false);
                    }
                });
            });

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

                    axios.delete(route('admin.all.frontend.user.bulk.action'), {
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


        } );
    </script>
@endpush
