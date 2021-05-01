@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">{{ucwords($localName->name)}} Local</p>
    </li>
    <li>
        <p class="navbar-text" style="font-size: 12px;">
            Male &numero; &nbsp;{{$male}}
        </p>
    </li>
    <li>
        <p class="navbar-text" style="font-size: 12px;">
            Female &numero; &nbsp;{{$female}}
        </p>
    </li>
    <li>
        <p class="navbar-text" style="font-size: 12px;">
            Deacons &numero; &nbsp;{{$deacon}}
        </p>
    </li>
    <li>
        <p class="navbar-text" style="font-size: 12px;">
            Deaconess&numero; &nbsp;{{$deaconess}}
        </p>
    </li>
    <li>
        <p class="navbar-text" style="font-size: 12px;">
            Children&numero; &nbsp;{{count($children)}}
        </p>
    </li>

    <li>
        <p class="navbar-text" style="font-size: 12px;">
            Total&numero; &nbsp;{{$countUsers}}
        </p>
    </li>
@endsection
@section('content')
    <div class="table-responsive">
    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="{{route('local.index')}}">Home</a>
                </li>
                <li>
                    <a href="javascript:;">None Active Users</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered mb0">
                    <thead>
                    <tr>
                        <th>Members Id</th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Role</th>
                        <th>Age</th>
                        <th>Start Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users)
                        @foreach($users as $user)
                            @if((Carbon\Carbon::now()->format('Y-m-d'))-$user->birthDate>15)
                            <tr>
                                <td>{{$user->members_id}}</td>
                                <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                <td><a href="{{route('ministry.edit',$user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->role? $user->role->name: 'User has no role'}}</td>
                                <td>{{$user->is_active==1? 'Active':'Not Active'}}</td>
                                <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>
                                <td>{{$user->created_at->diffForHumans() }}</td>
                            </tr>
                                @else
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection


