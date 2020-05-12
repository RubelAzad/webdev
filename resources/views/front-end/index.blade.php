@extends('front-end.layouts.app')

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
    });
</script>
@endpush

@section('content')
    <section id="home" data-target="home">
        <div class="row" style="border: solid thin lightgray;">
            <div class="col-xs-1 text-right highlighted"><h4>Latest Update</h4></div>
            <div class="col-xs-11">
                <div class="TickerNews" id="T1">
                    <div class="ti_wrapper">
                        <div class="ti_slide">

                            <div class="ti_content">
                                <div class="ti_news"><a href="#"><span>11:00</span> US fisherman rescued by tanker after 66 days lost at sea</a></div>
                                <div class="ti_news"><a href="#"><span>12:00</span> Overseas aid must rise by £1bn in next two years, says Europe</a></div>
                                <div class="ti_news"><a href="#"><span>13:00</span> Muslim population looks likely to double in size </a></div>
                                <div class="ti_news"><a href="#"><span>15:00</span> Heathrow cuts passenger levy to boost domestic flights</a></div>
                                <div class="ti_news"><a href="#"><span>16:00</span> Couple plotted to sell their new baby online for €5,000 </a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="static-banner">
            <div class="banner-text">
                <h1>Hello. <span class="highlighted"> We’r SA. </span> <br> <small>Smart - Stylish - Powerful</small></h1>
                <a href="#" class="btn btn-tranparent">GET STARTED</a>
            </div>
        </div>
        <div class="action-banner">
            <div class="container">
                @include('front-end.partials.middle-menu')
            </div>
        </div>
        <div class="section-area">
            <div class="container">
                <div class="title-section">
                    <h1>Awesome Features.</h1>
                    <p>Lorem ipsum dolor sit amet, te vel illud clita tempor. Commodo laoreet mei no. Vis ea mollis mediocrem voluptatum, <br>ad harum nominati duo. Dictas periculis salutatus ei est, eu odio augue vel. </p>
                </div>
                <div class="row features">
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-rocket icon-circle"></span> Easy To Launch</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-comment icon-circle"></span> Easy To Launch</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-heart icon-circle"></span> Easy To Launch</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                </div>
                <div class="blog-slider-wrap">
                    <ul class="blog-slider">
                        <li>
                            <img src="{{url('front-end/images/blog-slider1.jpg')}}" alt="">
                            <div class="overlay-data right">
                                <div class="overlay-inner">
                                    <div>
                                        <h4>Work Title Here</h4>
                                    </div>
                                </div>
                                <a href="{{url('front-end/images/blog-slider1.jpg')}}" title="" class="zoom fancybox" rel="group1"><span class="fa fa-search"></span></a>
                            </div>
                        </li>
                        <li>
                            <img src="{{url('front-end/images/blog-slider2.jpg')}}" alt="">
                            <div class="overlay-data right">
                                <div class="overlay-inner">
                                    <div>
                                        <h4>Work Title Here</h4>
                                    </div>
                                </div>
                                <a href="{{url('front-end/images/blog-slider2.jpg')}}" title="" class="zoom fancybox" rel="group1"><span class="fa fa-search"></span></a>
                            </div>
                        </li>
                        <li>
                            <img src="{{url('front-end/images/blog-slider3.jpg')}}" alt="">
                            <div class="overlay-data right">
                                <div class="overlay-inner">
                                    <div>
                                        <h4>Work Title Here</h4>
                                    </div>
                                </div>
                                <a href="{{url('front-end/images/blog-slider3.jpg')}}" title="" class="zoom fancybox" rel="group1"><span class="fa fa-search"></span></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section id="aboutus" data-target="aboutus">
        <div class="section-area aboutus offwhite">
            <div class="container">
                <div class="title-section text-center">
                    <h1>About Us.</h1>
                    <p>Lorem ipsum dolor sit amet, te vel illud clita tempor. Commodo laoreet mei no. Vis ea mollis mediocrem voluptatum,<br> ad harum nominati duo. Dictas periculis salutatus ei est, eu odio augue vel. </p>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Strategy Solutions
                                            <span class="fa toggle-icon"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs cond mentum leo massa mollis estiegittis miristum nulla.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading" role="tab" id="headingTwo">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Our Mission
                                            <span class="fa toggle-icon"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                    <div class="panel-body">
                                        <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs cond mentum leo massa mollis estiegittis miristum nulla.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            History
                                            <span class="fa toggle-icon"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs cond mentum leo massa mollis estiegittis miristum nulla.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading" role="tab" id="headingFour">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                            Clean Modern Code
                                            <span class="fa toggle-icon"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                    <div class="panel-body">
                                        <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs cond mentum leo massa mollis estiegittis miristum nulla.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>Creativity</h4>
                        <div class="progress ">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%;">
                                </div>
                            </div>
                        </div>
                        <h4>Photoshop</h4>
                        <div class="progress ">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
                                </div>
                            </div>
                        </div>
                        <h4>Development</h4>
                        <div class="progress ">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
                                </div>
                            </div>
                        </div>
                        <h4>Responsive</h4>
                        <div class="progress ">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%;">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section id="ourteam" data-target="ourteam">
        <div class="section-area ourteam">
            <div class="container">
                <div class="title-section">
                    <h1>Our Team.</h1>
                    <p>Lorem ipsum dolor sit amet, te vel illud clita tempor. Commodo laoreet mei no. Vis ea mollis mediocrem voluptatum,<br> ad harum nominati duo. Dictas periculis salutatus ei est, eu odio augue vel. </p>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="member">
                            <img src="{{url('front-end/images/member.jpg')}}" alt="">
                            <div class="overlay-data">
                                <div class="overlay-inner">
                                    <!-- !!!!!!! donot delete this extra div tag -->
                                    <div>
                                        <!-- donot delete this extra div tag -->
                                        <h4>Jeff Roe <br> <small>Assistant of CEO</small></h4>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt.</p>
                                        <p class="social-icons"><a href="#" title=""><span class="fa fa-facebook"></span></a><a href="#" title=""><span class="fa fa-twitter"></span></a><a href="#" title=""><span class="fa fa-linkedin"></span></a></p>
                                    </div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="member">
                            <img src="{{url('front-end/images/member.jpg')}}" alt="">
                            <div class="overlay-data">
                                <div class="overlay-inner">
                                    <!-- !!!!!!! donot delete this extra div tag -->
                                    <div>
                                        <!-- donot delete this extra div tag -->
                                        <h4>Jeff Roe <br> <small>Assistant of CEO</small></h4>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt.</p>
                                        <p class="social-icons"><a href="#" title=""><span class="fa fa-facebook"></span></a><a href="#" title=""><span class="fa fa-twitter"></span></a><a href="#" title=""><span class="fa fa-linkedin"></span></a></p>
                                    </div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="member">
                            <img src="{{url('front-end/images/member.jpg')}}" alt="">
                            <div class="overlay-data">
                                <div class="overlay-inner">
                                    <!-- !!!!!!! donot delete this extra div tag -->
                                    <div>
                                        <!-- donot delete this extra div tag -->
                                        <h4>Jeff Roe <br> <small>Assistant of CEO</small></h4>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt.</p>
                                        <p class="social-icons"><a href="#" title=""><span class="fa fa-facebook"></span></a><a href="#" title=""><span class="fa fa-twitter"></span></a><a href="#" title=""><span class="fa fa-linkedin"></span></a></p>
                                    </div></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="member">
                            <img src="{{url('front-end/images/member.jpg')}}" alt="">
                            <div class="overlay-data">
                                <div class="overlay-inner">
                                    <!-- !!!!!!! donot delete this extra div tag -->
                                    <div>
                                        <!-- donot delete this extra div tag -->
                                        <h4>Jeff Roe <br> <small>Assistant of CEO</small></h4>
                                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt.</p>
                                        <p class="social-icons"><a href="#" title=""><span class="fa fa-facebook"></span></a><a href="#" title=""><span class="fa fa-twitter"></span></a><a href="#" title=""><span class="fa fa-linkedin"></span></a></p>
                                    </div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="portfolio" data-target="portfolio">
        <div class="section-area portfolio offwhite">
            <div class="container">
                <div class="title-section text-center">
                    <h1>Gallery</h1>
                    <ul class="list-inline filter-list">
                        <li class="active"><a href="#" title="" data-filter="*">All</a></li>
                        <li><a href="#" title="" data-filter=".logo">Logo</a></li>
                        <li><a href="#" title="" data-filter=".template">Template</a></li>
                        <li><a href="#" title="" data-filter=".business">Business</a></li>
                        <li><a href="#" title="" data-filter=".photography">Photography</a></li>
                        <li><a href="#" title="" data-filter=".graphic">Graphic</a></li>
                        <li><a href="#" title="" data-filter=".branding">Branding</a></li>
                    </ul>
                </div>
                <ul class="items_container">
                    <li class="logo">
                        <img src="{{url('front-end/images/portfolio1.jpg')}}" alt="">
                        <div class="overlay-data top">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio1.jpg')}}" title="" class="zoom fancybox" rel="group1a"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="template">
                        <img src="{{url('front-end/images/portfolio2.jpg')}}" alt="">
                        <div class="overlay-data right">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio2.jpg')}}" title="" class="zoom fancybox" rel="group2"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="business">
                        <img src="{{url('front-end/images/portfolio3.jpg')}}" alt="">
                        <div class="overlay-data bottom">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio3.jpg')}}" title="" class="zoom fancybox" rel="group3"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="photography">
                        <img src="{{url('front-end/images/portfolio4.jpg')}}" alt="">
                        <div class="overlay-data left">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio4.jpg')}}" title="" class="zoom fancybox" rel="group4"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="graphic">
                        <img src="{{url('front-end/images/portfolio5.jpg')}}" alt="">
                        <div class="overlay-data top">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio5.jpg')}}" title="" class="zoom fancybox" rel="group1a"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="branding">
                        <img src="{{url('front-end/images/portfolio6.jpg')}}" alt="">
                        <div class="overlay-data right">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio6.jpg')}}" title="" class="zoom fancybox" rel="group2"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="logo">
                        <img src="{{url('front-end/images/portfolio1.jpg')}}" alt="">
                        <div class="overlay-data top">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio1.jpg')}}" title="" class="zoom fancybox" rel="group3"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="template">
                        <img src="{{url('front-end/images/portfolio2.jpg')}}" alt="">
                        <div class="overlay-data right">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio2.jpg')}}" title="" class="zoom fancybox" rel="group4"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="business">
                        <img src="{{url('front-end/images/portfolio3.jpg')}}" alt="">
                        <div class="overlay-data bottom">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio3.jpg')}}" title="" class="zoom fancybox" rel="group1a"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="photography">
                        <img src="{{url('front-end/images/portfolio4.jpg')}}" alt="">
                        <div class="overlay-data left">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio4.jpg')}}" title="" class="zoom fancybox" rel="group2"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="graphic">
                        <img src="{{url('front-end/images/portfolio5.jpg')}}" alt="">
                        <div class="overlay-data top">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio5.jpg')}}" title="" class="zoom fancybox" rel="group3"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                    <li class="branding">
                        <img src="{{url('front-end/images/portfolio6.jpg')}}" alt="">
                        <div class="overlay-data right">
                            <div class="overlay-inner">
                                <div>
                                    <h4>Work Title Here</h4>
                                    <p>photography</p>
                                </div>
                            </div>
                            <a href="{{url('front-end/images/portfolio6.jpg')}}" title="" class="zoom fancybox" rel="group4"><span class="fa fa-search"></span></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section id="services" data-target="services">
        <div class="section-area no-border">
            <div class="container">
                <div class="title-section">
                    <h1>Services.</h1>
                    <p>Lorem ipsum dolor sit amet, te vel illud clita tempor. Commodo laoreet mei no. Vis ea mollis mediocrem voluptatum, <br>ad harum nominati duo. Dictas periculis salutatus ei est, eu odio augue vel. </p>
                </div>
                <div class="row features">
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-eye icon-circle"></span> Retina Ready</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-trophy icon-circle"></span> Focused Offerings</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-share-alt icon-circle"></span> Seo/Ppcm</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                </div>
                <div class="row features">
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-wordpress icon-circle"></span> Branding/Identity</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-book icon-circle"></span> Copy Writing</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                    <div class="col-sm-4 feature">
                        <h3><span class="fa fa-code icon-circle"></span> Development/Coding</h3>
                        <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blog" data-target="blog">
        <div class="container">
            <div class="section-area">
                <div class="title-section">
                    <h1>The Blog.</h1>
                    <p>Lorem ipsum dolor sit amet, te vel illud clita tempor. Commodo laoreet mei no. Vis ea mollis mediocrem voluptatum, <br>ad harum nominati duo. Dictas periculis salutatus ei est, eu odio augue vel. </p>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="post">
                            <div class="post-thumbmail">
                                <img src="{{url('front-end/images/blog1.jpg')}}" alt="">
                            </div>
                            <div class="post-date">
                                <strong>10</strong>
                                <span>April 2015</span>
                            </div>
                            <div class="post-info clearfix">
                                <p class="pull-left"><span class="fa fa-user"></span>Posted by: Author</p>
                                <p class="pull-right"><span class="fa fa-comment"></span>3 Comments</p>
                            </div>
                            <div class="post-text">
                                <h3><a href="#" title="">Lorem ipsum dolor sit amet</a></h3>
                                <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri. Ex his purto veri discere, ut cum labore eripuit insolens.</p>
                                <a href="#" title="" class="read-more">Read more</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="post">
                            <div class="post-thumbmail">
                                <img src="{{url('front-end/images/blog2.jpg')}}" alt="">
                            </div>
                            <div class="post-date">
                                <strong>10</strong>
                                <span>April 2015</span>
                            </div>
                            <div class="post-info clearfix">
                                <p class="pull-left"><span class="fa fa-user"></span>Posted by: Author</p>
                                <p class="pull-right"><span class="fa fa-comment"></span>3 Comments</p>
                            </div>
                            <div class="post-text">
                                <h3><a href="#" title="">Lorem ipsum dolor sit amet</a></h3>
                                <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri. Ex his purto veri discere, ut cum labore eripuit insolens.</p>
                                <a href="#" title="" class="read-more">Read more</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="post">
                            <div class="post-thumbmail">
                                <img src="{{url('front-end/images/blog3.jpg')}}" alt="">
                            </div>
                            <div class="post-date">
                                <strong>10</strong>
                                <span>April 2015</span>
                            </div>
                            <div class="post-info clearfix">
                                <p class="pull-left"><span class="fa fa-user"></span>Posted by: Author</p>
                                <p class="pull-right"><span class="fa fa-comment"></span>3 Comments</p>
                            </div>
                            <div class="post-text">
                                <h3><a href="#" title="">Lorem ipsum dolor sit amet</a></h3>
                                <p>Dicant nostrum cum te. An sint choro ius, cibo tractatos usu at, copiosae invenire eu pri. Ex his purto veri discere, ut cum labore eripuit insolens.</p>
                                <a href="#" title="" class="read-more">Read more</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="section-area no-border">
                <div class="testimonial-slider-wrap text-center">
                    <ul>
                        <li>
                            <h1>Testimonials.</h1>
                            <p>Lorem ipsum dolor sit amet, te vel illud clita tempor. Commodo laoreet mei no. Vis ea mollis mediocrem voluptatum, ad harum nominati duo. Dictas periculis salutatus ei est, eu odio augue vel. Vix vide probatus theophrastus et, graece persius est ne, id vis ridens volumus posidonium.</p>
                            <p>
                                <a href="#">John Doe, Company Inc.</a>
                                <span class="rating-bar">
									<a href="" title="" class="fa fa-star"></a>
									<a href="" title="" class="fa fa-star"></a>
									<a href="" title="" class="fa fa-star"></a>
									<a href="" title="" class="fa fa-star"></a>
									<a href="" title="" class="fa fa-star"></a>
								</span>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection