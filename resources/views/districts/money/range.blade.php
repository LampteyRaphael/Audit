@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
             REPORT RANGE
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')
    {!! Form::open(['method'=>'POST','action'=>'District\DistrictMoneyController@rangepost','class'=>'modal form-inline','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><span class="bold">From</span></div>
                            {!! Form::date('from',Carbon\Carbon::now(),['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>
                    </label>
                </div>

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><span class="bold">To</span></div>
                            {!! Form::date('to',Carbon\Carbon::now(),['class'=>'form-control']) !!}
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
    <div class="panel">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>daily report</li>
                <li>
                    <a class="btn btn-primary btn-xs" href="#date" data-toggle="modal">Change Date Range</a>
                </li>
                <li>
                    <a href="" class="btn btn-default btn-xs">Export to Excel</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($incomeCategory)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>  Income Categories</th>
                            <th>(GHS)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomeCategory as $item)
                            <?php
                            $incomeSum=App\DistrictIncome::where("district_id",Auth::user()->district_id)
                                ->where('district_income_categories_id',$item->id)
                                ->whereBetween('created_at',[$from,$to])
                                ->pluck('amount')->sum();
                            ?>
                            <tr>
                                @if($incomeSum===0)@else
                                    <td>{{$item->name}}</td>
                                    <td>
                                        {{number_format($incomeSum,2)}}
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                        @if($total===0)@else
                            <tfoot>
                            <tr>
                                <td>Total</td>
                                <td>{{number_format($total,2)}}</td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
                @endif

                @if($incomeCategory)

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Expenditure Categories</th>
                            <th>(GHS)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomeCategoryE as $item)
                            <?php
                            $expenditureSum=App\DistrictExpenditure::where("district_id",Auth::user()->district_id)
                                ->where('district_income_categories_id',$item->id)
                                ->whereBetween('created_at',[$from,$to])
                                ->pluck('amount')->sum();
                            ?>
                            @if($expenditureSum===0)@else
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        {{number_format(($expenditureSum),2)}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                        @if($totalE===0)@else
                            <tr>
                                <td>Total</td>
                                <td>{{number_format($totalE,2)}}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                @endif

                <table class="table table-bordered">
                    <tbody>
                    @if($total===0)@else
                        <tr>
                            <td>Total Income</td>
                            <td>{{number_format($total,2)}}</td>
                        </tr>
                    @endif

                    @if($totalE===0)@else
                        <tr>
                            <td>Total Expenditure</td>
                            <td>{{number_format($totalE,2)}}</td>
                        </tr>
                    @endif

                    <tr>
                        <td>Account Balance</td>
                        <td>{{number_format($total-$totalE,2)}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
        </div>
@endsection
