@extends('nec.layouts.app')

@push('style')
<link rel="stylesheet" href="{{url('magic/plugins/feeder/example/libs/style.css')}}">
<style type="text/css">
    #stop-resume{
        display: block;
        padding: 10px;
        background-color: #f1f1f1;
        margin:10px;
        width: 70px;
        text-align: center;
        border:solid 1px white;
        text-transform: uppercase;
        font-family: sans-serif;
        text-decoration: none;
    }
    #stop-resume:active{
        background-color:white;
        border:solid 1px #f1f1f1;
        color:blue;
    }
    .carousel-inner, .carousel-inner > .item{
        min-height: 300px;
        height: 365px;
    }
    .carousel-inner > .item > img{
        min-height: 300px;
    }
    .testimonials{
        padding-bottom: 0;
    }
    .container .jumbotron{
        padding-left: 0px;
        padding-right: 0px;
        margin-bottom: 0px;
    }
    .jumbotron-content {
        background-color: black;
        opacity: 0.5;
        padding-left: 10px;
        width: 95%;
        position: absolute;
        top: initial;
        bottom: 0;
    }
    .jumbotron-content__title h1{
        margin-bottom: 5px;
    }
    .jumbotron__control{
        top: 5px;
    }
    .no-padding{
        padding: 0;
    }
    .no-padding-left{
        padding-left:0;
    }
    .no-padding-right{
        padding-right: 0;
    }
    .tracking-box{
        margin-bottom: 0;
        border: none;
    }
    .tracking-button{
        cursor: pointer;
    }
    .home-left-link{
        font-size: 23px;
    }
</style>
@endpush

@push('scripts')
<script src="{{url('magic/plugins/feeder/jquery.tickerNews.min.js')}}"></script>
<script type="text/javascript">
    $(function(){
        var timer = !1;
        _Ticker = $("#T1").newsTicker();
        _Ticker.on("mouseenter",function(){
            var __self = this;
            timer = setTimeout(function(){
                __self.pauseTicker();
            },200);
        });
        _Ticker.on("mouseleave",function(){
            clearTimeout(timer);
            if(!timer) return !1;
            this.startTicker();
        });

        valid_this_form('#frm_tracking');

        $('#btn_tracking').click(function (e) {
            if( $('#frm_tracking').valid() ){
                $('#frm_tracking').submit();
            }
        });
    });
</script>
@endpush

@section('content')
    @include('nec.feeds')

    <div class="container">
        <div class="row" style="padding-top: 5px">
            <div class="col-sm-8 hidden-sm hidden-xs no-padding-right">
                @include('nec.partials.slide_show')
            </div>
            <div class="col-sm-12 col-md-4 no-padding-left">
                <div class="list-group" style="width:100%">
                    <div class="list-group-item no-padding">
                        <div class="panel panel-info tracking-box">
                            <div class="panel-header">
                                <h3 style="padding-left: 5px; "><i class="fa fa-crosshairs" aria-hidden="true"></i> Track your parcel</h3>
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['class' => 'form-inline', 'id' => 'frm_tracking', 'url' => url('track')]) !!}
                                <div class="form-group">
                                    <div class="input-group">

                                        {!! Form::text('tracking_number', '', ['class' => 'form-control', 'placeholder' => 'Enter Tracking Number', 'required' => 'required']) !!}
                                        <div class="input-group-addon"><span id="btn_tracking" class="tracking-button"><i class="fa fa-search text-danger"></i> Track item</span></div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <a class="list-group-item home-left-link" href="{{url('request-pickup')}}"><span class="text-success"><i class="fa fa-truck"></i> Request home pickup</span></a>
                    <a class="list-group-item home-left-link" href="{{url('get-quote')}}"><span class="text-success"><i class="fa fa-gbp"></i> Get a quote</span></a>
                    <a class="list-group-item home-left-link" href="{{url('find-location')}}"><span class="text-success"><i class="fa fa-map-marker"></i> Find us locally</span></a>
                    <a class="list-group-item home-left-link" href="{{url('contact-us')}}"><span class="text-success"><i class="fa fa-comment"></i> Get an enquiry</span></a>
                    {{--<a class="list-group-item home-left-link" href="{{url('faq')}}"><span class="text-success"><i class="fa fa-question"></i> FAQ</span></a>--}}
                </div>
            </div>
        </div>
    </div>


    <!-- OUR SERVICES -->
    <div class="container" role="main">
        @include('nec.home-page.pages')
        @include('nec.home-page.services')
    </div><!-- /.conainer -->

    <!-- CTA -->
{{--    @include('nec.home-page.call-to-action')--}}

    <!-- NEWS -->
    @include('nec.home-page.news')

    <!-- VALUES -->
    {{--@include('nec.home-page.value')--}}

    {{--<!-- ABOUT / QUICK QUITE / GALLERY / FAQ -->--}}
    {{--@include('nec.home-page.about')--}}

    <!-- TESTIMONIALS -->
    {{--@include('nec.home-page.testimonials')--}}

    <!-- OUR PARTNERS -->
    @include('nec.home-page.partners')

    <!-- COUNTERS -->
    @include('nec.home-page.counter')
@endsection