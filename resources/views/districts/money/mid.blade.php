@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            MID YEAR FINANCIAL REPORT
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')

    <div class="panel">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    MID YEAR
                </li>
                <li>
                    January-June
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
                            ->whereMonth('created_at','<=',6)
                            ->whereYear('created_at',$year)
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
                            ->whereMonth('created_at','<=',6)
                            ->whereYear('created_at',$year)
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

            <table class="table table-striped">
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
