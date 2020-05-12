@extends('shipment::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('shipment:js/hawb-details.js'))}}"></script>
    <script>
        var hawb_id = '{{$hawb->id}}';
    </script>
@endpush

@section('page_header')
    <i class="fa fa-plane"></i> House Air Way Bill No: {{$hawb->id}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('shipment/hawb')}}">HAWB</a></li>
    <li>House Air Way Bill Details - {{$hawb->id}}</li>
@endsection

@section('top_right_corner_button_group')

@endsection

@section('content')
    <div class="container">
        <div class="col-xs-10">
            <input id="tracking_no" type="text" class="form-control" placeholder="Enter Tracking Number">
        </div>
        <div class="col-xs-2">
            <button id="btn_add_post" class="btn btn-primary"><i class="fa fa-arrow-circle-down"></i></button>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel-body no-padding">
                <table id="tbl_hawb_details" class="table table-bordered table-hover" style="width: 100%">
                    <thead>
                    <tr>
                        <th class="center">Tracking No</th>
                        <th>Receiver Name</th>
                        <th class="center">Contact Number</th>
                        <th class="center">Number of Packages</th>
                        <th class="center">Weight</th>
                        <th class="center">Note</th>
                        <th class="center hidden-print">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hawb->posts as $post)
                        <tr>
                            <td class="center">{{strtoupper($post->actual_post->tracking_no)}}</td>
                            <td>{{$post->actual_post->receiver->name}}</td>
                            <td class="center">{{$post->actual_post->receiver->phone_number}}</td>
                            <td class="center">{{$post->actual_post->packages->count()}}</td>
                            <td class="center">{{get_total_weight($post->actual_post->packages)}}</td>
                            <td class="center"></td>
                            <td class="center"></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
