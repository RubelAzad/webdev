@extends('cargo::layouts.master')

@push('style')

@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('cargo:js/shipment/booking_confirmed.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Confirmed Booking - Awaiting To Be Picked
@endsection

@section('breadcrumb')
    <li><a href="{{url('cargo/confirmed-booking')}}"><i class="fa fa-archive"></i> Confirmed Bookings</a></li>
    <li class="active">Awaiting to be picked from: {{$agent->name}}</li>
@endsection

@section('top_right_corner_button_group')
    <button id="btn_assign_pickup" class="btn btn-primary">Assign Pickup</button>
@endsection

@section('content')
    {!! Form::open(['id' => 'frm_assign_to_warehouse', 'url' => url('cargo/assign-warehouse-pickup')]) !!}
    {!! Form::hidden('posts', '', ['id' => 'posts']) !!}
    {!! Form::close() !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><strong>Agent: {{$agent->name}}</strong></h3>
        </div>
        <div class="panel-body table-responsive">
            <table id="tbl_booking" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th class="center"><i class="fa fa-square-o"></i></th>
                    <th class="center">Tracking Number</th>
                    <th class="center">Date</th>
                    <th>Valuable Items</th>
                    <th class="center">Pieces</th>
                    <th class="center">Weight</th>
                </tr>
                </thead>
                <tbody>
                @if($pickups->count())
                    @foreach($pickups as $pickup)
                        <tr>
                            <td></td>
                            <td class="center"><a href="{{url('post/view/' . $pickup->post->tracking_no)}}">{{$pickup->post->tracking_no}}</a></td> <!-- some changes made to test conflict -->
                            <td class="center">{{$pickup->created_at->format('d/m/Y')}}</td>
                            <td>{{$pickup->post->items->implode('name')}}</td>
                            <td class="center">{{$pickup->post->packages->sum('quantity')}}</td>
                            <td class="center">{{number_format(get_total_weight($pickup->post->packages), 2)}} kg</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
