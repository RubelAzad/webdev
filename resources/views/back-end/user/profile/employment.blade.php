<div class="panel rounded shadow no-overflow">
    <div class="panel-heading">
        <div class="pull-left">
            <h3 class="panel-title">Employment Details</h3>
        </div>
        <div class="pull-right">
            @can('add_employment', \Modules\People\Entities\PersonEmployment::class)
                <button id="btn_add_employment" class="btn btn-primary" title="Add New Employment"><i class="fa fa-plus"></i> Add Employment</button>
            @endcan
        </div>
        <div class="clearfix"></div>
    </div><!-- /.panel-heading -->
    <div class="panel-body no-padding">
        <div id="div_form_employment" class="well" style="display: none">
            {!! Form::open(['id' => 'frm_employment', 'url' => 'people/employment-update', 'class'=> 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('employment_position', 'Position', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('employment_position', '', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('employment_organisation', 'Organisation', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('employment_organisation', '', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('employment_income', 'Income', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('employment_income', '', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            {!! Form::hidden('person_id', $user->person->id) !!}
            {!! Form::hidden('employment_id', '', array('id' => 'employment_id')) !!}

            <div class="form-group">
                <div class="btn-group pull-right" role="group">
                    {!! Form::button('Cancel', ['id' => 'cancel_employment_form', 'class' => 'btn btn-default']); !!}
                    {!! Form::submit('Save Change', ['class' => 'btn btn-inverse']); !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
        <!-- Start repeater -->
        <table id="tbl_employment" class="table table-striped table-bordered table-hover table-condensed" width="100%">
            <thead>
            <tr>
                <th class="text-center">SN</th>
                <th>Position</th>
                <th>Organisation</th>
                <th class="text-center">Income</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($user->person->employments->count() && $i=1)
                @foreach($user->person->employments as $employment)
                    <tr>
                        <td class="text-center">{{$i++}}</td>
                        <td>{{$employment->position}}</td>
                        <td>{{$employment->organisation}}</td>
                        <td class="text-center">{{$employment->income}}</td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                @can('edit_employment', $employment)
                                    <a href="{{url('people/employment-get/'. $employment->id)}}" class="btn btn-warning edit_employment">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                @endcan
                                @can('delete_employment', $employment)
                                    <a href="{{url('people/employment-delete/'. $employment->id)}}" class=" btn btn-danger delete_employment">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <!--/ End repeater -->
    </div><!-- /.panel-body -->
</div><!-- /.panel -->
<!--/ End repeater -->
