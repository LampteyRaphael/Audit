@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text">
            MEMBERSHIP DATA
        </p>
    </li>
@endsection

@section('content')
    <div class="row">
        @include('includes.form_error')
        {!! Form::model($user,['method'=>'PATCH','action'=>['Individuals\IndividualDashboardController@update',$user->id],'files'=>true,'onsubmit' => 'return ConfirmUpdate()',],['class'=>'form-inline'])!!}

        <div class="panel mb25 hidden">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">LOCATION</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="col-md-12" id="formHeader"><span   class="text-uppercase" style="color: red;font-size:1em; font-weight: bold;">Areas in bold are mandatory</span></div>
                <div class="col-md-4 hidden">
                    <div class="form-group ">
                        {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('region_id',$regions,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group hidden">
                        {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('area_id',$areas,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden">
                    <div class="form-group">
                        {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('district_id',$districts,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4 hidden">
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

                
                <ul class="nav">
                    <li><span id="name_error" class="text text-danger bold "></span></li>
                </ul>
                <div class="col-md-4">
                    <img class="img-rounded img-responsive" height="150" width="150" src="{{$user->photo? $user->photo->file :'http://placehold.it/400x400'}}" alt="image">
                </div>
                <div class="col-sm-4">
                    <div class="form-group clear">
                        {!! Form::label('name','Full Name',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'FirstName/Middle Name/Surname','required'=>'required']) !!}
                        </div>
    
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group clear">
                        {!! Form::label('gender','Gender',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-genderless"></i></div>
                            {!! Form::select('gender',[''=>'--Choose Option--','male'=>'Male','female'=>'Female'],null,['class'=>'form-control','required'=>'required']) !!}
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group clear">
                        {!! Form::label('birthDate','Date Of Birth(YY-mm-dd))',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('birthDate',null,['class'=>'form-control','Placeholder'=>'YY-mm-dd','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group clear">
                        {!! Form::label('placeOfBirth','Place Of Birth',['class'=>'control-label']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('placeOfBirth',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('hometown','Hometown',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('hometown',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('hometown_region','Home Town Region',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('hometown_region',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    
    
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('nationality','Nationality',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
    
    
                            {!! Form::select('nationality',[''=>'--Choose Options--']+nationality(),null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    
    
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('languagess','Language(s) Spoken(eg.twi,english) maximum 5',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('languagess',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    
    
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('maritalStatus','Marital Status',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('maritalStatus',[''=>'Choose Option','married'=>'Married','single'=>'Single',
                            'divorce'=>'Divorce','separated'=>'Separated','widow(er)'=>'Widow(er)'
    
                            ],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('mariagetype','Type Of Marriage',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('mariagetype',[''=>'--Choose Option--','customary'=>'Customary','ordinance'=>'Ordinance'],null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
    
    
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('spouseName','Name Of Spouse',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('spouseName',null,['class'=>'form-control',]) !!}
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group">
                        {!! Form::label('numberOfChildren','Number Of Children',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::number('numberOfChildren',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('fathers_name',' Name Of Father',['class'=>'control-label','required'=>'required']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('fathers_name',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('fathers_hometown','Father\'s Hometown',['class'=>'control-label','required'=>'required']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('fathers_hometown',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('mothers_name',' Name Of Mother',['class'=>'control-label']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('mothers_name',null,['class'=>'form-control','id'=>'mothers_name','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('mothers_hometown','Mother\'s  Hometown',['class'=>'control-label']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('mothers_hometown',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>
    </div>
        {{-- EDUCATION AND PROFESSION--}}
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">EDUCATION & PROFESSION</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('education','Level Of Education',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('education',[''=>'--Choose Options--',
                            'none'=>'Non',
                            'basic'=>'Basic',
                            'vocational'=>'Vocational',
                            'secondary'=>'Secondary',
                            'o level'=>'O Level',
                            'tertiary'=>'Tertiary'],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('courseStudied','Course Studied',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('courseStudied',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('employmentType','Employment Type',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('employmentType',
                            [''=>'--Choose Options--',
                             'self employed'=>'Self Employed',
                             'government'=>'Government',
                             'private sector'=>'Private Sector',
                             'student'=>'Student',
                             'unemployed'=>'Unemployed',
                             'retired'=>'Retired'
                            ],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('profOccupation','Profession/Occupation',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('profOccupation',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('placeOfWork','Place Of Work',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                            {!! Form::text('placeOfWork',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

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

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('datejoinchurch','Date Join The Church(specifically the year)',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {{--{!! Form::date('datejoinchurch',null,['class'=>'form-control']) !!}--}}
                            {!! Form::date('datejoinchurch',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('previousdenomination','Previous Denomination',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                            {!! Form::text('previousdenomination',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('waterBaptism','Water Baptism',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('waterBaptism',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('baptismBy','Baptised By',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('baptismBy',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('baptismDate','Date Of Baptism ',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('baptismDate',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('baptismLocality','Place Of Baptism *',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                            {!! Form::text('baptismLocality',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('rightHandOfFellowship','Right Hand Of Fellowship',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('rightHandOfFellowship',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('communicant','Communicant',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('communicant',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('holySpiritBaptism','Holy Spirit Baptism',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('holySpiritBaptism',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('anySpiritualGift','Any Spiritual Gift(s)',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('anySpiritualGift',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('pleaseIndicate','Please Indicate Any Spiritual Gift(s)',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('pleaseIndicate',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('officeHeld','Office Held',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('officeHeld',[''=>'--Choose Option--',
                                   'elder'=>'Elder','deacon'=>'Deacon','deaconess'=>'Deaconess','member'=>'Member'
                            ],null,['class'=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('ordainedBy','Ordained By',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('ordainedBy',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('dateOrdained','Date Ordained',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('dateOrdained',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">POSITION/SERVICE IN THE CHURCH</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="col-md-12">

                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('movementGroup','Movement/Group',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
                                {!! Form::textarea('movementGroup',null,['class'=>'form-control','rows'=>2]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('position','Position/Service In The Church',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
                                {!! Form::textarea('position',null,['class'=>'form-control','rows'=>2]) !!}
                            </div>
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

                    <div class="col-md-4 hidden">
                        <div class="form-group ">
                            {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                                {!! Form::select('role_id',$roles,null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 hidden">
                        <div class="form-group ">
                            {!! Form::label('is_active','Active Status',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                                {!! Form::select('is_active',[''=>'--Choose Options--',1=>'Active',0=>'Not Active'],null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('password','Password',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                {!! Form::password('password',['class'=>'form-control','id'=>'myInput']) !!}
                                <div class="input-group-addon"><input type="checkbox"  onclick="myFunction()">Show
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('members_id','Membership ID',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user-secret"></i></div>
                                {!! Form::text('members_id',null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group ">
                            {!! Form::label('photo_id','Photo',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-photo"></i></div>
                                {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="pull-rignt">
                            <div class="form-group ">
                                {!! Form::submit('Send ',['class'=>'btn btn-primary btn-lg']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
   <?php
    function nationality(){
        return  $nationaliyty=[
            "afghan"=>"afghan",
            "albanian"=> "albanian",
            "algerian"=> "algerian",
            "american"=>"american",
            "andorran"=> "andorran",
            "angolan"=>"angolan",
            "antiguans"=> "antiguans",
            "argentinean"=> "argentinean",
            "armenian"=> "armenian",
            "australian"=>"australian",
            "austrian"=>"austrian",
            "azerbaijani"=>"azerbaijani",
            "bahamian"=>"bahamian",
            "bahraini"=> "bahraini",
            "bangladeshi"=>"bangladeshi",
            "barbadian"=>"barbadian",
            "barbudans"=>"barbudans",
            "batswana"=>"batswana",
            "belarusian"=> "belarusian",
            "belgian"=> "belarusian",
            "belizean"=>"belizean",
            "beninese"=>"beninese",
            "bhutanese"=>"bhutanese",
            "bolivian"=> "bolivian",
            "bosnian"=>"bosnian",
            "brazilian"=>"brazilian",
            "british"=>"british",
            "bruneian"=> "bruneian",
            "bulgarian"=>"bulgarian",
            "burkinabe"=> "burkinabe",
            "burmese"=>"burmese",
            "burundian"=>"burundian",
            "cambodian"=>"cambodian",
            "cameroonian"=> "cameroonian",
            "canadian"=> "canadian",
            "cape verdean"=> "cape verdean",
            "central african"=>"central african",
            "chadian"=>"chadian",
            "chilean"=>"chilean",
            "chinese"=> "chinese",
            "colombian"=>"colombian",
            "comoran"=>"comoran",
            "congolese"=>"congolese",
            "costa rican"=> "costa rican",
            "croatian"=> "croatian",
            "cuban"=>"cuban",
            "cypriot"=>"cypriot",
            "czech"=>  "czech",
            "danish"=>"danish",
            "djibouti"=> "djibouti",
            "dominican"=>"dominican",
            "dutch"=>"dutch",
            "east timorese"=> "east timorese",
            "ecuadorean"=>"ecuadorean",
            "egyptian"=>"egyptian",
            "emirian"=>"emirian",
            "equatorial guinean"=>"equatorial guinean",
            "eritrean"=>"eritrean",
            "estonian"=>"estonian",
            "ethiopian"=> "ethiopian",
            "fijian"=> "fijian",
            "filipino"=>"filipino",
            "finnish"=>"finnish",
            "french"=> "french",
            "gabonese"=>"gabonese",
            "gambian"=>"gambian",
            "georgian"=>"georgian",
            "german"=>"german",
            "ghanaian"=>"ghanaian",
            "greek"=> "greek",
            "grenadian"=>"grenadian",
            "guatemalan"=> "guatemalan",
            "guinea-bissauan"=> "guinea-bissauan",
            "guinean"=> "guinean",
            "guyanese"=>  "guyanese",
            "haitian"=>"haitian",
            "herzegovinian"=> "herzegovinian",
            "honduran"=>"honduran",
            "hungarian"=> "hungarian",
            "icelander"=> "icelander",
            "indian"=> "indian",
            "indonesian"=>"indonesian",
            "iranian"=>  "iranian",
            "iraqi"=>"iraqi",
            "irish"=> "irish",
            "israeli"=>"israeli",
            "italian"=>"italian",
            "ivorian"=> "ivorian",
            "jamaican"=>"jamaican",
            "japanese"=>"japanese",
            "jordanian"=> "jordanian",
            "kazakhstani"=>"kazakhstani",
            "kenyan"=> "kenyan",
            "kittian and nevisian"=>"kittian and nevisian",
            "kuwaiti"=>"kuwaiti",
            "kyrgyz"=> "kyrgyz",
            "laotian"=> "laotian",
            "latvian"=>"latvian",
            "lebanese"=>"lebanese",
            "liberian"=> "liberian",
            "libyan"=> "libyan",
            "liechtensteiner"=>  "liechtensteiner",
            "lithuanian"=>"lithuanian",
            "luxembourger"=> "luxembourger",
            "macedonian"=>"macedonian",
            "malagasy"=> "malagasy",
            "malawian"=>"malawian",
            "malaysian"=> "malaysian",
            "maldivan"=>  "maldivan",
            "malian"=>  "malian",
            "maltese"=>"maltese",
            "marshallese"=>"marshallese",
            "mauritanian"=> "mauritanian",
            "mauritian"=> "mauritian",
            "mexican"=> "mexican",
            "micronesian"=>"micronesian",
            "moldovan"=>"moldovan",
            "monacan"=> "monacan",
            "mongolian"=>   "mongolian",
            "moroccan"=>  "moroccan",
            "mosotho"=>"mosotho",
            "motswana"=> "motswana",
            "mozambican"=> "mozambican",
            "namibian"=>"namibian",
            "nauruan"=> "nauruan",
            "nepalese"=>"nepalese",
            "new zealander"=> "new zealander",
            "ni-vanuatu"=> "ni-vanuatu",
            "nicaraguan"=>"nicaraguan",
            "nigerien"=>  "nigerien",
            "north korean"=>"north korean",
            "northern irish"=> "northern irish",
            "norwegian"=>"norwegian",
            "omani"=> "omani",
            "pakistani"=> "pakistani",
            "palauan"=> "palauan",
            "panamanian"=>  "panamanian",
            "papua new guinean"=> "papua new guinean",
            "paraguayan"=>  "paraguayan",
            "peruvian"=>  "peruvian",
            "polish"=>  "polish",
            "portuguese"=>  "portuguese",
            "qatari"=> "qatari",
            "romanian"=> "romanian",
            "russian"=>"russian",
            "rwandan"=> "rwandan",
            "saint lucian"=>"saint lucian",
            "salvadoran"=> "salvadoran",
            "samoan"=>  "samoan",
            "san marinese"=>"san marinese",
            "sao tomean"=> "sao tomean",
            "saudi"=>"saudi",
            "scottish"=>"scottish",
            "senegalese"=> "senegalese",
            "serbian"=> "serbian",
            "seychellois"=>  "seychellois",
            "sierra leonean"=>"sierra leonean",
            "singaporean"=> "singaporean",
            "slovakian"=> "slovakian",
            "slovenian"=>  "slovenian",
            "solomon islander"=> "solomon islander",
            "somali"=>   "somali",
            "south african"=> "south african",
            "south korean"=> "south korean",
            "spanish"=>"spanish",
            "sri lankan"=> "sri lankan",
            "sudanese"=> "sudanese",
            "surinamer"=> "surinamer",
            "swazi"=> "swazi",
            "swedish"=>  "swedish",
            "swiss"=>  "swiss",
            "syrian"=> "syrian",
            "taiwanese"=> "taiwanese",
            "tajik"=> "tajik",
            "tanzanian"=> "tanzanian",
            "thai"=> "thai",
            "togolese"=> "togolese",
            "tongan"=> "tongan",
            "trinidadian or tobagonian"=>  "trinidadian or tobagonian",
            "tunisian"=>"tunisian",
            "turkish"=>  "turkish",
            "tuvaluan"=>  "tuvaluan",
            "ugandan"=> "ugandan",
            "ukrainian"=> "ukrainian",
            "uruguayan"=> "uruguayan",
            "uzbekistani"=>  "uzbekistani",
            "venezuelan"=>"venezuelan",
            "vietnamese"=> "vietnamese",
            "welsh"=> "welsh",
            "yemenite"=>"yemenite",
            "zambian"=> "zambian",
            "zimbabwean"=> "zimbabwean",
        ];
    }
    ?>
        {!! Form::close() !!}
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

