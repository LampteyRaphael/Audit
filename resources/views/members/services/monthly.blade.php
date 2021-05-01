@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Monthly Contribution
        </p>
    </li>
@endsection
@section('content')
    {!! Form::open(['method'=>'POST','action'=>'Locals\PostMonthlyController@index','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">Month</span></div>
                            {!! Form::selectMonth('month',\Carbon\Carbon::now()->month,['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>
                    </label>
                </div>

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">Year</span></div>
                            {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,\Carbon\Carbon::now()->year,['class'=>'form-control']) !!}
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

    <div class="collapse" id="statement">
        <div class="panel">
            <div class="panel-heading">
                {{Carbon\Carbon::parse($date)->format('F,Y')}} Income Statement

            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @foreach($incomeCategory as $item)
                        <ul class="nav navbar-nav nav-tabs">
                            <li><u style="color: blue">{{$item->name}}</u>

                                @foreach($a=App\income::where("local_id",\Illuminate\Support\Facades\Auth::user()
                                ->local_id)->where('category_id',$item->id)
                                ->whereYear('created_at',$year)
                                ->whereMonth('created_at',$month)
                                ->get(['amount','description','created_at']) as $value)

                                    <ul>

                                        <li>
                                            {{$value->created_at->format('jS F,Y') . " " .$value->description. " " .$value->amount}}

                                        </li>
                                    </ul>
                            </li>
                            @endforeach
                            <ul>
                                <li class="bold">
                                    Total= {{number_format((App\income::where("local_id",\Illuminate\Support\Facades\Auth::user()
                             ->local_id)->where('category_id',$item->id)
                             ->whereYear('created_at',$year)
                             ->whereMonth('created_at',$month)
                             ->pluck('amount')->sum()),2)}}
                                </li>
                            </ul>

                        </ul>
                    @endforeach
                </div>
            </div>
            <div class="panel-footer">
                <span style="font-size:15px">GHS &nbsp;{{number_format($total,2)}}</span>

            </div>
        </div>

        {{--ENDING OF INCOME STATEMENT--}}
        <div class="panel">
            <div class="panel-heading">{{Carbon\Carbon::parse($date)->format('F,Y')}} Expenditure Statement</div>
            <div class="panel-body">
                <div class="table-responsive">
                    @foreach($expenditureCategory as $item1)
                        <ul class="nav navbar-nav nav-tabs">
                            <li><u style="color: blue">{{$item1->name}}</u>

                                @foreach($a=App\Expenditure::where("local_id",\Illuminate\Support\Facades\Auth::user()
                                ->local_id)->where('category_id',$item1->id)
                                ->whereYear('created_at',$year)
                                ->whereMonth('created_at',$month)
                                ->get(['amount','description','created_at']) as $value)

                                    <ul>

                                        <li>
                                            {{$value->created_at->format('jS F,Y') . " " .$value->description. " " .$value->amount}}

                                        </li>
                                    </ul>
                            </li>
                            @endforeach
                            <ul>
                                <li class="bold">
                                    Total = {{number_format((App\Expenditure::where("local_id",\Illuminate\Support\Facades\Auth::user()
                             ->local_id)->where('category_id',$item1->id)
                             ->whereYear('created_at',$year)
                             ->whereMonth('created_at',$month)
                             ->pluck('amount')->sum()),2)}}
                                </li>
                            </ul>

                        </ul>
                    @endforeach
                </div>


            </div>
            <div class="panel-footer">
                <div class="table-responsive">
                    <div class="row">
                        <span style="font-size:15px">GHS &nbsp;{{number_format($totalExpenditure,2)}}</span>
                    </div>

                    <table class="table">
                        <tr>
                            <td>TOTAL INCOME</td>
                            <td>{{number_format($total,2)}}</td>
                        </tr>
                        <tr>
                            <td>TOTAL EXPENDITURE</td>
                            <td>{{number_format($totalExpenditure,2)}}</td>
                        </tr>
                        <tr>
                            <td>ACCOUNT BALANCE</td>
                            <td>{{number_format($total-$totalExpenditure ,2)}}</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="panel">

        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="" class="btn-link" data-toggle="modal" data-target="#date" style="color: darkblue"><i class="fa fa-calendar"></i>Click Here To Change Date</a>
                </li>
                <li>
                    {{Carbon\Carbon::parse($date)->format('F,Y')}}
                </li>
                <li class="active">Data tables</li>
                <li><a class="btn btn-primary" href="#statement" data-toggle="collapse">Statement</a></li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($incomeCategory)

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>INCOME</th>
                            <th>(GHS)</th>
                            <th>Date Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomeCategory as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    {{number_format((App\income::where("local_id",\Illuminate\Support\Facades\Auth::user()
                                    ->local_id)->where('category_id',$item->id)
                                    ->whereYear('created_at',$year)
                                    ->whereMonth('created_at',$month)
                                    ->pluck('amount')->sum()),2)}}
                                </td>
                                <td>{{$month."/".$year}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($total,2)}}</td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                <br>
                @if($expenditureCategory)

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>EXPENDITURE</th>
                            <th>(GHS)</th>
                            <th>Date Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenditureCategory as $item)
                            <tr>
                                <td>{{$item->name}}</td>

                                <td>
                                    {{number_format((App\Expenditure::where("local_id",\Illuminate\Support\Facades\Auth::user()->local_id)
                                    ->where('category_id',$item->id)
                                      ->whereYear('created_at',$year)
                                     ->whereMonth('created_at',$month)
                                     ->pluck('amount')->sum()),2)}}
                                </td>
                                <td>{{$month."/".$year}}</td>

                                {!! Form::close() !!}
                            </tr>
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($totalExpenditure,2)}}</td>
                            <td colspan="4"></td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                <table class="table table-bordered">
                    <thead>

                    </thead>
                    <tbody>

                    <tr>
                        <th>INCOME</th>
                        <td>{{number_format($total,2)}}</td>
                    </tr>
                    <tr>
                        <th>EXPENDITURE</th>
                        <td>{{number_format($totalExpenditure,2)}}</td>
                    </tr>

                    <tr>
                        <th>BALANCED</th>
                        <td>{{number_format($total-$totalExpenditure ,2)}}</td>
                        <td colspan="4"></td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection