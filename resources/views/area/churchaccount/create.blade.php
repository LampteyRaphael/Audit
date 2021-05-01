@extends('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text"> {{$areaName}}</p>
    </li>
@endsection
@section('content')
    @include('includes.alert')

    <div class="table-responsive">
        <div class="panel shadow mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Deceased</a>
                    </li>
                    <li>
                        <a href="javascript:;">Members</a>
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
                            <th>Position</th>
                            <th>District</th>
                            <th>Local</th>
                            <th>Role</th>
                            <th>Age</th>
                            <th>Start Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                    <td><a class="btn-link" href="{{route('waiting.edit',$user->id)}}">{{$user->name}}</a></td>
                                    <td>{{ucwords($user->role? $user->role->name: 'User has no role')}}</td>
                                    <td>{{ucwords($user->district->name? $user->district->name : 'no district name yet')}}</td>
                                    <td>{{ucwords($user->local->name? $user->local->name:'no local name yet')}}</td>
                                    <td>{{ucwords($user->is_active==1? 'Active':'Not Active')}}</td>
                                    <td>{{Carbon\Carbon::parse($user->birthDate)->age}}</td>
                                    <td>{{$user->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection


