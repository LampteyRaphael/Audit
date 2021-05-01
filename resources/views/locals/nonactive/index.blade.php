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

{{--    <li>--}}
{{--        <p class="navbar-text" style="font-size: 12px;">--}}
{{--            Total&numero; &nbsp;{{$countUsers}}--}}
{{--        </p>--}}
{{--    </li>--}}
{{--@endsection--}}
{{--@section('content')--}}
@extends('layouts.app', ['activePage' => 'nonactive', 'titlePage' => __('None Active Users')])

@section('content')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">None Active Users</h4>
                            <p class="card-category">None Active are block from using the system</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
    <div class="table-responsive">
            <div class="table-responsive">
                <table class="table table-striped table-success mb0" id="data-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>IMAGES</th>
                        <th>NAME</th>
                        <th>GENDER</th>
                        <th>YRS IN CH.</th>
                        <th>OFFICE HELD </th>
                        <th>AGE</th>
                        <th>EDIT</th>
                        <th>DELETE</th>
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
                                </td>
                                <td><a href="{{route('registration.edit',$user->id)}}">{{strtoupper($user->name)}}</a></td>

                                <td>{{strtoupper($user->gender)}}</td>

                                <td>{{strtoupper(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch))->diff(Carbon\Carbon::now())
                                 ->format('%y years,%m months,%d days'))}}</td>

                                <td>{{strtoupper($user->officeHeld)}}</td>

                                <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>

                                <td><a class="btn btn-primary btn-sm" href="{{route('registration.edit',$user->id)}}"><i class="fa fa-edit"></i></a></td>

                                <td>
                                    {!! Form::model($user,['method'=>'DELETE','action'=>['Locals\RegisterLocalMembersController@destroy',$user->id],'onsubmit' => 'return ConfirmDelete()',],['class'=>'form-inline'])!!}
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-trash"></i></button>
                                    {!! Form::close() !!}
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
    </div>
</div>
</div>
</div>
</div>
    <script>
        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function() {--}}
            {{--$(function () {--}}
                {{--$('#data-table').DataTable({--}}
                    {{--processing: true,--}}
                    {{--serverSide: true,--}}
                    {{--ajax:"{{ route('nonactive.index') }}",--}}
                    {{--columns: [--}}
                        {{--{data: 'actionA'},--}}
                        {{--// {data:'pictures'},--}}
                        {{--{--}}
                            {{--data:"file",name:"file",--}}

                            {{--render:function (data, type, full, meta) {--}}

                              {{--return  "<img src='{{URL::to('/')}}/images/" + data + "width='70' class='image-thumbnail'/>";--}}

                            {{--}--}}
                        {{--},--}}
                        {{--{data: 'name', name: 'name'},--}}
                        {{--{data: 'actionG'},--}}
                        {{--{data: 'action3'},--}}
                        {{--{data: 'action4'},--}}
                        {{--{data: 'datesOfBirth'},--}}
                        {{--{data: 'action', name: 'action', orderable: true, searchable: true},--}}
                        {{--{data: 'delete', name: 'delete'},--}}
                    {{--]--}}
                {{--});--}}

            {{--});--}}

        {{--});--}}

        {{--{--}}
        {{--data: 'photo_id', name:'photo_id',render:function (data, type, full, meta) {--}}

        {{--return "<img src='{{URL::to('/')}}/images/"--}}

        {{--+ data + "width='70' class='image-thumbnail'/>"--}}
        {{--}--}}
        {{--}--}}

        {{--// orderable: false,--}}

        {{--// },--}}
        {{--function ConfirmDelete()--}}
        {{--{--}}
            {{--var x = confirm("Are you sure you want to delete?");--}}
            {{--if (x)--}}
                {{--return true;--}}
            {{--else--}}
                {{--return false;--}}
        {{--}--}}


    {{--// </script>--}}
@endsection


