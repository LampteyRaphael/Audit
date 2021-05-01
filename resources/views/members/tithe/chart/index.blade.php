{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            Tithe Chart--}}
{{--        </p>--}}
{{--    </li>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    @include('includes.form_error')--}}
{{--    @include('includes.alert')--}}
@extends('layouts.app', ['activePage' => 'titheChart', 'titlePage' => __('Tithe Chart')])

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    {{--@include('sweet::alert')--}}

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Tithe And Thanksgiving</h4>
                            <p class="card-category">Amount</p>
                        </div>
                        <div class="card-body">
    {{Session(['chartYear'=>$year])}}
    {!! Form::open(['method'=>'POST','action'=>'Locals\TitheChartController@store','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><span class="bold">Year</span></div>
                            {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,\Carbon\Carbon::now()->year,['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="modal-footer no-border">
                <div class="form-group">
                    {!! Form::submit('Close',['class'=>'btn  btn-danger','data-dismiss'=>'modal']) !!}
                    {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
<div class="row">
<div class="table-responsive">

                    <a class="btn btn-primary btn-xs pull-right" href="#" data-toggle="modal" data-target="#date">{{$year}}</a>


                    <a class="btn btn-success pull-right" href="{{route('titheCharts.edit','exporting..')}}">Export.Excel</a>

                {{--<li>--}}
                {{--<a href="{{route('titheChartRPdf',$year)}}">Print PDF</a>--}}

                <table class="table  table-hover">
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
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
    </div>
</div>


@endsection

