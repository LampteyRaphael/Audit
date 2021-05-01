@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            {{$regionName->name}}
        </p>

    </li>
    <li>
        <p class="navbar-text">
            AREA TITHE RECORDS
        </p>
    </li>
@endsection

@section('content')
    {!! Form::open(['method'=>'POST','action'=>'National\NationalFinanceAreaController@indexpost','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">Select Date</span></div>
                            {!! Form::date('date',Carbon\Carbon::now(),['class'=>'form-control']) !!}
                            {!! Form::hidden('id',$id,['class'=>'form-control']) !!}
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
    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li><a href="{{route('NDaily')}}" class="btn btn-default btn-xs">Go Back</a></li>
                <li>
                    <a href="javascript:;">Tithe</a>
                </li>
                <li>
                    <a href="javascript:;">Daily</a>
                </li>
                <li>
                    {{$date}}
                </li>
                <li><a class="btn btn-xs btn-default" href="#date" data-toggle="modal">Change Date</a></li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($areas)
                    <table class="table table-striped table-scroll-vertical table-hover">
                        <thead>
                        <tr>
                            <th>Daily</th>
                            <th colspan="3">GROSS</th>
                            <th colspan="3">60%</th>
                            <th colspan="3">5%</th>
                            <th colspan="3">10%</th>
                            <th colspan="3">25%</th>
                        </tr>
                        <tr>
                            <th>Daily</th>
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
                        @foreach($areas as $area)
                            <tr>
                                <td>
                                    <a class="btn-link" href="{{route('districtNational',$area->id)}}">{{$area->name}}</a>
                                </td>
                                <td>
                                    <?php
                                    $tithe= App\PostTithe::whereIn('local_id',App\Locals::whereIn('district_id',App\District::where('area_id',$area->id)->pluck('id')->all())->pluck('id')

                                        ) ->whereDay('created_at',$day)->whereMonth('created_at',$month)
                                            ->whereYear('created_at', $year)
                                            ->pluck('amount')->sum();
                                    ?>
                                    {{number_format($tithe,2)}}
                                </td>
                                <td>

                                    <?php
                                    $thanks=App\income::whereIn('local_id',
                                        App\Locals::whereIn('district_id',App\District::where('area_id',$area->id)->pluck('id')->all())->pluck('id')

                                    ) ->whereDay('created_at',$day)->whereMonth('created_at',$month)
                                        ->whereYear('created_at', $year)
                                        ->pluck('amount')->sum();
                                    ?>
                                    {{number_format($thanks,2)}}

                                </td>

                                <td style="background:white">

                                    {{number_format(($tithe)+($thanks),2)}}
                                </td>

                                <td>
                                    {{number_format($tithe*0.6,2)}}
                                </td>

                                <td>
                                    {{number_format($thanks*0.6,2)}}
                                </td>

                                <td style="background:white">
                                    {{number_format(($tithe*0.6)+($thanks*0.6),2)}}
                                </td>

                                <td>
                                    {{number_format($tithe*0.05,2)}}
                                </td>

                                <td>
                                    {{number_format($thanks*0.05,2)}}
                                </td>

                                <td style="background:white">
                                    {{number_format(($tithe*0.05)+($thanks*0.05),2)}}
                                </td>


                                <td>
                                    {{number_format($tithe*0.1,2)}}
                                </td>

                                <td>
                                    {{number_format($thanks*0.1,2)}}
                                </td>

                                <td style="background:white">
                                    {{number_format(($tithe*0.1)+($thanks*0.1),2)}}
                                </td>

                                <td>
                                    {{number_format($tithe*0.25,2)}}
                                </td>

                                <td>
                                    {{number_format($thanks*0.25,2)}}
                                </td>

                                <td style="background:white">
                                    {{number_format(($tithe *0.25)+($thanks*0.25),2)}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($yearTotal,2)}}</td>
                            <td>{{number_format($incomeTotal,2)}}</td>
                            <td>{{number_format(($yearTotal)+($incomeTotal),2)}}</td>
                            <td>{{number_format($yearTotal*0.6,2)}}</td>
                            <td>{{number_format($incomeTotal*0.6,2)}}</td>
                            <td>{{number_format(($yearTotal*0.6)+($incomeTotal*0.6),2)}}</td>
                            <td>{{number_format($yearTotal*0.05,2)}}</td>
                            <td>{{number_format($incomeTotal*0.05,2)}}</td>
                            <td>{{number_format(($yearTotal*0.05)+($incomeTotal*0.05),2)}}</td>
                            <td>{{number_format($yearTotal*0.1,2)}}</td>
                            <td>{{number_format($incomeTotal*0.1,2)}}</td>
                            <td>{{number_format(($yearTotal*0.1)+($incomeTotal*0.1),2)}}</td>
                            <td>{{number_format($yearTotal*0.25,2)}}</td>
                            <td>{{number_format($incomeTotal*0.25,2)}}</td>
                            <td>{{number_format(($yearTotal*0.25)+($incomeTotal*0.25),2)}}</td>
                        </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection



