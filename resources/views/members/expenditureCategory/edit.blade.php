@extends ('layouts.master_table')
@section('dashboard')

@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')
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
        {!! Form::model($category,['method'=>'PATCH','action'=>['Locals\ExpenditureCategoryController@update',$category->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}

        <div class="form-group">
            {!! Form::hidden('local_id',null,['class'=>'form-control']) !!}
        </div>
        @if($category->local_id==0)
        <div class="form-group">
            {!! Form::label('name','Edit Category',['class'=>'form-label']) !!}
            {!! Form::text('name',null,['class'=>'form-control','disabled'=>'disabled']) !!}
        </div>
            @else
            <div class="form-group">
                {!! Form::label('name','Edit Category',['class'=>'form-label']) !!}
                {!! Form::text('name',null,['class'=>'form-control']) !!}
            </div>
        @endif

    </div>
    <div class="panel-footer">
        <div class="form-group  col-md-offset-9">
            <a href="{{route('expenditureC.index')}}" class='btn  btn-danger'>Close</a>

            @if($category->local_id==0)
            {!! Form::submit('update',['class'=>'btn  btn-info','disabled'=>'disabled']) !!}
                @else
            {!! Form::submit('update',['class'=>'btn  btn-info']) !!}
            @endif
            {!! Form::close() !!}


        </div>
    </div>
</div>


@endsection