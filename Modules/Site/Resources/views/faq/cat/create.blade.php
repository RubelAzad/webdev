@extends('site::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('site:faq/cat/js/form.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('site/faq-cat')}}">Cats</a></li>
    <li>Create new faq category</li>
@endsection

@section('content')
<section class="panel panel-default">
    <div class="panel-heading"><h1 class="">Create New FAQ Category</h1></div>
    <div class="panel-body">
        @include('site::faq.cat.form', ['cat' => ''])
    </div>
    <div class="panel-footer">
        <button id="btn_save_cat" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</section>
@endsection