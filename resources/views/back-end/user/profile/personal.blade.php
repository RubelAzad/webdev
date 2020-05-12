<div class="panel rounded shadow no-overflow">
    <div class="panel-heading">
        <div class="pull-left">
            <h3 class="panel-title">Personal Details</h3>
        </div>
        <div class="pull-right">
            @can('edit_personal_info', \Modules\People\Entities\Person::class)
                <button id="btn_edit_personal_info" class="btn btn-primary" title="Edit Personal Details"><i class="fa fa-edit"></i></button>
            @endcan
        </div>
        <div class="clearfix"></div>
    </div><!-- /.panel-heading -->
    <div class="panel-body no-padding">
        <!-- Start repeater -->
        <div id="div_form_personal_info" class="well" style="display: none">
            {!! Form::open(['id' => 'frm_personal_info', 'url' => 'people/personal-update', 'class'=> 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('title', 'Title', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::select('title_id', get_titles_as_select_options(), $user->person->person_title_id, ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('first_name', 'First Name', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('first_name', $user->person->first_name, ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('middle_name', 'Middle Name', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('middle_name', $user->person->middle_name, ['class' => 'form-control']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('last_name', 'Last Name', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('last_name', $user->person->last_name, ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('dob', 'Date of Birth', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('dob', $user->person->dob ? $user->person->dob->format('d/m/Y') : '', ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('sex', 'Sex', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::select('sex', get_sex_as_select_options(), $user->person->person_sex_id, ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('place_of_birth', 'Place of Birth', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('place_of_birth', $user->person->place_of_birth, ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('country_of_birth', 'Country of Birth', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('country_of_birth', $user->person->country_of_birth, ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('state', 'State of Origin', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('state', $user->person->state, ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('lga', 'LGA of Origin', ['class' => 'control-label col-md-4']); !!}
                <div class="col-md-8">
                    {!! Form::text('lga', $user->person->lga, ['class' => 'form-control', 'required' => 'required']); !!}
                </div>
            </div>

            {!! Form::hidden('person_id', $user->person->id) !!}

            <div class="form-group">
                <div class="btn-group pull-right" role="group">
                    {!! Form::button('Cancel', ['id' => 'cancel_personal_form', 'class' => 'btn btn-default']); !!}
                    {!! Form::submit('Save Change', ['class' => 'btn btn-inverse']); !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
        <table id="tbl_personal_details" class="table">
            <tr>
                <th>Title</th>
                <td>{{$user->person->title ? $user->person->title->name : ''}}</td>
            </tr>
            <tr>
                <th>First Name</th>
                <td>{{$user->person->first_name}}</td>
            </tr>
            <tr>
                <th>Middle Name</th>
                <td>{{$user->person->middle_name}}</td>
            </tr>
            <tr>
                <th>Surname</th>
                <td>{{$user->person->last_name}}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{$user->person->dob ? $user->person->dob->format('d/m/Y') : ''}}</td>
            </tr>
            <tr>
                <th>Sex</th>
                <td>{{$user->person->sex ? $user->person->sex->name : ''}}</td>
            </tr>
            <tr>
                <th>Place of Birth</th>
                <td>{{$user->person->place_of_birth}}</td>
            </tr>
            <tr>
                <th>Country of Birth</th>
                <td>{{$user->person->country_of_birth}}</td>
            </tr>
            <tr>
                <th>State of Origin</th>
                <td>{{$user->person->state}}</td>
            </tr>
            <tr>
                <th>LGA of Origin</th>
                <td>{{$user->person->lga}}</td>
            </tr>
        </table>
        <!--/ End repeater -->
    </div><!-- /.panel-body -->
</div><!-- /.panel -->
<!--/ End repeater -->
