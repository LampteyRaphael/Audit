@extends('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">Area Church Children</p>
    </li>
@endsection
@section('content')
    @include('includes.alert')
    <div class="table-responsive">
        <div class="panel shadow mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">{{$areaName}}Area</a>
                    </li>
                    <li>
                        <a href="javascript:;">Users</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mb0">
                        <thead>
                        <tr>
                            <th>Images</th>
                            <th>Name</th>
                            <th>ROLE</th>
                            <th>DISTRICT</th>
                            <th>LOCAL</th>
                            <th>STATUS</th>
                            <th>AGE</th>
                            <th>OFFICE HELD </th>
                            <th>YEARS IN THE CHURCH.</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                    <td><a class="btn-link" href="{{route('waiting.edit',$user->id)}}">{{strtoupper($user->name)}}</a></td>
                                    <td>{{$user->role? strtoupper($user->role->name):''}}</td>
                                    <td>{{$user->district? strtoupper($user->district->name) : ''}}</td>
                                    <td>{{$user->local? strtoupper($user->local->name):''}}</td>
                                    <td>{{ucwords($user->is_active==1? 'Active':'Not Active')}}</td>
                                    <td>{{Carbon\Carbon::parse($user->birthDate)->age}}</td>
                                    <td>{{strtoupper($user->officeHeld)}}</td>
                                    <td>{{strtoupper(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch))->diff(Carbon\Carbon::now())
                                 ->format('%y years,%m months,%d days'))}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>

            </div>
        </div>
    </div>
@endsection


