@extends ('layouts.master_table')
@section('content')
    <div class="table-responsive">

        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    {{--<li>--}}
                        {{--<a href="{{route('updates.show',Session::get('localAdminId'))}}"><i class="fa fa-backward fa-fw"></i>Back</a>--}}
                    {{--</li>--}}
                    <li>
                        <a href="javascript:;">User</a>
                    </li>
                    <li>
                        <a href="javascript:;">{{$user->name}}</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <table class="table table-bordered mb0">
                    <thead>
                    <tr>
                        <th>Member ID</th>
                        <td>{{$user->members_id}}</td>
                    </tr>
                    <tr>
                        <th>User Name</th>
                        <td>{{$user->name}}</td>
                    </tr>

                    <tr>
                        <th>E-Mail</th>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{$user->gender}}</td>
                    </tr>
                    <tr>
                        <th>Date Of Birth</th>
                        <td>{{$user->birthDate}}</td>
                    </tr>
                    <tr>
                        <th>Marital Status</th>
                        <td>{{$user->maritalStatus}}</td>
                    </tr>
                    <tr>
                        <th>Date Of Baptism</th>
                        <td>{{$user->baptismDate}}</td>
                    </tr>
                    <tr>
                        <th>Local Of Baptism</th>
                        <td>{{$user->baptismLocality}}</td>
                    </tr>
                    <tr>
                        <th>Baptize By</th>
                        <td>{{$user->baptismBy}}</td>
                    </tr>

                    <tr>
                        <th>Role In Church</th>
                        <td>{{$user->position}}</td>
                    </tr>

                    <tr>
                        <th>Telephone Number</th>
                        <td>{{$user->phone}}</td>
                    </tr>

                    <tr>
                        <th>Occupation</th>
                        <td>{{$user->occupation}}</td>
                    </tr>

                    <tr>
                        <th>Role</th>
                        <td>{{$user->role->name}}</td>
                    </tr>

                    <tr>
                        <th>Active</th>
                        <td>{{$user->is_active =1? 'Active':'Not Active'}}</td>
                    </tr>

                    <tr>
                        <th>Region</th>
                        <td>{{$user->region->name}}</td>
                    </tr>

                    <tr>
                        <th>Area</th>
                        <td>{{$user->area->name}}</td>
                    </tr>

                    <tr>
                        <th>District</th>
                        <td>{{$user->district->name}}</td>
                    </tr>

                    <tr>
                        <th>Local or Assembly</th>
                        <td>{{$user->local->name}}</td>
                    </tr>

                    <tr>
                        <th>Fathers Name</th>
                        <td>{{$user->fathers_name}}</td>
                    </tr>

                    <tr>
                        <th>Fathers Hometown</th>
                        <td>{{$user->fathers_hometown}}</td>
                    </tr>

                    <tr>
                        <th>mothers Name</th>
                        <td>{{$user->mothers_name}}</td>
                    </tr>

                    <tr>
                        <th>Mothers Hometown</th>
                        <td>{{$user->mothers_hometown}}</td>
                    </tr>

                    <tr>
                        <th>House Address</th>
                        <td>{{$user->houseaddress}}</td>
                    </tr>

                    <tr>
                        <th>House Number</th>
                        <td>{{$user->houseNumber}}</td>
                    </tr>

                    <tr>
                        <th>Street Name</th>
                        <td>{{$user->streetname}}</td>
                    </tr>

                    <tr>
                        <th>Landmark</th>
                        <td>{{$user->landmark}}</td>
                    </tr>

                    <tr>
                        <th>Digital Address</th>
                        <td>{{$user->digitalAddress}}</td>
                    </tr>

                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


