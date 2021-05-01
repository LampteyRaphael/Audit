@extends('layouts.app', ['activePage' => 'incomeAll', 'titlePage' => __('Reverse/Change the Amount')])
@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-rose">
                            <h4 class="card-title ">Income Category</h4>
                            <p class="card-category">{{$categoryName->name}}</p>
                        </div>
                        <div class="card-body">

                    {!! Form::model($income,['method'=>'PATCH','action'=>['Locals\IncomeController@update',$income->id],'onsubmit' => 'return ConfirmDelete()'])!!}

                        <div class="form-group">
                            {!! Form::textArea('reason',null,['class'=>'form-control','required'=>'required','placeholder'=>'Enter your Reason for changing that figure']) !!}
                        </div>

                        <div class="form-group font-weight-bold">
                                {!! Form::number('amount',$income->amount,['class'=>'form-control','required'=>'required','placeholder'=>'Amount']) !!}
                        </div>

                        <div class="pull-right">
                            {!! Form::submit('submit',['class'=>'btn btn-success btn-sm']) !!}
                        </div>

                            {!! Form::close() !!}
                </div>

            </div>

          </div>
       </div>
    </div>
    </div>

      <script>

            function ConfirmDelete()
            {
                var x = confirm("You will be responsible for changing this figure. If yes click Ok else Cancel");
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

