@extends('back-end.layouts.app')

@push('style')

@endpush

@push('scripts')
    <script src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>
    <script type="application/javascript" src="{{url(Module::asset('post:js/view.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> View Post - {{strtoupper($post->tracking_no)}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('cargo')}}"><i class="fa fa-archive"></i> Management Shipments</a></li>
    <li class="active">View Post</li>
@endsection

@section('top_right_corner_button_group')
    <a href="{{url('post/invoice/' . $post->id)}}" target="_blank" class="btn btn-primary">Print Invoice</a>
    <a href="{{url('post/label/' . $post->id)}}" target="_blank" class="btn btn-primary">Print Label</a>
@endsection

@section('content')
    <div class="row">
        <article class="col-xs-12 col-md-5 pull-right">
            <!-- Widget ID (each widget will need unique ID)-->
            <div style="width: 100%" class="jarviswidget jarviswidget-color-blueLight" id="wid-id-10" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="true" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">

                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-list-alt"></i> </span>
                    <h2>Tracking Information </h2>
                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

                <!-- widget div-->
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        @if($post->note)
                            <div class="alert alert-info" style="margin-bottom: 0">
                                <p> <i class="fa fa-info-circle fa-lg" aria-hidden="true"></i> {{$post->note}}</p>
                            </div>
                        @endif

                        @include('post::tracking-info', ['post' => $post, 'histories' => $post->histories])

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->
        </article>
        <article class="col-xs-12 col-md-7 pull-left">

            <!-- Widget ID (each widget will need unique ID)-->
            <div style="width: 100%" class="jarviswidget jarviswidget-color-blueLight" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="true" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false" role="widget">

                <header role="heading">
                    <span class="widget-icon"> <i class="fa fa-list-alt"></i> </span>
                    <h2>Post information</h2>
                    <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>

                <!-- widget div-->
                <div role="content">

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">

                        @include('post::summary', ['post' => $post])

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
    </div>
@stop
