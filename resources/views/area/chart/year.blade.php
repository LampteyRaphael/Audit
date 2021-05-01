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
    @include('includes.form_error')

    {!! Form::open(['method'=>'POST','action'=>'Area\AreaTitheChartController@store','class'=>'modal form-inline','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><span class="bold">Date  click me</span></div>
                            {!! Form::selectYear('year',2017, \Carbon\Carbon::now()->year,\Carbon\Carbon::now()->year,['class'=>'form-control']) !!}
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
                    <li>
                        <a href="#date" data-toggle="modal" class="btn btn-primary btn-sm">Change Date</a>
                    </li>
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