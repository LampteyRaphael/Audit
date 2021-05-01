@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text text-capitalize">
            Daily Report BreakDown
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')

    @if($locals)
        <div class="table-responsive">
            <div class="panel mb25">
                <div class="panel-heading border">
                    <ol class="breadcrumb mb0 no-padding">
                        <li>
                            <a href="{{route('areaYearlyReport')}}" class="btn btn-link">Back</a>
                        </li>
                        <li>
                            <a href="javascript:;">Daily</a>
                        </li>
                        <li>
                            <a href="javascript:;">Report</a>
                        </li>
                        <li class="active">Data tables</li>
                    </ol>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered mb0">
                            <thead>
                            <tr>
                                <th>Local Code</th>
                                <th>Local Name</th>
                                <th>GHS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($locals as $local)
                                <tr>
                                    <td>{{$local->local_code}}</td>
                                    <td>{{$local->name}}</td>
                                    <td>
                                        {{number_format((App\PostTithe::where("local_id",$local->id)
                                        ->whereYear('created_at',$year)
                                        ->pluck('amount')->sum()),2)}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Total Tithe</td>
                                <td></td>
                                <td>GHS{{number_format($area_tithe,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection


