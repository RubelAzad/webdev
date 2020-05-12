@extends('cargo::layouts.master')

@push('style')

@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('cargo:js/shipment/assign-pickup.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Assign Shipment To Be Picked
@endsection

@section('breadcrumb')
    <li><a href="{{url('cargo/confirmed-booking')}}"><i class="fa fa-archive"></i> Confirmed Bookings</a></li>
    <li class="active">Assign Shipment To Be Picked</li>
@endsection

@section('top_right_corner_button_group')

@endsection

@section('content')
<div class="container">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Following items will be pickup</h3>
        </div>
        <div class="panel-body no-padding">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">Item</th>
                    <th class="center">Quantity</th>
                    <th class="center">Weight(kg)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td class="center">{{$package['name']}}</td>
                        <td class="center">{{$package['quantity']}}</td>
                        <td class="center">{{$package['weight']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">
                Assign warehouse to pickup shipment from <b>{{$agent->name}}, {{$agent->city}}</b>
            </h3>
        </div>
        <div class="panel-body">
            {!! Form::open(['id' => 'frm_assign_shipment', 'class' => 'form-horizontal', 'url' => url('warehouse/assign-pickup')]) !!}
            {!! Form::hidden('posts', $posts->pluck('id')->implode(',')) !!}
            <div class="form-group">
                {!! Form::label('warehouse_id', 'Select Warehouse', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::select('warehouse_id', $warehouses->pluck('name', 'id')->prepend('', ''), '', ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('', 'Carrier', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::checkbox('external_driver', '1', '1', ['id' => 'external_driver', 'required' => 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('driver_id', 'Driver information', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::select('driver_id', [], '', ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('est_pickup_date', 'Estimated Pickup Date', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::text('est_pickup_date', '', ['class' => 'form-control', 'placeholder' => 'dd/mm/yyyy', 'autocomplete' => 'off']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('note', 'Note', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::textarea('note', '', ['class' => 'form-control', 'rows' => 3]) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>

        <div class="panel-footer center">
            <button id="btn_submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>
        </div>
    </div>
</div>
@stop
