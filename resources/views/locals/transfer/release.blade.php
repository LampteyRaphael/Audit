@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">Transfers</p>
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
                        <a href="javascript:;">History</a>
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
                            <th>Area</th>
                            <th>District</th>
                            <th>Local</th>
                            <th>Released Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->user->members_id}}</td>
                                    <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                    <td><a class="btn-link" href="#">{{strtoupper($user->user? $user->user->name:'unknown member')}}</a></td>
                                    <td>{{$user->area? $user->area->name: strtoupper('unknown area')}}</td>
                                    <td>{{$user->district? $user->district->name: strtoupper('unknown district')}}</td>
                                    <td>{{$user->local? $user->local->name: strtoupper('unknown local')}}</td>
                                    <th>{{$user->created_at}}</th>
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