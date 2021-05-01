@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Church Expenditure
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')

    <div class="row">
        {!! Form::open(['method'=>'POST','action'=>'Locals\PostExpensesController@store'])!!}
        <div class="panel">
            <div class="panel-heading">Post Church Expenditure</div>
            <div class="panel-body">

                <div class="form-group ">
                    {!! Form::label('expenditureCategory','State the type of Expenditure',['class'=>'control-label']) !!}
                    {!! Form::text('expenditureCategory',null,['class'=>'form-control','required'=>'required']) !!}
                </div>
                <div class="form-group ">
                    {!! Form::label('amount','Amount (GHS:)',['class'=>'control-label']) !!}
                    {!! Form::text('amount',null,['class'=>'form-control','required'=>'required']) !!}
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

