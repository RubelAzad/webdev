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
                    <th >Sourec Country</th>
                    <th >Destination Country</th>
                    <th >Charge setup</th>
                    <th >Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customercomlist as $cuscomlist)
                <tr> 
                  <td>{{$cuscomlist->exchname}} </td>

                  <td>{{$cuscomlist->franchise_count}} </td>

                  <td>{{$cuscomlist->franchise_name}} </td>
                  <td>{{$cuscomlist->provider_name}} </td>
                  <td>{{$cuscomlist->effect_date}} </td>
                  <td>{{$cuscomlist->soureccountry}} </td>
                  <td>{{$cuscomlist->destcountry}} </td>
                  <td>{{$cuscomlist->chargesetup}} </td>

                  <td>
                    <a href="edit-charge/{{ $cuscomlist->chargesetup }}" class="btn btn-sm btn-info">Edit</a>
                  </td>

                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
