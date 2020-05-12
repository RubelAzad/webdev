<div class="widget-icon-box">
    <div class="icon-box">
        <i class="fa fa-headphones"></i>
        <h4 class="icon-box__title">Call Us Anytime</h4>
        <span class="icon-box__subtitle">{{get_settings('customer_care_number', '')}}</span>
    </div>
</div>


<div class="widget-icon-box">
    <div class="icon-box">
        <i class="fa fa-envelope-o"></i>
        <h4 class="icon-box__title">Email Us</h4>
        <span class="icon-box__subtitle">{{get_settings('customer_care_email', 'info@bitac.co.uk')}}</span>
    </div>
</div>

<a href="{{url('get-quote')}}" class="btn btn-info" id="button_requestQuote"></a>