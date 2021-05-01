@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">New Transfer</p>
    </li>

@endsection
@section('content')
    @include('includes.alert')
    <script>

        function Confirm()
        {
            var x = confirm("Are you sure you want to accept this church member to your local assembly?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

    <div class="table-responsive">
        <div class="panel mb25">
            <div class="panel-heading no-border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="{{route('local.index')}}">Transfer</a>
                    </li>
                    <li>
                        <a href="javascript:;">Members</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Membership Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Region</th>
                            <th>Area</th>
                            <th>District</th>
                            <th>Local</th>
                            <th>Released Date</th>
                            <th>Block</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->user->members_id}}</td>
                                    <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                    <td><a class="btn-link" href="">{{strtoupper($user->user->name)}}</a></td>
                                    <td>{{$user->region->name}}</td>
                                    <td>{{$user->area->name}}</td>
                                    <td>{{$user->district->name}}</td>
                                    <td>{{$user->user->local->name}}</td>
                                    <th>{{$user->created_at->diffForHumans()}}</th>
                                    <td>
                                        <a href="{{route('text.edit',$user->user_id)}}" onsubmit="return confirm()" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection