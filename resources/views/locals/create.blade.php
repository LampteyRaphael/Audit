@extends('layouts.app', ['activePage' => 'nonactive5', 'titlePage' => __('Add Members')])
@section('content')
<div class="content">
    <div class="container-fluid">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Membership Data Form</h4>
                        <p class="card-category"> Register Your Church Members Here</p>
                    </div>
                    <div class="card-body">
                        @include('includes.alert')
                        @include('includes.form_error')
    {!! Form::open(['method'=>'POST','action'=>'Locals\RegisterLocalMembersController@store','files'=>true, 'onsubmit'=>'return ConfirmDelete()'])!!}
        @include('includes.localFolder.local_head')
        @include('includes.registrationFolder.personal')
        @include('includes.registrationFolder.contact')
        @include('includes.registrationFolder.educationProfession')
        @include('includes.registrationFolder.churchDetails')
        @include('includes.registrationFolder.provisionService')
        @include('includes.localFolder.localFooter')
    {!! Form::close() !!}


</div>
</div>
</div>
</div>
</div>
@include('includes.form_js')
@endsection



