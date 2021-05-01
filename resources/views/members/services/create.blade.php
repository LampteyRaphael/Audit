@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Church Generated Fund
        </p>
    </li>
@endsection



@section('content')

    @include('includes.form_error')
    @include('includes.alert')

    <div class="row">
        {!! Form::open(['method'=>'POST','action'=>'Locals\PostServicesController@store'])!!}
        <div class="panel">
            <div class="panel-heading">Post Generated fund</div>
            <div class="panel-body">

                <div class="form-group">
                    {!! Form::label('generatedfund','State the type of generated fund',['class'=>'control-label']) !!}
                    {!! Form::text('generatedfund',null,['class'=>'form-control','required'=>'required']) !!}
                </div>

                <div class="form-group ">
                    {!! Form::label('amount','Amount (GHS:)',['class'=>'control-label']) !!}
                    {!! Form::number('amount',null,['class'=>'form-control','required'=>'required']) !!}
                </div>

                <div class="form-group ">
                    {!! Form::hidden('local_id','local id',['class'=>'control-label']) !!}
                    {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control']) !!}
                </div>

            </div>
            <div class="panel-footer">{!! Form::submit('submit',['class'=>'btn btn-primary']) !!}</div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection

