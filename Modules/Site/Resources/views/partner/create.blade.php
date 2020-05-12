@extends('site::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('site:partner/js/form.js'))}}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('site/partner')}}">Partners</a></li>
    <li>Create new partner</li>
@endsection

@section('content')
<section class="panel panel-default">
    <div class="panel-heading"><h1 class="">Create New Partner</h1></div>
    <div class="panel-body">
        @include('site::partner.form', ['partner' => ''])
    </div>
    <div class="panel-footer">
        <button id="btn_save_partner" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</section>
@endsection