@extends('back-end.layouts.app')

@push('scripts')
<script src="{{url('assets/role/js/definition.js')}}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('roles')}}">All Roles</a></li>
    <li class="active">Role Definition</li>
@endsection

@section('page_header')
    <i class="fa fa-lock"></i> Role Definition: {{$role->name}}
@endsection

@section('content')

    @php
        $last_model = '';
    @endphp

    <div id="accordion" class="accordion-style1 panel-group">
        @foreach($abilities as $ability)
            @if($last_model != $ability->model)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$ability->id}}">
                                <i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                &nbsp;{{$ability->model}}
                            </a>
                        </h4>
                    </div>

                    <div class="panel-collapse collapse" id="collapse{{$ability->id}}">
                        <div class="panel-body">
                            <table class="table table-striped">
                                @foreach($abilities as $this_ability)
                                    @if($this_ability->model == $ability->model)
                                        <tr>
                                            <th width="60%">{{$this_ability->title}}</th>
                                            <td class="center">
                                                @can('update_role_definition', \App\Role::class)
                                                    <span class="onoffswitch">
                                                                        <input update_role_ability type="checkbox" name="switch-field-1" class="onoffswitch-checkbox" {{(isset($assigned[$this_ability->ability]) ? 'checked' : '')}} id="{{$role->id}}-{{$this_ability->id}}">
                                                                        <label class="onoffswitch-label" for="{{$role->id}}-{{$this_ability->id}}">
                                                                            <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                                                                            <span class="onoffswitch-switch"></span>
                                                                        </label>
                                                                    </span>
                                                @else
                                                    {{(isset($assigned[$this_ability->ability]) ? 'Yes' : 'No')}}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                @php $last_model = $ability->model @endphp
            @endif
        @endforeach
    </div>

@endsection