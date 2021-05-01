{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text" style="font-size: 12px;">--}}
{{--            Male &numero; &nbsp;{{$male}}--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text" style="font-size: 12px;">--}}
{{--            Female &numero; &nbsp;{{$female}}--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text" style="font-size: 12px;">--}}
{{--            Deacons &numero; &nbsp;{{$deacon}}--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text" style="font-size: 12px;">--}}
{{--            Deaconess&numero; &nbsp;{{$deaconess}}--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    --}}{{--<li>--}}
{{--        --}}{{--<p class="navbar-text" style="font-size: 12px;">--}}
{{--            --}}{{--Children&numero; &nbsp;{{count($children)}}--}}
{{--        --}}{{--</p>--}}
{{--    --}}{{--</li>--}}

{{--    <li>--}}
{{--        <p class="navbar-text" style="font-size: 12px;">--}}
{{--            Total&numero; &nbsp;{{$countUsers}}--}}
{{--        </p>--}}
{{--    </li>--}}
{{--@endsection--}}
{{--@section('content')--}}
{{--    <div class="panel mb25">--}}
{{--        <div class="panel-heading border">--}}
{{--            <ol class="breadcrumb mb0 no-padding">--}}
{{--                <li>--}}
{{--                    <a href="{{route('local.index')}}">Home</a>--}}
{{--                </li>--}}
{{--                <li>--}}
{{--                    <a href="javascript:;">Deceased</a>--}}
{{--                </li>--}}
{{--                <li class="active">Data tables</li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--        <div class="panel-body">--}}
@extends('layouts.app', ['activePage' => 'nonactive4', 'titlePage' => __(' Deceased Members')])

@section('content')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Deceased Members</h4>
                            <p class="card-category"> Here you can manage users</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
            <div class="table-responsive">
                <table class="table table-striped mb0">
                    <thead>
                    <tr>
                        <th>Members Id</th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Role</th>
                        <th>Age</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($users)
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->members_id}}</td>
                                <td  rel="tooltip" title="Image">
                                    <div class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">
                                        <img src="{{$user->photo? $user->photo->file :asset('images/placeholder.png') }}" alt="" style="max-width: 100px;">
                                    </div>
                                </td>                                <td><a href="{{route('registration.edit',$user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->role? $user->role->name: 'User has no role'}}</td>
                                <td>{{$user->is_active==1? 'Active':'Not Active'}}</td>
                                <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>
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
  </div>
 </div>
</div>

@endsection


