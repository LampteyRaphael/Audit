@extends ('layouts.master_table')
@section('dashboard')

@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')
    @include('sweet::alert')

    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to update?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            {!! Form::model($category,['method'=>'PATCH','action'=>['National\NationalExpenditureCategoryController@update',$category->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}

            <div class="form-group">
                {!! Form::hidden('local_id',null,['class'=>'form-control']) !!}
            </div>

                <div class="form-group">
                    {!! Form::label('name','Edit Category',['class'=>'form-label']) !!}
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>

        </div>
        <div class="panel-footer">
            <div class="form-group  col-md-offset-9">
                <a href="{{route('categoryNa.index')}}" class='btn  btn-danger'>Close</a>
                    {!! Form::submit('update',['class'=>'btn  btn-info']) !!}

                {!! Form::close() !!}


            </div>
        </div>
    </div>


@endsection