@include('includes.slideHeader')
<div class="app layout-fixed-header">

  <!-- sidebar panel -->
  <div class="sidebar-panel offscreen-left">

    <div class="brand">
      <span style="color: white; font-size:x-large; font-weight: bolder">TACMS</span>
      {{--<img src="{{asset('photos/logo4.png')}}" height="30" alt="">--}}
        {{--<h1 class="bg-white">TACMS</h1>--}}
      <!-- logo -->
      <div class="brand-logo">

      </div>
      <!-- /logo -->

      <!-- toggle small sidebar menu -->
      <a href="javascript:;" class="toggle-sidebar hidden-xs hamburger-icon v3" data-toggle="layout-small-menu">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a>
      <!-- /toggle small sidebar menu -->

    </div>

    <!-- main navigation -->
    <nav role="navigation">

      <img class="img img-responsive" src="{{asset('photos/logo 2.png')}}" alt="banner" width="30%" height="30%" style="margin-left: 50px;">

    @if(Auth::user()->isAdminHeadQuarters())

      @include('includes.national')

      @elseif(Auth::user()->isAreaAdmin())

       @include('includes.area')

       @elseif(Auth::user()->isAdminDistrict())

       @include('includes.district')

       @elseif(Auth::user()->isAdminLocal())

        @include('includes.local')


       @elseif(Auth::user()->isMember())

       @include('includes.individual')
      @endif
      <ul class="nav">
      <li>
        <a href="{{route('manual.index')}}">
          <i class="fa fa-book"></i>
          <span>System Manual</span>
        </a>
      </li>
      </ul>
    </nav>
    <!-- /main navigation -->
  </div>
