@extends('layouts.master_table')

@section('dashboard')
     <li>
        <p class="navbar-text">ANONYMOUS ADMINS</p>
     </li>
@endsection
@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    {{--@include('sweet::alert')--}}
 <div class="table-responsive">
    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Anonymous Admin</a>
                </li>
                <li>
                    <a href="javascript:;">Users</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                {!! Form::open(['method'=>'POST', 'action'=>['National\localSearchNationalController@admins']]) !!}
                <div class="col-md-11">
                    <div class="form-group">
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        {!! Form::submit('search',['class'=>'btn btn-primary btn-sm','Placeholder'=>'search']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <table class="table table-bordered mb0">
                    <thead>
                    <tr>
                        <th>Images</th>
                        <th>Anonymous Name</th>
                        <th>Position</th>
                        <th>District</th>
                        <th>Local</th>
                        <th>Role</th>
                        <th>Age</th>
                        <th>Start Date</th>
                        <th>Online/Offline</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users)
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/face3.jpg') }}" alt="">
                                </td>
                                <td><a class="btn-link" href="{{route('Anonymous.edit',$user->id)}}">{{$user->name}}</a></td>
                                <td>{{ucwords($user->role? $user->role->name: 'User has no role')}}</td>
                                <td>{{ucwords($user->district->name? $user->district->name : 'no district name yet')}}</td>
                                <td>{{ucwords($user->local->name? $user->local->name:'no local name yet')}}</td>
                                <td>{{ucwords($user->is_active==1? 'Active':'Not Active')}}</td>
                                <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>
                                <td>{{$user->created_at->diffForHumans() }}</td>
                                @if($user->isOnline())
                                    <td style="color: red">online</td>
                                    @else
                                    <td style="color: blue">Offline</td>
                                @endif
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



