@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            EDIT  MEMBERSHIP DATA
        </p>
    </li>
@endsection
@section('content')
    <div class="row">
        @include('includes.form_error')
        {!! Form::model($user,['method'=>'PATCH','action'=>['National\AdminEditUsersController@update',$user->id],'files'=>true,'onsubmit' => 'return ConfirmUpdate()',],['class'=>'form-inline'])!!}
        @include('includes.national.national_head')
        @include('includes.updateFolders.personal')
        @include('includes.updateFolders.contact')
        @include('includes.updateFolders.educationProfession')
        @include('includes.updateFolders.churchDetails')
        @include('includes.updateFolders.provisionServices')
        @include('includes.national.localUpdate')
    </div>
    @include('includes.national_js')
@endsection