@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            <a class="btn-link" href="" data-toggle="modal" data-target="#date" style="color: darkblue"><i class="fa fa-hand-o-right"></i>click here to change date</a>
        </p>
    </li>
@endsection

@section('content')
    {!! Form::open(['method'=>'POST','action'=>'Locals\PostCurrentController@request','class'=>'modal form-inline','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><span class="bold">Date  click me</span></div>
                            {!! Form::date('date',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="modal-footer no-border">
                <div class="form-group">
                    {!! Form::submit('Close',['class'=>'btn  btn-danger','data-dismiss'=>'modal']) !!}
                    {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}



    <div class=" row col-md-4">

        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Icome</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <table class='table'>
                    <thead>
                    <tr>
                        <th>Icome</th>
                        <th>GHȻ</th>
                    </tr>
                    </thead>
                    <tbody id='table-tr'>
                    <tr>
                        <td>Offering</td>
                        <td>{{number_format($offering,2)}}</td>

                    </tr>
                    <tr>
                        <td>Tithe</td>
                        <td>{{number_format($tithe,2)}}</td>

                    </tr>
                    <tr>
                        <td>Envelops</td>
                        <td>{{number_format($envelop,2)}}</td>

                    </tr>

                    <tr>
                        <td>Fund Raising</td>
                        <td>{{number_format($fundraising,2)}}</td>

                    </tr>

                    <tr>
                        <td colspan="2">Generated Fund</td>
                    </tr>

                    <tr>
                        <td>Amount</td>
                        <td>{{number_format($generatedfund,2)}}</td>
                    </tr>

                    <tr>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <td>{{number_format($total,2)}}</td>

                    </tr>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Total Expenditure</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <table class="table table-responsive">
                    <tr>
                        <th>Expenditure</th>
                        <th>{{number_format($expenditure,2)}}</th>
                    </tr>
                </table>
            </div>
        </div>

    </div>


    <div class="col-md-4">
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Account Balance</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <table class="table table-responsive">
                    <tr>
                        <th>Total Income</th>
                        <th>{{number_format($total,2)}}</th>
                    </tr>

                    <tr>
                        <th>Expenditure</th>
                        <th>-{{number_format($expenditure,2)}}</th>
                    </tr>

                    <tr>
                        <th></th>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th>Account Balanced</th>
                        <td>{{number_format($total-$expenditure,2)}}</td>
                    </tr>
                    <tr>
                        <td><i class="fa fa-file-pdf-o"></i><a class="btn-link" href="{{route('sunday.edit',$date)}}">PDF</a></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
@endsection


