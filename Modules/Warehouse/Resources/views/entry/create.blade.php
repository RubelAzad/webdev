@extends('warehouse::layouts.master')

@push('style')

@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('warehouse:js/add-entry.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Warehouses Entries
@endsection

@section('breadcrumb')
    <li class="">{{$warehouse->name}}</li>
    <li class="active"> Entries</li>
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-10">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon3">Enter Tracking Number</span>
                            <input id="tracking_number" type="text" class="form-control" aria-describedby="basic-addon3" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-xs-2">
                        <button id="search_post" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        <button id="clear_search_post" class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div id="search_result" class="row padding-10" style="display: none">

                </div>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body no-padding">
                <table id="warehouse_entries" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">Remove</th>
                        <th class="center">Tracking No</th>
                        <th class="center">Status</th>
                        <th class="center">Pieces</th>
                    </tr>
                    </thead>
                    <tbody id="warehouse_entries_body">
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="3" class="center">Total Pieces</th>
                        <th class="center"><span id="total_pieces">0</span></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <div class="panel-footer center">
                <button id="btn_confirm_received" class="btn btn-primary"><i class="fa fa-save"></i> Confirm Received</button>
                <button onclick="window.location.reload()" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
            </div>
        </div>
    </div>

@stop