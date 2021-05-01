@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            {{$categoryName->name}}
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    {{--@include('sweet::alert')--}}
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
                Edit Posted Amount
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    {!! Form::model($income,['method'=>'PATCH','action'=>['District\DistrictIncomeController@update',$income->id],'onsubmit' => 'return ConfirmUpdate()'])!!}

                    <div class="form-group">
                        {!! Form::label('reason','Reason',['class'=>'control-label']) !!}
                        {!! Form::textArea('reason',null,['class'=>'form-control','required'=>'required','row'=>1]) !!}
                    </div>

                    <div class="form-group ">
                        {!! Form::label('amount','Amount (GHS)',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i>GHS</i></div>
                            {!! Form::number('amount',$income->amount,['class'=>'form-control','required'=>'required']) !!}
                            <div class="input-group-addon bg-blue"><i>.00</i></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        {!! Form::submit('submit',['class'=>'btn btn-primary btn-xm  btn-block']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

    <script>

        function ConfirmUpdate()
        {
            var x = confirm("You will be responsible for this changes");
            if (x)
                return true;
            else
                return false;
        }

        function searchInfo()
        {
            var x = confirm("Are you ready to search?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endsection

