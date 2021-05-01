@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Local
        </p>
    </li>

    <li>
        <p class="navbar-text">
            <a  class="btn-link"  href="" data-toggle="modal" data-target="#info">Summary of data</a>
        </p>
    </li>
    <li>
        <p class="navbar-text"  >
            &nbsp; &numero; &nbsp;{{ $countUsers}}
        </p>
    </li>

@endsection

@section('content')
    @include('includes.alert')
    @include('includes.form_error')
    <div class="modal" id="info">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Summary of {{ucwords($locals->name)}} Local Assembly
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th COLSPAN="3">
                                    TOTAL CHURCH MEMBERS
                                </th>

                                <th>
                                    {{$countUsers}}
                                </th>
                            </tr>
                            <tr>
                                <th>MALE</th>
                                <th>FEMALE</th>

                                <th>DEACONS</th>

                                <th>DEACONESS</th>

                                <th>ELDERSS</th>

                                <th>CHILDREN</th>

                                <th>PRESIDING</th>

                                <th>PASTOR</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            <tr>
                                <td>{{$male}}</td>
                                <td>{{$female}}</td>
                                <td>{{$deacon}}</td>
                                <td>{{$deaconess}}</td>
                                <td>{{$elder}}</td>
                                <td>{{$children}}</td>
                                <td>
                                    {{$presiding}}
                                </td>
                                <td>
                                    {{$pastors}}
                                </td>
                            </tr>

                            </tr>

                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">
                            @if(Session::has('district_id'))
                                <a class="btn-link" href="{{route('level.show',(Session::get('district_id')))}}">{{$locals->name}}</a>
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
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Members ID</th>
                                <th>Photo</th>
                                <th>User</th>
                                <th>ROLE</th>
                                <th>DISTRICT</th>
                                <th>LOCAL</th>
                                <th>STATUS</th>
                                <th>AGE</th>
                                <th>OFFICE HELD </th>
                                <th>YEARS IN THE CHURCH.</th>
                                <th>Details</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->members_id}}</td>
                                    <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                    <td><a class="btn-link" href="{{route('waiting.edit',$user->id)}}">{{$user->name}}</a></td>
                                    <td>{{($user->role? $user->role->name: 'User has no role')}}</td>
                                    <td>{{($user->district? $user->district->name : 'no district name yet')}}</td>
                                    <td>{{($user->local? $user->local->name:'no local name yet')}}</td>
                                    <td>{{($user->is_active==1? 'Active':'Not Active')}}</td>
                                    <td>{{Carbon\Carbon::parse($user->birthDate)->age}}</td>
                                    <td>{{($user->officeHeld)}}</td>
                                    <td>{{(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch))->diff(Carbon\Carbon::now())
                                 ->format('%y years,%m months,%d days'))}}</td>

                                    <td><a class="btn btn-primary btn-xs" href="{{route('waiting.show',$user->id)}}"><i class="fa fa-edit"></i></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                {{$users->links()}}
            </div>
        </div>
    </div>
@endsection




