{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            EDIT MEMBERSHIP DATA--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            <a href="{{route('registration.index')}}" class=" btn-info btn-sm">Home</a>--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--          <a href="{{route('localIndividualT',$user->id)}}" class=" btn-info btn-sm">Tithe</a>--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            <a class="btn-success btn-sm" href="{{route('registration.edit',$user->id)}}" onclick="return update()">Edit</a>--}}
{{--        </p>--}}
{{--    </li>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    <div class="row">--}}
@extends('layouts.app', ['activePage' => 'registration', 'titlePage' => __('User Profile')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
            @include('includes.form_error')
            @include('includes.alert')
                  {!! Form::model($user,['method'=>'PATCH','action'=>['Locals\RegisterLocalMembersController@update',$user->id],'files'=>true, 'onsubmit'=>'return ConfirmUpdate()'],['class'=>'form-inline'])!!}
                    <div class="card ">
                        <div class="card-header card-header-image">
                            <p class="card-category">
                            <div class="avatar avatar-sm rounded-circle img-circle" style="width:150px; height:150px;overflow: hidden;">
                                <img src="{{$user->photo? $user->photo->file :asset('images/placeholder.png') }}" alt="" style="max-width: 150px;">
                            </div>
                        </div>
                        <div class="card-body ">
                            @include('includes.localFolder.updateHeader')
                            @include('includes.updateFolders.personal')
                            @include('includes.updateFolders.contact')
                            @include('includes.updateFolders.educationProfession')
                            @include('includes.updateFolders.churchDetails')
                            @include('includes.updateFolders.provisionServices')
                            @include('includes.localFolder.updateFooter')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
//        function _(x) {
//            return  document.getElementById(x);
//        }
//
//        function progressbar(x) {
//            return   _('progressbar').value=x;
//        }
//
//        function message_error(errors,x) {
//            return _(errors).style.display=x;
//        }
//
//        var step2= _('step2').style.display="none";
//        var step3=  _('step3').style.display="none";
//        var step4=  _('step4').style.display="none";
//        var step5=  _('step5').style.display="none";
//        var step6=  _('step6').style.display="none";
//                   _("btn1").style.display="none";
//                   // _('progressbar0').style.display="none";
//        progressbar(17);
//        message_error("progressbar","block");
//
//        var btn2 =_('btn2');
//
//        function  step1Function(){
//            if (_('name').value ===""){
//                _('name_error').innerHTML="Username is required *";
//                message_error('name_error','block');
//                message_error('name_error2','none');
//                return false;
//            }
//            else if(_('gender').value===""){
//                _('name_error').innerHTML="Gender field is required *";
//                message_error('name_error','block');
//                return false;
//
//            } else if(_('birthDate').value===""){
//                _('name_error').innerHTML="Date Of Birth field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//            else if(_('placeOfBirth').value==="" || _('placeOfBirth').value==null){
//                _('name_error').innerHTML="Place Of Birth field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//            else if(_('hometown').value===""){
//                _('name_error').innerHTML="Home town field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//            else if(_('hometown_region').value===""){
//                _('name_error').innerHTML="Home town region field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//            else if(_('nationality').value===""){
//                _('name_error').innerHTML="Nationality field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else if(_('languagess').value===""){
//                _('name_error').innerHTML="Language(s) Spoken field is required * (example: twi,english) maximum 5";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else if(_('maritalStatus').value===""){
//                _('name_error').innerHTML="Marital Status field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else if(_('maritalStatus').value===""){
//                _('name_error').innerHTML="Marital Status field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else if(_('numberOfChildren').value===""){
//                _('name_error').innerHTML="Number of children field is required *(if none put zero(0))";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else if(_('fathers_name').value===""){
//                _('name_error').innerHTML="Name of father field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else if(_('fathers_hometown').value===""){
//                _('name_error').innerHTML="father's home town field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else if(_('mothers_name').value===""){
//                _('name_error').innerHTML="Name of mother field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else if(_('mothers_hometown').value===""){
//                _('name_error').innerHTML="mother's home town field is required *";
//                message_error('name_error','block');
//                return false;
//            }
//
//            else{
//                _('step2').style.display="block";
//                _('step1').style.display="none";
//                progressbar(34);
//                message_error('name_error2','none');
//                return false;
//            }
//
//        }
//
//        function  step2BackFunction(){
//            _('step2').style.display="none";
//            _('step1').style.display="block";
//            progressbar(17);
//            message_error('name_error','none');
//            return false;
//        }
//
//        function  step2NextFunction(){
//            _('step2').style.display = "none";
//            _('step3').style.display = "block";
//            progressbar(51);
//            return false;
//        }
//
//        function  step3BackFunction(){
//            _('step3').style.display="none";
//            _('step2').style.display="block";
//            message_error('name_error2','none');
//            progressbar(34);
//            message_error('name_error3','none');
//            return false;
//        }
//
//        function  step3NextFunction(){
//            if(_('education').value==="")
//            {
//                _('name_error3').innerHTML="The educational level field is required *";
//                message_error('name_error3','block');
//                return false;
//            }
//            else if (_('employmentType').value==="") {
//                _('name_error3').innerHTML="The employment type field is required *";
//                message_error('name_error3','block');
//                return false;
//            }
//            else{
//                _('step3').style.display = "none";
//                _('step4').style.display = "block";
//                progressbar(68);
//                return false;
//            }
//        }
//
//        function step4BackFunction() {
//            _('step4').style.display="none";
//            _('step3').style.display="block";
//            progressbar(51);
//            message_error('name_error3','none');
//            message_error('name_error4', 'none');
//            return false;
//        }
//
//        function step4NextFunction() {
//            if (_('waterBaptism').value === "") {
//                _('name_error4').innerHTML = "Water Baptism field is required *";
//                message_error('name_error4', 'block');
//                return false;
//            }else
//
//            if (_('rightHandOfFellowship').value === "") {
//                _('name_error4').innerHTML = "Right hand of fellowship field is required *";
//                message_error('name_error4', 'block');
//                return false;
//            }else
//
//            if (_('communicant').value === "") {
//                _('name_error4').innerHTML = "Communicant field is required *";
//                message_error('name_error4', 'block');
//                return false;
//            }else
//
//            if (_('holySpiritBaptism').value === "") {
//                _('name_error4').innerHTML = "Holy Spirit Baptism field is required *";
//                message_error('name_error4', 'block');
//                return false;
//            }else
//
//            if (_('anySpiritualGift').value === "") {
//                _('name_error4').innerHTML = "Any spiritual gift field is required *";
//                message_error('name_error4', 'block');
//                return false;
//            }else
//
//            if (_('officeHeld').value === "") {
//                _('name_error4').innerHTML = "The office held field is required *";
//                message_error('name_error4', 'block');
//                return false;
//            }
//
//            else{
//                _('step4').style.display = "none";
//                _('step6').style.display = "none";
//                _('step5').style.display = "block";
//                progressbar(85);
//                return false;
//            }
//
//        }
//
//
//        function step5BackFunction() {
//            _('step5').style.display="none";
//            _('step4').style.display="block";
//            message_error('name_error4', 'none');
//            progressbar(68);
//            return false;
//        }
//
//        function step5NextFunction() {
//            _('step5').style.display="none";
//            _('step6').style.display="block";
//            progressbar(100);
//            return false;
//        }
//
//        function step6BackFunction() {
//            _('step6').style.display="none";
//            _('step5').style.display="block";
//            message_error('name_error5', 'none');
//            progressbar(85);
//            return false;
//        }
//
//        function submitFunction() {
//            if (_('password').value===""){
//                _('name_error5').innerHTML="Password is required *";
//                message_error('name_error5', 'block');
//                return false;
//            }else
//            if(_('members_id').value===""){
//                _('name_error5').innerHTML="Membership ID is required *";
//                message_error('name_error5', 'block');
//                return false;
//            }
//        }

        function myFunction() {
            var x=document.getElementById('myInput');

            if (x.type==="password"){
                x.type="text";
            }else {
                x.type="password";
            }
        }
        function ConfirmDelete() {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmUpdate() {
            var x = confirm("Are you sure you want to update?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection
