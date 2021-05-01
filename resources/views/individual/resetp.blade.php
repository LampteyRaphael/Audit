@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Password Reset
        </p>
    </li>
@endsection
@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    <div class="row">
        {{--{!! Form::open(['method'=>'POST','action'=>'individualCircularController@store4']) !!}--}}
        <div class="panel">
            <div class="panel-heading">Change Of Password</div>
            <div class="panel-body">

                <div class="form-group">
                    {!! Form::label('password','Old Password',['class'=>'control-label']) !!}
                    {!! Form::text('password',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('new_password','New Password',['class'=>'control-label']) !!}

                    {!! Form::text('new_password',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('confirm_password','Confirm Password',['class'=>'control-label']) !!}

                    {!! Form::text('confirm_password',null,['class'=>'form-control']) !!}
                </div>

            </div>
            <div class="panel-footer">
                {!! Form::submit('submit',['class'=>'btn btn-primary btn-block']) !!}
            </div>

        </div>
        {!! Form::close() !!}
    </div>
@endsection

