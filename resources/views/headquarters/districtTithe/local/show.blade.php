@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            <a  class="btn-link" style="color: darkblue; font-family: initial; font-size: 15px;" href="" data-toggle="modal" data-target="#info">Summary of data</a>
        </p>
    </li>
    <li>
        <p class="navbar-text"  style="color: darkblue; font-family: initial; font-size: 15px;" >
            &nbsp; &numero; &nbsp;{{ $countUsers}}
        </p>
    </li>
    <li>
        <a  href="{{route('NmayJune',$id)}}">Tithe</a>
    </li>
    <li>
        <a href="{{route('nationalAttendance',$locals->id)}}">Attendance</a>
    </li>
    <li>
        <a href="{{route('nationalAudit',$locals->id)}}">Audit Trail</a>
    </li>
@endsection
@section('content')
    <div class="modal" id="info">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Summary of {{ucwords($locals->name)}} local
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ACTIVE CHURCH MEMBERS TOTAL</th>
                            <th>{{$countUsers}}</th>
                        </tr>
                        <tr>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Elder</th>
                            <th>Deacons</th>
                            <th>Deaconess</th>
                            <th>Children</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$male}}</td>
                            <td>{{$female}}</td>
                            <td>{{$elder}}</td>
                            <td>{{$deacon}}</td>
                            <td>{{$deaconess}}</td>

                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
<div class="panel mb25">
    @include('includes.alert')
    {{--@include('sweet::alert')--}}
    @include('includes.form_error')
    <div class="panel-heading border">
        <ol class="breadcrumb mb0 no-padding">
            <li>
                <a href="javascript:;">
                    @if(Session::has('district_id'))
                        <a class="btn-link" href="{{route('district.show',(Session::get('district_id')))}}">{{$locals->name}}</a>
                    @endif
                </a>
            </li>
            <li>
                <a href="javascript:;">Local</a>
            </li>
            <li class="active">Data tables</li>
        </ol>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            @if($users)
                <table class="table table-bordered">
                    {!! Form::open(['method'=>'POST','action'=>'National\NationalLocalSearchController@store'])!!}
                    <div class="form-group col-md-10 bold">
                        {!! Form::text('search',null,['class'=>'form-control input-sm']) !!}
                        {!! Form::hidden('id',$id,['class'=>'form-control input-sm']) !!}
                    </div>
                    <div class="form-group col-md-2">
                        {!! Form::submit('Search',['class'=>'btn btn-info']) !!}
                    </div>
                    {!! Form::close() !!}
                    <thead>
                    <tr>
                        <th>Members ID</th>
                        <th>Photo</th>
                        <th>User</th>
                        <th>Gender</th>
                        <th>Date Join</th>
                        <th>Office Held</th>
                        <th>Age</th>
                        <th>Tithe</th>
                        <th>Details</th>
                        <th>Created at</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->members_id ? $user->members_id :''}}</td>
                            <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                            <td><a class="btn-link" href="{{route('admin.edit',$user->id)}}">{{$user->name? $user->name:''}}</a></td>
                            <td>{{strtoupper($user->gender ? $user->gender:'')}}</td>

                            <td>{{strtoupper(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch))->diff(Carbon\Carbon::now())
                        ->format('%y years,%m months,%d days'))}}</td>

                            <td>{{strtoupper($user->officeHeld ? $user->officeHeld:'')}}</td>

                            <td>
                                {{Carbon\Carbon::parse(date("Y-m-d", strtotime($user->birthDate)))->age}}
                            </td>

                            <td><a class="btn btn-success btn-sm" href="{{route('Nmember',$user->id)}}"><i class="fa fa-edit"></i></a></td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('admin.show',$user->id)}}"><i class="fa fa-edit"></i></a></td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$users->links()}}
            @endif
        </div>
    </div>
</div>
</div>
@endsection

