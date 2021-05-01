{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            MEMBERSHIP DATA--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            <a href="{{route('ministry.index')}}" class=" btn-default btn-sm">Home</a>--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            <a href="{{route('localIndividualT',$user->id)}}" class=" btn-info btn-sm">Tithe</a>--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            <a class="btn-success btn-sm" href="{{route('ministry.edit',$user->id)}}" id="submitUpdate">Edit</a>--}}
{{--        </p>--}}
{{--    </li>--}}

{{--@endsection--}}

{{--@section('content')--}}

{{--    <script>--}}

{{--        function ConfirmDelete()--}}
{{--        {--}}
{{--            var x = confirm("Are you sure you want to delete?");--}}
{{--            if (x)--}}
{{--                return true;--}}
{{--            else--}}
{{--                return false;--}}
{{--        }--}}

{{--        function ConfirmUpdate()--}}
{{--        {--}}
{{--            var x = confirm("Are you sure you want to update?");--}}
{{--            if (x)--}}
{{--                return true;--}}
{{--            else--}}
{{--                return false;--}}
{{--        }--}}
{{--    </script>--}}
{{--    <div class="modal" id="delete">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    {{$user->name}}--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}


{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="row">--}}
@extends('layouts.app', ['activePage' => 'children', 'titlePage' => __('Children Ministry')])
@section('content')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-image">
{{--                            <h4 class="card-title pb-lg-3">{{$user->name}}</h4>--}}
                            <p class="card-category">
                            <div class="avatar avatar-sm rounded-circle img-circle" style="width:100px; height:100px;overflow: hidden;">
                                <img src="{{$user->photo? $user->photo->file :asset('images/placeholder.png') }}" alt="" style="max-width: 100px;">
                            </div>

{{--                                <img class="avatar " height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt="image">--}}
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
        @include('includes.form_error')
        @include('includes.alert')
        {!! Form::model($user,['method'=>'PATCH','action'=>['Locals\ChildrenMinistryAtLocalController@update',$user->id],'files'=>true,'onsubmit' => 'return ConfirmUpdate()',],['class'=>'form-inline'])!!}

        <div class="panel mb25">
            <div class="panel-heading no-border">
                <ol class="breadcrumb mb0 no-padding">
                    <li><a href="javascript:;">LOCATION</a></li>
                    <li> <a href="{{route('registration.index')}}" class="">Home</a></li>
                    <li> <a href="{{route('localIndividualT',$user->id)}}" class="">Tithe</a></li>
                    <li> <a class="" href="{{route('registration.edit',$user->id)}}" onclick="return update()">Edit</a></li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('region_id',$regions,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('area_id',$areas,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('district_id',$districts,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('local_id','Local',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('local_id',$locals,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        PERSONAL DETAILS
                    </li>
                </ol>
            </div>
            <div class="panel-body">

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('name','Full Name',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('name',null,['class'=>'form-control','required'=>'required','placeholder'=>'FirstName/Middle Name/Surname','disabled'=>'disabled']) !!}
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="form-group">
                            {!! Form::label('gender','Gender',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-genderless"></i></div>
                                {!! Form::select('gender',[''=>'--Choose Option--','male'=>'Male','female'=>'Female'],null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('birthDate','Date Of Birth ',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('birthDate',null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('placeOfBirth','Place Of Birth *',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('placeOfBirth',null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('hometown','Hometown',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('hometown',null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('hometown_region','Home Town Region',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('hometown_region',$home_regions,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('nationality','Nationality',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('nationality',null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('languagess','Language(s) Spoken',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('languagess',[$user->languagess=>$user->languagess],null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('fathers_name',' Name Of Father',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('fathers_name',null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('fathers_hometown','Father\'s Hometown',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('fathers_hometown',null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('mothers_name',' Name Of Mother',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('mothers_name',null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('mothers_hometown','Mother\'s  Hometown',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('mothers_hometown',null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Ending of Guardians--}}


        {{--Church Details--}}

        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">CHURCH DETAILS</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('datejoinchurch','Date Join The Church(specifically the year)',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {{--{!! Form::date('datejoinchurch',null,['class'=>'form-control']) !!}--}}
                            {!! Form::date('datejoinchurch',null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('waterBaptism','Water Baptism',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('waterBaptism',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('baptismBy','Baptised By',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('baptismBy',null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('baptismDate','Date Of Baptism ',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('baptismDate',null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('baptismLocality','Place Of Baptism *',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                            {!! Form::text('baptismLocality',null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('officeHeld','Office Held',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('officeHeld',['member'=>'Member','children ministry'=>'Children Ministry','new convert'=>'New Convert'],null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">OFFICE USE ONLY</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                                {!! Form::select('role_id',$roles,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('is_active','Active Status',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                                {!! Form::select('is_active',[''=>'--Choose Options--',1=>'Active',0=>'Not Active'],null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                    </div>
                </div>
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

            function myFunction() {
                var x=document.getElementById('myInput');

                if (x.type==="password"){
                    x.type="text";
                }else {
                    x.type="password";
                }
            }

        </script>
    </div>
@endsection
