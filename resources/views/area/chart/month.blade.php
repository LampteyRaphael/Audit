@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            The Apostolic Church-Ghana (District)
        </p>
    </li>

    <li>
        <p class="navbar-text">
            &numero; &nbsp;{{$countArea}}
        </p>
    </li>
@endsection

@section('content')
    @include('includes.alert')
    <div class="col-sm-12">
        {!! Form::open(['method'=>'POST','action'=>'Area\AreaDashboardController@store','class'=>'modal','id'=>'addArea', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Create New District
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('area_id','Area',['class'=>'control-label']) !!}
                            {!! Form::select('area_id',[$area->id=>$area->name],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('name','New District Name',['class'=>'control-label']) !!}
                            {!! Form::text('name',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('district_code','District Code',['class'=>'control-label']) !!}
                            {!! Form::text('district_code',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('date','Date District Was Created(optional)',['class'=>'control-label']) !!}
                            {!! Form::date('date',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="modal-footer no-border">
                    <div class="form-group">
                        {!! Form::submit('Close',["class"=>"btn btn-danger" ,"data-dismiss"=>"modal"]) !!}
                        {!! Form::submit('submit',["class"=>"btn  btn-info"]) !!}
                    </div>
                </div>
            </div>

        </div>

        {!! Form::close() !!}

    </div>

    @include('includes.form_error')
    <div class="table-responsive">
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a class="btn-link" href="{{route('areaDashboard.index')}}">
                            Home
                        </a>
                    </li>
                    <li>
                        <a class="btn-link" href="javascript:;">
                            <a class="btn-link" href="">{{ucwords($area->name)}}</a>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">District</a>
                    </li>
                    <li class="active">Data tables</li>

                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @if($districts)
                        <table class="table table-bordered mb0">
                            <thead>
                            <tr>
                                <th>District Code</th>
                                <th>District</th>
                                <th>Amount(GHS)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($districts as $district)
                                <tr>
                                    <td>{{$district->district_code}}</td>
                                    <td><a href="{{route('areaYearlyReport.index',$district->id)}}">{{$district->name}}</a></td>
                                    <td>
                                        {{number_format($tithe=App\PostTithe::whereIn('local_id',
                                        (App\Locals::where('district_id',$district->id)
                                        ->whereYear('created_at',$year)
                                        ->whereMonth('created_at',$month)
                                        ->pluck('id')))
                                        ->whereYear('created_at',$year)
                                        ->pluck('amount')->sum(),2)}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection