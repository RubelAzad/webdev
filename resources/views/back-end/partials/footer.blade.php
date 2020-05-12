<div class="row">
    <div class="col-xs-12 col-sm-6">
        <span class="txt-color-white">Magic Office <span class="hidden-xs"> - Web Application Framework</span> © 2014-{{\Carbon\Carbon::today()->format('Y')}}</span>
    </div>

    <div class="col-xs-6 col-sm-6 text-right hidden-xs">
        <div class="txt-color-white inline-block">
            @if(auth()->id())
                <i class="txt-color-blueLight hidden-mobile">Logged in since <i class="fa fa-clock-o"></i> <strong>{{login_since()}}</strong> </i>
            @endif
        </div>
    </div>
</div>