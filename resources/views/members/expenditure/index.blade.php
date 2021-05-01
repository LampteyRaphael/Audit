@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            {{$categoryName->name}}
        </p>
    </li>
@endsection

@section('content')

    <script>

        function ConfirmDelete()
        {
            var x = confirm("You are responsible for changing this figure. If yes click Ok else Cancel");
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
                    {!! Form::model($expenditure,['method'=>'PATCH','action'=>['Locals\ExpenditureController@update',$expenditure->id],'onsubmit' => 'return ConfirmDelete()'])!!}

                    <div class="form-group">
                        {!! Form::label('reason','Reason',['class'=>'control-label']) !!}
                        {!! Form::textArea('reason',null,['class'=>'form-control','required'=>'required']) !!}
                    </div>

                    <div class="form-group ">
                        {!! Form::label('amount','Amount (GHS)',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i>GHS</i></div>
                            {!! Form::number('amount',$expenditure->amount,['class'=>'form-control','required'=>'required']) !!}
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
@endsection

