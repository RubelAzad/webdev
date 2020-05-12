<!-- FOOTER -->
<footer class="footer">

    <div class="footer-top">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 col-md-4">

                    <p>
                        <img alt="logo-footer" src="{{get_main_logo_url()}}" class="logo" width="200">
                    </p>
                    {{--<p>--}}
                        {{--But i must explain to you how all this mistaken idea pleasure and praising pain was born and i will give you. But i explain to you how all this mistaken idea.--}}
                    {{--</p>--}}
                    <p>
                        <a target="_blank" href="{{url(get_settings('facebook') ? get_settings('facebook') : '#')}}" class="icon-container icon-container--square">
                            <span class="fa fa-facebook"></span>
                        </a>
                        <a target="_blank" href="{{url(get_settings('twitter') ? get_settings('twitter') : '#')}}" class="icon-container icon-container--square">
                            <span class="fa fa-twitter"></span>
                        </a>
                        <a target="_blank" href="{{url(get_settings('linkedin') ? get_settings('linkedin') : '#')}}" class="icon-container icon-container--square">
                            <span class="fa fa-linkedin"></span>
                        </a>
                        <a target="_blank" href="{{url(get_settings('youtube') ? get_settings('youtube') : '#')}}" class="icon-container icon-container--square">
                            <span class="fa fa-youtube-play"></span>
                        </a>
                    </p>

                </div><!-- /.row -->

                <div class="col-xs-12 col-md-2">

                    <div class="widget_nav_menu">
                        <h6 class="footer-top__headings">NAVIGATION</h6>
                        <ul>
                            <li><a href="{{url('page/about-us')}}">About Us</a></li>
                            <li><a href="{{url('support')}}">Help & Support</a></li>
                            <li><a href="{{url('career')}}">Career with us</a></li>
                        </ul>
                    </div><!-- /.widget_nav_menu -->

                </div><!-- /.row -->

                <div class="col-xs-12 col-md-2">

                    <div class="widget_nav_menu">

                        <h6 class="footer-top__headings">OUR SERVICES</h6>
                        <ul>
                            @if($services = get_site_services())
                                @foreach($services as $service)
                                    <li><a href="{{url('our-service/'. $service->slug)}}">{{title_case($service->title)}}</a></li>
                                @endforeach
                            @endif
                        </ul>

                    </div><!-- /.widget_nav_menu -->

                </div><!-- /.row -->

                <div class="col-xs-12 col-md-4">

                    <h6 class="footer-top__headings">Contact Us</h6>
                    <p><i class="fa fa-address-book"></i> 624A Romford road, Manor park, London, E12 5AQ, United Kingdom </p>
                    <p><i class="fa fa-phone"></i>  +44 20 3769 9425, +44 20 8478 2118 , +44 20 3769 6109, +44 20 8552 6438, +44 20 3769 5865 </p>
                    <p><i class="fa fa-envelope"></i> {{get_settings('customer_care_email', ' info@neccargo.com')}}</p>

                </div><!-- /.row -->

            </div><!-- /.row -->

        </div><!-- /.footer -->

    </div><!-- /.footer-top -->

    <div class="footer-bottom">

        <div class="container">

            <div class="footer-bottom__left">
                Powered By <a href="http://www.magicoffice.co.uk/">Magic Office</a>.
            </div>

            <div class="footer-bottom__right">
                <p>Copyright &copy; {{\Carbon\Carbon::now()->format('Y')}} {{ config('app.name', 'Magic Office') }}. All rights reserved</p>
            </div>

        </div><!-- /.container -->

    </div><!-- /.footer-bottom -->

</footer>