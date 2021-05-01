@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text text-capitalize">
            MidYear Report
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')

        <div class="table-responsive">
            <div class="panel shadow mb25">
                <div class="panel-heading border">
                    <ol class="breadcrumb mb0 no-padding">
                        <li>
                            <a href="javascript:;">MidYear</a>
                        </li>
                        <li>
                            <a href="javascript:;">Report</a>
                        </li>
                        <li class="active">Data tables</li>
                    </ol>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        @if($incomeCategory)

                            <table class="table table-striped css-table-xs">
                                <thead>
                                <tr>
                                    <th>Income Categories</th>
                                    <th class="text-center">GHS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($incomeCategory as $item)
                                    <?php
                                       $incomesum=   App\AreaIncome::
                                          where("area_id",Auth::user()->area_id)
                                        ->where('area_income_categories_id',$item->id)
                                        ->pluck('amount')->sum();
                                    ?>
                                    @if($incomesum==0)@else
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td class="text-center">
                                            {{number_format($incomesum,2)}}
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                <tr>
                                    <td>Total Income</td>
                                    <td class="text-center">{{number_format($total,2)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        @endif

                        <br><br>
                        @if($incomeCategoryE)
                            <table class="table table-striped css-table-xs">
                                <thead>
                                <tr>
                                    <th>Expenditure Categories</th>
                                    <th class="text-center">GHS</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($incomeCategoryE as $item)
                                    <?php
                                    $expenditureSum=App\AreaExpenditure::where("area_id",Auth::user()->area_id)->where('area_income_categories_id',$item->id)->pluck('amount')->sum();
                                    ?>
                                    @if($expenditureSum==0)@else
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td class="text-center">
                                            {{number_format($expenditureSum,2)}}
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                @if($totalE==0)@else
                                <tr>
                                    <td>Total Expenditure</td>
                                    <td class="text-center">{{number_format($totalE,2)}}</td>
                                </tr>
                                @endif
                                </tbody>
                            </table>
                            <table class="table table-striped css-table-xs">
                                <tbody>
                                <tr>
                                    <td>Total Income</td>
                                    <td class="text-center">{{number_format($total,2)}}</td>
                                </tr>
                                <tr>
                                    <td>Total Expenditure</td>
                                    <td class="text-center">{{number_format($totalE,2)}}</td>
                                </tr>

                                <tr>
                                    <td>Net Income</td>
                                    <td class="text-center">{{(number_format($total,2))-$totalE}}</td>
                                </tr>
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
        </div>
@endsection