<div class="col-md-10 col-md-offset-1">
<div class="panel shadow mb0" id="step1">
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
        <ul class="nav">
            <li><span id="name_error" class="text text-danger bold "></span></li>
        </ul>
        <div class="col-sm-4">
            <div class="form-group clear">
                {!! Form::label('name','Full Name',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'FirstName/Middle Name/Surname']) !!}
                </div>

            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group clear">
                {!! Form::label('gender','Gender',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-genderless"></i></div>
                    {!! Form::select('gender',[''=>'--Choose Option--','male'=>'Male','female'=>'Female'],null,['class'=>'form-control']) !!}
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
                    {!! Form::date('birthDate',null,['class'=>'form-control','Placeholder'=>'YY-mm-dd']) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group clear">
                {!! Form::label('placeOfBirth','Place Of Birth',['class'=>'control-label']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    {!! Form::text('placeOfBirth',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group ">
                {!! Form::label('hometown','Hometown',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    {!! Form::text('hometown',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group ">
                {!! Form::label('hometown_region','Home Town Region',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                    {!! Form::text('hometown_region',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group ">
                {!! Form::label('nationality','Nationality',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>


                    {!! Form::select('nationality',[''=>'--Choose Options--']+nationality(),null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="form-group ">
                {!! Form::label('languagess','Language(s) Spoken(eg.twi,english) maximum 5',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                    {!! Form::text('languagess',null,['class'=>'form-control']) !!}
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

                    ],null,['class'=>'form-control']) !!}
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
                    {!! Form::number('numberOfChildren',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group ">
                {!! Form::label('fathers_name',' Name Of Father',['class'=>'control-label']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    {!! Form::text('fathers_name',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group ">
                {!! Form::label('fathers_hometown','Father\'s Hometown',['class'=>'control-label']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    {!! Form::text('fathers_hometown',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group ">
                {!! Form::label('mothers_name',' Name Of Mother',['class'=>'control-label']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    {!! Form::text('mothers_name',null,['class'=>'form-control','id'=>'mothers_name']) !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group ">
                {!! Form::label('mothers_hometown','Mother\'s  Hometown',['class'=>'control-label']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    {!! Form::text('mothers_hometown',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <button id="btn2" class="btn btn-primary pull-right" onclick="step1Function();">Continue</button>
            <button id="btn1" class="btn btn-danger pull-right" onclick="step0BackFunction();">Back</button>
        </div>

    </div>
</div>
</div>
{{--Ending of Guardians--}}
{{--CONTACT INFORMATION--}}
<div class="col-md-10 col-md-offset-1">
    <div class="panel shadow mb0" id="step2">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">CONTACT INFORMATION</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <ul class="nav">
                <li><span id="name_error2" class="text text-danger bold "></span></li>
            </ul>
            <div class="">
                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('digitalAddress','Digital Address',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                            {!! Form::text('digitalAddress',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('houseaddress','House NO',['class'=>'control-label bold']) !!}
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                                {!! Form::text('houseaddress',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('streetname','Street Name',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('streetname',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('landmark','Landmark',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('landmark',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('mobileNumber1','Mobile Number1',['class'=>'control-label bold']) !!} <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                        {!! Form::text('mobileNumber1',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('mobileNumber2','Mobile Number2',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                        {!! Form::text('mobileNumber2',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('workNumber','Work Number',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                        {!! Form::text('workNumber',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('whatsappNumber','WhatsApp No',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-whatsapp"></i></div>
                        {!! Form::text('whatsappNumber',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('email','Email',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-mail-forward"></i></div>
                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <button id="btn4" class="btn btn-primary pull-right" onclick="step2NextFunction()">Continue</button>
            <button id="btn3" class="btn btn-danger pull-right" onclick="step2BackFunction()">Back</button>

        </div>
    </div>
</div>
{{-- EDUCATION AND PROFESSION--}}
<div class="col-md-10 col-md-offset-1">
    <div class="panel shadow mb0" id="step3">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">EDUCATION & PROFESSION</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <ul class="nav">
                <li><span id="name_error3" class="text text-danger bold "></span></li>
            </ul>
            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('education','Level Of Education',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('education',[''=>'--Choose Option--',
                        'non'=>'Non',
                        'basic'=>'Basic',
                        'vocational'=>'Vocational',
                        'secondary'=>'Secondary',
                        'o level'=>'O Level',
                        'tertiary'=>'Tertiary'],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('courseStudied','Course Studied',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::text('courseStudied',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('employmentType','Employment Type',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('employmentType',
                        [''=>'--Choose Option--',
                         'self employed'=>'Self Employed',
                         'government'=>'Government',
                         'private sector'=>'Private Sector',
                         'student'=>'Student',
                         'unemployed'=>'Unemployed',
                         'retired'=>'Retired'
                        ],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('profOccupation','Profession/Occupation',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::text('profOccupation',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('placeOfWork','Place Of Work',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                        {!! Form::text('placeOfWork',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <button id="btn5" class="btn btn-primary pull-right" onclick="step3NextFunction()">Continue</button>
                <button id="btn6" class="btn btn-danger pull-right" onclick="step3BackFunction()">Back</button>
            </div>
        </div>
    </div>
</div>
{{--Church Details--}}
<div class="col-md-10 col-md-offset-1">
    <div class="panel shadow mb0" id="step4">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">CHURCH DETAILS</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <ul class="nav">
                <li><span id="name_error4" class="text text-danger bold "></span></li>
            </ul>
            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('datejoinchurch','Date Join The Church(specifically the year( YY-mm-dd))',['class'=>'control-label bold']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {!! Form::date('datejoinchurch',null,['class'=>'form-control','placeholder'=>'YY-mm-dd)']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('previousdenomination','Previous Denomination',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                        {!! Form::text('previousdenomination',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('waterBaptism','Water Baptism',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('waterBaptism',[''=>'--Choose Option--', 'yes'=>'Yes','no'=>'No'],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('baptismBy','Baptised By',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::text('baptismBy',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('baptismDate','Date Of Baptism (YY-mm-dd)',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {!! Form::date('baptismDate',null,['class'=>'form-control','placeholder'=>'YY-mm-dd)']) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('baptismLocality','Place Of Baptism',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-location-arrow"></i></div>
                        {!! Form::text('baptismLocality',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('rightHandOfFellowship','Right Hand Of Fellowship',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('rightHandOfFellowship',[''=>'Choose Option','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('communicant','Communicant',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('communicant',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('holySpiritBaptism','Holy Spirit Baptism',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('holySpiritBaptism',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('anySpiritualGift','Any Spiritual Gift(s)',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('anySpiritualGift',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('pleaseIndicate','Please Indicate Any Spiritual Gift(s)',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::text('pleaseIndicate',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>



            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('officeHeld','Office Held',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('officeHeld',[''=>'--Choose Option--', 'apostle'=>'Apostle','pastor'=>'Pastor','entrant'=>'Entrant',
                               'elder'=>'Elder','presiding elder'=>'Presiding Elder','deacon'=>'Deacon','deaconess'=>'Deaconess','member'=>'Member','new convert'=>'New Convert'
                        ],null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('ordainedBy','Ordained By',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::text('ordainedBy',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('dateOrdained','Date Ordained (YY-mm-dd)',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {!! Form::date('dateOrdained',null,['class'=>'form-control','placeholder'=>'YY-mm-dd)']) !!}
                    </div>
                </div>
            </div>

            <button id="btn7" class="btn btn-primary pull-right" onclick="step4NextFunction()">Continue</button>
            <button id="btn8" class="btn btn-danger pull-right" onclick="step4BackFunction()">Back</button>

        </div>
    </div>
</div>

<div class="col-md-10 col-md-offset-1">
    <div class="panel shadow mb0" id="step5">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">POSITION/SERVICE IN THE CHURCH</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <div class="form-group ">
                        {!! Form::label('movementGroup','Movement/Group',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
                            {!! Form::textarea('movementGroup',null,['class'=>'form-control','rows'=>2,'id'=>'moreform']) !!}
                        </div>
                    </div>
                </div>


                <div class="col-sm-6">
                    <div class="form-group ">
                        {!! Form::label('position','Position/Service In The Church',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>
                            {!! Form::textarea('position',null,['class'=>'form-control','rows'=>2]) !!}
                        </div>
                    </div>
                </div>

                <button id="btn9" class="btn btn-primary pull-right" onclick="step5NextFunction()">Next</button>
                <button id="btn10" class="btn btn-danger pull-right" onclick="step5BackFunction()">Back</button>

            </div>
        </div>
    </div>
</div>


{{--<div class="col-md-10 col-md-offset-1">--}}
{{--    <div class="panel mb0" id="step6">--}}
{{--        <div class="panel-heading border">--}}
{{--            <ol class="breadcrumb mb0 no-padding">--}}
{{--                <li>--}}
{{--                    <a href="javascript:;">OFFICE USE ONLY</a>--}}
{{--                </li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--        <div class="panel-body">--}}
{{--            <ul class="nav">--}}
{{--                <li><span id="name_error5" class="text text-danger bold "></span></li>--}}
{{--            </ul>--}}
{{--            <div class="col-sm-12">--}}

{{--                <div class="col-sm-4">--}}
{{--                    <div class="form-group ">--}}
{{--                        {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}--}}
{{--                        <span style="color: red">*</span>--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>--}}
{{--                            {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-md-4 hidden">--}}
{{--                    <div class="form-group ">--}}
{{--                        {!! Form::label('is_active','Active Status',['class'=>'control-label bold']) !!}--}}
{{--                        <span style="color: red">*</span>--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>--}}
{{--                            {!! Form::select('is_active',[''=>'--Choose Option--',1=>'Active',0=>'Non Active'],1,['class'=>'form-control']) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-4">--}}
{{--                    <div class="form-group ">--}}
{{--                        {!! Form::label('password','Password',['class'=>'control-label bold']) !!}--}}
{{--                        <div class="input-group">--}}
{{--                            {!! Form::password('password',['class'=>'form-control','required'=>'required','id'=>'myInput']) !!}--}}
{{--                            <div class="input-group-addon"><input type="checkbox"  onclick="myFunction()">Show--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                <div class="col-sm-4">--}}
{{--                    <div class="form-group ">--}}
{{--                        {!! Form::label('members_id','Membership ID',['class'=>'control-label bold']) !!}--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-addon"><i class="fa fa-user-secret"></i></div>--}}
{{--                            {!! Form::number('members_id',null,['class'=>'form-control','required'=>'required', 'placeholder'=>$membershipId . "+3-digit only" ]) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-12">--}}
{{--                    <div class="form-group ">--}}
{{--                        {!! Form::label('photo_id','Photo',['class'=>'control-label']) !!}--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-addon"><i class="fa fa-photo"></i></div>--}}
{{--                            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="pull-right">--}}
{{--                    <div class="form-group ">--}}
{{--                        <button id="btn11" class="btn btn-danger" onclick="step6BackFunction()">Back</button>--}}
{{--                        {!! Form::submit('submit',['class'=>'btn btn-primary','id'=>'submit','onclick'=>'submitFunction()']) !!}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</div>--}}

