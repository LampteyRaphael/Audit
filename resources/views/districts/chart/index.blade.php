@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">TITHE STATEMENT</p>
    </li>
@endsection
@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    {!! Form::open(['method'=>'POST','action'=>['District\DistrictTransferController@store',$id],'class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">Year</span></div>
                    {!! Form::selectMonth('month',$month,['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>
                    </label>
                </div>
                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">Year</span></div>
                            {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
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
            <div class="panel mb25">
                <div class="panel-heading border">
                    <ol class="breadcrumb mb0 no-padding">
                        <li>
                            <a  href="javascript:;" >{{$localName}}</a>
                        </li>
                        <li>
                            <a  href="javascript:;" >{{ $dates}}</a>
                        </li>
                        <li>
                            <a  href="javascript:;" >{{$year}}</a>
                        </li>
                        <li class="active">Data tables</li>
                        <li>
                            <a href="#date" data-toggle="modal" class="btn btn-success btn-xs">Change Date</a>
                        </li>
                        <li>
                            <a class="btn btn-info btn-xs" href="{{route('excel',$year)}}">Export to Excel</a>
                        </li>
                    </ol>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-responsive-sm table-sm table-small-font">
                            <thead>
                            <tr>
                                <th class="text-center bold large" colspan="7">{{str_replace(',',':',$dates)}}</th>
                            </tr>
                            <tr class="text-xl-center">
                                <th>ID</th>
                                <th>WEEK 1</th>
                                <th>WEEK 2</th>
                                <th>WEEK 3</th>
                                <th>WEEK 4</th>
                                <th>WEEK 5</th>
                                <th>TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <div class="table-responsive-sm">&nbsp;&nbsp;&nbsp;
                                @if($users)
                                    @foreach($users as $user_id)
                                        <tr>
                                            <td>{{$user_id->members_id}}</td>
                                            <td>
                                                @if (   number_format(
                                                    App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                    ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                      ->skip(0)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(0)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif

                                            </td>
                                            <td>
                                                @if (   number_format(
                                                 App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                 ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                   ->skip(1)->take(1)
                                               ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(1)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>

                                            <td>
                                                @if (   number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                              ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                ->skip(2)->take(1)
                                            ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(2)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (   number_format(
                                           App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                           ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                             ->skip(3)->take(1)
                                         ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(3)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (   number_format(
                                            App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                            ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                              ->skip(4)->take(1)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                                    ->skip(4)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>

                                            <td>

                                                @if ( number_format(
                                      App\PostTithe::where('user_id', $user_id->id)
                                          ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)

                                                @else
                                                    {{
                                             number_format(
                                      App\PostTithe::where('user_id', $user_id->id)
                                          ->whereYear('created_at',$year)->whereMonth('created_at',$a)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                             }}
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                            </div>

                            </tbody>
                        </table>
                        {{$users->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection