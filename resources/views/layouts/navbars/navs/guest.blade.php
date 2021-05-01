<!-- Navbar -->
{{--<div class="dropdown">--}}
{{--    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">--}}
{{--        Dropdown <span class="caret"></span>--}}
{{--    </button>--}}
{{--    <ul class="dropdown-menu">--}}
{{--        <li><a href="#">Action</a></li>--}}
{{--        <li><a href="#">Another action</a></li>--}}
{{--        <li class="dropdown">--}}
{{--            <a href="#">One more dropdown</a>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                <li><a href="#">Action</a></li>--}}
{{--                <li><a href="#">Another action</a></li>--}}
{{--                <li class="dropdown">--}}
{{--                    <a href="#">One more dropdown</a>--}}
{{--                    <ul class="dropdown-menu">--}}
{{--                        ...--}}
{{--                    </ul>--}}
{{--                </li>--}}
{{--                <li><a href="#">Something else here</a></li>--}}
{{--                <li><a href="#">Separated link</a></li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li><a href="#">Something else here</a></li>--}}
{{--        <li><a href="#">Separated link</a></li>--}}
{{--    </ul>--}}
{{--</div>--}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-transparent fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
        <img style="width:50px" src="{{ asset('logo') }}/logo 2.png">
      <a class="navbar-brand" href="{{ route('home') }}">{{ $title }}</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end navnav ">
      <ul class="navbar-nav">
          <li class="nav-item">
              <div class="dropdown">
                  <a class="nav-link dropdown-toggle sub-menu" href="#" role="" id="dropdownMenuLink" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                      Aposa
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="#">Campus Information</a>
                      <a class="dropdown-item" href="#">Aposa National</a>
                      <a class="dropdown-item" href="#">Documents</a>
                      <a href="#" class="dropdown-item">Requests and Payments</a>
                      <a href="#" class="dropdown-item">News items on campus activities</a>
                      <a href="#" class="dropdown-item">Video of training and other ministrations</a>
                  </div>
              </div>
          </li>

          <li class="nav-item">
              <div class="dropdown show">
                  <a class="nav-link dropdown-toggle" href="" id="dropdownMenuLink27" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Apostle</a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink27">
                      <a href="#" class="dropdown-item">Home Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Contact Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Home Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Contact Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Home Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Contact Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Home Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Contact Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Home Something else here Something else here</a>
                      <a href="#" class="dropdown-item">Contact Something else here Something else here</a>

                  </div>
              </div>
          </li>

        <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
             {{ __('About Us') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('History') }}
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'login' ? ' active' : '' }}">
          <a  href="{{ route('login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
        <li class="nav-item ">
          <a href="{{ route('profile.edit') }}" class="nav-link">
            <i class="material-icons">face</i> {{ __('Profile') }}
          </a>
        </li>
      </ul>

    </div>
  </div>
    <div style="background:lightskyblue;width:100%; height:15px; position: absolute; margin-top:80px;"></div>
</nav>




<!-- End Navbar -->


