@extends('back-end.layouts.app')

@section('content')
    <div class="row">

        @can('view_confirmed_booking_list', \Modules\Cargo\Entities\CargoPost::class)
            @if($unpicked = total_unpicked_post_booking_from_agent())
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="panel panel-primary">
                    <div class="panel-heading"><h3 class="panel-title">{{$unpicked}} Confirmed Booking!</h3></div>
                    <div class="panel-body">
                        <h5>Confirmed booking awaiting to be picked from agent location.</h5>
                        <a href="{{url('cargo/confirmed-booking')}}" class="btn btn-sm btn-default"><strong>View Bookings</strong></a>
                    </div>
                </div>
            </div>
            @endif
        @endcan

    </div>
@endsection
