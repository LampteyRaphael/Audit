@extends ('layouts.master_table')
@section('content')
    <h1 class="page-header">Admin Users</h1>
    <div class="table-responsive">
    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
                </thead>
                <tbody>
                @if($ChurchMembers)
                    @foreach($ChurchMembers as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td><img height="50" src="{{$user->photo? $user->photo->file :''}}" alt=""></td>
                            <td><a href="{{route("members.edit",$user->id)}}">{{$user->name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role? $user->role->name: 'User has no role'}}</td>
                            <td>{{$user->is_active==1? 'Active':'Not Active'}}</td>
                            <td>{{$user->created_at->diffForHumans() }}</td>
                            <td>{{$user->updated_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
       </div>
    </div>
@endsection


