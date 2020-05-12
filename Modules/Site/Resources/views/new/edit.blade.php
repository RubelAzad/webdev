@extends('site::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('site:new/js/form.js'))}}"></script>
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
    <li><a href="{{url('site/news')}}">News</a></li>
    <li>Edit News - {{$new->title}}</li>
@endsection

@section('content')
<section class="panel panel-default">
    <div class="panel-heading"><h1 class="">Edit News - {{$new->title}}</h1></div>
    <div class="panel-body">
        @include('site::new.form', ['new' => $new])
    </div>
    <div class="panel-footer">
        <button id="btn_save_news" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</section>
@endsection