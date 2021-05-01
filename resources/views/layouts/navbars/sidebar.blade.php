<div class="sidebar" data-color="danger" data-background-color="black" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="javascript:void(0)" class="simple-text logo-normal">
        <img style="width:50px" src="{{ asset('logo/logo 2.png') }}">
      {{ __('TACMS') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i class="material-icons">face</i>
          <p>{{ __('Users') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>

{{--        start--}}

        <li class="nav-item {{ ($activePage == 'registration' || $activePage == 'nonactive' || $activePage == 'nonactive2' || $activePage == 'nonactive3' || $activePage == 'nonactive4' || $activePage == 'nonactive5'  ) ? ' active' : '' }}">
            <a class="nav-link show" data-toggle="collapse" href="#churchM" aria-expanded="true">
                <i class="material-icons">person</i>
                <p>Church Members
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchM">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'registration' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('registration.index')}}">
                            <i class="material-icons">face</i>
                            <span class="sidebar-normal">{{ __('Active Users') }} </span>
                        </a>
                    </li>

                    @if(Auth::user()->role_id !==8)
                        <li class="nav-item{{ $activePage == 'registration' ? ' active' : '' }}">
                            <a class="nav-link" href="{{route('registration.edit',Auth::user()->id)}}">
                                <i class="material-icons">AU</i>
                                <span class="sidebar-normal">Anonymous User</span>
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

                    <li class="nav-item{{ $activePage == 'nonactive' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('nonactive.index')}}">
                            <i class="material-icons">face</i>
                            <span class="sidebar-normal">{{ __('None Active Users') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'nonactives2' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('nonactive.show','newconvert')}}">
                            <i class="material-icons">face</i>
                            <span class="sidebar-normal">{{ __('New Convert') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'nonactive3' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('nonactive.show','newconvert')}}">
                            <i class="material-icons">face</i>
                            <span class="sidebar-normal">{{ __('New Entrant') }} </span>
                        </a>
                    </li>

                    <li class="nav-item{{ $activePage == 'nonactive4' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('nonactive.create')}}">
                            <i class="material-icons">face</i>
                            <span class="sidebar-normal">{{ __('Deceased') }} </span>
                        </a>
                    </li>

                    <li class="nav-item{{ $activePage == 'nonactive5' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('registration.create')}}">
                            <i class="material-icons">face</i>
                            <span class="sidebar-normal">{{ __('+ Add User') }} </span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>



        {{--        Church Account--}}
        <li class="nav-item {{ ($activePage == 'income' || $activePage == 'tithe' || $activePage == 'donation'|| $activePage == 'charts') ? ' active' : '' }}"">
            <a class="nav-link collapsed" data-toggle="collapse" href="#churchA" aria-expanded="false">
                <i class="material-icons">content_paste</i>
                <p>Church Account
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchA">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'income' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('income.create')}}">
                            <i class="material-icons">AT</i>
                            <span class="sidebar-normal">{{ __('Add Income') }} </span>
                        </a>
                    </li>

                    <li class="nav-item{{ $activePage == 'income' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('income.index')}}">
                            <i class="material-icons">AE</i>
                            <span class="sidebar-normal">{{ __('Add Expenditure') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'tithe' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('tithe.create')}}">
                            <i class="material-icons">AT</i>
                            <span class="sidebar-normal">{{ __('Add Tithe') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'donation' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('donation/Pledge')}}">
                            <i class="material-icons">AD</i>
                            <span class="sidebar-normal">{{ __('Add Donation') }} </span>
                        </a>
                    </li>

                    <li class="nav-item{{ $activePage == 'charts' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('titheCharts.index')}}">
                            <i class="material-icons">TC</i>
                            <span class="sidebar-normal">{{ __('Tithe Chart') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'charts' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('titheCharts.create')}}">
                            <i class="material-icons">TCR </i>
                            <span class="sidebar-normal">{{ __('Tithe Chart Range') }} </span>
                        </a>
                    </li>

                    <li class="nav-item{{ $activePage == 'tithe' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('tithe.index')}}">
                            <i class="material-icons">face</i>
                            <span class="sidebar-normal">{{ __('Posted Tithe') }} </span>
                        </a>
                    </li>

                    <li class="nav-item{{ $activePage == 'donation' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('onlyDonation')}}">
                            <i class="material-icons">PD</i>
                            <span class="sidebar-normal">{{ __('Posted Donation') }} </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#churchAA" aria-expanded="false">
                            <i class="material-icons">spanner</i>
                            <p>Income
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="churchAA">
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'income' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('category.index')}}">
                                        <i class="material-icons">IC</i>
                                        <span class="sidebar-normal">{{ __('Income Categories') }} </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#churchAE" aria-expanded="false">
                            <i class="material-icons">spanner</i>
                            <p>Expenditure
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="churchAE">
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'income' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('expenditureC.index')}}">
                                        <i class="material-icons">EC</i>
                                        <span class="sidebar-normal">{{ __('Expenditure Categories') }} </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    {{--                    Financial Report--}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#churchAF" aria-expanded="false">
                            <i class="material-icons">spanner</i>
                            <p>Financial Report
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="churchAF">
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('sunday.index')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Daily Report') }} </span>
                                    </a>
                                </li>
                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('services.index')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Monthly Report') }} </span>
                                    </a>
                                </li>
                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('midyear.index')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Mid Year Report') }} </span>
                                    </a>
                                </li>
                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('year.index')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Yearly Report') }} </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{--          tithe chart          --}}
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#churchAT" aria-expanded="true">
                            <i class="material-icons">spanner</i>
                            <p>Tithe Report
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse show" id="churchAT">
                            <ul class="nav">
                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('titheYearStatement')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Jan -Feb') }} </span>
                                    </a>
                                </li>

                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('titheMonthStatement')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Mar-Apr') }} </span>
                                    </a>
                                </li>

                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('mayJune')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('May-June') }} </span>
                                    </a>
                                </li>

                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('julyAugust')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Jul-Aug') }} </span>
                                    </a>
                                </li>

                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('septOctober')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Sep-Oct') }} </span>
                                    </a>
                                </li>

                                <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('novDecember')}}">
                                        <i class="material-icons">money</i>
                                        <span class="sidebar-normal">{{ __('Nov-Dec') }} </span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>

                </ul>
            </div>
        </li>

        {{--        church announcement--}}
        <li class="nav-item{{ ($activePage == 'announcement_national' || $activePage == 'announcement_area' || $activePage == 'announcement_district' || $activePage == 'announcement_local'|| $activePage == 'announcement_local' )? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#churchAnnouncement" aria-expanded="true">
                <i class="material-icons">notifications</i>
                <p>Announcement
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchAnnouncement">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'announcement_national' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('nationalcircular.index')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('National') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'announcement_area' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('localAreaPost')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Area') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'announcement_district' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('localdistrict.index')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('District') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'announcement_local' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('localAreaPost')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Local') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'announcement_post' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('localPost')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Post Local Ann') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        {{--    church    messages--}}
        <li class="nav-item{{ ($activePage == 'birthday'|| $activePage == 'messages' )? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#churchBirthD" aria-expanded="true">
                <i class="material-icons">messages</i>
                <p>Messages
                    <span class="label bg-rose pull-right pr-5"><label class=" bmd-label"></label></span>
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchBirthD">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'birthday' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('birthday.index')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Birthdays Celebrants') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#churchsms" aria-expanded="true">
                <i class="material-icons">sms</i>
                <p>SMS
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchsms">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('localSms.index')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Notifications') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('birthday.index')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Verification') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        {{--        church attendance report--}}
        <li class="nav-item{{ ($activePage == 'attendance' || $activePage == 'attendance_range' || $activePage == 'attendance_create') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#churchAttendance" aria-expanded="true">
                <i class="material-icons">report</i>
                <p>Attendance Report
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchAttendance">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'attendance' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('dailyAttendance')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Daily') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'attendance_range' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('attendance.index')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Range') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'attendance_create' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('attendance.create')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Post Attendance') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        {{--        church attendance report--}}
        <li class="nav-item{{ ($activePage == 'error' || $activePage == 'system_trail') ? ' active' : '' }}">
            <a class="nav-link collapse show" data-toggle="collapse" href="#churchTrails" aria-expanded="true">
                <i class="material-icons">history</i>
                <p>Audit Trails
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchTrails">
                <ul class="nav">
                    <li class="nav-item{{ ($activePage == 'error') ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('errorLog.index')}}">
                            <i class="material-icons">errors</i>
                            <span class="sidebar-normal">{{ __('Errors') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'system_trail' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('audit-trail.index')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('System Trails') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>


        <li class="nav-item{{ ($activePage == 'children' || $activePage == 'deceased'||$activePage == 'addChildren') ? ' active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#churchChildren" aria-expanded="true">
                <i class="material-icons">person</i>
                <p>Children Ministry
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchChildren">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'children' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('ministry.index')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Active') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'deceased' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('deceased-children')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Deceased') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'addChildren' ? ' active' : '' }}">
                        <a class="nav-link" href="{{route('ministry.create')}}">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Add Children') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#churchTransfer" aria-expanded="true">
                <i class="material-icons">library_books</i>
                <p>Transfer
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse" id="churchTransfer">
                <ul class="nav">
                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                        <a class="nav-link" href="">
                            <i class="material-icons">NT</i>
                            <span class="sidebar-normal">{{ __('Newly Transfer') }} </span>
                        </a>
                    </li>
                    <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
                        <a class="nav-link" href="">
                            <i class="material-icons">money</i>
                            <span class="sidebar-normal">{{ __('Transfer Document') }} </span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
  </div>
</div>
