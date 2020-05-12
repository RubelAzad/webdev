@extends('site::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('site:slide-show/js/form.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('site/slide-show')}}">Slide-shows</a></li>
    <li>Edit Slide Show - {{$slide_show->title}}</li>
@endsection

@section('content')
<section class="panel panel-default">
    <div class="panel-heading"><h1 class="">Edit Slide Show - {{$slide_show->title}}</h1></div>
    <div class="panel-body">
        @include('site::slide-show.form', ['slide-show' => $slide_show])
    </div>
    <div class="panel-footer">
        <button id="btn_save_slide_show" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</section>
@endsection