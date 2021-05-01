{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">Deceased Children</p>--}}
{{--    </li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text">{{ucwords($localName->name)}} Local</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Male &numero; &nbsp;{{$male}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Female &numero; &nbsp;{{$female}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Deacons &numero; &nbsp;{{$deacon}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Deaconess&numero; &nbsp;{{$deaconess}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Children&numero; &nbsp;{{count($children)}}--}}
        {{--</p>--}}
    {{--</li>--}}

    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Total&numero; &nbsp;{{$countUsers}}--}}
        {{--</p>--}}
    {{--</li>--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <div class="panel mb25">--}}
{{--        <div class="panel-heading border">--}}
{{--            <ol class="breadcrumb mb0 no-padding">--}}
{{--                <li>--}}
{{--                    <a href="{{route('ministry.index')}}">Home</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="javascript:;">Deceased Children</a>--}}
{{--                </li>--}}
{{--                <li class="active">Data tables</li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--        <div class="panel-body">--}}
    @extends('layouts.app', ['activePage' => 'deceased', 'titlePage' => __('Deceased')])
@section('content')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Children Ministry</h4>
                            <p class="card-category">Children You Lost In Your Assembly</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
            <div class="table-responsive">
                <table class="table table-success mb0 table-striped">
                    <thead>
                    <tr>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Years In the Church</th>
                        <th>Status</th>
                        <th>Age</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users)
                        @foreach($users as $user)
                            {{--@if((Carbon\Carbon::now()->format('Y-m-d'))-$user->birthDate<=15)--}}
                            <tr>
                                <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                <td><a href="{{route('ministry.edit',$user->id)}}">{{$user->name}}</a></td>
                                <td>{{strtoupper($user->gender)}}</td>

                                <td>{{strtoupper(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch))->diff(Carbon\Carbon::now())
                                 ->format('%y years,%m months,%d days'))}}</td>

                                <td>{{strtoupper($user->officeHeld)}}</td>

                                <td>{{$user->birthDate}}</td>
                            </tr>
                                {{--@else--}}
                            {{--@endif--}}
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


