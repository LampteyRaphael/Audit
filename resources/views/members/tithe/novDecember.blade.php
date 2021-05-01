@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">TITHE STATEMENT</p>
    </li>
@endsection
@section('content')

    {!! Form::open(['method'=>'POST','action'=>'Locals\TitheController@novDecemberPost','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
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
                            {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,\Carbon\Carbon::now()->year,['class'=>'form-control']) !!}
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
                        <li>{{$year}}</li>
                        <li>
                            <a  href="javascript:;" >NOVEMBER-DECEMBER</a>
                        </li>
                        <li class="active">Data tables</li>
                        <li>
                            <a href="#date" data-toggle="modal" class="btn btn-success btn-xs">Change Date</a>
                        </li>
                        <li>
                            <a class="btn btn-info btn-xs" href="{{route('excelND',$year)}}">Export to Excel</a>
                        </li>
                    </ol>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-responsive-sm table-sm table-small-font">
                            <thead>
                            <tr>
                                <th colspan="7" class="text-center">NOVEMBER</th>
                                <th colspan="7" class="text-center">DECEMBER</th>
                            </tr>
                            <tr class="text-xl-center">
                                <th>ID</th>
                                <th>WEEK 1</th>
                                <th>WEEK 2</th>
                                <th>WEEK 3</th>
                                <th>WEEK 4</th>
                                <th>WEEK 5</th>
                                <th>TOTAL</th>

                                <th>WEEK 1</th>
                                <th>WEEK 2</th>
                                <th>WEEK 3</th>
                                <th>WEEK 4</th>
                                <th>WEEK 5</th>
                                <th>TOTAL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <div class="table-responsive-sm">
                                &nbsp;<a class="btn-link" style="color: blue" class="btn-link" href="{{route('titheYearStatement')}}">January-February</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn-link" style="color: blue" href="{{route('titheMonthStatement')}}">March-April</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn-link" style="color: blue" href="{{route('mayJune')}}">May-June</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn-link" style="color: blue" href="{{route('julyAugust')}}">July-August</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn-link" style="color: blue" href="{{route('septOctober')}}">September-October</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                <a class="btn-link" style="color: blue" href="{{route('novDecember')}}">November-December</a>&nbsp;&nbsp;&nbsp;
                                @if($users)
                                    @foreach($users as $user_id)
                                        <tr>
                                            <td>{{$user_id->members_id}}</td>

                                            {{--january--}}
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


                                            {{--February--}}
                                            <td>
                                                @if (   number_format(
                                                    App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                    ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                      ->skip(0)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(0)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif

                                            </td>
                                            <td>
                                                @if (   number_format(
                                                 App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                 ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                   ->skip(1)->take(1)
                                               ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(1)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>

                                            <td>
                                                @if (   number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                              ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                ->skip(2)->take(1)
                                            ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(2)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (   number_format(
                                           App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                           ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                             ->skip(3)->take(1)
                                         ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(3)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>
                                            <td>
                                                @if (   number_format(
                                            App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                            ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                              ->skip(4)->take(1)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)


                                                @else
                                                    {{
                                                      number_format(
                                              App\PostTithe::orderBy('created_at','asc')->where('user_id', $user_id->id)
                                                  ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                                    ->skip(4)->take(1)
                                                  ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)
                                                     }}
                                                @endif
                                            </td>

                                            <td>

                                                @if ( number_format(
                                      App\PostTithe::where('user_id', $user_id->id)
                                          ->whereYear('created_at',$year)->whereMonth('created_at',$b)
                                          ->where('local_id', Auth::user()->local_id)->pluck('amount')->sum(),2)==0.00)

                                                @else
                                                    {{
                                             number_format(
                                      App\PostTithe::where('user_id', $user_id->id)
                                          ->whereYear('created_at',$year)->whereMonth('created_at',$b)
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