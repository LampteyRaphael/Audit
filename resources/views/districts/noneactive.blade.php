@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
           None Active Church Members
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')

    <div class="table-responsive shadow">
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">None Active Members</a>
                    </li>

                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">

                <table class="table table-striped" id="data-table">
                    <thead>
                    <tr>
                        <th>Membership Id</th>
                        <th>Photo</th>
                        <th>User</th>
                        <th>Gender</th>
                        <th>Date Join</th>
                        <th>Office Held</th>
                        <th>Age</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                </table>








{{--                @if($users)--}}
{{--                    <table class="table table-striped table-bordered mb0">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Membership Id</th>--}}
{{--                            <th>Photo</th>--}}
{{--                            <th>User</th>--}}
{{--                            <th>Gender</th>--}}
{{--                            <th>Date Join</th>--}}
{{--                            <th>Office Held</th>--}}
{{--                            <th>Age</th>--}}
{{--                            <th>Edit</th>--}}
{{--                            <th>Delete</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($users as $user)--}}

{{--                            <tr>--}}
{{--                                <td>{{$user->members_id}}</td>--}}
{{--                                <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :""}}" alt=""></td>--}}

{{--                                <td><a class="btn-link" href="{{route('nonedit',$user->id)}}">{{strtoupper($user->name)}}</a></td>--}}

{{--                                <td>{{strtoupper($user->gender)}}</td>--}}

{{--                                <td>{{strtoupper(Carbon\Carbon::now()->parse($user->datejoinchurch)->diff(Carbon\Carbon::now())--}}
{{--                                 ->format('%y years,%m months,%d days'))}}</td>--}}

{{--                                <td>{{strtoupper($user->officeHeld)}}</td>--}}

{{--                                <td>{{Carbon\Carbon::parse($user->birthDate)->age}}</td>--}}

{{--                                <td class="text-center"><a class="btn btn-primary btn-xs" href="{{route('individuals.index',$user->id)}}"><i class="fa fa-edit"></i></a></td>--}}
{{--                                <td>--}}
{{--                                    {!! Form::model($user,['method'=>'DELETE','action'=>['DistrictUpCreateController@destroy',$user->id],'onsubmit' => 'return ConfirmDelete()',],['class'=>'form-inline'])!!}--}}
{{--                                    <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-edit"></i></button>--}}
{{--                                    {!! Form::close() !!}--}}

{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    {{$users->links()}}--}}
{{--                @endif--}}
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(function () {
                $.fn.dataTable.ext.errMode="javascript";
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    "iDisplayLength": 50,
                    ajax:"{{route('addnew.show',urlencode('NoneActiveMembers'))}}",
                    columns: [
                        {data:'actionA',name:'members_id'},
                        {data:'pictures',name:'pictures'},
                        {data: 'actionB', name: 'actionB'},
                        {data: 'actionC',name: 'actionC'},
                        {data: 'actionD',name: 'actionD'},
                        {data: 'actionE',name: 'actionE'},
                        {data: 'actionF',name: 'actionF'},
                        {data: 'edit',name: 'edit',orderable: true, searchable: true},
                    ],
                });
            });
        });

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmUpdate()
        {
            var x = confirm("Are you sure you want to edit?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection