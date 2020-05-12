<div class="container">
    {!! Form::open(['url' => url('#'), 'class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('', 'Inside Container', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <span class="onoffswitch">
                <input type="checkbox" name="activate" class="onoffswitch-checkbox" id="activate_agent">
                <label class="onoffswitch-label" for="activate_agent">
                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </span>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('', 'Fixed Sidebar', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <span class="onoffswitch">
                <input type="checkbox" name="activate" class="onoffswitch-checkbox" id="activate_agent">
                <label class="onoffswitch-label" for="activate_agent">
                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </span>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('', 'Fixed Header', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <span class="onoffswitch">
                <input type="checkbox" name="activate" class="onoffswitch-checkbox" id="activate_agent">
                <label class="onoffswitch-label" for="activate_agent">
                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </span>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('', 'Fixed Breadcrumb', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <span class="onoffswitch">
                <input type="checkbox" name="activate" class="onoffswitch-checkbox" id="activate_agent">
                <label class="onoffswitch-label" for="activate_agent">
                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </span>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('', 'Fixed Footer', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <span class="onoffswitch">
                <input type="checkbox" name="activate" class="onoffswitch-checkbox" id="activate_agent">
                <label class="onoffswitch-label" for="activate_agent">
                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </span>
        </div>
    </div>
    {!! Form::close() !!}
</div>