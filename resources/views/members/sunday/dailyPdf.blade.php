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
    h3{

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
    <p><h3 class="text-center">{{strtoupper(Auth::user()->local->name .' ' . ' Assembly')}}</h3></p>
    <p class="text-center">{{$date}} Income And Expenditure</p>

    @if($incomeCategory)
        <table class="table">
            <thead>
            <tr>
                <th>INCOME</th>
                <th>(GHS)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($incomeCategory as $item)
                <?php
                 $sumIncome=App\income::where("local_id",Auth::user()->local_id)->where('category_id',$item->id)->whereYear('created_at',$year)
                    ->whereMonth('created_at',$month)
                    ->whereDay('created_at',$day)
                    ->pluck('amount')->sum();
                ?>
                @if($sumIncome===0)@else
                <tr>
                    <td id="td1">{{$item->name}}</td>
                    <td id="td2">{{$sumIncome}}</td>
                </tr>
                @endif
            @endforeach
            @if($donation===0)@else
            <tr>
                <td id="td1">Donation</td>
                <td id="td2">{{$donation}}</td>
            </tr>
            @endif
            @if($totalTithe===0)@else
            <tr>
                <td id="td1">Tithe</td>
                <td id="td2">{{$totalTithe}}</td>
            </tr>
            @endif
            <tr>
                <td id="td1">Total</td>
                <td id="td2">{{$total=$incomeCategoryTotal+$totalTithe+$donation}}</td>
            </tr>
            </tbody>
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
                $sumExpenditure=App\Expenditure::where("local_id",Auth::user()->local_id)
                    ->where('category_id',$item->id)
                    ->whereYear('created_at',$year)
                    ->whereMonth('created_at',$month)
                    ->whereDay('created_at',$day)
                    ->pluck('amount')->sum();
                ?>
                @if($sumExpenditure===0)@else
                <tr>
                    <td id="td1">{{$item->name}}</td>
                    <td id="td2">{{$sumExpenditure}}</td>
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

    <br>

    <table class="table">
        <tbody>
        <tr>
            <th id="td1">TOTAL INCOME</th>
            <td id="td2">{{$total}}</td>
        </tr>
        <tr>
            <th id="td1">TOTAL EXPENDITURE</th>
            <td id="td2">{{$totalExpenditure}}</td>
        </tr>

        <tr>
            <th id="td1">NET INCOME</th>
            <td id="td2">{{$total-$totalExpenditure}}</td>
        </tr>

        </tbody>
    </table>
</div>
</body>
</html>

