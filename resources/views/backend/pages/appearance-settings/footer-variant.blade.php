@extends('backend.layouts.app')
@section('site-title')
    {{__('Footer Variant Settings')}}
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
                        <h4 class="header-title">{{__('Footer Variant')}}</h4>
                        <form action="{{route('admin.footer.variant')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="footer_variant" value="{{get_static_option('footer_variant')}}" name="footer_variant">
                            </div>
                            @php
                                $footer_variant = [
                                   '01' => 'footer-01.jpg',
                                ];
                            @endphp
                            <div class="row">
                            @foreach($footer_variant as $footer_number => $image)
                                <div class="col-lg-3 col-md-6">
                                    <div class="img-select selected">
                                        <div class="img-wrap">
                                            <img src="{{asset('assets/common/images/footer-variant/'.$image)}}" class="img-fluid" data-footer_id="{{$footer_number}}" alt="">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Footer Variant')}}</button>
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
                var id = $('#footer_variant').val();

                imgSelect.removeClass('selected');
                $('img[data-footer_id="'+id+'"]').parent().parent().addClass('selected');
                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#footer_variant').val($(this).data('footer_id'));
                })
            })

        })(jQuery);
    </script>
@endpush
