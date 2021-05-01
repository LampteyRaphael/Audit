@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text">
            MEMBERSHIP TRANSFER
        </p>
    </li>
    <li>
        <p class="navbar-text">
            <a href="{{route('registration.index')}}" class=" btn-info btn-xs">Home</a>
        </p>
    </li>
    <li>
        <p class="navbar-text">
            <a href="{{route('localIndividualT',$user->id)}}" class=" btn-info btn-xs">Tithe</a>
        </p>
    </li>
    <li>
        <p class="navbar-text">
            <a class="btn-success btn-xs" href="{{route('registration.edit',$user->id)}}" onclick="return update()">Edit</a>
        </p>
    </li>

@endsection

@section('content')
    <script>

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
            var x = confirm("Are you sure you want to update?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

    <div class="row">
        @include('includes.form_error')
        @include('includes.alert')
        {!! Form::open(['method'=>'PATCH','action'=>['Locals\TextFieldController@update',$user->id],'files'=>true,'onsubmit' => 'return ConfirmUpdate()'],['class'=>'form-inline'])!!}

        <div class="panel mb25 hidden">
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
                    <img class="img-rounded img-responsive" height="150" width="150" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt="image">
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('region_id',$regions,null,['class'=>'form-control','required'=>'required']) !!}
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('area_id',$areas,null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('district_id',$districts,null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('local_id','Local',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('local_id',$locals,null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="panel mb0 hidden" id="step1">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">PERSONAL DETAILS</a>
                    </li>
                    <li>
                        <span style="color: red">*</span> is compulsory
                    </li>
                </ol>
            </div>
            <div class="panel-body">

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('name','Full Name',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('name',$user->name,['class'=>'form-control','required'=>'required','placeholder'=>'FirstName/Middle Name/Surname']) !!}
                        </div>

                    </div>
                </div>

                <div class="col-sm-4">
                    <div>
                        <div class="form-group">
                            {!! Form::label('gender','Gender',['class'=>'control-label bold']) !!}
                            <span style="color: red">*</span>
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-genderless"></i></div>
                                {!! Form::text('gender',$user->gender,['id'=>'gender','class'=>'form-control','required'=>'required']) !!}
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('birthDate','Date Of Birth',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('birthDate',$user->birthDate,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('placeOfBirth','Place Of Birth',['class'=>'control-label']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('placeOfBirth',$user->placeOfBirth,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('hometown','Hometown',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('hometown',$user->hometown,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('hometown_region','Home Town Region',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('hometown_region',$home_regions,null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('nationality','Nationality',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            <select id="nationality" name="nationality" class="form-control">
                                <option value="{{$user->nationality}}">{{ucwords($user->nationality)}}</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('languagess','Language(s) Spoken',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('languagess[]',[$user->languagess=>$user->languagess]+$languages,$user->languagess,['id'=>'languagess',
                            'class'=>'selectpicker form-control',
                            'multiple data-max-options'=>5,
                            'data-live-search'=>'true',
                            ]) !!}
                        </div>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('maritalStatus','Marital Status',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('maritalStatus',$user->maritalStatus,['class'=>'form-control',]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('mariagetype','Type Of Marriage',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('mariagetype',$user->mariagetype,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('spouseName','Name Of Spouse',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('spouseName',$user->spouseName,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('numberOfChildren','Number Of Children',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::number('numberOfChildren',$user->numberOfChildren,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('fathers_name',' Name Of Father',['class'=>'control-label']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('fathers_name',$user->fathers_name,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('fathers_hometown','Father\'s Hometown',['class'=>'control-label']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('fathers_hometown',$user->fathers_hometown,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('mothers_name',' Name Of Mother',['class'=>'control-label']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('mothers_name',$user->mothers_name,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('mothers_hometown','Mother\'s  Hometown',['class'=>'control-label']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('mothers_hometown',$user->mothers_hometown,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="panel mb0">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">OFFICE USE ONLY</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">

                @if(Auth::user()->role_id==8)
                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                                {!! Form::select('role_id',$Adminsroles,null,['class'=>'form-control','required'=>'required']) !!}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-6 hidden">
                        <div class="form-group ">
                            {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                                {!! Form::select('role_id',$roles,null,['class'=>'form-control','required'=>'required']) !!}
                            </div>
                        </div>
                    </div>

                @endif

                <div class="col-md-6" hidden>
                    <div class="form-group ">
                        {!! Form::label('is_active','Active Status',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('is_active',[''=>'--Choose Option--',1=>'Active',0=>'Not Active'],1,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('password','Password',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            {!! Form::password('password',['class'=>'form-control','id'=>'myInput']) !!}
                            <div class="input-group-addon"><input type="checkbox"  onclick="myFunction()">Show
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('members_id','Membership ID',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-secret"></i></div>
                            {!! Form::number('members_id',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="">
                        <div class="form-group">
                            {!! Form::label('photo_id','Photo',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-photo"></i></div>
                                {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="pull-right">
                        <button class="btn btn-primary pull-right" type="submit">Add New Transfer</button>
                        {!! Form::close() !!}
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

