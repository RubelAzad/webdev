@extends('back-end.layouts.app')

@push('scripts')
@endpush

@push('style')
@endpush

@section('page_header')
    Available Statuses
@endsection

@section('breadcrumb')
    <li class="active">Available Statuses</li>
@endsection

@section('content')
    <div class="row">
        <article class="col-xs-12">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">SN</th>
                    <th>Name</th>
                    <th class="center">Activated</th>
                    <th class="center"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($statuses as $status)
                    <tr>
                        <td class="center">{{$status->id}}</td>
                        <td>{{$status->name}}</td>
                        <td class="center">{{$status->active ? 'Yes' : 'No'}}</td>
                        <td class="center"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </article>
    </div>
@endsection