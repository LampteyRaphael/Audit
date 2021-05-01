@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
          Edit The Area
        </p>
    </li>
@endsection

@section('content')
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
    <div class="panel mb25">
        @include('includes.form_error')
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Edit</a>
                    </li>
                    <li>
                        <a href="javascript:;">{{$area->name}}</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                {!! Form::model($area,['method'=>'PUT', 'action'=>['National\AreaController@update',$area->id],'files'=>true]) !!}
                <div class="form-group ">
                    {!! Form::label('name','Area Name',['class'=>'control-label']) !!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    <div class="form-group ">
                        {!! Form::label('area_code','Area Code',['class'=>'control-label']) !!}
                        {!! Form::text('area_code',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group ">
                        {!! Form::label('date','Date Area Was Created(optional)',['class'=>'control-label']) !!}
                        {!! Form::date('date',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group col-lg-6">
                    {!! Form::submit('Update Area',['class'=>'btn btn-info btn-block btn-sm']) !!}
                </div>

                {!! Form::close() !!}

                {!! Form::model($area,['method'=>'DELETE', 'action'=>['National\AreaController@destroy',$area->id],'files'=>true,'onsubmit' => 'return ConfirmDelete()']) !!}
                <div class="form-group col-lg-6">
                    {!! Form::submit('Delete',['class'=>'btn btn-danger btn-block btn-sm']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    <div class="col-sm-9">




    </div>
@endsection

