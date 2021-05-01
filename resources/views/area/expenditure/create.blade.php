@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Expenditure
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')
    <div class="row">
        <div class="table-responsive col-md-8 col-md-offset-2">
    <div class="panel shadow animated slideInDown">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Expenditure Category</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-striped mb0">
                <tbody>
                {!! Form::open(['method'=>'POST','action'=>'Area\AreaAreaPostController@post'] ) !!}

                <tr>
                    {!! Form::hidden('area_id',$id,['class'=>'form-control']) !!}

                    <div class="form-group">
                        {!! Form::label('area_income_categories_id','Select Category',['class'=>'control-label']) !!}
                        {!! Form::select('area_income_categories_id',[''=>'--Select Option--']+$category,null,['class'=>'form-control','required'=>'required']) !!}

                    </div>

                    <td>
                        <div class="form-group ">
{{--                            {!! Form::label('amount','(GHS)',['class'=>'control-label']) !!}--}}
                            {!! Form::number('amount',null,['class'=>'form-control','placeholder'=>'Amount','required'=>'required']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="form-group ">
{{--                            {!! Form::label('description','Description',['class'=>'control-label']) !!}--}}
                            {!! Form::text('description',null,['class'=>'form-control','placeholder'=>'Description']) !!}
                        </div>
                    </td>
                    <td>
                        {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}

                        {!! Form::button('Close',['class'=>'btn  btn-danger','data-toggle'=>"collapse","data-target"=>"#post"]) !!}
                    </td>
                </tr>
                {!! Form::close() !!}

                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
@endsection