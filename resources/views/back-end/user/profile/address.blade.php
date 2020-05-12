<div class="panel rounded shadow no-overflow">
    <div class="panel-heading">
        <div class="pull-left">
            <h3 class="panel-title">Address Details</h3>
        </div>
        <div class="pull-right">
            @can('add_person_address', \Modules\People\Entities\PersonAddress::class)
                <button id="btn_add_address" class="btn btn-primary" title="Add New Address"><i class="fa fa-plus"></i> Add Address</button>
            @endcan
        </div>
        <div class="clearfix"></div>
    </div><!-- /.panel-heading -->
    <div class="panel-body no-padding">
        <div id="div_form_address" class="well" style="display: none">
            {!! Form::open(['id' => 'frm_address', 'url' => 'people/address-update', 'class'=> 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('type_id', 'Address Type', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::select('type_id', get_address_type_select_options(), '', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('line1', 'Address Line 1', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('line1', '', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('line2', 'Address Line 2', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('line2', '', ['class' => 'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('line3', 'Address Line 3', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('line3', '', ['class' => 'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('address_city', 'City', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('address_city', '', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('address_state', 'State', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('address_state', '', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('address_country', 'Country', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('address_country', 'Nigeria', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            {!! Form::hidden('person_id', $person->id) !!}
            {!! Form::hidden('address_id', '', array('id' => 'address_id')) !!}

            <div class="form-group">
                <div class="btn-group pull-right" role="group">
                    {!! Form::button('Cancel', ['id' => 'cancel_address_form', 'class' => 'btn btn-default']); !!}
                    {!! Form::submit('Save Change', ['class' => 'btn btn-inverse']); !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>

        <div id="profile_address_content" class="panel panel-tab panel-tab-double panel-tab-vertical row no-margin mb-15 rounded shadow">
            <!-- Start tabs heading -->
            <div class="panel-heading no-padding col-lg-3 col-md-3 col-sm-3">
                <ul class="nav nav-tabs">
                    <li class="active">
                        <a href="#home_address" data-toggle="tab" aria-expanded="true">
                            <i class="fa fa-home"></i>
                            <h5>Home Address</h5>
                        </a>
                    </li>
                    <li class="">
                        <a href="#work_address" data-toggle="tab" aria-expanded="false">
                            <i class="fa fa-building"></i>
                            <h5>Work Address</h5>
                        </a>
                    </li>
                </ul>
            </div><!-- /.panel-heading -->
            <!--/ End tabs heading -->

            <!-- Start tabs content -->
            <div class="panel-body col-lg-9 col-md-9 col-sm-9">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="home_address">
                        <div class="panel rounded shadow">
                            <div class="panel-body">
                                @if($person->addresses->where('person_address_type_id', 1)->count())
                                    <h4>Current Address</h4>
                                    @if($address = $person->addresses->where('person_address_type_id', 1)->last())
                                        @if($address->end_date == null)
                                            <div class="button-group pull-right" role="group">
                                                @can('edit_person_address', $address)
                                                    <a href="{{url('people/address-get/' .$address->id)}}" class="btn btn-warning edit_address"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('delete_person_address', $address)
                                                    <a href="{{url('people/address-delete/' .$address->id)}}" class="btn btn-danger delete_address"><i class="fa fa-trash"></i></a>
                                                @endcan
                                            </div>
                                            <address>{!! format_the_address($address) !!}</address>
                                        @else
                                            Record not found or may have been deleted!
                                        @endif
                                    @endif
                                    <hr>
                                    @if($addresses = $person->addresses->where('person_address_type_id', 1)->where('end_date', '!=', null))
                                        <h4>Previous Addresses</h4>
                                        @foreach($addresses->reverse() as $address)
                                            <address>
                                                {!! format_the_address($address) !!}
                                            </address>
                                        @endforeach
                                    @endif
                                @else
                                    <div class="alert alert-danger">
                                        <p>Record not found!</p>
                                    </div>
                                @endif
                            </div><!-- /.panel-body -->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="work_address">
                        <div class="panel rounded shadow">
                            <div class="panel-body">
                                @if($person->addresses->where('person_address_type_id', 2)->count())
                                    <h4>Current Address</h4>
                                    @if($address = $person->addresses->where('person_address_type_id', 2)->last())
                                        @if($address->end_date == null)
                                            <div class="button-group pull-right" role="group">
                                                @can('edit_person_address', $address)
                                                    <a href="{{url('people/address-get/' .$address->id)}}" class="btn btn-warning edit_address"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('delete_person_address', $address)
                                                    <a href="{{url('people/address-delete/' .$address->id)}}" class="btn btn-danger delete_address"><i class="fa fa-trash"></i></a>
                                                @endcan
                                            </div>
                                            <address>{!! format_the_address($address) !!}</address>
                                        @else
                                            Record not found or may have been deleted!
                                        @endif
                                    @endif
                                    <hr>
                                    @if($addresses = $person->addresses->where('person_address_type_id', 2)->where('end_date', '!=', null))
                                        <h4>Previous Addresses</h4>
                                        @foreach($addresses->reverse() as $address)
                                            <address>
                                                {!! format_the_address($address) !!}
                                            </address>
                                        @endforeach
                                    @endif
                                @else
                                    <div class="alert alert-danger">
                                        <p>Record not found!</p>
                                    </div>
                                @endif
                            </div><!-- /.panel-body -->
                        </div>
                    </div>
                </div>
            </div><!-- /.panel-body -->
            <!--/ End tabs content -->
        </div>


    </div><!-- /.panel-body -->
</div><!-- /.panel -->
<!--/ End repeater -->