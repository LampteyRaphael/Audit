@extends('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
          District  Posted Attendance
        </p>
    </li>
@endsection
@section('content')
    {!! Form::open(['method'=>'POST','action'=>'District\DistrictMoneyController@attendancepost','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <div class="input-group col-md-6 col-md-offset-3">
                        <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                        {!! Form::select('local', $locals,null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group col-md-6 col-md-offset-3">
                        <div class="input-group-addon"><span>Category</span></div>
                        {!! Form::select('category',
                        [
                        'sunday'=>'Sunday Service',
                        'wednesday'=>'Wednesday Teaching Service',
                        'Friday'=>'Friday Prayer Service',
                        'other'=>'Others'
                        ],null,['class'=>'form-control']) !!}
                        <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="date" class="control-label">  </label>
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">From</span></div>
                            {!! Form::date('from',Carbon\Carbon::now(),['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>

                </div>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="date" class="control-label">   </label>
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">To</span></div>
                            {!! Form::date('to',Carbon\Carbon::now(),['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>

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
    <div class="table-responsive">
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="">Home</a>
                    </li>
                    <li>
                        <a href="javascript:;">Total Attendance</a>
                    </li>
                    <li class="active">Data tables</li>
                    <li>
                        <a class="btn btn-success btn-xs" href="#date" data-toggle="modal">Change date & local</a>
                    </li>
                    <li>
                        <a class="btn btn-primary btn-xs" href="">Export to Excel</a>
                    </li>
                </ol>
            </div>

            <div class="panel-body">
                <div>
                    <table class="table table-striped mb0 overflow-hidden">
                    <span style="color:red">
                          {{$localName}}&nbsp;&nbsp;&nbsp;

                          {{$year}}&nbsp;&nbsp;&nbsp;

                           Category:{{$category}}
                    </span>


                        <thead>
                        <tr>
                            <th>Category</th>
                            @foreach($post as $item)
                                <th>{{$item->created_at? Carbon\Carbon::parse($item->created_at)->format('jS F,Y'):'-'}}</th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th>Ministers</th>
                            @if($post)
                                @foreach($post as $item)
                                    <td>{{$el=$item->ministers? $item->ministers:'-'}}</td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <th>Elders</th>
                            @if($post)
                                @foreach($post as $item)
                                    <td>{{$el=$item->elders? $item->elders:'-'}}</td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <th>Deacon</th>
                            @foreach($post as $item)
                                <td>{{$dac=$item->deacon? $item->deacon:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Deaconess</th>
                            @foreach($post as $item)
                                <td>{{$deacn=$item->deaconess? $item->deaconess:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Male</th>
                            @foreach($post as $item)
                                <td>{{$males=$item->male? $item->male:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Female</th>
                            @foreach($post as $item)
                                <td>{{$females=$item->female? $item->female:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Children</th>
                            @foreach($post as $item)
                                <td>{{$item->children? $item->children:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Visitors</th>
                            @foreach($post as $item)
                                <td>{{$v=$item->visitors? $item->visitors:'-'}}</td>
                            @endforeach
                        </tr>
                        <tr>
                            <th>Total</th>
                            @foreach($post as $item)
                                <?php $ministers=$item->ministers?>
                                <?php $el=$item->elders?>
                                <?php $dea=$item->deacon?>
                                <?php $deacns=$item->deaconess?>
                                <?php $males=$item->male?>
                                <?php $females=$item->female?>
                                <?php $child=$item->children?>
                                <?php $visitors=$item->visitors?>
                                <td>{{$el+$dea+$deacns+$males+$females+$visitors+$child+$ministers}}</td>
                            @endforeach

                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection