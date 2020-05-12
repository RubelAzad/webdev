@extends('agent::layouts.master')

@push('style')

@endpush

@push('scripts')
    <script src="{{url(Module::asset('agent:js/account/payment.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Edit payment
@endsection

@section('breadcrumb')
    <li><a href="{{url('agent/account')}}">Agent Accounts</a></li>
    <li class="active"> Add new payment</li>
@endsection


@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Edit payment entry
                </h3>
            </div>
            <div class="panel-body">
                @include('agent::account.payment-form')
            </div>
            <div class="panel-footer center">
                <button id="btn_update_payment" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>
    </div>
@stop
