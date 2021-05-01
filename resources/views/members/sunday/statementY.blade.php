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

    ul li{
        list-style-type: none;
    }


</style>
<body style="background:white">
<div>
    <h2 class="text-center"><img src="{{url('/photos/logo 2.png')}}" alt="" height="50" width="50"><u>THE APOSTOLIC CHURCH-GHANA</u></h2>
    <p><h3 class="text-center">{{ucwords(Auth::user()->local->name)}} Local</h3></p>
    <p class="text-center">The Year: {{$post}} Income And Expenditure</p>

                    @foreach($incomeCategory as $item)
                        <ul class="nav nav-navbar  nav-tabs">
                            <li><u style="color: blue;padding-left: 40px;">{{$item->name}}</u>

                                @foreach($a=App\income::where("local_id",\Illuminate\Support\Facades\Auth::user()
                                ->local_id)->where('category_id',$item->id)
                                ->whereYear('created_at',$post)
                                ->get(['amount','description','created_at']) as $value)

                                    <ul class="nav nav-navbar">
                                        <li>
                                            {{$value->created_at->format('jS F,Y') . " " .$value->description. " " .$value->amount}}
                                        </li>
                                    </ul>
                            </li>
                            @endforeach
                            <ul class="nav nav-navbar  nav-tabs">
                                <li>
                                    Total= {{number_format((App\income::where("local_id",\Illuminate\Support\Facades\Auth::user()
                             ->local_id)->where('category_id',$item->id)
                             ->whereYear('created_at',$post)
                             ->pluck('amount')->sum()),2)}}
                                </li>
                            </ul>

                        </ul>
                    @endforeach
                    <ul class="nav navbar-nav  nav-tabs" style="list-style-type: none; padding-left: 20px;">
                        <li><u style="color: blue">Tithe</u></li>
                        <li>{{number_format($a=$totalTithe,2)}}</li>
                    </ul>

                <span style="font-size:15px">GHS &nbsp;{{number_format($totals=$total+$a,2)}}</span>

    <br><br>

            Expenditure Statement

                    @foreach($expenditureCategory as $item1)
                        <ul class="nav navbar-nav  nav-tabs">
                            <li><u style="color: blue;position: center;">{{$item1->name}}</u>

                                @foreach($a=App\Expenditure::where("local_id",Auth::user()
                                ->local_id)->where('category_id',$item1->id)
                                ->whereYear('created_at',$post)
                                ->get(['amount','description','created_at']) as $value)

                                    <ul>
                                        <li>
                                            {{$value->created_at->format('jS F,Y') . " " .$value->description. " " .$value->amount}}
                                        </li>
                                    </ul>
                            </li>
                            @endforeach
                            <ul class="nav nav-navbar nav-tabs">
                                <li>
                                    Total = {{number_format((App\Expenditure::where("local_id",Auth::user()
                             ->local_id)->where('category_id',$item1->id)
                             ->whereYear('created_at',$post)
                             ->pluck('amount')->sum()),2)}}
                                </li>
                            </ul>
                        </ul>
                    @endforeach

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
                    <td>ACCOUNT BALANCED</td>
                    <td>{{number_format($totals-$totalExpenditure ,2)}}</td>
                </tr>
            </table>
        </div>

</body>
</html>

