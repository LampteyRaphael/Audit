<!doctype html>
<html>
<head>
    <title>The Apostolic Church Ghana Management System</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>

    h2{
        color:darkblue;
    }

    h3{
        color: red;
    }

</style>
<body style="background: white">

<h2 class="text-center"><img src="{{url('/photos/logo 2.png')}}" alt="" height="50" width="50"><u>THE APOSTOLIC CHURCH-GHANA</u></h2>
<h3 class="text-center">{{ucwords($localName)}} Local</h3>
             <p class="text-center">{{Carbon\Carbon::parse($date)->format('jS F,Y')}}  Contributions</p>
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Icome</th>
                        <th>GHS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td >Offering</td>
                        <td>{{number_format($offering,2)}}</td>

                    </tr>
                    <tr>
                        <td>Tithe</td>
                        <td>{{number_format($tithe,2)}}</td>

                    </tr>
                    <tr>
                        <td>Envelops</td>
                        <td>{{number_format($envelop,2)}}</td>

                    </tr>

                    <tr>
                        <td>Fund Raising</td>
                        <td>{{number_format($fundraising,2)}}</td>

                    </tr>

                    <tr>
                        <td colspan="2">Generated Fund</td>
                    </tr>

                    <tr>
                        <td>Amount</td>
                        <td>{{number_format($generatedfund,2)}}</td>
                    </tr>

                    <tr>
                        <td colspan="2"></td>
                    </tr>

                    <tr>
                        <th>Total</th>
                        <td>{{number_format($total,2)}}</td>

                    </tr>

                    </tbody>
                </table>

               <br><br><br>

                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th colspan="3">Expenditure</th>
                        <th>GHS</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td colspan="2">Total Expenditure</td>
                        <td>{{number_format($expenditure,2)}}</td>
                    </tr>
                    </tbody>

                </table>

                <br><br><br>

                <table class="table table-condensed">
                    <tr>
                        <td colspan="2">Total Income</td>
                        <td>{{number_format($total,2)}}</td>
                    </tr>

                    <tr>
                        <td colspan="2">Expenditure</td>
                        <td>-{{number_format($expenditure,2)}}</td>
                    </tr>

                    <tr>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <th colspan="2">Balanced</th>
                        <td>{{number_format($total-$expenditure,2)}}</td>
                    </tr>
                </table>
</body>
</html>




