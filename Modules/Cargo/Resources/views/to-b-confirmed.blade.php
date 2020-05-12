@extends('cargo::layouts.master')

@push('style')
<style>
    .popover{
        width: 240px;
        overflow-y: hidden;
        overflow-x: hidden;
    }
    .popover-content{
        padding: 0;
    }
    .panel{
        margin-bottom: 0;
    }
</style>
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('cargo:js/shipment/to_b_confirm.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Management Shipments - book for pickup
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-archive"></i> Management Shipments - book for pickup</li>
@endsection

@section('top_right_corner_button_group')
    @can('pickup_booking_warehouse', Modules\Cargo\Entities\CargoPost::class)
        <a href="{{url('cargo/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Shipment"><i class="fa fa-plus"></i> Create New Shipment</a>
        <a href="{{url('cargo/draft')}}" class="btn btn-success" rel="tooltip" data-placement="top" title="Create new Shipment"><i class="fa fa-file"></i> View Draft</a>
        <button id="btn_add_to_pickup" {{$available_credit >= 1 ? '' : 'disabled'}} class="btn btn-danger">Book for Pickup</button>
    @endcan
{{--    <h3>Current Balance: {{number_format($current_balance, 2)}}</h3>--}}
    <h3 class="text-{{$available_credit >= 1 ? 'info' : 'danger'}}">Available balance to use: {{get_currency_symbol($agent->country) . number_format($available_credit, 2)}}</h3>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_post" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th class="center">Select</th>
                    <th class="center">Tracking No</th>
                    <th class="center">Date</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th class="center">Pieces</th>
                    <th class="center">Weight</th>
                    <th class="center">Selling Price</th>
                    <!-- <th class="center">Cost Price</th> -->
                    <th class="center">Commission</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($posts->count() && $i = 1)
                    @foreach($posts->sortByDesc('id') as $post)
                        <tr>
                            <td class="center" width="50px"></td>
                            <td class="center">{{strtoupper($post->tracking_no)}}</td>
                            <td class="center">{{$post->created_at->format('d/m/Y')}}</td>
                            <td>{{$post->sender->name}}</td>
                            <td>{{$post->receiver ? $post->receiver->name : ''}}</td>
                            <td class="center">{{$post->packages->sum('quantity')}}</td>
                            <td class="center">{{number_format(get_total_weight($post->packages), 2)}} kg</td>
                            <td class="center">{{get_currency_symbol($agent->country) . number_format(calculate_post_amount_total($post), 2)}}</td>
                            <!-- <td class="center">{{get_currency_symbol($agent->country) . number_format(get_post_total_for_agent_billing($post), 2)}}</td> -->
                            <td class="center">
                                @php($agentcom=($agent->commission)/100)
                                <span rel="popover-hover" data-placement="top" data-container="body" data-html="true" data-content="@include('cargo::commission-breakdown', ['post' => $post])">
                                    {{get_currency_symbol($agent->country) . number_format(calculate_post_amount_total($post) * ($agentcom))}}
                                </span>
                            </td>
                            <th class="center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{url('post/view/' . $post->tracking_no)}}" class="btn btn-info"><i class="fa fa-search"></i></a>
                                    @can('cancel_shipment', $post)
                                        <a href="{{url('post/cancel/' . $post->tracking_no)}}" class="btn btn-danger delete"><i class="fa fa-times"></i></a>
                                    @endcan
                                </div>
                            </th>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
