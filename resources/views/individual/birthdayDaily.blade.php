@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">Birthdays Members</p>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="table-responsive">
            <div class="panel shadow mb25">
                <div class="panel-heading border">
                    <ol class="breadcrumb mb0 no-padding">
                        <li>
                            <a href="javascript:;">Date Of Birth</a>
                        </li>
                        <li>
                            <a href="javascript:;">Notifications</a>
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
                                <th>Date Of Birth</th>
                                <th>Age</th>
                                <th><i class="fa fa-phone"></i>Number</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users)
                                @foreach($users as $user)
                                    <tr>
                                        <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                        <td><a href="{{route('registration.edit',$user->id)}}">{{$user->name}}</a></td>
                                        <td>{{$user->birthDate}}</td>
                                        <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>
                                        <td>{{$user->mobileNumber1."-".$user->mobileNumber2}}</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


