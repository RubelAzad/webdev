@extends('site::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('site:faq/js/form.js'))}}"></script>
    <script src="{{url('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
        CKEDITOR.replace( 'answer', options);
    </script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('site/faq')}}">Faqs</a></li>
    <li>Edit Faq - {{$faq->title}}</li>
@endsection

@section('content')
<section class="panel panel-default">
    <div class="panel-heading"><h1 class="">Edit Faq - {{$faq->title}}</h1></div>
    <div class="panel-body">
        @include('site::faq.form', ['faq' => $faq])
    </div>
    <div class="panel-footer">
        <button id="btn_save_faq" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</section>
@endsection