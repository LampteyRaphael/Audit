@extends ('layouts.master_table')
@section('dashboard')
<li>
    <p class="navbar-text">
            Income
    </p>
</li>
@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')
<div class="table-responsive col-md-6 col-md-offset-2">
    <div class="panel shadow  animated slideInDown">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Income Category</a>
                </li>
            </ol>

        </div>
        <div class="panel-body">
                    {!! Form::open(['method'=>'POST','action'=>'District\PostAreaCController@post','onsubmit' => 'return ConfirmUpdate()'] ) !!}

                        {!! Form::hidden('district_id',$id,['class'=>'form-control']) !!}

                        <div class="form-group">
                            {!! Form::label('district_income_categories_id','Select Category',['class'=>'control-label']) !!}
                            {!! Form::select('district_income_categories_id',[''=>'--Choose Option--']+$category,null,['class'=>'form-control','required'=>'required']) !!}

                        </div>
                            <div class="form-group">
                                {!! Form::label('amount','Amount(GHS)',['class'=>'control-label']) !!}
                                {!! Form::number('amount',null,['class'=>'form-control','step'=>'any','required'=>'required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('description','Description',['class'=>'control-label']) !!}
                                {!! Form::text('description',null,['class'=>'form-control']) !!}
                            </div>

                            <div class="form-group pull-right">
                                {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                            </div>
                    {!! Form::close() !!}
        </div>
    </div>
</div>
    <script>

        function ConfirmUpdate()
        {
            var x = confirm("Are you sure you want to post?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
@endsection