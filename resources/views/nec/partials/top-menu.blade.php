<li><a href="{{url('/')}}">Home</a></li>
<li><a href="{{url('about')}}">About</a></li>
<li class="menu-item-has-children">
    <a href="{{url('our-service')}}">Services</a>
    <ul role="menu" class="sub-menu">
        @if($services = get_site_services())
            @foreach($services as $service)
                <li><a href="{{url('our-service/'. $service->slug)}}">{{title_case($service->title)}}</a></li>
            @endforeach
        @endif
    </ul>
</li>
<li><a href="{{url('support')}}">Help & Support</a></li>
<li><a href="{{url('contact-us')}}">Contact Us</a></li>
<li><a href="{{url('login')}}"><i class="fa fa-sign-in"></i> My Account</a></li>