{{--@extends ('layouts.master_table')--}}

{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            CHILDREN DATA FORM--}}
{{--        </p>--}}
{{--    </li>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <script>--}}

{{--        function ConfirmDelete()--}}
{{--        {--}}
{{--            var x = confirm("Are you sure you want to Post?");--}}
{{--            if (x)--}}
{{--                return true;--}}
{{--            else--}}
{{--                return false;--}}
{{--        }--}}

{{--    </script>--}}
@extends('layouts.app', ['activePage' => 'deceased', 'titlePage' => __('Deceased')])
@section('content')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Children Ministry</h4>
                            <p class="card-category">Children You Lost In Your Assembly</p>
                        </div>
                        <div class="card-body">
        @include('includes.alert')
        @include('includes.form_error')
        {!! Form::open(['method'=>'POST','action'=>'Locals\ChildrenMinistryAtLocalController@store','files'=>true,'class'=>'form-row', 'onsubmit'=>'return ConfirmDelete()'])!!}
        <div class="panel mb0 hidden">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <span style="color: red">*</span> is compulsory
                </li>
                <li>
                    <a href="javascript:;">LOCATION</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="col-sm-6">
                <div class="form-group ">
                    {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                        {!! Form::select('region_id',$regions,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group ">
                    {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                        {!! Form::select('area_id',$areas,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group ">
                    {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                        {!! Form::select('district_id',$districts,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('local_id','Local',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                        {!! Form::select('local_id',$locals,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="panel mb0" id="step1">
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
                        {!! Form::text('name',null,['class'=>'form-control','required'=>'required','placeholder'=>'FirstName/Middle Name/Surname']) !!}
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
                            {!! Form::select('gender',[''=>'--Choose Option--','male'=>'Male','female'=>'Female'],null,['id'=>'gender','class'=>'form-control','required'=>'required']) !!}
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
                        {!! Form::date('birthDate',null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
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
                        {!! Form::select('hometown_region',[''=>'--Choose Option--']+$home_regions,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group">
                    {!! Form::label('nationality','Nationality',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="dropdown-menu">
                        <select id="nationality" name="nationality" class="form-control dropdown">
                            <option value="">-- select one --</option>
                            <option value="afghan">Afghan</option>
                            <option value="albanian">Albanian</option>
                            <option value="algerian">Algerian</option>
                            <option value="american">American</option>
                            <option value="andorran">Andorran</option>
                            <option value="angolan">Angolan</option>
                            <option value="antiguans">Antiguans</option>
                            <option value="argentinean">Argentinean</option>
                            <option value="armenian">Armenian</option>
                            <option value="australian">Australian</option>
                            <option value="austrian">Austrian</option>
                            <option value="azerbaijani">Azerbaijani</option>
                            <option value="bahamian">Bahamian</option>
                            <option value="bahraini">Bahraini</option>
                            <option value="bangladeshi">Bangladeshi</option>
                            <option value="barbadian">Barbadian</option>
                            <option value="barbudans">Barbudans</option>
                            <option value="batswana">Batswana</option>
                            <option value="belarusian">Belarusian</option>
                            <option value="belgian">Belgian</option>
                            <option value="belizean">Belizean</option>
                            <option value="beninese">Beninese</option>
                            <option value="bhutanese">Bhutanese</option>
                            <option value="bolivian">Bolivian</option>
                            <option value="bosnian">Bosnian</option>
                            <option value="brazilian">Brazilian</option>
                            <option value="british">British</option>
                            <option value="bruneian">Bruneian</option>
                            <option value="bulgarian">Bulgarian</option>
                            <option value="burkinabe">Burkinabe</option>
                            <option value="burmese">Burmese</option>
                            <option value="burundian">Burundian</option>
                            <option value="cambodian">Cambodian</option>
                            <option value="cameroonian">Cameroonian</option>
                            <option value="canadian">Canadian</option>
                            <option value="cape verdean">Cape Verdean</option>
                            <option value="central african">Central African</option>
                            <option value="chadian">Chadian</option>
                            <option value="chilean">Chilean</option>
                            <option value="chinese">Chinese</option>
                            <option value="colombian">Colombian</option>
                            <option value="comoran">Comoran</option>
                            <option value="congolese">Congolese</option>
                            <option value="costa rican">Costa Rican</option>
                            <option value="croatian">Croatian</option>
                            <option value="cuban">Cuban</option>
                            <option value="cypriot">Cypriot</option>
                            <option value="czech">Czech</option>
                            <option value="danish">Danish</option>
                            <option value="djibouti">Djibouti</option>
                            <option value="dominican">Dominican</option>
                            <option value="dutch">Dutch</option>
                            <option value="east timorese">East Timorese</option>
                            <option value="ecuadorean">Ecuadorean</option>
                            <option value="egyptian">Egyptian</option>
                            <option value="emirian">Emirian</option>
                            <option value="equatorial guinean">Equatorial Guinean</option>
                            <option value="eritrean">Eritrean</option>
                            <option value="estonian">Estonian</option>
                            <option value="ethiopian">Ethiopian</option>
                            <option value="fijian">Fijian</option>
                            <option value="filipino">Filipino</option>
                            <option value="finnish">Finnish</option>
                            <option value="french">French</option>
                            <option value="gabonese">Gabonese</option>
                            <option value="gambian">Gambian</option>
                            <option value="georgian">Georgian</option>
                            <option value="german">German</option>
                            <option value="ghanaian">Ghanaian</option>
                            <option value="greek">Greek</option>
                            <option value="grenadian">Grenadian</option>
                            <option value="guatemalan">Guatemalan</option>
                            <option value="guinea-bissauan">Guinea-Bissauan</option>
                            <option value="guinean">Guinean</option>
                            <option value="guyanese">Guyanese</option>
                            <option value="haitian">Haitian</option>
                            <option value="herzegovinian">Herzegovinian</option>
                            <option value="honduran">Honduran</option>
                            <option value="hungarian">Hungarian</option>
                            <option value="icelander">Icelander</option>
                            <option value="indian">Indian</option>
                            <option value="indonesian">Indonesian</option>
                            <option value="iranian">Iranian</option>
                            <option value="iraqi">Iraqi</option>
                            <option value="irish">Irish</option>
                            <option value="israeli">Israeli</option>
                            <option value="italian">Italian</option>
                            <option value="ivorian">Ivorian</option>
                            <option value="jamaican">Jamaican</option>
                            <option value="japanese">Japanese</option>
                            <option value="jordanian">Jordanian</option>
                            <option value="kazakhstani">Kazakhstani</option>
                            <option value="kenyan">Kenyan</option>
                            <option value="kittian and nevisian">Kittian and Nevisian</option>
                            <option value="kuwaiti">Kuwaiti</option>
                            <option value="kyrgyz">Kyrgyz</option>
                            <option value="laotian">Laotian</option>
                            <option value="latvian">Latvian</option>
                            <option value="lebanese">Lebanese</option>
                            <option value="liberian">Liberian</option>
                            <option value="libyan">Libyan</option>
                            <option value="liechtensteiner">Liechtensteiner</option>
                            <option value="lithuanian">Lithuanian</option>
                            <option value="luxembourger">Luxembourger</option>
                            <option value="macedonian">Macedonian</option>
                            <option value="malagasy">Malagasy</option>
                            <option value="malawian">Malawian</option>
                            <option value="malaysian">Malaysian</option>
                            <option value="maldivan">Maldivan</option>
                            <option value="malian">Malian</option>
                            <option value="maltese">Maltese</option>
                            <option value="marshallese">Marshallese</option>
                            <option value="mauritanian">Mauritanian</option>
                            <option value="mauritian">Mauritian</option>
                            <option value="mexican">Mexican</option>
                            <option value="micronesian">Micronesian</option>
                            <option value="moldovan">Moldovan</option>
                            <option value="monacan">Monacan</option>
                            <option value="mongolian">Mongolian</option>
                            <option value="moroccan">Moroccan</option>
                            <option value="mosotho">Mosotho</option>
                            <option value="motswana">Motswana</option>
                            <option value="mozambican">Mozambican</option>
                            <option value="namibian">Namibian</option>
                            <option value="nauruan">Nauruan</option>
                            <option value="nepalese">Nepalese</option>
                            <option value="new zealander">New Zealander</option>
                            <option value="ni-vanuatu">Ni-Vanuatu</option>
                            <option value="nicaraguan">Nicaraguan</option>
                            <option value="nigerien">Nigerien</option>
                            <option value="north korean">North Korean</option>
                            <option value="northern irish">Northern Irish</option>
                            <option value="norwegian">Norwegian</option>
                            <option value="omani">Omani</option>
                            <option value="pakistani">Pakistani</option>
                            <option value="palauan">Palauan</option>
                            <option value="panamanian">Panamanian</option>
                            <option value="papua new guinean">Papua New Guinean</option>
                            <option value="paraguayan">Paraguayan</option>
                            <option value="peruvian">Peruvian</option>
                            <option value="polish">Polish</option>
                            <option value="portuguese">Portuguese</option>
                            <option value="qatari">Qatari</option>
                            <option value="romanian">Romanian</option>
                            <option value="russian">Russian</option>
                            <option value="rwandan">Rwandan</option>
                            <option value="saint lucian">Saint Lucian</option>
                            <option value="salvadoran">Salvadoran</option>
                            <option value="samoan">Samoan</option>
                            <option value="san marinese">San Marinese</option>
                            <option value="sao tomean">Sao Tomean</option>
                            <option value="saudi">Saudi</option>
                            <option value="scottish">Scottish</option>
                            <option value="senegalese">Senegalese</option>
                            <option value="serbian">Serbian</option>
                            <option value="seychellois">Seychellois</option>
                            <option value="sierra leonean">Sierra Leonean</option>
                            <option value="singaporean">Singaporean</option>
                            <option value="slovakian">Slovakian</option>
                            <option value="slovenian">Slovenian</option>
                            <option value="solomon islander">Solomon Islander</option>
                            <option value="somali">Somali</option>
                            <option value="south african">South African</option>
                            <option value="south korean">South Korean</option>
                            <option value="spanish">Spanish</option>
                            <option value="sri lankan">Sri Lankan</option>
                            <option value="sudanese">Sudanese</option>
                            <option value="surinamer">Surinamer</option>
                            <option value="swazi">Swazi</option>
                            <option value="swedish">Swedish</option>
                            <option value="swiss">Swiss</option>
                            <option value="syrian">Syrian</option>
                            <option value="taiwanese">Taiwanese</option>
                            <option value="tajik">Tajik</option>
                            <option value="tanzanian">Tanzanian</option>
                            <option value="thai">Thai</option>
                            <option value="togolese">Togolese</option>
                            <option value="tongan">Tongan</option>
                            <option value="trinidadian or tobagonian">Trinidadian or Tobagonian</option>
                            <option value="tunisian">Tunisian</option>
                            <option value="turkish">Turkish</option>
                            <option value="tuvaluan">Tuvaluan</option>
                            <option value="ugandan">Ugandan</option>
                            <option value="ukrainian">Ukrainian</option>
                            <option value="uruguayan">Uruguayan</option>
                            <option value="uzbekistani">Uzbekistani</option>
                            <option value="venezuelan">Venezuelan</option>
                            <option value="vietnamese">Vietnamese</option>
                            <option value="welsh">Welsh</option>
                            <option value="yemenite">Yemenite</option>
                            <option value="zambian">Zambian</option>
                            <option value="zimbabwean">Zimbabwean</option>
                        </select>

                        {{--{!! Form::text('nationality',null,['class'=>'form-control','required'=>'required']) !!}--}}
                    </div>
                </div>
            </div>


            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('languagess','Language(s) Spoken',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('languagess[]',$languages,null,['id'=>'languagess',
                        'class'=>'form-control'
                        ]) !!}
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
                        {!! Form::text('mothers_name',null,['class'=>'form-control']) !!}
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
        </div>
    </div>
    {{--Ending of Guardians--}}


    {{--Church Details--}}
    <div class="panel mb0" id="step4">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">CHURCH DETAILS</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">

            <div class="col-sm-4">
                <div class="form-group ">
                    {!! Form::label('datejoinchurch','Date Join The Church(specifically the year)',['class'=>'control-label bold']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {!! Form::date('datejoinchurch',null,['class'=>'form-control']) !!}
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
                    {!! Form::label('baptismDate','Date Of Baptism',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {!! Form::date('baptismDate',null,['class'=>'form-control']) !!}
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

            <div class="col-sm-4 hidden">
                <div class="form-group">
                    {!! Form::label('officeHeld','Office Held',['class'=>'control-label bold']) !!}
                    <span style="color: red">*</span>
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('officeHeld',[''=>'--Choose Option--', 'apostle'=>'Apostle','pastor'=>'Pastor',
                               'elder'=>'Elder','deacon'=>'Deacon','deaconess'=>'Deaconess','member'=>'Member','children ministry'=>'Children Ministry','new convert'=>'New Convert'
                        ],'children ministry',['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="panel mb0" id="step6">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">OFFICE USE ONLY</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="col-sm-12">

                <div class="col-sm-4 hidden">
                    <div class="form-group ">
                        {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 hidden">
                    <div class="form-group ">
                        {!! Form::label('is_active','Active Status',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('is_active',[''=>'--Choose Option--',1=>'Active',0=>'Not Active'],1,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('photo_id','Photo',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-photo"></i></div>
                            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('password','Password',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            {!! Form::password('password',['class'=>'form-control','required'=>'required','id'=>'myInput']) !!}
                            <div class="input-group-addon"><input type="checkbox"  onclick="myFunction()">Show
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-4 hidden">
                    <div class="form-group">
                        {!! Form::label('members_id','Membership ID',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-secret"></i></div>
                            {!! Form::number('members_id',random_int(700,999),['class'=>'form-control','required'=>'required', 'placeholder'=>$membershipId . "+3-digit only" ]) !!}
                        </div>
                    </div>
                </div>


                <div class=" pull-right">
                    <div class="form-group ">
                        {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

    {{--<script>--}}
        {{--$.notify({--}}
            {{--// options--}}
            {{--icon: 'glyphicon glyphicon-warning-sign',--}}
            {{--title: 'Hello! Admin,',--}}
            {{--message: 'Greetings from TAC-HQ(IT Department).We want to inform you that the registration form has not been change. we only compressed it. ' +--}}
                {{--'Some of the input form has been taken out since the system will automatically fill them for you. Like your region,area,district and local. '+--}}
                    {{--' Every Registered Member is automatically Active and also  a member'+--}}

                {{--'Thank you',--}}
            {{--target: '_blank'--}}
        {{--},{--}}
            {{--// settings--}}
            {{--element: 'body',--}}
            {{--position: null,--}}
            {{--type: "danger",--}}
            {{--allow_dismiss: true,--}}
            {{--newest_on_top: false,--}}
            {{--showProgressbar: false,--}}
            {{--placement: {--}}
                {{--from: "top",--}}
                {{--align: "right"--}}
            {{--},--}}
            {{--offset: 20,--}}
            {{--spacing: 10,--}}
            {{--z_index: 1031,--}}
            {{--delay: 10000,--}}
            {{--timer: 10000,--}}
            {{--url_target: '_blank',--}}
            {{--mouse_over: null,--}}
            {{--animate: {--}}
                {{--enter: 'animated fadeInDown',--}}
                {{--exit: 'animated fadeOutUp'--}}
            {{--},--}}
            {{--onShow: null,--}}
            {{--onShown: null,--}}
            {{--onClose: null,--}}
            {{--onClosed: null,--}}
            {{--icon_type: 'class',--}}
            {{--template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +--}}
                {{--'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +--}}
                {{--'<span data-notify="icon"></span> ' +--}}
                {{--'<span data-notify="title">{1}</span> ' +--}}
                {{--'<span data-notify="message">{2}</span>' +--}}
                {{--'<div class="progress" data-notify="progressbar">' +--}}
                {{--'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +--}}
                {{--'</div>' +--}}
                {{--'<a href="{3}" target="{4}" data-notify="url"></a>' +--}}
                {{--'</div>'--}}
        {{--});--}}
    {{--</script>--}}
    <script>

        function myFunction() {
            var x=document.getElementById('myInput');

            if (x.type==="password"){
                x.type="text";
            }else {
                x.type="password";
            }
        }

        // $("#step2").show();
        // $("#step3").hide();
        // $("#step4").hide();
        // $("#step5").hide();
        // $("#step6").hide();

        //
        // $("#name").keydown(function () {
        //     if ((this).val() !==""){
        //
        //         $("#step3").show();
        //     }
        // });
    </script>
@endsection



