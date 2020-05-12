@extends('back-end.layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="well well-sm bg-color-blue txt-color-white text-center">
                <p>You can get a quote before you create a shipment</p>
                <a href="{{url('cargo/get-quote')}}" class="btn btn-default btn-lg"> <strong>Get</strong> <i>Quote</i> </a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="well well-sm bg-color-pinkDark txt-color-white text-center">
                <h5>Well with background</h5>
                <code>
                    .bg-color-pinkDark</code>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-3">
            <div class="well well-sm bg-color-pinkDark txt-color-white text-center">
                <h5>Well with background</h5>
                <code>
                    .bg-color-pinkDark</code>
            </div>
        </div>
        @if($total_enquires = get_active_enquiries_by_agent(session('agent')))
            <div class="col-xs-12 col-sm-6 col-md-3">
                <div class="alert alert-info text-center">
                    <i class="fa fa-comment"></i>
                    <p class=""><strong>{{$total_enquires->count()}}</strong> {{$total_enquires->count() > 1 ? 'Enquiries' : 'Enquiry'}} Need Attention!</p>
                    <a href="{{url('enquiry/agent')}}" class="btn btn-default btn-lg"> <strong>View</strong> <i>Enquiries</i> </a>
                </div>
            </div>
        @endif
    </div>
@endsection
