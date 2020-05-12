<ul>
    <li>
        <a href="{{url('event/calendar')}}" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
    </li>
    <li>
        <a href="{{url('user/view/'. Auth::id())}}" class="jarvismetro-tile big-cubes bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
    </li>
    @if(session('orig_user'))
    <li>
        <a href="{{ url('/back_to_my_account') }}" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-undo fa-4x"></i> <span>Back to Original </span> </span> </a>
    </li>
    @endif
</ul>