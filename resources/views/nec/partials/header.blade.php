<div class="header_container">

    <div class="container">

        <header class="header">

            <div class="header__logo">
                <a href="{{url('/')}}">
                    <img class="img-responsive" srcset="{{get_main_logo_url()}}" alt="{{config('app.name')}}" src="{{get_main_logo_url()}}">
                </a>
                <button data-target="#cargopress-navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                    <span class="navbar-toggle__text">MENU</span>
                    <span class="navbar-toggle__icon-bar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</span>
                </button>
            </div><!-- /.header__logo -->

            <div class="header__navigation">
                <nav class="collapse navbar-collapse" id="cargopress-navbar-collapse">
                    <ul class="main-navigation js-main-nav js-dropdown">
                        @include('nec.partials.top-menu')
                    </ul>
                </nav>
            </div><!-- /.header__navigation -->

            <div class="header__widgets">
                @include('nec.partials.top-info')
            </div><!-- /.header__widgets -->
        </header>

    </div><!-- /.container -->

</div>