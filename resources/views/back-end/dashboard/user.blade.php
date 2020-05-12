@extends('back-end.layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <div class="panel panel-info col-xs-6">
                <div class="panel-body">
                    <a href="{{url('cargo/create')}}" class="btn bg-color-green btn-circle btn-xl">
                        <i class="fa fa-ship"></i>&nbsp; &nbsp; &nbsp;
                        <span class="text-warning">Create User Shipment</span>
                    </a>
                </div>
            </div>
            <div class="panel panel-info col-xs-6">
                <div class="panel-body">
                    <a href="{{url('cargo/draft')}}" class="btn bg-color-magenta btn-circle btn-xl">
                        <i class="fa fa-file"></i>&nbsp; &nbsp; &nbsp;
                        <span class="text-warning">View User Draft</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

        @if($to_b_confirmed = $agent->posts()->where('status_id', 0)->get()->count())
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="panel panel-info">
                    <div class="panel-body">
                        <div class="col-sm-3"><i class="fa fa-check-square fa-5x text-info" aria-hidden="true"></i></div>
                        <div class="col-sm-9">
                            <h5>{{$to_b_confirmed}} {{$to_b_confirmed > 1 ? 'Shipments' : 'Shipment'}} To Be Confirm</h5>
                            <a href="{{url('cargo/pickup-booking')}}" class="btn btn-default"> <strong>Confirm</strong> <i>Now</i> </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($total_enquires = get_active_enquiries_by_agent(session('agent')))
            @if($total_enquires->count())
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="panel panel-info">
                        <div class="panel-body">
                            <div class="col-sm-3"><i class="fa fa-comment-o fa-5x text-info" aria-hidden="true"></i></div>
                            <div class="col-sm-9">
                                <h5 class=""><strong>{{$total_enquires->count()}}</strong> {{$total_enquires->count() > 1 ? 'Enquiries' : 'Enquiry'}} Need Attention!</h5>
                                <a href="{{url('enquiry/agent')}}" class="btn btn-default"> <strong>View</strong> <i>Enquiries</i> </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection
