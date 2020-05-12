@extends('site::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('site:service/js/form.js'))}}"></script>
    <script src="{{url('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
        CKEDITOR.replace( 'body', options);
    </script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('site/service')}}">Services</a></li>
    <li>Edit Service - {{$service->title}}</li>
@endsection

@section('content')
<section class="panel panel-default">
    <div class="panel-heading"><h1 class="">Edit Service - {{$service->title}}</h1></div>
    <div class="panel-body">
        @include('site::service.form', ['service' => $service])
    </div>
    <div class="panel-footer">
        <button id="btn_save_service" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</section>
@endsection