@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
             Edit Local
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
                        <a href="javascript:;">Local</a>
                    </li>
                    <li class="active">{{$local->name}}</li>
                </ol>
            </div>
            <div class="panel-body">

                    {!! Form::model($local,['method'=>'PATCH','action'=>['National\LocalsController@update',$local->id]] ) !!}

                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label for="name" class="control-label">Local Name</label>
                        <input type="text" name="name" value="{{$local->name}}" class="form-control">
                    </div>
                <div class="form-group">
                    <div class="form-group ">
                        {!! Form::label('local_code','Local Code',['class'=>'control-label']) !!}
                        {!! Form::text('local_code',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group ">
                        {!! Form::label('date','Date  Was Created(optional)',['class'=>'control-label']) !!}
                        {!! Form::date('date',null,['class'=>'form-control']) !!}
                    </div>
                </div>

                    <div class="form-group col-lg-6">
                        <input type="submit" name="submit" value="update Area" class="btn btn-info btn-block btn-sm">
                    </div>
                    {!! Form::close() !!}

                    <div class="form-group col-lg-6">
                        {!! Form::open(['method'=>'DELETE','action'=>['National\LocalsController@update',$local->id],'files'=>true,'onsubmit' => 'return ConfirmDelete()'] ) !!}
                            <input type="submit" name="submit" value="Delete Area" class="btn btn-danger btn-block btn-sm">
                        {!! Form::close() !!}
                    </div>
            </div>
        </div>


@endsection