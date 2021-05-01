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
<p class="text-center">{{$date}} Tithe And Thanksgiving Offering</p>

<table class="table table-bordered">
    <thead>
    <tr>
        <th>MONTH</th>
        <th>GROSS</th>
        <th>60%</th>
        <th>5%</th>
        <th>10%</th>
        <th>25%</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>Tithe</th>
        <td>{{$postTithe}}</td>
        <td>{{$postTithe*0.6}}</td>
        <td>{{$postTithe*0.05}}</td>
        <td>{{$postTithe*0.1}}</td>
        <td>{{$postTithe*0.25}}</td>
    </tr>
    <tr>
        <th>Thanksgiving Offering</th>
        <td>{{$taksIdRange}}</td>
        <td>{{$taksIdRange*0.6}}</td>
        <td>{{$taksIdRange*0.05}}</td>
        <td>{{$taksIdRange*0.1}}</td>
        <td>{{$taksIdRange*0.25}}</td>
    </tr>
    <tr>
        <th>Total</th>
        <td>{{$taksIdRange+$postTithe}}</td>
        <td>{{($taksIdRange+$postTithe)*0.6}}</td>
        <td>{{($taksIdRange+$postTithe)*0.05}}</td>
        <td>{{($taksIdRange+$postTithe)*0.1}}</td>
        <td>{{($taksIdRange+$postTithe)*0.25}}</td>
    </tr>

    </tbody>
</table>

</body>
</html>


