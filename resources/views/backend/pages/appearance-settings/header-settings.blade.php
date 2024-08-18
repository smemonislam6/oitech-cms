@extends('backend.layouts.app')
@section('site-title')
    {{__('Header Settings')}}
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
                        <h4 class="card-title">{{__('Header Settings')}}</h4>
                        <form action="{{route('admin.header.settings')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" class="form-control" id="header_variant" value="{{get_static_option('header_variant')}}" name="header_variant">
                            @php
                                $header = [
                                   '01' => 'header-01.jpg',
                                   '02' => 'header-02.jpg',
                                ];
                            @endphp
                            @foreach($header as $number => $image)
                            <div class="img-select mb-3">
                                <div class="img-wrap">
                                    <img src="{{asset('assets/common/images/header-variant/'. $image)}}" data-navid="{{ $number }}" class="img-fluid" alt="{{ __('Header Image')}}">
                                </div>
                            </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script >
        (function($){
            "use strict";
            $(document).ready(function () {
                var imgSelect = $('.img-select');
                var id = $('#header_variant').val();
                imgSelect.removeClass('selected');
                $('img[data-navid="'+id+'"]').parent().parent().addClass('selected');

                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#header_variant').val($(this).data('navid'));
                })
            });

        })(jQuery);
    </script>
@endpush
