@extends ('layouts.master_table')
@section('dashboard')
<li>
    <p class="navbar-text">

        {{Carbon\Carbon::now()->format('jS F,Y')}}
    </p>
</li>
@endsection



@section('content')

@include('includes.alert')

@include('includes.form_error')

<div class="row">
    {!! Form::open(['method'=>'POST','action'=>'Locals\PostSundayController@store'])!!}
    <div class="panel">
        <div class="panel-heading">Post sunday contributions to church Account</div>
        <div class="panel-body">
            <div class="form-group ">
                {!! Form::label('offering','Offering Amount (GHS:)',['class'=>'control-label']) !!}
                {!! Form::number('offering',null,['class'=>'form-control','required'=>'required']) !!}
            </div>
            <div class="form-group ">
                {!! Form::label('tithe','Tithe Amount (GHS:)',['class'=>'control-label']) !!}
                {!! Form::number('tithe',null,['class'=>'form-control','required'=>'required']) !!}
            </div>

            <div class="form-group ">
                {!! Form::label('donation','Donations Amount (GHS:)',['class'=>'control-label']) !!}
                {!! Form::number('donation',null,['class'=>'form-control']) !!}
            </div>


            <div class="form-group ">
                {!! Form::label('envelop','Envelop Amount (GHS:)',['class'=>'control-label']) !!}
                {!! Form::number('envelop',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group ">
                {!! Form::label('fundraising','Fundraising Amount (GHS:)',['class'=>'control-label']) !!}
                {!! Form::number('fundraising',null,['class'=>'form-control']) !!}
            </div>

            <div class="form-group ">
                {!! Form::label('typeofevent','Type Of Event(in words)',['class'=>'control-label']) !!}
                {!! Form::text('typeofevent',null,['class'=>'form-control']) !!}
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

