@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Tithe Chart Range
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')

    {{Session(['date1'=>$date1])}}
    {{Session(['date2'=>$date2])}}

    {!! Form::open(['method'=>'POST','action'=>'District\DistrictTransferController@store2','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">From</span></div>
                            {!! Form::date('date1',$date1,['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>
                    </label>
                </div>

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">To</span></div>
                            {!! Form::date('date2',$date2,['class'=>'form-control']) !!}
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
        <div class="panel">
            <div class="panel-heading">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="#">tithe</a>
                    </li>
                    <li>
                        <a href="#">Chart</a>
                    </li>
                    <li>
                        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#date">{{$date}}</a>
                    </li>
                    <li>
                        <a href="#">Data table</a>
                    </li>
                    <li>
                        <a href="{{route('titheCharts.show','TitheRange')}}" class="btn btn-success btn-xs">Print Pdf</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-hover">
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
            </div>
        </div>
    </div>
@endsection

