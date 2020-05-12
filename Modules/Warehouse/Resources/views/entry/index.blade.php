@extends('warehouse::layouts.master')

@push('style')

@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('warehouse:js/entries.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Warehouses Entries
@endsection

@section('breadcrumb')
    <li class="">{{$warehouse->name}}</li>
    <li class="active"> Entries</li>
@endsection

@section('top_right_corner_button_group')
    <a href="{{url('warehouse/add-entry')}}" class="btn btn-primary">Add Entry</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <table id="warehouse_entries" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th class="center">Tracking No</th>
                        <th class="center">Entry Date</th>
                        <th>Status</th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th class="center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($entries->count())
                        @foreach($entries as $entry)
                            <tr>
                                <td class="center">{{$entry->post->tracking_no}}</td>
                                <td class="center">{{$entry->date->format('d/m/Y')}}</td>
                                <td>{{$entry->post->current_status->name}}</td>
                                <td>{{$entry->post->sender->name}}</td>
                                <td>{{$entry->post->receiver->name}}</td>
                                <td class="center"></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop