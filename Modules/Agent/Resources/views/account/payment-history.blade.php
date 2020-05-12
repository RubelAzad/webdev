@extends('agent::layouts.master')

@push('style')

@endpush

@push('scripts')
    <script src="{{url(Module::asset('agent:js/account/payment.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Payment History
@endsection

@section('breadcrumb')
    <li><a href="{{url('agent/account')}}">Agent Accounts</a></li>
    @if($agent)
        <li><a href="{{url('agent/account/' . $agent->id)}}">{{$agent->name}}</a></li>
    @endif
    <li class="active"> Payment History</li>
@endsection


@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Payment History
                </h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="center">Date</th>
                        <th>Agent</th>
                        <th class="center">Payment Method</th>
                        <th class="center">Amount</th>
                        <th class="center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td class="center">{{$payment->date->format('d/m/Y')}}</td>
                            <td>{{$payment->agent->name}}</td>
                            <td class="center">{{title_case($payment->payment_method)}}</td>
                            <td class="center">{{number_format($payment->amount, 2)}}</td>
                            <td class="center">
                                <div class="btn-group">
                                    @can('edit_payment', \Modules\Agent\Entities\Agent::class)
                                        <a href="{{url('agent/edit-payment/' . $payment->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
