@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Add Region
        </p>
    </li>
@endsection

@section('content')
<div class="col-md-10 col-md-offset-1">
    @include('includes.form_error')
    <div class="panel">
        {!! Form::open(['method'=>'POST', 'action'=>'National\RegionController@store','files'=>true]) !!}
        <div class="panel-heading">Create New Region</div>
        <div class="panel-body">
            <div class="form-group ">
                <div class="">
                    {!! Form::label('name','Enter Region Name',['class'=>'control-label']) !!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection

