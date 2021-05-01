@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            {{$regionName}}
        </p>

    </li>
    <li>
        <p class="navbar-text">
           TITHE AND THANKSGIVING RECORDS
        </p>
    </li>
@endsection

@section('content')
    {!! Form::open(['method'=>'POST','action'=>'Area\AreaPostedChartController@yrangepost','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>

            <div class="modal-body">
                <div class="form-group col-md-offset-1">
                    <label for="date" class="control-label">   </label>
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><span class="bold">From</span></div>
                            {!! Form::date('date1',$date1,['class'=>'form-control']) !!}
                            {!! Form::hidden('id',$id,['class'=>'form-control col-md-6']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>

                </div>

                <div class="form-group col-md-offset-1">
                    <label for="date" class="control-label"></label>
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><span class="bold">To</span></div>
                            {!! Form::date('date2',$date2,['class'=>'form-control col-md-6']) !!}
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
    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Tithe</a>
                </li>
                <li>
                    <a href="javascript:;">Range</a>
                </li>
                <li>
                    {{$date}}
                </li>
                <li><a class="btn btn-sm btn-primary" href="#date" data-toggle="modal">Change Date</a></li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($districts)
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>District Code</th>
                            <th>District Name</th>
                            <th colspan="3">Gross</th>
                            <th colspan="3">60%</th>
                            <th colspan="3">5%</th>
                            <th colspan="3">10%</th>
                            <th colspan="3">25%</th>
                        </tr>
                        <tr>
                            <th>District Code</th>
                            <th>District Name</th>
                            <th>Tithe</th>
                            <th>Thanksgiving Offering</th>
                            <th>Total</th>
                            <th>Tithe%</th>
                            <th>Thanksgiving Offering</th>
                            <th>Total</th>
                            <th>Tithe</th>
                            <th>Thanksgiving Offering</th>
                            <th>Total</th>
                            <th>Tithe</th>
                            <th>Thanksgiving Offering</th>
                            <th>Total</th>
                            <th>Tithe</th>
                            <th>Thanksgiving Offering</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($districts as $district)
                            <tr>
                                <td>{{$district->district_code}}</td>
                                <td>
                                    <a href="{{route('PostedRangeALChart',$district->id)}}">{{$district->name}}</a></td>
                                <td>
                                    <?php
                                    $tithe= App\PostTithe::whereIn('local_id',
                                        App\Locals::whereIn('district_id',
                                            App\District::where('id',$district->id)
                                                ->pluck('id')->all())->pluck('id')->all())
                                        ->whereBetween('created_at', [$date1,$date2])
                                        ->pluck('amount')->sum()
                                    ?>
                                    {{($tithe)}}
                                </td>
                                <td>
                                    <?php $thanks=App\income::whereIn('local_id',
                                        App\Locals::whereIn('district_id',
                                            App\District::where('id',$district->id)
                                                ->pluck('id')->all())->pluck('id')->all())
                                        ->where('category_id',$taksId)
                                        ->whereBetween('created_at', [$date1,$date2])
                                        ->pluck('amount')->sum() ?>
                                    {{$thanks}}
                                </td>
                                <td>
                                    {{($tithe)+($thanks)}}
                                </td>
                                <td>
                                    {{$tithe*0.6}}
                                </td>
                                <td>
                                    {{$thanks*0.6}}
                                </td>
                                <td>
                                    {{($tithe*0.6)+($thanks*0.6)}}
                                </td>
                                <td>
                                    {{$tithe*0.05}}
                                </td>
                                <td>
                                    {{$thanks*0.05}}
                                </td>
                                <td>
                                    {{($tithe*0.05)+($thanks*0.05)}}
                                </td>
                                <td>
                                    {{$tithe*0.1}}
                                </td>
                                <td>
                                    {{$thanks*0.1}}
                                </td>
                                <td>
                                    {{($tithe*0.1)+($thanks*0.1)}}
                                </td>
                                <td>
                                    {{$tithe*0.25}}
                                </td>
                                <td>
                                    {{$thanks*0.25}}
                                </td>
                                <td>
                                    {{($tithe *0.25)+($thanks*0.25)}}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td>-</td>
                            <td>{{$yearTotal}}</td>
                            <td>{{$incomeTotal}}</td>
                            <td>{{($yearTotal)+($incomeTotal)}}</td>
                            <td>{{$yearTotal*0.6}}</td>
                            <td>{{$incomeTotal*0.6}}</td>
                            <td>{{($yearTotal*0.6)+($incomeTotal*0.6)}}</td>
                            <td>{{$yearTotal*0.05}}</td>
                            <td>{{$incomeTotal*0.05}}</td>
                            <td>{{($yearTotal*0.05)+($incomeTotal*0.05)}}</td>
                            <td>{{$yearTotal*0.1}}</td>
                            <td>{{$incomeTotal*0.1}}</td>
                            <td>{{($yearTotal*0.1)+($incomeTotal*0.1)}}</td>
                            <td>{{$yearTotal*0.25}}</td>
                            <td>{{$incomeTotal*0.25}}</td>
                            <td>{{($yearTotal*0.25)+($incomeTotal*0.25)}}</td>
                        </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection




