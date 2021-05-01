@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row" style="margin-top:50px;">
            <div class="col-md-5 col-md-offset-3">
                <div class="panel" style="box-shadow: 0 0 70px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);">
                    <div  class="panel-heading  text-capitalize text-center" style="color:darkblue;font-family:Algerian; font-size: 1.5em ">TACMS PORTAL</div>

                    <div class="panel-body" style="background: white">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-1 text-center">
                                    <img src="{{url('/photos/logo 2.png')}}" alt="banner" width="50px" height="50px">
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                {{--<label for="email" class="col-md-4 control-label">Email</label>--}}

                                <div class="col-md-9 col-md-offset-1 text-center">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="Email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                {{--<label for="password" class="col-md-4 control-label"></label>--}}

                                <div class="col-md-9 col-md-offset-1 text-center">
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group">--}}
                                {{--<div class="col-md-6 col-md-offset-4">--}}
                                    {{--<div class="checkbox">--}}
                                        {{--<label>--}}
                                            {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group">
                                <div class="col-md-9 col-md-offset-1">
                                    <button type="submit" class="btn  btn-primary">
                                        Login
                                    </button>

                                    <a class="btn btn-link  text-center" href="{{ route('password.request') }}">
                                        Forgot Your Password?
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection