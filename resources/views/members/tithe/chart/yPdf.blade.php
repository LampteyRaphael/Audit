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


</style>
<p style="background: white">

<h2 class="text-center"><img src="{{url('/photos/logo 2.png')}}" alt="" height="50" width="50"><u>THE APOSTOLIC CHURCH-GHANA</u></h2>

<p><h3 class="text-center">{{ucwords(Auth::user()->local->name)}}</h3></p>
<p class="text-center">{{$year}} Tithe And Thanksgiving Offering</p>

<table class="table table-bordered table-hover">
    <thead class="text-center">
    <tr>
        <th>MONTH</th>
        <th colspan="3">GROSS</th>
        <th colspan="3">60%</th>
        <th colspan="3">5%</th>
        <th colspan="3">10%</th>
        <th colspan="3">25%</th>
    </tr>
    <tr>
        <th>MONTH</th>
        <th>Tithe</th>
        <th>Thanksgiving</th>
        <th>Total</th>
        <th>Tithe</th>
        <th>Thanksgiving</th>
        <th>Total</th>
        <th>Tithe</th>
        <th>Thanksgiving</th>
        <th>Total</th>
        <th>Tithe</th>
        <th>Thanksgiving</th>
        <th>Total</th>
        <th>Tithe</th>
        <th>Thanksgiving</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>January</th>
        <td>{{$postTithe}}</td>
        <td>{{$thanksgiving1}}</td>
        <td>{{$postTithe+$thanksgiving1}}</td>
        <td>{{$postTithe*0.6}}</td>
        <td>{{$thanksgiving1*0.6}}</td>
        <td>{{($postTithe+$thanksgiving1)*0.6}}</td>
        <td>{{$postTithe*0.05}}</td>
        <td>{{$thanksgiving1*0.05}}</td>
        <td>{{($postTithe+$thanksgiving1)*0.05}}</td>
        <td>{{$postTithe*0.1}}</td>
        <td>{{$thanksgiving1*0.1}}</td>
        <td>{{($postTithe+$thanksgiving1)*0.1}}</td>
        <td>{{$postTithe*0.25}}</td>
        <td>{{$thanksgiving1*0.25}}</td>
        <td>{{($postTithe+$thanksgiving1)*0.25}}</td>
    </tr>
    <tr>
        <th>February</th>
        <td>{{$fpostTithe}}</td>
        <td>{{$thanksgiving2}}</td>
        <td>{{($fpostTithe+$thanksgiving2)}}</td>
        <td>{{$fpostTithe*0.6}}</td>
        <td>{{$thanksgiving2*0.6}}</td>
        <td>{{($fpostTithe+$thanksgiving2)*0.6}}</td>
        <td>{{$fpostTithe*0.05}}</td>
        <td>{{$thanksgiving2*0.05}}</td>
        <td>{{($fpostTithe+$thanksgiving2)*0.05}}</td>
        <td>{{$fpostTithe*0.1}}</td>
        <td>{{$thanksgiving2*0.1}}</td>
        <td>{{($fpostTithe+$thanksgiving2)*0.1}}</td>
        <td>{{$fpostTithe*0.25}}</td>
        <td>{{$thanksgiving2*0.25}}</td>
        <td>{{($fpostTithe+$thanksgiving2)*0.25}}</td>

    </tr>
    <tr>
        <th>March</th>
        <td>{{$mfpostTithe}}</td>
        <td>{{$thanksgiving3}}</td>
        <td>{{($mfpostTithe+$thanksgiving3)}}</td>
        <td>{{$mfpostTithe*0.6}}</td>
        <td>{{$thanksgiving3*0.6}}</td>
        <td>{{($mfpostTithe+$thanksgiving3)*0.6}}</td>
        <td>{{$mfpostTithe*0.05}}</td>
        <td>{{$thanksgiving3*0.05}}</td>
        <td>{{($mfpostTithe+$thanksgiving3)*0.05}}</td>
        <td>{{$mfpostTithe*0.1}}</td>
        <td>{{$thanksgiving3*0.1}}</td>
        <td>{{($mfpostTithe+$thanksgiving3)*0.1}}</td>
        <td>{{$mfpostTithe*0.25}}</td>
        <td>{{$thanksgiving3*0.25}}</td>
        <td>{{($mfpostTithe+$thanksgiving3)*0.25}}</td>

    </tr>
    <tr>
        <th>April</th>
        <td>{{$afpostTithe}}</td>
        <td>{{$thanksgiving4}}</td>
        <td>{{($afpostTithe+$thanksgiving4)}}</td>
        <td>{{$afpostTithe*0.6}}</td>
        <td>{{$thanksgiving4*0.6}}</td>
        <td>{{($afpostTithe+$thanksgiving4)*0.6}}</td>
        <td>{{$afpostTithe*0.05}}</td>
        <td>{{$thanksgiving4*0.05}}</td>
        <td>{{($afpostTithe+$thanksgiving4)*0.05}}</td>
        <td>{{$afpostTithe*0.1}}</td>
        <td>{{$thanksgiving4*0.1}}</td>
        <td>{{($afpostTithe+$thanksgiving4)*0.1}}</td>
        <td>{{$afpostTithe*0.25}}</td>
        <td>{{$thanksgiving4*0.25}}</td>
        <td>{{($afpostTithe+$thanksgiving4)*0.25}}</td>
    </tr>
    <tr>
        <th>May</th>
        <td>{{$myfpostTithe}}</td>
        <td>{{$thanksgiving5}}</td>
        <td>{{($myfpostTithe+$thanksgiving5)}}</td>
        <td>{{$myfpostTithe*0.6}}</td>
        <td>{{$thanksgiving5*0.6}}</td>
        <td>{{($myfpostTithe+$thanksgiving5)*0.6}}</td>
        <td>{{$myfpostTithe*0.05}}</td>
        <td>{{$thanksgiving5*0.05}}</td>
        <td>{{($myfpostTithe+$thanksgiving5)*0.05}}</td>
        <td>{{$myfpostTithe*0.1}}</td>
        <td>{{$thanksgiving5*0.1}}</td>
        <td>{{($myfpostTithe+$thanksgiving5)*0.1}}</td>
        <td>{{$myfpostTithe*0.25}}</td>
        <td>{{$thanksgiving5*0.25}}</td>
        <td>{{($myfpostTithe+$thanksgiving5)*0.25}}</td>
    </tr>
    <tr>
        <th>June</th>
        <td>{{$jfpostTithe}}</td>
        <td>{{$thanksgiving5}}</td>
        <td>{{($jfpostTithe+$thanksgiving5)}}</td>
        <td>{{$jfpostTithe*0.6}}</td>
        <td>{{$thanksgiving5*0.6}}</td>
        <td>{{($jfpostTithe+$thanksgiving5)*0.6}}</td>
        <td>{{$jfpostTithe*0.05}}</td>
        <td>{{$thanksgiving5*0.05}}</td>
        <td>{{($jfpostTithe+$thanksgiving5)*0.05}}</td>
        <td>{{$jfpostTithe*0.1}}</td>
        <td>{{$thanksgiving5*0.1}}</td>
        <td>{{($jfpostTithe+$thanksgiving5)*0.1}}</td>
        <td>{{$jfpostTithe*0.25}}</td>
        <td>{{$thanksgiving5*0.25}}</td>
        <td>{{($jfpostTithe+$thanksgiving5)*0.25}}</td>
    </tr>
    <tr>
        <th>July</th>
        <td>{{$jyfpostTithe}}</td>
        <td>{{$thanksgiving6}}</td>
        <td>{{($jyfpostTithe+$thanksgiving6)}}</td>
        <td>{{$jyfpostTithe*0.6}}</td>
        <td>{{$thanksgiving6*0.6}}</td>
        <td>{{($jyfpostTithe+$thanksgiving6)*0.6}}</td>
        <td>{{$jyfpostTithe*0.05}}</td>
        <td>{{$thanksgiving6*0.05}}</td>
        <td>{{($jyfpostTithe+$thanksgiving6)*0.05}}</td>
        <td>{{$jyfpostTithe*0.1}}</td>
        <td>{{$thanksgiving6*0.1}}</td>
        <td>{{($jyfpostTithe+$thanksgiving6)*0.1}}</td>
        <td>{{$jyfpostTithe*0.25}}</td>
        <td>{{$thanksgiving6*0.25}}</td>
        <td>{{($jyfpostTithe+$thanksgiving6)*0.25}}</td>
    </tr>
    <tr>
        <th>August</th>
        <td>{{$aufpostTithe}}</td>
        <td>{{$thanksgiving7}}</td>
        <td>{{($aufpostTithe+$thanksgiving7)}}</td>
        <td>{{$aufpostTithe*0.6}}</td>
        <td>{{$thanksgiving7*0.6}}</td>
        <td>{{($aufpostTithe+$thanksgiving7)*0.6}}</td>
        <td>{{$aufpostTithe*0.05}}</td>
        <td>{{$thanksgiving7*0.05}}</td>
        <td>{{($aufpostTithe+$thanksgiving7)*0.05}}</td>
        <td>{{$aufpostTithe*0.1}}</td>
        <td>{{$thanksgiving7*0.1}}</td>
        <td>{{($aufpostTithe+$thanksgiving7)*0.1}}</td>
        <td>{{$aufpostTithe*0.25}}</td>
        <td>{{$thanksgiving7*0.25}}</td>
        <td>{{($aufpostTithe+$thanksgiving7)*0.25}}</td>
    </tr>
    <tr>
        <th>September</th>
        <td>{{$sefpostTithe}}</td>
        <td>{{$thanksgiving9}}</td>
        <td>{{($sefpostTithe+$thanksgiving9)}}</td>
        <td>{{$sefpostTithe*0.6}}</td>
        <td>{{$thanksgiving9*0.6}}</td>
        <td>{{($sefpostTithe+$thanksgiving9)*0.6}}</td>
        <td>{{$sefpostTithe*0.05}}</td>
        <td>{{$thanksgiving9*0.05}}</td>
        <td>{{($sefpostTithe+$thanksgiving9)*0.05}}</td>
        <td>{{$sefpostTithe*0.1}}</td>
        <td>{{$thanksgiving9*0.1}}</td>
        <td>{{($sefpostTithe+$thanksgiving9)*0.1}}</td>
        <td>{{$sefpostTithe*0.25}}</td>
        <td>{{$thanksgiving9*0.25}}</td>
        <td>{{($sefpostTithe+$thanksgiving9)*0.25}}</td>

    </tr>
    <tr>
        <th>October</th>
        <td>{{$ocfpostTithe}}</td>
        <td>{{$thanksgiving10}}</td>
        <td>{{$ocfpostTithe+$thanksgiving10}}</td>
        <td>{{$ocfpostTithe*0.6}}</td>
        <td>{{$thanksgiving10 *0.6}}</td>
        <td>{{($ocfpostTithe+$thanksgiving10)*0.6}}</td>
        <td>{{$ocfpostTithe*0.05}}</td>
        <td>{{$thanksgiving10*0.05}}</td>
        <td>{{($ocfpostTithe+$thanksgiving10)*0.05}}</td>
        <td>{{$ocfpostTithe*0.1}}</td>
        <td>{{$thanksgiving10*0.1}}</td>
        <td>{{($ocfpostTithe+$thanksgiving10)*0.1}}</td>
        <td>{{$ocfpostTithe*0.25}}</td>
        <td>{{$thanksgiving10*0.25}}</td>
        <td>{{($ocfpostTithe+$thanksgiving10)*0.25}}</td>
    </tr>
    <tr>
        <th>November</th>
        <td>{{$novfpostTithe}}</td>
        <td>{{$thanksgiving11}}</td>
        <td>{{$novfpostTithe+$thanksgiving11}}</td>
        <td>{{$novfpostTithe*0.6}}</td>
        <td>{{$thanksgiving11*0.6}}</td>
        <td>{{($novfpostTithe+$thanksgiving11)*0.6}}</td>
        <td>{{$novfpostTithe*0.05}}</td>
        <td>{{$thanksgiving11*0.05}}</td>
        <td>{{($novfpostTithe+$thanksgiving11)*0.05}}</td>
        <td>{{$novfpostTithe*0.1}}</td>
        <td>{{$thanksgiving11*0.1}}</td>
        <td>{{($novfpostTithe+$thanksgiving11)*0.1}}</td>
        <td>{{$novfpostTithe*0.25}}</td>
        <td>{{$thanksgiving11*0.25}}</td>
        <td>{{($novfpostTithe+$thanksgiving11)*0.25}}</td>
    </tr>
    <tr>
        <th>December</th>
        <td>{{$decfpostTithe}}</td>
        <td>{{$thanksgiving12}}</td>
        <td>{{($decfpostTithe+$thanksgiving12)}}</td>
        <td>{{$decfpostTithe*0.6}}</td>
        <td>{{$thanksgiving12*0.6}}</td>
        <td>{{($decfpostTithe+$thanksgiving12)*0.6}}</td>
        <td>{{$decfpostTithe*0.05}}</td>
        <td>{{$thanksgiving12*0.05}}</td>
        <td>{{($decfpostTithe+$thanksgiving12)*0.05}}</td>
        <td>{{$decfpostTithe*0.1}}</td>
        <td>{{$thanksgiving12*0.1}}</td>
        <td>{{($decfpostTithe+$thanksgiving12)*0.1}}</td>
        <td>{{$decfpostTithe*0.25}}</td>
        <td>{{$thanksgiving12*0.25}}</td>
        <td>{{($decfpostTithe+$thanksgiving12)*0.25}}</td>
    </tr>
    </tbody>
</table>

</body>
</html>


