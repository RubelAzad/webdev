@extends('location::layouts.master')

@push('scripts')
    <script>
        $(function () {
            $('#tbl_countries').dataTable({
                responsive:true,
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10', '25', '50', 'All' ]
                ],
                dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
            });
        });
    </script>
@endpush

@section('breadcrumb')
    <li><i class="fa fa-flag" aria-hidden="true"></i> List of Countries</li>
@endsection

@section('page_header')
    <i class="fa fa-flag" aria-hidden="true"></i> List of Countries
@endsection

@section('content')
    <div class="panel panel-default">
        {{--<div class="panel-heading"><h3 class="panel-title"><i class="fa fa-flag" aria-hidden="true"></i> List of Countries</h3></div>--}}
        <div class="panel-body">
            <table id="tbl_countries" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Capital</th>
                    <th class="center">Number of Franchise</th>
                    <th class="center">Number of Agent</th>
                    <th class="center">Number of Zone</th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr>
                        <td><a href="{{url('country/view/' . $country->iso_3166_3)}}"><span class="flag-icon flag-icon-{{strtolower($country->iso_3166_2)}}"></span> {{$country->name}}</a></td>
                        <td>{{$country->capital}}</td>
                        <td class="center">{{get_number_of_franchises($country->iso_3166_3)}}</td>
                        <td class="center">{{get_number_of_agents($country->iso_3166_3)}}</td>
                        <td class="center">{{get_number_of_zones($country->iso_3166_3)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop