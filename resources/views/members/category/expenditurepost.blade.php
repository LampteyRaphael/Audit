@extends('layouts.app', ['activePage' => 'expenditureAdd', 'titlePage' => __('Add Expenditure')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Income Category</h4>
                            <p class="card-category"> Here you can manage users</p>
                        </div>
                        <div class="card-body">
                {!! Form::open(['method'=>'POST','action'=>'Locals\PostYearController@post'] ) !!}

                    {!! Form::hidden('local_id',$id,['class'=>'form-control']) !!}

                    <div class="form-group">
                        {!! Form::label('category_id','Select Category',['class'=>'control-label']) !!}
                        {!! Form::select('category_id',[''=>'--Choose Option--']+$category,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>

                        <div class="form-group ">
                            {!! Form::label('amount','Amount(GHS)',['class'=>'control-label']) !!}
                            {!! Form::number('amount',null,['class'=>'form-control','step'=>'any']) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::label('description','Description',['class'=>'control-label']) !!}
                            {!! Form::text('description',null,['class'=>'form-control']) !!}
                        </div>


                        <button type="submit" class="btn btn-info pull-right" name="submit" >Submit</button>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
        </div>
    </div>
    </div>
@endsection
