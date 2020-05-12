<div class="row">
    <div class="col-sm-12">
        <h3 class="widget-title big lined"><span>OUR SERVICES</span></h3>
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">

    @foreach($services as $service)
        <div class="col-sm-4">
            <div class="widget_pw_icon_box margin-bottom-30">
                <a target="_self" href="{{url('our-service/' . $service->slug)}}" class="icon-box">
                    <i class="fa fa-{{$service->icon ? $service->icon : 'check'}}"></i>
                    <h4 class="icon-box__title">{{strtoupper($service->title)}}</h4>
                    <span class="icon-box__subtitle">{{$service->summary}}</span>
                </a>
            </div>
        </div>
    @endforeach
</div><!-- /.row -->