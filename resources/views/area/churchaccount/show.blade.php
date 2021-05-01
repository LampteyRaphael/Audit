@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">

        </p>
    </li>
@endsection
@section('content')
    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Select</a>
                </li>
                <li>
                    <a href="javascript:;">Date</a>
                </li>
                <li class="active">Account Statement</li>
            </ol>
        </div>
        <div class="panel-body">
            {!! Form::open(['method'=>'POST','action'=>'Area\AreaShowAccountController@store'] ) !!}

            <div class="form-group">
                <div class="form-group ">
                    {!! Form::label('year','Year',['class'=>'control-label']) !!}

                    {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,\Carbon\Carbon::now()->year,['class'=>'form-control']) !!}

                </div>
            </div>

            <div class="form-group">
                <div class="form-group ">
                    {!! Form::label('local_id','Locals',['class'=>'control-label']) !!}
                    {!! Form::select('local_id',[''=>'--Select Option--']+$local,null,['class'=>'form-control','required'=>'required']) !!}
                </div>
            </div>


            <div class="form-group">
                {!! Form::submit('submit',["class"=>"btn btn-block  btn-info"]) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

