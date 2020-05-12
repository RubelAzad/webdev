@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
<style>
    thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/services.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Services
@endsection

@section('breadcrumb')
    
    <li><a href="{{url('service/provider')}}"><i class="fa fa-cogs"></i> Sharing Setup List</a></li>
    
    <li class="active"><i class="fa fa-cog"></i> Manage Sharing</li>
@endsection


@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_services" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Sharing of</th>
                    <th>Direction</th>
                    <th>Charge</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($chargelist as $share)
                <tr> 
                  <td style="text-transform:capitalize;">{{$share->code}} </td>
                  <td style="text-transform:capitalize;">{{$share->desc}} </td>
                  <td style="text-transform:capitalize;">{{$share->sharing}} </td>
                  <td style="text-transform:capitalize;">{{$share->direction}} </td>
                  <td style="text-transform:capitalize;">{{$share->charge}} </td>

                  <td>
                    <a href="edit-charge/{{ $share->code }}" class="btn btn-sm btn-info">Edit</a>
                  </td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
