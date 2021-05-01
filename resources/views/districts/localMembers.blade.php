@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">{{strtoupper($locals->name)}} ASSEMBLY</p>
    </li>

    <li>
        <p class="navbar-text">
            <a class="btn-link" href="#summary" data-toggle="modal">Summary</a>
        </p>
    </li>
    <li>
        <p class="navbar-text" style="font-size: 12px;">
            Total&numero; &nbsp;{{$countUsers}}
        </p>
    </li>

    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Male &numero; &nbsp;{{$male}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Female &numero; &nbsp;{{$female}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Deacons &numero; &nbsp;{{$deacon}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Deaconess&numero; &nbsp;{{$deaconess}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Children&numero; &nbsp;{{count($children)}}--}}
        {{--</p>--}}
    {{--</li>--}}

    {{--<li>--}}
        {{--<p class="navbar-text" style="font-size: 12px;">--}}
            {{--Total&numero; &nbsp;{{$countUsers}}--}}
        {{--</p>--}}
    {{--</li>--}}

@endsection

@section('content')

       @include('includes.alert')
        @include('includes.form_error')
       <div class="modal" id="summary">
           <div class="modal-dialog">
               <div class="modal-content">
                   <div class="modal-header"></div>
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
                               <td>{{$children}}</td>
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
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        @if(Session::has('anotherDistrict_id'))
                            <a class="btn-link" href="{{route('districtPost.show',(Session::get('anotherDistrict_id')))}}">{{ucwords($locals->name)}}</a>
                        @endif
                    </li>
                    <li>
                        <a href="javascript:;">Local</a>
                    </li>
                    <li>
                        <a href="javascript:;">Members</a>
                    </li>
                    <li class="active">Data tables</li>
                    <li>
                        <a class="btn btn-default btn-xs" href="{{route('search.locals',$id)}}">Adult Church Members</a>
                    </li>
                    <li>
                        <a class="btn btn-default btn-xs" href="{{route('ChildrenMinistry.locals',$id)}}">Children Ministry View</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                @if($users)
                <table class="table table-striped mb0">
                    <thead>
                    <tr>
                        <th>Members Id</th>
                        <th>Photo</th>
                        <th>User</th>
                        <th>GENDER</th>
                        <th>YEARS IN THE CHURCH.</th>
                        <th>OFFICE HELD </th>
                        <th>AGE</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)

                        <tr>
                            <td>{{$user->members_id}}</td>
                            <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :'https://placehold.it/400x400'}}" alt=""></td>

                            <td><a class="btn-link" href="{{route('nonedit',$user->id)}}">{{strtoupper($user->name)}}</a></td>

                            <td>{{strtoupper($user->gender)}}</td>

                            <td>{{strtoupper(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch))->diff(Carbon\Carbon::now())
                                 ->format('%y years,%m months,%d days'))}}</td>

                            <td>{{strtoupper($user->officeHeld)}}</td>

                            <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>
                            <td class="text-center"><a class="btn btn-primary btn-sm" href="{{route('individuals.index',$user->id)}}"><i class="fa fa-edit"></i></a></td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    {{$users->links()}}
                @endif
            </div>
        </div>
</div>
@endsection