@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text">
            EDIT MEMBERSHIP DATA
        </p>
    </li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('includes.form_error')
            @include('includes.alert')
        </div>
        {!! Form::model($user,['method'=>'PATCH','action'=>['Area\AreaUsersUpdatingController@update',$user->id],'files'=>true,'onsubmit'=>'return ConfirmUpdate()'],['class'=>'form-inline'])!!}
        @include('includes.national.national_head')
        @include('includes.updateFolders.personal')
        @include('includes.updateFolders.contact')
        @include('includes.updateFolders.educationProfession')
        @include('includes.updateFolders.churchDetails')
        @include('includes.updateFolders.provisionServices')
        @include('includes.areaFolder.updateFooter')
    </div>
    @include('includes.national_js')
@endsection