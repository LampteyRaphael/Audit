@extends('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Search Attendance
        </p>
    </li>
@endsection
@section('content')

    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            {!! Form::open(['method'=>'POST','action'=>'National\PostAttendanceController@attendance','class'=>'form-row'] ) !!}

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    {!! Form::select('category',
                    [
                    'sunday'=>'Sunday Service',
                    'wednesday'=>'Wednesday Teaching Service',
                    'Friday'=>'Friday Prayer Service',
                    'other'=>'Others'
                    ],null,['class'=>'form-control selectpicker','multiple data-max-options'=>1]) !!}
                    <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                </div>
            </div>


            <div class="form-group">
                <label for="date" class="control-label">
                    <div class="input-group">
                        <div class="input-group-addon bg-blue"><span class="bold">From</span></div>
                        {!! Form::date('from',Carbon\Carbon::now(),['class'=>'form-control selectpicker']) !!}
                        <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                    </div>
                </label>
            </div>
            <div class="form-group">
                <label for="date" class="control-label">
                    <div class="input-group">
                        <div class="input-group-addon bg-blue"><span class="bold">To</span></div>
                        {!! Form::date('to',Carbon\Carbon::now(),['class'=>'form-control selectpicker']) !!}
                        <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                    </div>
                </label>
            </div>

            <div class="form-group">
                <label for="search" class="control-label">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                        {!! Form::text('search',null,['class'=>'form-control selectpicker']) !!}
                    </div>

                </label>
            </div>


            <div class="form-group  col-md-6">
                {!! Form::submit('Close',['class'=>'btn  btn-danger btn-block']) !!}
            </div>
            <div class="form-group col-md-6">
                {!! Form::submit('submit',['class'=>'btn  btn-info btn-block']) !!}
            </div>



            {!! Form::close() !!}
        </div>
        <div class="panel-footer"></div>
    </div>
@endsection