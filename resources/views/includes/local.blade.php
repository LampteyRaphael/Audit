<ul class="nav">

    <!-- dashboard -->
    <li>
        <a href="javascript:;">
            <i class="fa fa-flask"></i>
            <span>Dashboard</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('local.index')}}">
                    <i class="fa fa-home"></i>
                    <span>Home</span>
                </a>
            </li>

            <li>
                {{--<a href="{{route('users.create')}}">--}}

                <span>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form4').submit();">
                     <i class="fa fa-sign-out"></i>
                    Logout
                  </a>
                  <form id="logout-form4" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </span>
                {{--</a>--}}
            </li>
        </ul>
    </li>
    <!-- /dashboard -->

    <!-- ui -->
    {{--          @if(Auth::user()->role_id)--}}
    <li>
        <a href="javascript:;">
            <i class="fa fa-toggle-on"></i>
            <span>Church Members</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('registration.index')}}">
                    <i class="fa fa-users"></i>
                    <span>Active Members</span>
                </a>
            </li>
            @if(Auth::user()->role_id ==8)
                <li>
                    <a href="{{route('registration.edit',Auth::user()->id)}}">
                        <i class="fa fa-user-plus"></i>
                        <span>Anonymous User</span>
                    </a>
                </li>
            @elseif(Auth::user()->role_id==12)
                <li>
                    <a href="{{route('registration.edit',Auth::user()->id)}}">
                        <i class="fa fa-user-secret"></i>
                        <span>Special Local Admin</span>
                    </a>
                </li>
            @else
            @endif
            <li>
                <a href="{{route('nonactive.index')}}">
                    <i class="fa fa-circle-o-notch"></i>
                    <span>Non Active Members</span>
                </a>
            </li>
            <li>
                <a href="{{route('nonactive.show','newconvert')}}">
                    <i class="fa fa-hacker-news"></i>
                    <span>New Convert</span>
                </a>
            </li>
            <li>
                <a href="{{route('nonactive.show','newconvert')}}">
                    <i class="fa fa-hacker-news"></i>
                    <span>New Entrant</span>
                </a>
            </li>

            <li>
                <a href="{{route('nonactive.create')}}">
                    <i class="fa fa-map-marker"></i>
                    <span>Deceased</span>
                </a>
            </li>
            <li>
                <a href="{{route('registration.create')}}">
                    <i class="fa fa-plus"></i>
                    <span>Add New Member</span>
                </a>
            </li>
        </ul>
    </li>
    <!-- /ui -->
    <!-- tables -->
    <!-- charts -->
    {{--          @else--}}
    <li>
        <a href="javascript:;">
            <i class="fa fa-pie-chart"></i>
            <span>Church Account</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('income.create')}}">
                    <i class="fa fa-tag"></i>
                    Add Income
                </a>
            </li>

            <li>
                <a href="{{route('income.index')}}">
                    <i class="fa fa-tag"></i>
                    Add Expenditure</a>
            </li>

            <li>
                <a href="{{route('tithe.create')}}">
                    <i class="fa fa-map-marker"></i>
                    <span>Add Tithe</span>
                </a>
            </li>
            <li>
                <a href="{{route('donation/Pledge')}}">
                    <i class="fa fa-map-marker"></i>
                    <span>Add Donation</span>
                </a>
            </li>
            <li>
                <a href="{{route('titheCharts.index')}}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Tithe Chart</span>
                </a>
            </li>
            <li>
                <a href="{{route('titheCharts.create')}}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Tithe Chart Range</span>
                </a>
            </li>
            <li>
                <a href="{{route('tithe.index')}}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Posted Tithe</span>
                </a>
            </li>
            <li>
                <a href="{{route('onlyDonation')}}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Posted Donation</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-pie-chart"></i>
                    <span>Income</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('category.index')}}">
                            <i class="fa fa-level-down"></i>

                            <span>All Categories</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="">
                    <i class="fa fa-tag"></i>
                    <span>Expenditure</span>
                </a>
                <ul class="sub-menu">
                    <li class="active">
                        <a href="{{route('expenditureC.index')}}">
                            <i class="fa fa-level-down"></i>
                            <span>All Categories</span>
                        </a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="">
                    <i class="fa fa-pie-chart"></i>
                    <span>Financial Report</span>

                </a>

                <ul class="sub-menu">
                    <li>
                        <a href="{{route('sunday.index')}}">
                            <i class="fa fa-chain-broken"></i>
                            <span>Daily Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('services.index')}}">
                            <i class="fa fa-chain"></i>
                            <span>Monthly Report</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('midyear.index')}}">
                            <i class="fa fa-line-chart"></i>
                            <span>Mid Year Report</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('year.index')}}">
                            <i class="fa fa-area-chart"></i>
                            <span>Yearly Report</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="">
                    <i class="fa fa-pie-chart"></i>
                    <span>Tithe Report</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('titheYearStatement')}}">
                            <i class="fa fa-calendar"></i>
                            <span>January-February</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('titheMonthStatement')}}">
                            <i class="fa fa-calendar"></i>
                            <span>March-April</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('mayJune')}}">
                            <i class="fa fa-calendar"></i>
                            <span>May-June</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('julyAugust')}}">
                            <i class="fa fa-calendar"></i>
                            <span>July-August</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('septOctober')}}">
                            <i class="fa fa-calendar"></i>
                            <span>September-October</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('novDecember')}}">
                            <i class="fa fa-calendar"></i>
                            <span>November-December</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </li>
    <!-- /charts -->
    {{--@endif--}}
{{--    @if(Auth::user()->role_id !==10)--}}
    <!-- maps -->
        <li>
            <a href="javascript:;">
                <i class="fa fa-map-marker"></i>
                <span>Announcement</span>
                <span class="label label-success pull-right">new
                &nbsp
                {{ App\AreaCircular::whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('nationalcircular.index')}}">
                        <i class="fa fa-info-circle"></i>
                        <span>National</span>
                        <span class="label label-primary pull-right">new
                &nbsp
                {{ App\AreaCircular::whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('localAreaPost')}}">
                        <i class="fa fa-info-circle"></i>
                        <span>Area</span>
                        <span class="label label-info pull-right">new
                &nbsp
               {{ App\AreaLevelCircular::whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('localdistrict.index')}}">
                        <i class="fa fa-info-circle"></i>
                        <span>District</span>
                        <span class="label label-default pull-right">new
                &nbsp
                {{ App\DistrictCircular::whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('localcircular.create')}}">
                        <i class="fa fa-info-circle"></i>
                        <span>Local</span>

                    </a>
                </li>

                <li>
                    <a href="{{route('localPost')}}">
                        <i class="fa fa-send-o"></i>
                        <span>Post To Local Members</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- /maps -->

        <!-- extras -->
        <li>
            <a href="javascript:;">
                <i class="fa fa-envelope"></i>
                <span>Messages</span>
                <span class="label label-danger pull-right">new
                &nbsp
               {{App\User::where('local_id',Auth::user()->local_id)->whereMonth('birthDate',Carbon\Carbon::now()->month)
            ->whereday('birthDate',Carbon\Carbon::now()->day)
            ->count()}}
              </span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('birthday.index')}}">
                        <i class="fa fa-birthday-cake"></i>
                        <span>Birthday Notification</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- /extras -->

        <!-- extras -->
        <li>
            <a href="javascript:;">
                <i class="fa fa-signal"></i>
                <span>SMS</span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('localSms.index')}}">
                        <i class="fa fa-send"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('birthday.index')}}">
                        <i class="fa fa-send-o"></i>
                        <span>Verification</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- /extras -->

        <!-- menu levels -->
        <li>
            <a href="javascript:;">
                <i class="fa fa-level-down"></i>
                <span>Attendance</span>
            </a>
            <ul class="sub-menu">

                <li>
                    <a href="{{route('attendance.create')}}">
                        <i class="fa fa-reply"></i>
                        <span>Add Attendance</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('dailyAttendance')}}">
                        <i class="fa fa-reply"></i>
                        <span>Daily Report</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('attendance.index')}}">
                        <i class="fa fa-reply"></i>
                        <span>Report Range</span>
                    </a>
                </li>
            </ul>

        <li>
            <a href="{{route('tithe.create')}}">
                <i class="fa fa-wrench"></i>
                <span>Audit Trail</span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('errorLog.index')}}">
                        <i class="fa fa-trash"></i>
                        <span>Errors</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('audit-trail.index')}}">
                        <i class="fa fa-trash"></i>
                        <span>Trails</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="fa fa-toggle-on"></i>
                <span>Children Ministry</span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('ministry.index')}}">
                        <i class="fa fa-users"></i>
                        <span>Active children</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('deceased-children')}}">
                        <i class="fa fa-map-marker"></i>
                        <span>Deceased Children</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('ministry.create')}}">
                        <i class="fa fa-plus"></i>
                        <span>Add New Child</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;">
                <i class="fa fa-toggle-on"></i>
                <span>Transfer</span>
                <span class="label label-primary pull-right">new
              </span>
            </a>
            <ul class="sub-menu">
                <li>
                    <a href="{{route('transferLocal')}}">
                        <i class="fa fa-users"></i>
                        <span>New Transfer</span>
                    </a>
                </li>
                <li>
                    <a href="{{route('releases')}}">
                        <i class="fa fa-map-marker"></i>
                        <span>Release</span>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="{{route('text.index')}}">
                <i class="fa fa-line-chart"></i>
                <span class="">Chat Room</span>
            </a>
        </li>
{{--    @endif--}}
</ul>