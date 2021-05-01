@extends('layouts.app', ['activePage' => 'incomeAdd', 'titlePage' => __('Add income')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                @include('includes.form_error')
                @include('includes.alert')
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Income Category</h4>
                            <p class="card-category"> Here you can manage users</p>
                        </div>
                        <div class="card-body">
            {!! Form::open(['method'=>'POST','action'=>'Locals\PostYearController@addIncome'] ) !!}

            {!! Form::hidden('local_id',$id,['class'=>'form-control']) !!}

            {!! Form::label('category_id','Select Category',['class'=>'control-label']) !!}

            {!! Form::select('category_id',[''=>'--Choose Option--']+$category,null,['class'=>'form-control','required'=>'required']) !!}

            {!! Form::label('amount','Amount(GHS)',['class'=>'control-label']) !!}

            {!! Form::number('amount',null,['class'=>'form-control','step'=>'any']) !!}

            {!! Form::label('description','Description',['class'=>'control-label']) !!}
            {!! Form::text('description',null,['class'=>'form-control']) !!}

            <button type="submit" class="btn btn-info" name="submit" >Submit</button>

            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
