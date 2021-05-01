@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Yearly Contributions
        </p>
    </li>
@endsection
@section('content')
    <div class="collapse" id="statement">
        <div class="panel">
            <div class="panel-heading">
                {{--{{$year}} Income Statement--}}

                <a class="btn btn-danger" href="{{route('printStatementY.pdf',$year)}}">Print Statement</a>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @foreach($incomeCategory as $item)
                        <ul class="nav navbar-nav nav-tabs" style="list-style-type: none; padding-left: 20px;">
                            <li style="list-style-type: none;"><u style="color: blue">{{$item->name}}</u>

                                @foreach($a=App\income::where("local_id",\Illuminate\Support\Facades\Auth::user()
                                ->local_id)->where('category_id',$item->id)
                                ->whereYear('created_at',$year)
                                ->get(['amount','description','created_at']) as $value)

                                    <ul>

                                        <li>
                                            {{$value->created_at->format('jS F,Y') . " " .$value->description. " " .$value->amount}}

                                        </li>
                                    </ul>
                            </li>
                            @endforeach
                            <ul style="list-style-type: none;">
                                <li class="bold" style="list-style-type: none;">
                                    Total= {{number_format((App\income::where("local_id",\Illuminate\Support\Facades\Auth::user()
                             ->local_id)->where('category_id',$item->id)
                             ->whereYear('created_at',$year)
                             ->pluck('amount')->sum()),2)}}
                                </li>
                            </ul>
                        </ul>
                    @endforeach
                    <br><br>

                    <ul class="nav navbar-nav nav-tabs" style="list-style-type: none; padding-left: 20px;">
                        <li><u style="color: blue">Tithe</u></li>
                        <li>{{number_format($a=$totalTithe,2)}}</li>
                    </ul>
                </div>
            </div>
            <div class="panel-footer">
                <span style="font-size:15px">GHS &nbsp;{{number_format($totals=$total+$a,2)}}</span>
            </div>
        </div>

        {{--ENDING OF INCOME STATEMENT--}}
        <div class="panel">
            <div class="panel-heading">{{$year}} Expenditure Statement</div>
            <div class="panel-body">
                <div class="table-responsive">
                    @foreach($expenditureCategory as $item1)
                        <ul class="nav navbar-nav nav-tabs">
                            <li><u style="color: blue">{{$item1->name}}</u>

                                @foreach($a=App\Expenditure::where("local_id",\Illuminate\Support\Facades\Auth::user()
                                ->local_id)->where('category_id',$item1->id)
                                ->whereYear('created_at',$year)
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
                            <td>{{number_format($totals,2)}}</td>
                        </tr>
                        <tr>
                            <td>TOTAL EXPENDITURE</td>
                            <td>{{number_format($totalExpenditure,2)}}</td>
                        </tr>
                        <tr>
                            <td>ACCOUNT BALANCE</td>
                            <td>{{number_format($totals-$totalExpenditure ,2)}}</td>
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
                    <a href="{{route('areaShow.index')}}" class="btn-link">Back</a>
                </li>
                <li>
                    {{$year}}
                </li>
                <li class="active">Data tables</li>

                <li><a class="btn btn-primary" href="#statement" data-toggle="collapse">Statement</a></li>

                <li><a class="btn btn-danger" href=""><i class="fa fa-print"></i>Print</a></li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($incomeCategory)
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>INCOME</th>
                            <th>(GHS)</th>
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
                                    ->pluck('amount')->sum()),2)}}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Tithe</td>
                            <td>{{$a=$totalTithe}}</td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($total=$total+$a,2)}}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                <br>
                @if($expenditureCategory)

                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>EXPENDITURE</th>
                            <th>(GHS)</th>
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
                                     ->pluck('amount')->sum()),2)}}
                                </td>
                                {!! Form::close() !!}
                            </tr>
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($totalExpenditure,2)}}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                <table class="table table-condensed">
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
                        <th>TOTAL</th>
                        <td>{{number_format($total-$totalExpenditure ,2)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

@endsection


