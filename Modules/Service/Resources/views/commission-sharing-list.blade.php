@extends('service::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url(Module::asset('service:css/form.css'))}}">

@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/service-form.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Services
@endsection

@section('breadcrumb')
    
    <li><a href="{{url('service/provider')}}"><i class="fa fa-cogs"></i> Customer Commission List</a></li>
    
    <li class="active"><i class="fa fa-cog"></i> Manage Services</li>
@endsection


@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_services" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th>Exchange Name</th>
                    <th >Franchise Country</th>
                    <th >Franchise Name</th>
                    <th >provider Name</th>
                    <th >Effect Date</th>
                    <th >Charge Type</th>
                    <th >Shareing charge</th>
                    <th >Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sharecomlist as $sharelist)
                <tr> 
                  <td>{{$sharelist->exchname}} </td>

                  <td>{{$sharelist->franchise_count}} </td>

                  <td>{{$sharelist->franchise_name}} </td>
                  <td>{{$sharelist->provider_name}} </td>
                  <td>{{$sharelist->effect_date}} </td>
                  <td>{{$sharelist->charge_type}} </td>
                  <td>{{$sharelist->share_charge}} </td>

                  <td>
                    <a href="edit-charge/{{ $sharelist->id }}" class="btn btn-sm btn-info">Edit</a>
                  </td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
