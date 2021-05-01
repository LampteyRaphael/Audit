<ul class="nav">
    <!-- ui -->
    <li>
        <a href="javascript:;">
            <i class="fa fa-flask"></i>
            <span>Dashboard</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('areaDashboard.index')}}">
                    <span>Home</span>
                </a>
            </li>
            <li>
                <span>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form2').submit();">Logout</a>
                  <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </span>
                {{--</a>--}}
            </li>
        </ul>
    </li>
    <!-- /ui -->

    <!-- ui -->
    <li>
        <a href="javascript:;">
            <i class="fa fa-tint"></i>
            <span>Church Member</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('areamembers.index')}}">
                    <i class="fa fa-search-minus"></i>
                    <span>General Search</span>
                </a>
            </li>
            <li>
                <a href="{{route('Admins.index')}}">
                    <i class="fa fa-user"></i>
                    <span>Area Admins</span>
                </a>
            </li>
            <li>
                <a href="{{route('Admins.create')}}">
                    <i class="fa fa-user"></i>
                    <span>District Admins</span>
                </a>
            </li>
            <li>
                <a href="{{route('Admins.show','locals')}}">
                    <i class="fa fa-user"></i>
                    <span>Locals Admins</span>
                </a>
            </li>

            @if(Auth::user()->role_id==6)

                <li>
                    <a href="{{route('Admins.edit',Auth::user()->id)}}">
                        <i class="fa fa-user"></i>
                        <span>Anonymous User</span>
                    </a>
                </li>
            @elseif(Auth::user()->role_id==10)

                <li>
                    <a href="{{route('Admins.edit',Auth::user()->id)}}">
                        <i class="fa fa-user"></i>
                        <span>Special Area Admin</span>
                    </a>
                </li>
            @else

            @endif
            <li>
                <a href="{{route('updates.index')}}">
                    <i class="fa fa-user"></i>
                    <span>Non Active Members</span>
                </a>
            </li>
            <li>
                <a href="{{route('updates.create')}}">
                    <i class="fa fa-user"></i>
                    <span>Deceased</span>
                </a>
            </li>
            <li>
                <a href="{{route('areaNoneActives')}}">
                    <i class="fa fa-user"></i>
                    <span>New Convert</span>
                </a>
            </li>
            <li>
                <a href="{{route('level.create')}}">
                    <i class="fa fa-plus"></i>
                    <span>Add Member</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="javascript:;">
            <i class="fa fa-level-down"></i>
            <span>Children Ministry</span>
        </a>
        <ul class="sub-menu">

            <li>
                <a href="{{route('areaChildren.index')}}">
                    <i class="fa fa-users"></i>
                    <span>Active Children</span>
                </a>
            </li>

            <li>
                <a href="{{route('NoneActiveChildren.index')}}">
                    <i class="fa fa-users"></i>
                    <span>Deceased Children</span>
                </a>
            </li>
        </ul>
    <li>

    <li>
        <a href="javascript:;">
            <i class="fa fa-toggle-on"></i>
            <span>Area</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('level.index')}}">
                    <span>{{Auth::user()->area->name}}</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="javascript:;">
            <i class="fa fa-pie-chart"></i>
            <span>Church Account</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('AccountInArea.create')}}">
                    <i class="fa fa-plus"></i>
                    <span> Add Income</span>
                </a>
            </li>
            <li>
                <a href="{{route('AccountECArea.create')}}">
                    <i class="fa fa-plus"></i>
                    <span>Add Expenditure</span>
                </a>
            </li>

            <li>
                <a href="javascript:;">
                    <i class="fa fa-tag"></i>
                    <span>Income</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('AccountInCArea.index')}}">
                  <span>
                    All Categories
                  </span>
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
                        <a href="{{route('AccountECArea.index')}}">
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
                        <a href="{{route('areaDailyReport')}}">
                            <span>Daily Report</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('mreport')}}">
                            <span>Monthly Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('miReport')}}">
                            <span>Mid Year Report</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('areaYearlyReport')}}">
                            <span>Year Report</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:;">
                    <i class="fa fa-pie-chart"></i>
                    <span>Tithe Report</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('PostedAreaChart')}}">
                            <span>Daily Tithe</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('PostedMonthlyAreaChart')}}">
                            <span>Monthly Tithe</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('PostedRangeAChart')}}">
                            <span>Range of Tithe</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('PostedYearAreaChart')}}">
                            <span>Yearly Tithe</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    <!-- /ui -->
    <!-- forms -->
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
                <a href="{{route('waiting.index')}}">
                    <i class="fa fa-info-circle"></i>
                    <span>National</span>
                    <span class="label label-primary pull-right">new
                &nbsp
                {{ App\AreaCircular::whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                </a>
            </li>
            <li>
                <a href="{{route('waiting.create')}}">
                    <i class="fa fa-info-circle"></i>
                    <span>Area</span>
                    <span class="label label-info pull-right">new
                &nbsp
               {{ App\AreaLevelCircular::where('area_id',Auth::user()->area_id)->whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                </a>
            </li>
            <li>
                <a href="{{route('APCircularGetD')}}">
                    <i class="fa fa-info-circle"></i>
                    <span>District</span>
                    <span class="label label-default pull-right">new
                &nbsp
                {{ App\DistrictCircular::where('district_id',Auth::user()->district_id)->whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                </a>
            </li>
            <li>
                <a href="{{route('APCircularGetL')}}">
                    <i class="fa fa-info-circle"></i>
                    <span>Local</span>

                </a>
            </li>

            <li>
                <a href="{{route('AreaPostCircular')}}">
                    <i class="fa fa-send-o"></i>
                    <span>Post Area Circular</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="{{route('ara-tray')}}">
            <i class="fa fa-history"></i>
            <span>Audit Trail</span>
        </a>
    </li>

    <li>
        <a href="javascript:;">
            <i class="fa fa-level-down"></i>
            <span>Attendance</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('areaAttendance')}}">
                    <i class="fa fa-reply"></i>
                    <span>Report</span>
                </a>
            </li>
        </ul>
    <li>

    <li>
        <a href="{{url('areaTransfer')}}">
            <i class="fa fa-history"></i>
            <span>Area Transfers</span>
        </a>
    </li>

</ul>