<ul class="nav">

    <!-- ui -->
    <li>
        <a href="javascript:;">
            <i class="fa fa-flask"></i>
            <span>Dashboard</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('dashboard-d.index')}}">
                    <span>Home</span>
                </a>
            </li>

            <li>
                {{--<a href="{{route('users.create')}}">--}}
                <span>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form3').submit();">Logout</a>
                  <form id="logout-form3" action="{{ route('logout') }}" method="POST" style="display: none;">
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
            <span>District Members</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('addnew.index')}}">
                    <i class="fa fa-user"></i>
                    <span>Active Members</span>
                </a>
            </li>

            <li>
                <a href="{{route('addnew.show',urlencode('NoneActiveMembers'))}}">
                    <i class="fa fa-user-plus"></i>
                    <span>Non Active Members</span>
                </a>
            </li>

            <li>
                <a href="{{route('addnew.edit',urlencode('DeceasedMembers'))}}">
                    <i class="fa fa-user-secret"></i>
                    <span>Deceased Members</span>
                </a>
            </li>

            @if(Auth::user()->role_id==7)

                <li>
                    <a href="{{route('districtPost.edit',Auth::user()->id)}}">
                        <i class="fa fa-user-secret"></i>
                        <span>Anonymous User</span>
                    </a>
                </li>
            @elseif(Auth::user()->role_id==11)

                <li>
                    <a href="{{route('districtPost.edit',Auth::user()->id)}}">
                        <i class="fa fa-user-secret"></i>
                        <span>Special District Admin</span>
                    </a>
                </li>
            @else
            @endif
            <li>
                <a href="{{route('districtPost.create')}}">
                    <i class="fa fa-plus"></i>
                    <span>Add Members</span>
                </a>
            </li>
        </ul>
    </li>

    <li>
        <a href="javascript:;">
            <i class="fa fa-wrench"></i>
            <span>Children Ministry</span>
        </a>
        <ul class="sub-menu">

            <li>
                <a href="{{route('DistCMinistry.index')}}">
                    <i class="fa fa-user-plus"></i>
                    <span>Active Children</span>
                </a>
            </li>
            <li>
                <a href="{{route('DistCMinistry.show',urlencode('DistrictChildrenMinistry'))}}">
                    <i class="fa fa-user-plus"></i>
                    <span>Deceased</span>
                </a>
            </li>
            <li>
                <a href="{{route('DistCMinistry.create')}}">
                    <i class="fa fa-plus"></i>
                    <span>Add Children</span>
                </a>
            </li>

        </ul>
    <li>



    <li>
        <a href="javascript:;">
            <i class="fa fa-toggle-on"></i>
            <span>District</span>
        </a>
        <ul class="sub-menu">
            <li>
                <a href="{{route('districtPost.show',Auth::user()->district_id)}}">
                    <span>All Locals</span>
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
                <a href="{{route('AccountIn.create')}}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Add Income</span>
                </a>
            </li>
            <li>
                <a href="{{route('AccountEC.create')}}">
                    <i class="fa fa-pie-chart"></i>
                    <span>Add Expenditure</span>
                </a>
            </li>

            <li>
                <a href="">
                    <i class="fa fa-pie-chart"></i>
                    <span>Tithe Chart</span>

                </a>

                <ul class="sub-menu">
                    <li>
                        <a href="{{route('dailyReport.index')}}">
                            <span>Daily Chart</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('monthlyReport.index')}}">
                            <span>Monthly Chart</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('midYearReport.index')}}">
                            <span>Mid Year Chart</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('ReportRange')}}">
                            <span>Report Chart</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('yearlyReport.index')}}">
                            <span>Yearly Chart</span>
                        </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="">
                    <i class="fa fa-tag"></i>
                    <span>Income</span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="{{route('AccountInC.index')}}">
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
                        <a href="{{route('AccountEC.index')}}">
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
                        <a href="{{route('financeDailyReport')}}">
                            <span>Daily Report</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('financeMonthlyReport')}}">
                            <span>Monthly Report</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('financeMidYearReport')}}">
                            <span>Mid Year Report</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{url('range')}}">
                            <span>Report Range</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{route('financeYearlyReport')}}">
                            <span>Yearly Report</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="">
                    <i class="fa fa-wrench"></i>
                    <span>Tithe Report</span>
                </a>
                <?php $districtLocals= App\Locals::where('district_id',Auth::user()->district_id)->get(['id','name']); ?>
                @if($districtLocals)
                    <ul class="sub-menu">
                        @foreach($districtLocals as $local)
                            <li>
                                <a href="{{route('DistrictChart.index',$local->id)}}">
                                    {{--                         <i class="fa fa-chain"></i>--}}
                                    <span>{{str_replace('-','',str_replace(ucwords(strtolower(Auth::user()->district->name)),'',ucwords(strtolower($local->name))))}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>

        </ul>
    </li>



    <!-- /ui -->

    <!-- forms -->
{{--    <li>--}}
{{--        <a href="javascript:;">--}}
{{--            <i class="fa fa-tint"></i>--}}
{{--            <span>Announcement</span>--}}
{{--        </a>--}}
{{--        <ul class="sub-menu">--}}
{{--            <li>--}}
{{--                <a href="{{route('')}}">--}}
{{--                    <span>National</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="{{route('')}}">--}}
{{--                    <span>District</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li>--}}
{{--                <a href="{{route('')}}">--}}
{{--                    <span>Admins</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </li>--}}

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
                <a href="{{route('circular1.index')}}">
                    <i class="fa fa-info-circle"></i>
                    <span>National</span>
                    <span class="label label-primary pull-right">new
                &nbsp
                {{ App\AreaCircular::whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                </a>
            </li>
            <li>
                <a href="{{route('districtCirArea')}}">
                    <i class="fa fa-info-circle"></i>
                    <span>Area</span>
                    <span class="label label-info pull-right">new
                &nbsp
               {{ App\AreaLevelCircular::whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                </a>
            </li>
            <li>
                <a href="{{route('circular1.create')}}">
                    <i class="fa fa-info-circle"></i>
                    <span>District</span>
                    <span class="label label-default pull-right">new
                &nbsp
                {{ App\DistrictCircular::whereMonth('created_at',Carbon\Carbon::now()->month)->whereYear('created_at',\Carbon\Carbon::now()->year)->count()}}
              </span>
                </a>
            </li>
            <li>
                <a href="{{route('districtCirLocals')}}">
                    <i class="fa fa-info-circle"></i>
                    <span>Local</span>

                </a>
            </li>

{{--            <li>--}}
{{--                <a href="{{route('onlyAdmins.index')}}">--}}
{{--                    <i class="fa fa-share"></i>--}}
{{--                    <span>District Admins</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="">--}}
{{--                    <i class="fa fa-share"></i>--}}
{{--                    <span>Area Admins</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li>--}}
{{--                <a href="">--}}
{{--                    <i class="fa fa-send-o"></i>--}}
{{--                    <span>Post Area Circular</span>--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </li>


    <!-- /forms -->
    <li>
        <a href="javascript:;">
            <i class="fa fa-level-down"></i>
            <span>Attendance</span>
        </a>
        <ul class="sub-menu">

            <li>
                <a href="{{route('districtAttendance')}}">
                    <i class=""></i>
                    <span>Report</span>
                </a>
            </li>
        </ul>
    <li>

    <li>
        <a href="{{route('AccountIn.index')}}">
            <i class="fa fa-history"></i>
            <span>Audit Trail</span>
        </a>
    </li>

    <li>
        <a href="{{route('AccountIn.show',urlencode('district-transfer-historys'))}}">
            <i class="fa fa-history"></i>
            <span>District Transfers</span>
        </a>
    </li>
</ul>