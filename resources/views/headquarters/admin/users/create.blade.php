@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            MEMBERSHIP DATA FORM
        </p>
    </li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
            @include('includes.form_error')
            @include('includes.alert')
    </div>
    {!! Form::open(['method'=>'POST','action'=>'National\AdminUsersController@store','files'=>true,'class'=>'form-row'])!!}
    @include('includes.national.national_head')
    @include('includes.registrationFolder.personal')
    @include('includes.registrationFolder.contact')
    @include('includes.registrationFolder.educationProfession')
    @include('includes.registrationFolder.churchDetails')
    @include('includes.registrationFolder.provisionService')
    @include('includes.national.footer')
    {!! Form::close() !!}
    @include('includes.national_js')
</div>
@endsection

