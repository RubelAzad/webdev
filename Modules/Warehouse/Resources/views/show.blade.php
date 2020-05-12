@extends('warehouse::layouts.master')

@push('style')
    <style>
        .select2-dropdown{
            top:49px;
        }
    </style>
@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('warehouse:js/show.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> View Warehouses - {{$house->name}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('warehouse')}}"> <i class="fa fa-archive"></i> Management Warehouses</a> </li>
    <li> View Warehouses</li>
    <li class="active"> {{$house->name}}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default rounded shadow">
                <div class="panel-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-left"><h1 class="text-capitalize"><strong>{{$house->name}}</strong></h1></li>
                            <li class="text-left">
                                <h3 class="text-capitalize">
                                    {{$house->add_line_1}}
                                    {!! $house->add_line_2 ? '<br>' . $house->add_line_2 : '' !!}
                                    {!! $house->add_line_3 ? '<br>' . $house->add_line_3 : '' !!}
                                    {!! $house->city ? '<br>' . $house->city : '' !!}
                                    {!! $house->county ? '<br>' . $house->county : '' !!}
                                    {!! $house->postcode ? '<br>' . $house->postcode : '' !!}
                                    <br>
                                    {{get_country_name_iso_3166_2($house->country_code)}}
                                </h3>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.panel -->

            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact Information</h3>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding rounded">
                    <ul class="list-group no-margin">
                        <li class="list-group-item"><i class="fa fa-phone mr-5"></i> {{$house->phone_number}}</li>
                        <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> {{$house->email}}</li>
                    </ul>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div>

        <div class="col-md-8">
            <div class="panel panel-default panel-tab rounded shadow">
                <div class="panel-body">
                    <div id="tabs">

                        <ul class="nav nav-tabs" role="tablist">
                            {{--<li><a href="#tabs-business-info">Business Information</a></li>--}}
                            {{--<li><a href="#tabs-services">Business Rules</a></li>--}}
                            <li role="presentation" class="active"><a href="#employees" aria-controls="employees" role="tab" data-toggle="tab">Employees</a></li>
                            <li role="presentation" class=""><a href="#external_driver" aria-controls="external_driver" role="tab" data-toggle="tab">External Driver</a></li>
                        </ul>

                        {{--<div id="tabs-business-info">--}}

                        {{--</div>--}}
                        {{--<div id="tabs-services">--}}

                        {{--</div>--}}
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="employees">
                                @can('add_employee_to_warehouse', \Modules\Warehouse\Entities\Warehouse::class)
                                    <button id="btn_add_employee" class="btn btn-primary"><i class="fa fa-plus"></i> Add Employee</button>
                                @endcan
                                <div id="add_employee_form" style="display: none">
                                    {!! Form::open(['id' => 'frm_add_employee', 'class' => 'form-horizontal', 'url' => url('warehouse/add-employee')]) !!}
                                    {!! Form::hidden('house_id', $house->id, ['id' => 'house_id']) !!}

                                    <div class="form-group">
                                        {!! htmlspecialchars_decode(Form::label('user_id', '<span class="star">*</span>User', ['class' => 'control-label col-sm-4'])) !!}
                                        <div class="col-sm-7 col-md-6">
                                            {!! Form::select('user_id', [], '', ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        {!! htmlspecialchars_decode(Form::label('role_id', '<span class="star">*</span>Role', ['class' => 'control-label col-sm-4'])) !!}
                                        <div class="col-sm-7 col-md-6">
                                            {!! Form::select('role_id', array_except(get_roles_for_select(), get_role_id_by_name('Admin')), '', ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('', '', ['class' => 'control-label col-sm-4']) !!}
                                        <div class="col-sm-7 col-md-6">
                                            <button id="btn_submit_employee" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
                                            <button id="btn_close_emp_form" type="button" class="btn btn-default">Close</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div id="employee_list">
                                    @include('warehouse::employees', ['employees' => $house->employees->count() ? $house->employees : collect()])
                                </div>
                            </div>

                            <div role="tabpanel" class="tab-pane" id="external_driver">
                                @can('manage_external_driver_for_warehouse', $house)
                                    <button id="btn_add_external_driver" class="btn btn-primary"><i class="fa fa-plus"></i> Add External Driver</button>
                                @endcan
                                <div id="add_external_driver_form" style="display: none">
                                    {!! Form::open(['id' => 'frm_add_external_driver', 'class' => 'form-horizontal', 'url' => url('warehouse/add-external-driver')]) !!}
                                    {!! Form::hidden('house_id', $house->id, ['id' => 'external_driver_house_id']) !!}
                                    {!! Form::hidden('external_driver_id', '', ['id' => 'external_driver_id']) !!}
                                    <div class="form-group">
                                        {!! htmlspecialchars_decode(Form::label('driver_name', '<span class="star">*</span>Driver Name', ['class' => 'control-label col-sm-4'])) !!}
                                        <div class="col-sm-7 col-md-6">
                                            {!! Form::text('driver_name', '', ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! htmlspecialchars_decode(Form::label('driver_number', '<span class="star">*</span>Contact Number', ['class' => 'control-label col-sm-4'])) !!}
                                        <div class="col-sm-7 col-md-6">
                                            {!! Form::text('driver_number', '', ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! htmlspecialchars_decode(Form::label('driver_email', '<span class="star">*</span>Email', ['class' => 'control-label col-sm-4'])) !!}
                                        <div class="col-sm-7 col-md-6">
                                            {!! Form::email('driver_email', '', ['class' => 'form-control', 'required' => 'required']) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('driver_address', 'Address', ['class' => 'control-label col-sm-4']) !!}
                                        <div class="col-sm-7 col-md-6">
                                            {!! Form::text('driver_address', '', ['class' => 'form-control',]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('driver_note', 'Note', ['class' => 'control-label col-sm-4']) !!}
                                        <div class="col-sm-7 col-md-6">
                                            {!! Form::textarea('driver_note', '', ['class' => 'form-control', 'rows' => 3]) !!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('', '', ['class' => 'control-label col-sm-4']) !!}
                                        <div class="col-sm-7 col-md-6">
                                            <button id="btn_submit_external_driver" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
                                            <button id="btn_close_external_driver_form" type="button" class="btn btn-default">Close</button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                                <div id="external_driver_list">
                                    @include('warehouse::external-drivers', ['drivers' => $house->external_drivers->count() ? $house->external_drivers : collect()])
                                </div>
                            </div>
                        </div>

                        {{--<div id="tabs-contact-details">--}}

                        {{--</div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
