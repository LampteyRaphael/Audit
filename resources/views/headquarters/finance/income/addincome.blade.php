@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Income Category
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    @include('sweet::alert')
    {!! Form::open(['method'=>'POST','action'=>'National\NationalIncomeStoreController@store'] ) !!}
    <div class="panel">
        <div class="panel-heading">
            <a href="javascript:;">Income Category</a>
        </div>
        <div class="panel-body">
            <div class="">
                <table class="table table-bordered table-responsive">
                    <tbody>
                    <tr>
                        <div class="form-group">
                            {!! Form::label('category_id','Select Category',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon bg-blue"><i class="glyphicon glyphicon-chevron-down"></i></div>
                                {!! Form::select('category_id',$category,null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'data-style'=>'btn-default','data-live-search'=>'true','required'=>'required']) !!}
                                <div class="input-group-addon bg-blue"><i class="fa fa-search"></i></div>
                            </div>
                        </div>
                        <td>
                            <div class="">
                                {!! Form::label('amount','Amount(GHS)',['class'=>'control-label']) !!}
                                <div class="input-group">
                                    <div class="input-group-addon bg-blue">GHS</div>
                                    {!! Form::text('amount',null,['class'=>'form-control','required'=>'required']) !!}
                                    <div class="input-group-addon bg-blue">.00</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="">
                                {!! Form::label('description','Description',['class'=>'control-label']) !!}
                                {!! Form::text('description',null,['class'=>'form-control']) !!}
                            </div>
                        </td>
                        <td style="padding-top:25px">
                            {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    {!! Form::close() !!}
@endsection