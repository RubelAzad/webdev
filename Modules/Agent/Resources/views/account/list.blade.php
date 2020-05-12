@extends('agent::layouts.master')

@push('style')

@endpush

@push('scripts')

    <script>
        $(function () {
            $('#tbl_agents').dataTable({
                responsive:true,
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10', '25', '50', 'All' ]
                ],
                dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>"
            });
        });
    </script>

@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Agents
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-sitemap"></i> Manage Agents</li>
@endsection

@section('top_right_corner_button_group')
    <a class="btn btn-info" href="{{url('agent/payment-history')}}"> Payment History</a>
    @can('receive_payment', Modules\Agent\Entities\Agent::class)
        <a href="{{url('agent/receive-payment')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Receive Payment</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_agents" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Person</th>
                    <th>Country</th>
                    <th>Contact Number</th>
                    <th class="center">Email</th>
                    <th>Credit Limit</th>
                    <th class="center">Balance</th>
                    <th class="center">Available Limit</th>
                </tr>
                </thead>
                <tbody>
                @if($agents->count() && $i=1)
                    @foreach($agents as $agent)
                        <tr>
                            <td>
                                @can('view_agent_account', $agent)
                                    <a href="{{url('agent/account/' . $agent->id)}}">{{$agent->name}}</a>
                                @else
                                    {{$agent->name}}
                                @endcan
                            </td>
                            <td>{{$agent->contact_person}}</td>
                            <td>{{$agent->main_country->name}}</td>
                            <td class="center">{{$agent->phone_number}}</td>
                            <td class="center">{{$agent->email}}</td>
                            <td class="center">{{number_format($agent->credit, 2)}}</td>
                            <td class="center">
                                @php($balance = $agent->accounts->sum('amount') - $agent->payments->sum('amount'))
                                {{$balance ? number_format($balance * -1 , 2) : number_format($balance, 2)}}
                            </td>
                            <td class="center">
                                @php($available_limit = $agent->credit - $balance)
                                {{number_format($available_limit, 2)}}
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
