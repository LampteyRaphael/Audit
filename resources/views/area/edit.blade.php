@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Edit district
        </p>
    </li>
@endsection
@section('content')
    @include('includes.form_error')

    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Edit</a>
                </li>
                <li>
                    <a class="btn-link" href="javascript:;">{{$district->name}}</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            {!! Form::model($district,['method'=>'PUT', 'action'=>['Area\AreaPostController@update',$district->id],'files'=>true,'onsubmit'=>'return confirmupdate()']) !!}

            <div class="form-group">
                <label for="name" class="control-label">District Name</label>
                <input type="text" name="name" value="{{$district->name}}" class="form-control">
            </div>
            <div class="form-group">
                <div class="form-group ">
                    {!! Form::label('district_code','District Code',['class'=>'control-label']) !!}
                    {!! Form::text('district_code',null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="form-group ">
                    {!! Form::label('date','Date District Was Created(optional)',['class'=>'control-label']) !!}
                    {!! Form::date('date',null,['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="form-group col-lg-6">
                <input type="submit" name="submit" value="update Area" class="btn btn-info btn-block btn-sm">
            </div>
            {!! Form::close() !!}

            <div class="form-group col-lg-6">
                {!! Form::model($district,['method'=>'DELETE', 'action'=>['Area\AreaPostController@destroy',$district->id],'files'=>true,'onsubmit' => 'return ConfirmDelete()']) !!}
                <input type="hidden" name="_method" value="DELETE">
                <input type="submit" name="submit" value="Delete Area" class="btn btn-danger btn-block btn-sm">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>

    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

        function confirmupdate() {
            var updat=confirm("Are you sure you want to Update?");
            if (updat){
                return true;
            }
            else {
                return false;
            }
        }

    </script>
@endsection