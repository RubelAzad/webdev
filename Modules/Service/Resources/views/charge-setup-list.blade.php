@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
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
<script type="application/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="application/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="application/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Services
@endsection

@section('breadcrumb')
    
    <li><a href="{{url('service/provider')}}"><i class="fa fa-cogs"></i> Charge Setup List</a></li>
    
    <li class="active"><i class="fa fa-cog"></i> Manage Services</li>
@endsection


@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="example" class="table table-bordered" style="width: 100%">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Description</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chargelist as $charge)
                        <tr> 
                        <td><a href="edit-charge/{{ $charge->name }}">{{$charge->name}}</a> </td>

                        <td><a href="edit-charge/{{ $charge->name }}">{{$charge->description}}</a> </td>
                        <td><a href="edit-charge/{{ $charge->name }}">{{$charge->payment_type}}</a> </td>
                        <td>
                            <a href="edit-charge/{{ $charge->name }}" class="btn btn-sm btn-info">View</a>
                        </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
