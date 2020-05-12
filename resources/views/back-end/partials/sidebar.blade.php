<aside id="left-panel">

    <!-- User info -->
    <div class="login-info">
        <span> <!-- User image size is adjusted inside CSS, it should stay as it -->
            <a id="show-shortcut" href="{{url('user/view/'. Auth::id())}}">
                <img src="{{ (Auth::user()->profile_picture ? url(Auth::user()->profile_picture->path) : Gravatar::get(Auth::user()->email))  }}" alt="{{Auth::user()->name}}" class="online" />
                <span>
                    {{Auth::user()->name}}
                </span>
            </a>

        </span>
    </div>
    <!-- end user info -->

    <!-- NAVIGATION : This navigation is also responsive-->
    <nav>
        <ul>
            @if($menus = config('menu.all'))
                @foreach($menus->sortBy('position') as $menu)
                    @if( ! $menu->children->count())
                        @if($menu->ability && $menu->class)
                            @can($menu->ability, resolve($menu->class))
                                <li class=""><a href="{{url($menu->link)}}"><i class="{{$menu->icon}}"></i> <span class="menu-item-parent"> {{$menu->text}}</span></a></li>
                            @endcan
                        @else
                            <li class=""><a href="{{url($menu->link)}}"><i class="{{$menu->icon}}"></i> <span class="menu-item-parent"> {{$menu->text}}</span></a></li>
                        @endif
                    @else
                        @if($menu->ability && $menu->class)
                            @can($menu->ability, resolve($menu->class))
                                <li>
                                    <a href="#"><i class="{{$menu->icon}}"></i> <span class="menu-item-parent"> {{$menu->text}}</span></a>
                                    <ul class="submenu">
                                        @foreach($menu->children->sortBy('position') as $child)
                                            @if($child->ability && $child->class)
                                                @can($child->ability, resolve($child->class))
                                                    <li class=""><a href="{{url($child->link)}}"> {{$child->text}} </a></li>
                                                @endcan
                                            @else
                                                <li class=""><a href="{{url($child->link)}}"> {{$child->text}} </a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endcan
                        @else
                            <li>
                                <a href="#"><i class="{{$menu->icon}}"></i> <span class="menu-item-parent"> {{$menu->text}}</span></a>
                                <ul class="submenu">
                                    @foreach($menu->children->sortBy('position') as $child)
                                        @if($child->ability && $child->class)
                                            @can($child->ability, resolve($child->class))
                                                <li class=""><a href="{{url($child->link)}}"> {{$child->text}} </a></li>
                                            @endcan
                                        @else
                                            <li class=""><a href="{{url($child->link)}}"> {{$child->text}} </a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
        </ul>
    </nav>


    <span class="minifyme" data-action="minifyMenu"><i class="fa fa-arrow-circle-left hit"></i></span>

</aside>