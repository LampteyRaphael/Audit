@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text text-capitalize">
            MidYear Report
        </p>
    </li>
@endsection

@section('content')

@include('includes.form_error')

@if($locals)
    <div class="table-responsive">
        <div class="panel shadow animated slideInDown mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">MidYear</a>
                    </li>
                    <li>
                        <a href="javascript:;">Report</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb0">
                        <thead>
                        <tr>
                            <th>Local Code</th>
                            <th>Local Name</th>
                            <th colspan="3">Gross</th>
                            <th colspan="3">60%</th>

                            <th colspan="3">5%</th>

                            <th colspan="3">10%</th>

                            <th colspan="3">25%</th>
                        </tr>
                        <tr>
                            <th>Local Code</th>
                            <th>Local Name</th>
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

                        @foreach($locals as $local)
                            <tr>
                                <td>{{$local->local_code}}</td>
                                <td>{{$local->name}}</td>
                                <td>
                                    <?php $tithe=App\PostTithe::where("local_id",$local->id)
                                        ->whereMonth('created_at','<=',6)
                                        ->whereYear('created_at',$year)
                                        ->pluck('amount')->sum() ?>
                                    {{number_format(($tithe),2)}}
                                </td>


                                <td>
                                    <?php $thanks=App\income::where('local_id',$local->id)->where('category_id',$taksId)
                                        ->whereMonth('created_at','<=',6)
                                        ->whereYear('created_at',$year)
                                        ->pluck('amount')->sum() ?>
                                    {{$thanks}}
                                </td>

                                <td>
                                    {{number_format(($tithe)+($thanks),2)}}
                                </td>

                                <td>
                                    {{number_format($tithe*0.6,2)}}
                                </td>

                                <td>
                                    {{number_format($thanks*0.6,2)}}
                                </td>

                                <td>
                                    {{number_format(($tithe*0.6)+($thanks*0.6),2)}}
                                </td>

                                <td>
                                    {{number_format($tithe*0.05,2)}}
                                </td>

                                <td>
                                    {{number_format($thanks*0.05,2)}}
                                </td>

                                <td>
                                    {{number_format(($tithe*0.05)+($thanks*0.05),2)}}
                                </td>


                                <td>
                                    {{number_format($tithe*0.1,2)}}
                                </td>

                                <td>
                                    {{number_format($thanks*0.1,2)}}
                                </td>

                                <td>
                                    {{number_format(($tithe*0.1)+($thanks*0.1),2)}}
                                </td>

                                <td>
                                    {{number_format($tithe*0.25,2)}}
                                </td>

                                <td>
                                    {{number_format($thanks*0.25,2)}}
                                </td>

                                <td>
                                    {{number_format(($tithe *0.25)+($thanks*0.25),2)}}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>-</td>
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
                    {{$locals->links()}}
                </div>
            </div>
        </div>
    </div>
@endif

@endsection