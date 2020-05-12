<div class="panel rounded shadow no-overflow">

    <div class="panel-body">
        <!-- Start repeater -->
        <div id="div_form_password">
            {!! Form::open(['id' => 'frm_password', 'url' => 'user/change-password', 'class'=> 'form-horizontal']) !!}

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="col-md-4 control-label">Enter New Password*</label>
                <div class="col-md-4">
                    <input type="password" id="password" name="password" class="form-control" required="required">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {!! Form::hidden('user_id', $user->id) !!}

            {!! Form::close() !!}
        </div>
    </div><!-- /.panel-body -->
    <div class="panel-footer center">
        <button id="btn_change_password" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
    </div>
</div><!-- /.panel -->
<!--/ End repeater -->
