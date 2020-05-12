@extends('agent::layouts.master')

@push('style')

@endpush

@push('scripts')
{{--<script type="application/javascript" src="{{url(Module::asset('agent:js/index.js'))}}"></script>--}}
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Account Statement for {{$agent->name}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('agent/account')}}">Agent Accounts</a></li>
    <li class="active">Account Statement for {{$agent->name}}</li>
@endsection

@section('top_right_corner_button_group')
    <a class="btn btn-primary" href="{{url('agent/payment-history/' . $agent->id)}}"> Payment History</a>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Account Status</h3>
                </div>
                <div class="panel-body no-padding">
                    <table class="table table-bordered">
                        <tr>
                            <th>Credit Limit</th>
                            <td class="center">{{number_format($agent->credit, 2)}}</td>
                        </tr>
                        <tr>
                            <th>Current Balance</th>
                            <td class="center">{{number_format($current_balance, 2)}}</td>
                        </tr>
                        <tr>
                            <th>Available Limit</th>
                            <td class="center">{{get_currency_symbol($agent->country) . number_format($available_limit, 2)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6"></div>
    </div>


    <div class="panel panel-default">
        <div class="panel-body no-padding">
            <table id="tbl_agents" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th class="center">Date</th>
                    <th>Description</th>
                    <th class="center">Invoice Total</th>
                    <th class="center">Amount</th>
                    <th class="center">View</th>
                </tr>
                </thead>
                <tbody>
                @foreach($agent->accounts as $account)
                    <tr>
                        <td class="text-center">{{$account->date->format('d/m/Y')}}</td>
                        <td>{{$account->description}}</td>
                        <td class="center">{{get_currency_symbol($agent->country) . number_format(calculate_post_amount_total($account->post), 2)}}</td>
                        <td class="text-right">{{get_currency_symbol($agent->country) . number_format(get_post_total_for_agent_billing($account->post), 2)}}</td>
                        <th class="center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{url('post/view/' . $account->post->tracking_no)}}" class="btn btn-info"><i class="fa fa-search"></i></a>
                            </div>
                        </th>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-right">Total</td>
                    <td class="text-right">{{get_currency_symbol($agent->country) . number_format($agent->accounts->sum('credit'), 2)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
