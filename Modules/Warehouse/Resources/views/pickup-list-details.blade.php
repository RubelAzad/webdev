@extends('warehouse::layouts.master')

@push('style')
    <style>
        .borderless td, .borderless th {
            border: 0;
        }
    </style>
@endpush

@push('scripts')
    {{--<script type="application/javascript" src="{{url(Module::asset('warehouse:js/show.js'))}}"></script>--}}

    <script>
        $(document).ready(function(){



            $("div.b1").click(function(){

                var mode = $("input[name='mode']:checked").val();
                var close = mode == "popup" && $("input#closePop").is(":checked");
                var extraCss = $("input[name='extraCss']").val();

                var print = "";
                $("input.selPA:checked").each(function(){
                    print += (print.length > 0 ? "," : "") + "div.PrintArea." + $(this).val();
                });

                var keepAttr = [];
                $(".chkAttr").each(function(){
                    if ($(this).is(":checked") == false )
                        return;

                    keepAttr.push( $(this).val() );
                });

                var headElements = $("input#addElements").is(":checked") ? '<meta charset="utf-8" />,<meta http-equiv="X-UA-Compatible" content="IE=edge"/>' : '';

                var options = { mode : mode, popClose : close, extraCss : extraCss, retainAttr : keepAttr, extraHead : headElements };

                $( print ).printArea( options );
            });

            $("input[name='mode']").click(function(){
                if ( $(this).val() == "iframe" ) $("#closePop").attr( "checked", false );
            });
        });

    </script>
@endpush

@section('page_header')
    Pickup List
@endsection

@section('breadcrumb')

@endsection

@section('top_right_corner_button_group')

@endsection

@section('content')

    <div class="PrintArea area1 all" id="Retain">
    <div id="pickup_list_container" class="container">
        <div class="panel panel-default">
            <div class="panel-heading" style="padding: 10px">
                <h3 class="panel-title">Pickup List #{{$pickup->id}}</h3>
            </div>
            <div class="panel-body">
                <table class="table no-border table-border-0">
                    <tbody>
                        <tr>
                            <th style="width: 200px; border: 0!important; text-align: left;font-size: 16px;">Created at</th>
                            <td style="border: 0!important;font-size: 16px;">: {{$pickup->created_at->format('d/m/Y : H:m')}}</td>
                        </tr>
                        <tr>
                            <th style="border: 0!important; text-align: left;font-size: 16px;">Warehouse</th>
                            <td style="border: 0!important;font-size: 16px;">: {{$pickup->warehouse->name}}</td>
                        </tr>
                        <tr>
                            <th style="border: 0!important; text-align: left;font-size: 16px;">Driver</th>
                            <td style="border: 0!important; font-size: 16px;">:
                                @if($pickup->external_driver)
                                    {{$pickup->ext_driver->name}}
                                @else
                                    {{$pickup->driver->name}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th style="border: 0!important;text-align: left;font-size: 16px;">Agent</th>
                            <td style="border: 0!important;font-size: 16px;">: {{$pickup->agent->name}}</td>
                        </tr>
                        <tr>
                            <th style="border: 0!important;text-align: left;font-size: 16px;">Estimated Pickup Date</th>
                            <td style="border: 0!important;font-size: 16px;">: {{$pickup->est_pickup_date ? $pickup->est_pickup_date->format('d/m/Y') : ''}}</td>
                        </tr>
                        <tr>
                            <th style="border: 0!important;text-align: left;font-size: 16px;">Note</th>
                            <td style="border: 0!important;font-size: 16px;">: {{$pickup->note}}</td>
                        </tr>
                    </tbody>
                </table>

                <br>
                <table id="tbl_ware" class="table table-bordered table-hover" style="border:1px solid black;">
                    <thead>
                    <tr>
                        <th style="border-right:1px solid black;border-bottom:1px solid black" class="center">Tracking No</th>
                        <th style="border-right:1px solid black;border-bottom:1px solid black" class="center">Booking Date</th>
                        <th style="border-right:1px solid black;border-bottom:1px solid black">Receiver</th>
                        <th style="border-right:1px solid black;border-bottom:1px solid black" class="center">Mobile Number</th>
                        <th style="border-right:1px solid black;border-bottom:1px solid black">Destination</th>
                        <th style="border-right:1px solid black;border-bottom:1px solid black" class="center">Pieces</th>
                        <th style="border-right:1px solid black;border-bottom:1px solid black" class="center">Weight</th>
                        <th style="border-bottom:1px solid black;" class="center">Valuable Items</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($posts->sortByDesc('id') as $post)
                        <tr>
                            <td style="border-right:1px solid black;" class="center"><a href="{{url('post/view/' . $post->post->tracking_no)}}">{{strtoupper($post->post->tracking_no)}}</a></td>
                            <td style="border-right:1px solid black;" class="center">{{$post->post->created_at->format('d/m/Y')}}</td>
                            <td style="border-right:1px solid black;">{{$post->post->receiver ? $post->post->receiver->name : ''}}</td>
                            <td style="border-right:1px solid black;" class="center">{{$post->post->receiver ? $post->post->receiver->phone_number : ''}}</td>
                            <td style="border-right:1px solid black;">{{$post->post->receiver ? get_country_name($post->post->receiver->country) : ''}}</td>
                            <td style="border-right:1px solid black;" class="center">{{$post->post->packages ? $post->post->packages->sum('quantity') : ''}}</td>
                            <td style="border-right:1px solid black;" class="center">{{$post->post->packages ? number_format(get_total_weight($post->post->packages), 2) : ''}} kg</td>
                            <td style="">{{$post->post->items->count() ? $post->post->items->implode('name') : ''}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
        <div style="padding: 0 10px 10px;" class="buttonBar text-center">
            <div class="btn btn-primary button b1">Print</div> <input type="checkbox" class="selPA" value="area1" checked />
            <div class="settingVals">
                <input type="hidden" class="selPA" value="area1" checked /><br>
            </div>
        </div>

@stop
