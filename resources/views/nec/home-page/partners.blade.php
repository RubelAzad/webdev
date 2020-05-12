<div class="container">
    <div class="row margin-bottom-60">
        <div class="col-sm-12">
            <div class="widget_text">
                <h3 class="widget-title lined big">
                    <span>OUR PARTNERS</span>
                </h3>
                <div class="logo-panel">
                    <div class="row">
                        @if($partners = get_partners())
                            @foreach($partners as $partner)
                                <div class="col-xs-12  col-sm-2" data-toggle="tooltip" title="{{$partner->name}}">
                                    <a href="{{url($partner->link ? $partner->link : '#')}}"><img alt="{{$partner->name}}" src="{{url('file/serve/' . $partner->logo)}}"></a>
                                </div>
                            @endforeach
                        @endif
                    </div><!-- /.row -->
                </div><!-- /.logo-panel -->
            </div><!-- /.widget_text -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container -->