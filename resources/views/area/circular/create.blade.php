@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
           Post Area Circular
        </p>
    </li>
@endsection

@section('content')
    <div class="row">
        @include('includes.form_error')
        @include('includes.alert')
        <div class="col-md-8 col-md-offset-2 shadow">
            {!! Form::open(['method'=>'POST','action'=>'Area\AreaPdfShowController@store','files'=>true] ) !!}

            <div class="panel">
                <div class="panel-default">
                    <div class="panel-heading">Add Circular</div>
                    <div class="panel-body">
                        <div class="form-group ">
                            {!! Form::label('name','Area Circular',['class'=>'control-label']) !!}
                            {!! Form::file('name',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::hidden('area_id',Auth::user()->area_id,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        {!! Form::submit('submit',['class'=>'btn btn-sm btn-info pull-right']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>

    </div>
@endsection