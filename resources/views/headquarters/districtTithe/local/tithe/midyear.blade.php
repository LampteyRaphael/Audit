@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">MidYear Tithe Statement</p>
    </li>
@endsection
@section('content')
    @if($tithe)
        <div class="row">
            <div class="table-responsive">
                <div class="panel mb25">
                    <div class="panel-heading border">
                        <ol class="breadcrumb mb0 no-padding">
                            <li>{{$year}}</li>
                            <li>
                                <a  href="javascript:;" >TITHE STATEMENT</a>
                            </li>
                            <li>
                                <a href="javascript:;">MidYear</a>
                            </li>
                            <li class="active">Data tables</li>
                            <li>
                                <a href="" class="btn btn-success btn-sm">Change Date</a>
                            </li>
                        </ol>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th></th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tithe as $tithes)
                                <tr>
                                    <td>
                                        {{$tithes->name}}
                                    </td>

                                    @foreach(App\PostTithe::where('local_id',Auth::user()->local_id)

                                    ->whereYear('created_at',$year)->whereMonth('created_at','<=',6)
                                    ->where('user_id',$tithes->id)->pluck('amount') as $item)

                                        <td> {{number_format($item,2)}} </td>

                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection