{!! Form::open(['url' => url('agent/confirm'), 'class' => 'form-horizontal', 'id' => 'frm_confirm', 'files' => true]) !!}
<input type="hidden" name="agent_id" id="agent_id" value="{{$agent ? $agent->id : ''}}">
@if($agent && $agent->logo)
    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <img class="img-rounded img-bordered-primary" src="{{url('file/serve/' . $agent->logo->hash)}}" width="140px">
        </div>
    </div>
@endif

<div class="form-group">
    {!! Form::label('logo', 'Upload Logo', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-4">
        {!! Form::file('file', ['class' => 'form-control']) !!}
        <span id="helpBlock" class="help-block">Preferred Size: Width=200px and Height=50px</span>
    </div>
</div>
@can('activate_agent', \Modules\Agent\Entities\Agent::class)
    <div class="form-group">
        {!! Form::label('', 'Activate', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <span class="onoffswitch">
                <input type="checkbox" name="activate" class="onoffswitch-checkbox" id="activate_agent" {{$agent ? $agent->active ? 'checked' : '': ''}}>
                <label class="onoffswitch-label" for="activate_agent">
                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </span>
        </div>
    </div>
@endcan
@can('approve_agent', \Modules\Agent\Entities\Agent::class)
    <div class="form-group">
        {!! Form::label('', 'Approved', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <span class="onoffswitch">
                <input type="checkbox" name="approved" class="onoffswitch-checkbox" id="approved_agent" {{$agent ? $agent->approved ? 'checked' : '': ''}}>
                <label class="onoffswitch-label" for="approved_agent">
                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                    <span class="onoffswitch-switch"></span>
                </label>
            </span>
        </div>
    </div>
@endcan
{!! Form::close() !!}