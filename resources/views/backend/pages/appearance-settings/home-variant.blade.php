@extends('backend.layouts.app')
@section('site-title')
    {{__('Home Variant Settings')}}
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
                        <h4 class="header-title">{{__('Home Variant')}}</h4>
                        <form action="{{route('admin.home.variant')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="home_page_variant" value="{{get_static_option('home_page_variant')}}" name="home_page_variant">
                            </div>
                            @php
                                $homepages = [
                                   '01' => 'home-01.jpg',
                                   '02' => 'home-02.jpg',
                                ];
                            @endphp
                            <div class="row">
                            @foreach($homepages as $home_number => $image)
                                <div class="col-lg-3 col-md-6">
                                    <div class="img-select selected">
                                        <div class="img-wrap">
                                            <img src="{{asset('assets/common/images/home-variant/'.$image)}}" class="img-fluid" data-home_id="{{$home_number}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Home Variant')}}</button>
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
                var id = $('#home_page_variant').val();

                imgSelect.removeClass('selected');
                $('img[data-home_id="'+id+'"]').parent().parent().addClass('selected');
                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#home_page_variant').val($(this).data('home_id'));
                })
            })

        })(jQuery);
    </script>
@endpush
