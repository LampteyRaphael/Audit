@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
           Mid Year Contributions
        </p>
    </li>
@endsection
@section('content')
    <div class="collapse" id="statement">
        <div class="panel">
            <div class="panel-heading">Mid Year Income Statement</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>INCOME CATEGORIES</th>
                            <th>BREAKDOWN</th>
                            <th>GHS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomeCategory as $item)
                            <tr>
                                <td style="color: blue">{{$item->name}}</td>
                                <td>
                                    @foreach($a=App\income::where("local_id",Auth::user()->local_id)->where('category_id',$item->id)
                                            ->whereMonth('created_at','<=',6)
                                            ->whereYear('created_at',$year)

                                            ->get(['amount','description','created_at']) as $value)

                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                {{$value->created_at->format('jS F,Y') }}
                                            </li>
                                            <li class="list-inline-item">
                                                {{$value->description}}
                                            </li>
                                            <li class="list-inline-item">
                                                {{"GHS".$value->amount}}
                                            </li>
                                        </ul>

                                    @endforeach
                                </td>
                                <td>
                                    {{number_format((App\income::where("local_id",Auth::user() ->local_id)->where('category_id',$item->id)
                                      ->whereMonth('created_at','<=',6)
                                      ->whereYear('created_at',$year)
                                      ->pluck('amount')->sum()),2)}}
                                </td>

                            </tr>

                        @endforeach
                        <tr>
                            <td style="color: blue">
                                Tithe
                            </td>
                            <td></td>

                            <td>
                                {{number_format($totalTithe,2)}}
                            </td>
                        </tr>

                        <tr>
                            <td style="color: blue">Donation</td>
                            <td></td>
                            <td>{{number_format($donation,2)}}</td>
                        </tr>

                        </tbody>
                        <tfoot>

                        <tr>
                            <td>TOTAL</td>
                            <td></td>
                            <td>{{number_format($total=$incomeCategoryTotal+$totalTithe+$donation,2)}}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{--ENDING OF INCOME STATEMENT--}}
        <div class="panel">
            <div class="panel-heading">Expenditure Statement</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>EXPENDITURE CATEGORIES</th>
                            <th>BREAKDOWN</th>
                            <th>GHS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenditureCategory as $item1)

                            <tr>
                                <td style="color: blue">{{$item1->name}}</td>

                                <td>
                                    @foreach($a=App\Expenditure::where("local_id",Auth::user()
                                    ->local_id)->where('category_id',$item1->id)
                                      ->whereMonth('created_at','<=',6)
                                    ->whereYear('created_at',$year)
                                    ->get(['amount','description','created_at']) as $value)

                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                {{$value->created_at->format('jS F,Y') }}
                                            </li>
                                            <li class="list-inline-item">
                                                {{$value->description}}
                                            </li>
                                            <li class="list-inline-item">
                                                {{"GHS".$value->amount}}
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td>
                                    <ul class="list-inline">
                                        <li  class="list-inline-item">
                                            {{number_format((App\Expenditure::where("local_id",Auth::user()
                                         ->local_id)->where('category_id',$item1->id)
                                           ->whereMonth('created_at','<=',6)
                                         ->whereYear('created_at',$year)
                                         ->pluck('amount')->sum()),2)}}
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>

                        <tr>
                            <td>TOTAL</td>
                            <td> </td>
                            <td>{{number_format($totalExpenditure,2)}}</td>
                        </tr>
                        </tfoot>
                    </table>

                    <table class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <th>TOTAL INCOME</th>
                            <td hidden></td>
                            <td>{{number_format($total,2)}}</td>
                        </tr>
                        <tr>
                            <th>TOTAL EXPENDITURE</th>
                            <td hidden></td>
                            <td>{{number_format($totalExpenditure,2)}}</td>
                        </tr>

                        <tr>
                            <th>NET INCOME</th>
                            <td hidden></td>
                            <td>{{number_format($total-$totalExpenditure ,2)}}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div class="panel shadow animated slideInDown">

        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    Mid Year
                </li>
                <li><a class="btn btn-primary btn-xs" href="#statement" data-toggle="collapse">Statement</a></li>
                <li class="active">Data tables</li>
                <li><a class="btn btn-danger btn-xs" href="{{route('midyearPdf')}}">Print Pdf</a></li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($incomeCategory)
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>INCOME</th>
                            <th>(GHS)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomeCategory as $item)
                            <?php
                             $sunIncome=App\income::where("local_id",Auth::user()
                                ->local_id)->where('category_id',$item->id)
                                ->whereYear('created_at',$year)
                                ->whereMonth('created_at','<=',6)
                                ->pluck('amount')->sum()
                            ?>

                            @if($sunIncome===0)
                                @else
                            <tr>
                                <td>{{$item->name}}</td>
                                    <td>
                                        {{number_format($sunIncome,2)}}
                                    </td>
                            </tr>
                            @endif
                        @endforeach
                        @if($donation==0)
                        @else
                            <tr>
                                <td>Donation</td>
                                <td>{{number_format($donation,2)}}</td>
                            </tr>
                        @endif

                        @if($totalTithe==0)
                        @else
                            <tr>
                                <td>Tithe</td>
                                <td>{{number_format($totalTithe,2)}}</td>
                            </tr>
                        @endif
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($total=$incomeCategoryTotal+$totalTithe+$donation,2)}}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                <br>
                @if($expenditureCategory)

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>EXPENDITURE</th>
                            <th>(GHS)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($expenditureCategory as $item)
                            <?php
                             $sumExpenditure=App\Expenditure::where("local_id",Auth::user()->local_id)
                                ->where('category_id',$item->id)
                                ->whereYear('created_at',$year)
                                ->whereMonth('created_at','<=',6)
                                ->pluck('amount')->sum();
                            ?>
                            @if($sumExpenditure===0)
                            @else
                            <tr>
                                <td>{{$item->name}}</td>

                                <td>
                                    {{number_format($sumExpenditure,2)}}
                                </td>
                            </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($totalExpenditure,2)}}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif

                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>INCOME</th>
                        <td>{{number_format($total,2)}}</td>
                    </tr>
                    <tr>
                        <th>EXPENDITURE</th>
                        <td>{{ number_format($totalExpenditure,2)}}</td>
                    </tr>

                    <tr>
                        <th>NET INCOME</th>
                        <td>{{number_format($total-$totalExpenditure,2)}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection