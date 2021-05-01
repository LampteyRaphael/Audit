
@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            SMS Activation
        </p>
    </li>
@endsection
@section('content')
    @include('includes.alert')

    <div class="panel">
        <div class="panel-body">
            {!! Form::model($post,['method'=>'PUT','action'=>['National\NationalSMSController@update',$post->id],'onsubmit' => 'return searchInfo()'])!!}
            <div class="form-group col-md-6">
                {!! Form::label('is_active','Status',['class'=>'control-label']) !!}
                {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],null,['class'=>'form-control','required'=>'required']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('block','Block Status',['class'=>'control-label']) !!}
                {!! Form::select('block',[1=>'Not Block',0=>'Block'],null,['class'=>'form-control','required'=>'required']) !!}
            </div>
            <div class="form-group pull-right">
                {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

        </div>
        <div class="panel-footer"></div>
    </div>

@endsection



