<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>The Apostolic Church Ghana</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
    h2{

        font-style: inherit;
        color:darkblue;
    }
    h4{

        font-style: inherit;
        color: red;
    }

    #td1{
        border: none;
    }
    #td2{
        text-align: center;
    }

</style>
<body style="background:white">
<div class="container-fluid">
<h2 class="text-center"><img src="{{url('/photos/logo 2.png')}}" alt="" height="50" width="50"><u>THE APOSTOLIC CHURCH-GHANA</u></h2>
          <p><h4 class="text-center">{{strtoupper(Auth::user()->local->name .' '.'Assembly') }} </h4></p>
            <p class="text-center">The Year: {{$post}} Income And Expenditure</p>

<div class="col-md-8 col-md-offset-4">
    @if($incomeCategory)
        <table class="table">
            <thead>
            <tr>
                <th>INCOME</th>
                <th>(GHS)</th>
            </tr>
            </thead>
            @foreach($incomeCategory as $item)
                <?php
                $sumIncome=App\income::where("local_id",Auth::user()
                    ->local_id)->where('category_id',$item->id)
                    ->whereYear('created_at',$year)
                    ->pluck('amount')->sum();
                ?>
                @if($sumIncome===0)@else
                    <tr>
                        <td id="td1">{{$item->name}}</td>
                        <td id="td2">{{$sumIncome}}</td>
                    </tr>
                @endif
            @endforeach
            @if($donation===0)
            @else
                <tr>
                    <td id="td1">Donation</td>
                    <td id="td2">{{$donation}}</td>
                </tr>
            @endif

            @if($totalTithe===0)
            @else
                <tr>
                    <td id="td1">Tithe</td>
                    <td id="td2">{{$totalTithe}}</td>
                </tr>
            @endif

            <tr>
                <td id="td1">Total</td>
                <td id="td2">{{number_format($totals=$totalTithe+$donation+$incomeCategoryTotal,2)}}</td>
            </tr>
        </table>
    @endif

    <br>
    @if($expenditureCategory)
        <table class="table">
            <thead>
            <tr>
                <th>EXPENDITURE</th>
                <th>(GHS)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($expenditureCategory as $item)
                <?php
                $sunExpenditure=App\Expenditure::where("local_id",Auth::user()->local_id)
                    ->where('category_id',$item->id)
                    ->whereYear('created_at',$year)
                    ->pluck('amount')->sum();
                ?>
                @if($sunExpenditure===0)@else
                    <tr>
                        <td id="td1">{{$item->name}}</td>
                        <td id="td2">{{$sunExpenditure}}</td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <td id="td1">Total</td>
                <td id="td2">{{$totalExpenditure}}</td>
            </tr>
            </tbody>
        </table>
    @endif

    <table class="table">
        <tbody>

        <tr>
            <th id="td1">INCOME</th>
            <td id="td2">{{number_format($totals,2)}}</td>
        </tr>
        <tr>
            <th id="td1">EXPENDITURE</th>
            <td id="td2">{{number_format($totalExpenditure,2)}}</td>
        </tr>

        <tr>
            <th id="td1">NET INCOME</th>
            <td id="td2">{{number_format($totals-$totalExpenditure ,2)}}</td>
        </tr>
        </tbody>
    </table>
</div>


</div>
</body>
</html>

