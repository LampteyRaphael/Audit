<!doctype html>
<html>
<head>
    <title>The Apostolic Church Ghana</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>

    h2{
        color:darkblue;
    }

    h3{
        color: red;
    }

    ul li{
        list-style-type: none;
    }

</style>
<body style="background: white">

<h2 class="text-center"><img src="{{url('/photos/logo 2.png')}}" alt="" height="50" width="50"><u>THE APOSTOLIC CHURCH-GHANA</u></h2>

<p><h3 class="text-center">{{ucwords(Auth::user()->local->name)}}</h3></p>
<p class="text-center">{{Carbon\Carbon::parse($date)->format('F,Y')}} Income And Expenditure</p>


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


</body>
</html>


