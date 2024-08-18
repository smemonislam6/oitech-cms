@extends('backend.layouts.app')

@section('site-title')
    {{__('All Newsletter')}}
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
                    <h4 class="header-title">{{__('Send Mail To All Newsletter Subscriber')}}</h4>
                    <form action="{{route('admin.subscriber.send_message_submit')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="edit_icon">{{__('Subject')}}</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="{{__('Subject')}}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="message">{{__('Message')}}</label>
                            <textarea name="content" class="form-control editor" id="message" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-xs btn-primary">{{__('Send Mail')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection