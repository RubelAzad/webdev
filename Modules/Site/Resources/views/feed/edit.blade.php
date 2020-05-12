@extends('site::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('site:feed/js/form.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('site/feed')}}">Feeds</a></li>
    <li>Edit Feed - {{$feed->title}}</li>
@endsection

@section('content')
<section class="panel panel-default">
    <div class="panel-heading"><h1 class="">Edit Feed - {{$feed->title}}</h1></div>
    <div class="panel-body">
        @include('site::feed.form', ['feed' => $feed])
    </div>
    <div class="panel-footer">
        <button id="btn_save_feed" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</section>
@endsection