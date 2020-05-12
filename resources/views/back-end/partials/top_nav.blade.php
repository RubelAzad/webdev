<header id="header">
    <div id="logo-group">

        <!-- PLACE YOUR LOGO HERE -->
        <span id="logo"> <img src="{{url('img/logo.png')}}" alt="{{config('app.site_name')}}"> </span>
        <!-- END LOGO PLACEHOLDER -->

        <!-- Note: The activity badge color changes when clicked and resets the number to 0
        Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
        <span id="activity" class="activity-dropdown"> <i class="fa fa-user"></i> <b class="badge"> 2 </b> </span>

        <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
        <div class="ajax-dropdown">

            <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
            <div class="btn-group btn-group-justified" data-toggle="buttons">
                <label class="btn btn-default">
                    <input type="radio" name="activity" id="/user/notifications">
                    notify (1) </label>
                <label class="btn btn-default">
                    <input type="radio" name="activity" id="/task/notifications">
                    Tasks (1) </label>
            </div>

            <!-- notification content -->
            <div class="ajax-notifications custom-scroll">

                <div class="alert alert-transparent">
                    <h4>Click a button to show messages here</h4>
                    This blank page message helps protect your privacy, or you can show the first message here automatically.
                </div>

                <i class="fa fa-lock fa-4x fa-border"></i>

            </div>
            <!-- end notification content -->

            <!-- footer: refresh area -->
            <span> Last updated on: 12/12/2013 9:43AM
						<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
							<i class="fa fa-refresh"></i>
						</button>
					</span>
            <!-- end footer -->

        </div>
        <!-- END AJAX-DROPDOWN -->
    </div>

    <!-- projects dropdown -->
    <div class="project-context hidden-xs hide">

        <span class="label">Folders:</span>
        <span class="project-selector dropdown-toggle" data-toggle="dropdown">Recent Folders <i class="fa fa-angle-down"></i></span>

        <!-- Suggestion: populate this list with fetch and push technique -->
        <ul class="dropdown-menu">
            <li>
                <a href="javascript:void(0);">Online e-merchant management system - attaching integration with the iOS</a>
            </li>
            <li>
                <a href="javascript:void(0);">Notes on pipeline upgradee</a>
            </li>
            <li>
                <a href="javascript:void(0);">Assesment Report for merchant account</a>
            </li>
        </ul>
        <!-- end dropdown-menu-->
    </div>
    <!-- end projects dropdown -->
    @if(session('franchise'))
        @can('view_my_franchise', session('current_franchise'))
            <a class="btn-header btn bg-color-darken txt-color-white" href="{{url('franchise/view/' . session('franchise'))}}">Franchise: <strong>{{session('franchise_name')}}</strong></a>
        @else
            <span class="btn-header btn bg-color-darken txt-color-white">Franchise: <strong>{{session('franchise_name')}}</strong></span>
        @endcan

    @endif
    @if(session('agent'))
        @can('view_my_agent', session('current_agent'))
            <a class="btn-header btn bg-color-darken txt-color-white" href="{{url('agent/view/' . session('agent'))}}">Agent: <strong>{{session('agent_name')}}</strong></a>
        @else
            <span class="btn-header btn bg-color-darken txt-color-white">Agent: <strong>{{session('agent_name')}}</strong></span>
        @endcan
    @endif

    <!-- pulled right: nav area -->
    <div class="pull-right">

        <!-- collapse menu button -->
        <div id="hide-menu" class="btn-header pull-right">
            <span> <a href="javascript:void(0);" data-action="toggleMenu" rel="tooltip" data-placement="bottom" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
        </div>
        <!-- end collapse menu -->


        <!-- logout button -->
        <div id="logout" class="btn-header transparent pull-right">
            <span>
                <a
                        href="{{ route('logout') }}"
                        rel="tooltip"
                        data-placement="bottom"
                        title="Sign Out"
                        data-action="userLogout"
                        data-logout-msg="You can improve your security further after logging out by closing this opened browser"
                >
                    <i class="fa fa-power-off"></i></a>
            </span>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
        <!-- end logout button -->

        <!-- fullscreen button -->
        <div id="fullscreen" class="btn-header transparent pull-right">
            <span> <a href="javascript:void(0);" data-action="launchFullscreen" rel="tooltip" data-placement="bottom" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
        </div>
        <!-- end fullscreen button -->

        <!-- back to original login button -->
        @if(session('orig_user'))
        <div id="backToOriginal" class="btn-header transparent pull-right">
            <span> <a href="{{ url('/back_to_my_account') }}" rel="tooltip" onclick="$.LoadingOverlay('show')" data-placement="bottom" title="Back to original login"><i class="fa fa-reply"></i></a> </span>
        </div>
        @endif
        <!-- end fullscreen button -->
        <div id="back_to_site" class="btn-header transparent pull-right">
            <span> <a href="{{url('')}}" rel="tooltip" target="_blank" data-placement="bottom" title="Visit Website">Visit Website</a> </span>
        </div>


        @if(session('house_id'))
            <div class="btn-header transparent pull-right">
                <span>
                    <a href="{{url('warehouse/logout')}}" rel="tooltip" data-placement="bottom" title="Logout from {{get_warehouse_name_by_id(session('house_id'))}}">
                        <i class="fa fa-arrow-left"></i> <i class="fa fa-home"></i> {{get_warehouse_name_by_id(session('house_id'))}}
                    </a>
                </span>
            </div>
        @else
            @if(auth()->user()->warehouse_employments->count())
                <div class="btn-header transparent pull-right">
                    <span>
                        <a href="{{url('warehouse/login')}}" rel="tooltip" data-placement="bottom" title="Login to Warehouse">
                            <i class="fa fa-arrow-right"></i> <i class="fa fa-home"></i>
                        </a>
                    </span>
                </div>
            @endif
        @endif


    </div>
    <!-- end pulled right: nav area -->

</header>