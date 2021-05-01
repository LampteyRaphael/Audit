@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text">
           ANONYMOUS MEMBERSHIP DATA
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
    {!! Form::model($user,['method'=>'PATCH','action'=>['National\AnonymousAdminsController@update',$user->id],'files'=>true,'onsubmit' => 'return ConfirmUpdate()'],['class'=>'form-inline'])!!}

        <div class="panel mb25">
            <div class="panel" style="background:-webkit-gradient(linear, 0% 100%, 0% 0%, from(rgb(221, 221, 221)), to(rgb(250, 250, 250)));padding: 5px">
                <a href="javascript:;">LOCATION</a>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <img class="img-rounded img-responsive" height="150" width="150" src="{{$user->photo? $user->photo->file :'http://placehold.it/400x400'}}" alt="image">
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('region_id',$regions,null,['class'=>'form-control selectpicker', 'data-live-search'=>'true','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('area_id',$areas,null,['class'=>'form-control selectpicker', 'data-live-search'=>'true','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('district_id',$districts,null,['class'=>'form-control selectpicker', 'data-live-search'=>'true','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('local_id','Local',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                            {!! Form::select('local_id',$locals,null,['class'=>'form-control selectpicker', 'data-live-search'=>'true','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="panel mb0">
            <div class="panel p-4">
                <a href="javascript:;">PERSONAL DETAILS</a>

            </div>

            <div class="panel-body">

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('name','Full Name',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('name',null,['class'=>'form-control selectpicker','required'=>'required','placeholder'=>'FirstName/Middle Name/Surname']) !!}
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div>
                        <div class="form-group">
                            {!! Form::label('gender','Gender',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-genderless"></i></div>
                                {!! Form::select('gender',['male'=>'Male','female'=>'Female'],null,['id'=>'gender','class'=>'selectpicker form-control','multiple data-max-options'=>1,'required'=>'required']) !!}
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
                            {!! Form::date('birthDate',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('placeOfBirth','Place Of Birth *',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('placeOfBirth',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('hometown','Hometown',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('hometown',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('hometown_region','Home Town Region',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('hometown_region',$home_regions,null,['class'=>'selectpicker form-control','required'=>'required','multiple data-max-options'=>1]) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('nationality','Nationality',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('nationality',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('languagess','Language(s) Spoken',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('languagess[]',[$user->languagess=>$user->languagess]+$languages,$user->languagess,['id'=>'languagess',
                            'class'=>'selectpicker form-control',
                            'required'=>'required',
                            'data-style'=>'btn-default',
                            'multiple data-max-options'=>5,
                            'data-live-search'=>'true',
                            'placeholder'=>'uu',
                            'picker-options.bind'=>"{ liveSearch: true, dropupAuto: false, noneSelectedText: '', liveSearchStyle: 'startsWith' }"


                            ]) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('maritalStatus','Marital Status',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('maritalStatus',['married'=>'Married','single'=>'Single',
                            'divorce'=>'Divorce','separated'=>'Separated','window(er)'=>'Window(er)'

                            ],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('mariagetype','Type Of Marriage',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('mariagetype',['customary'=>'Customary','ordinance'=>'Ordinance'],null,['class'=>'form-control selectpicker', 'multiple data-max-options'=>1]) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('spouseName','Name Of Spouse',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('spouseName',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('numberOfChildren','Number Of Children',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::number('numberOfChildren',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('fathers_name',' Name Of Father',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('fathers_name',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('fathers_hometown','Father\'s Hometown',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('fathers_hometown',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('mothers_name',' Name Of Mother',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('mothers_name',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('mothers_hometown','Mother\'s  Hometown',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('mothers_hometown',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Ending of Guardians--}}

        {{--CONTACT INFORMATION--}}
        <div class="panel mb0">
            <div class="panel">
                <a href="javascript:;">CONTACT INFORMATION</a>
            </div>
            <div class="panel-body">
                <div class="">
                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('digitalAddress','Digital Address',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                {!! Form::text('digitalAddress',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="form-group ">
                                {!! Form::label('houseaddress','House NO.*',['class'=>'control-label bold']) !!}
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                    {!! Form::text('houseaddress',null,['class'=>'form-control']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('streetname','Street Name *',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                {!! Form::text('streetname',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('landmark','Landmark',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                {!! Form::text('landmark',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('mobileNumber1','Mobile Number1',['class'=>'control-label bold']) !!} <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            {!! Form::text('mobileNumber1',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('mobileNumber2','Mobile Number2',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            {!! Form::text('mobileNumber2',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('workNumber','Work Number',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                            {!! Form::text('workNumber',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('whatsappNumber','WhatsApp No',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-whatsapp"></i></div>
                            {!! Form::text('whatsappNumber',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('email','Email',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-mail-forward"></i></div>
                            {!! Form::text('email',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- EDUCATION AND PROFESSION--}}
        <div class="panel mb0">
            <div class="panel">
                <a href="javascript:;">EDUCATION & PROFESSION</a>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('education','Level Of Education',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('education',[
                            'none'=>'Non',
                            'basic'=>'Basic',
                            'vocational'=>'Vocational',
                            'secondary'=>'Secondary',
                            'o level'=>'O Level',
                            'tertiary'=>'Tertiary'],null,['class'=>'form-control selectpicker', 'multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('courseStudied','Course Studied',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('courseStudied',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
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
                            ],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('profOccupation','Profession/Occupation',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('profOccupation',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
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

        <div class="panel mb0">
            <div class="panel">
                <a href="javascript:;">CHURCH DETAILS</a>
            </div>
            <div class="panel-body">

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('datejoinchurch','Date Join The Church(specifically the year)',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('datejoinchurch',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('previousdenomination','Previous Denomination',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                            {!! Form::text('previousdenomination',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('waterBaptism','Water Baptism',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('waterBaptism',['yes'=>'Yes','no'=>'No'],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('baptismBy','Baptised By',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('baptismBy',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('baptismDate','Date Of Baptism ',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('baptismDate',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('baptismLocality','Place Of Baptism *',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                            {!! Form::text('baptismLocality',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('rightHandOfFellowship','Right Hand Of Fellowship',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('rightHandOfFellowship',['yes'=>'Yes','no'=>'No'],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('communicant','Communicant',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('communicant',['yes'=>'Yes','no'=>'No'],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('holySpiritBaptism','Holy Spirit Baptism',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('holySpiritBaptism',['yes'=>'Yes','no'=>'No'],null,['class'=>'form-control selectpicker','required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('anySpiritualGift','Any Spiritual Gift(s)',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('anySpiritualGift',['yes'=>'Yes','no'=>'No'],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'required'=>'required']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('pleaseIndicate','Please Indicate Any Spiritual Gift(s)',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::text('pleaseIndicate',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('officeHeld','Office Held',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('officeHeld',['apostle'=>'Apostle','pastor'=>'Pastor',
                                   'elder'=>'Elder','deacon'=>'Deacon','deaconess'=>'Deaconess','member'=>'Member'
                            ],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1]) !!}
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('ordainedBy','Ordained By',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('ordainedBy',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
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

        <div class="panel mb0">
            <div class="panel">
                <a href="javascript:;">POSITION/SERVICE IN THE CHURCH</a>
            </div>
            <div class="panel-body">
                <div class="col-md-12">

                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('movementGroup','Movement/Group',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
                                {!! Form::textarea('movementGroup',null,['class'=>'form-control','rows'=>2]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
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

        <div class="panel mb0">
            <div class="panel">
                <a href="javascript:;">OFFICE USE ONLY</a>
            </div>
            <div class="panel-body">
                <div class="col-md-12">

                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                                {!! Form::select('role_id',$roles,null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'required'=>'required']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            {!! Form::label('is_active','Active Status',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                                {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'required'=>'required']) !!}
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
                                {!! Form::text('members_id',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group ">
                            {!! Form::label('photo_id','Photo',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-photo"></i></div>
                                {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <button class="btn-primary btn btn-block" type="submit">Update</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::model($user,['method'=>'DELETE','action'=>['National\AnonymousAdminsController@destroy',$user->id],'onsubmit' => 'return ConfirmDelete()',],['class'=>'form-inline'])!!}
                            <button class="btn-danger btn btn-block" type="submit">Delete</button>
                            {!! Form::close() !!}
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
@endsection

