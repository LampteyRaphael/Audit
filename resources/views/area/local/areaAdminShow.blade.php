@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text">
            ADMINS
        </p>
    </li>
    <li>
        <p class="navbar-text">
            <a href="" class=" btn-info btn-sm">Home</a>
        </p>
    </li>
    {{--<li>--}}
        {{--<p class="navbar-text">--}}
            {{--<a href="{{route('localIndividualT',$user->id)}}" class=" btn-info btn-sm">Tithe</a>--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text">--}}
            {{--<a class="btn-success btn-sm" href="{{route('registration.edit',$user->id)}}" onclick="return update()">Edit</a>--}}
        {{--</p>--}}
    {{--</li>--}}

@endsection

@section('content')
    <div class="row">

        {!! Form::model($user,['method'=>'PUT','action'=>['Area\AreaAdminsController@update',$user->id],'files'=>true,'onsubmit' => 'return ConfirmUpdate()'],['class'=>'form-inline'])!!}
        @include('includes.national.national_head')
        @include('includes.updateFolders.personal')
        @include('includes.updateFolders.contact')
        @include('includes.updateFolders.educationProfession')
        @include('includes.updateFolders.churchDetails')
        @include('includes.updateFolders.provisionServices')
        @include('includes.areaFolder.adminsUpdate')
    </div>
    @include('includes.national_js')

@endsection

