@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
           Post Local Circular
        </p>
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('includes.form_error')
            @include('includes.alert')
            @include('sweet::alert')
            {!! Form::open(['method'=>'POST','action'=>'Locals\PostLocalCircularController@store','files'=>true] ) !!}

            <div class="panel animated slideInDown shadow">
                <div class="panel-default">
                    <div class="panel-heading">
                        <ol class="breadcrumb mb0 no-padding">
                            <li>Post Circular</li>
                        </ol>
                    </div>
                    <div class="panel-body">
                        <div class="form-group ">
                            {!! Form::label('name','Local Circular',['class'=>'control-label']) !!}
                            {!! Form::file('name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            {!! Form::submit('submit',['class'=>'btn btn-info btn-xs pull-right']) !!}
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection