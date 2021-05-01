<ul class="nav">

    <!-- dashboard -->
    <li>
        <a href="javascript:;">
            <i class="fa fa-flask"></i>
            <span>Dashboard</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="">
                    <span>Home</span>
                </a>
            </li>

            <li>
                {{--<a href="{{route('users.create')}}">--}}
                <span>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form5').submit();">Logout</a>
                  <form id="logout-form5" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </span>
                {{--</a>--}}
            </li>
        </ul>
    </li>
    <!-- /dashboard -->

    <!-- ui -->
    <li>
        <a href="{{route('IndividualProfile')}}">
            <i class="fa fa-toggle-on"></i>
            <span>Profile</span>
        </a>
    </li>

    <!-- /ui -->


    <!-- tables -->


    <!-- charts -->
    <li>
        <a href="{{route('MDTithe.index')}}">
            <i class="fa fa-pie-chart"></i>
            <span>Tithe</span>
        </a>
    </li>
    <li>
        <a href="">
            <i class="fa fa-tag"></i>
            <span>Announcement</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('tolocalAnnouncement')}}">
                    <span>{{Auth::user()->local->name}} Local.</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('membersAnnouncementD')}}">
                    <span>{{Auth::user()->district->name}} District</span>
                </a>
            </li>
            <li class="active">
                <a href="{{route('membersAnnouncementA')}}">
                    <span>{{Auth::user()->area->name}} Area</span>
                </a>
            </li>
            <li class="active">
                <a href="{{route('membersAnnouncement')}}">
                    <span>{{Auth::user()->region->name}}</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="">
            <i class="fa fa-tag"></i>
            <span>Birthdays</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('birthdayDaily')}}">
                    <span>Daily</span>
                </a>
            </li>
            <li class="">
                <a href="{{route('birthdayMonth')}}">
                    <span>Monthly</span>
                </a>
            </li>
        </ul>
    </li>

</ul>