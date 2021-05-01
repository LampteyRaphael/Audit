@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text text-capitalize">
            Daily Report
        </p>
    </li>
@endsection

@section('content')
  @include('includes.form_error')

  {!! Form::open(['method'=>'POST','action'=>'Area\FinanceDailyController@store','class'=>'modal form-inline','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
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
                          {!! Form::date('date',Carbon\Carbon::now(),['class'=>'form-control']) !!}
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
        <div class="panel shadow mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Daily</a>
                    </li>
                    <li>
                        {{$date}}
                    </li>
                    <li class="active">Data tables</li>
                    <li>
                     <a href="" class="btn-link" data-toggle="modal" data-target="#date" style="color: darkblue"><i class="fa fa-calendar"></i>Change Date</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    @if($incomeCategory)

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Income Categories</th>
                                <th>GHS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($incomeCategory as $item)
                                <?php  $sumIncome=App\AreaIncome::where("area_id",Auth::user()->area_id)
                                    ->where('area_income_categories_id',$item->id)

                                    ->whereYear('created_at',$year)
                                    ->whereMonth('created_at',$month)
                                    ->whereDay('created_at',$day)
                                    ->pluck('amount')->sum();?>

                                @if($sumIncome==0)@else
                                    <tr>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            {{number_format($sumIncome,2)}}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach


                            <tr>
                                <td>Total Income</td>
                                <td>{{number_format($total,2)}}</td>
                            </tr>
                            </tbody>
                        </table>
                    @endif

                    <br><br>
                    @if($incomeCategoryE)
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Expenditure Categories</th>
                                <th>GHS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($incomeCategoryE as $item)
                                <?php $sunExpenditure=App\AreaExpenditure::where("area_id",Auth::user()->area_id)->where('area_income_categories_id',$item->id)
                                        ->whereYear('created_at',$year)
                                        ->whereMonth('created_at',$month)
                                        ->whereDay('created_at',$day)
                                        ->pluck('amount')->sum();
                                ?>

                                @if($sunExpenditure==0)@else
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>
                                        {{number_format($sunExpenditure,2)}}
                                    </td>
                                </tr>
                                @endif
                            @endforeach

                            @if($totalE==0)@else
                            <tr>
                                <td>Total Expenditure</td>
                                <td>{{number_format($totalE,2)}}</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                        <table class="table table-striped">
                            <tr>
                                <th>Total Income</th>
                                <td>{{number_format($total,2)}}</td>
                            </tr>
                            <tr>
                                <th>Total Expenditure</th>
                                <td>{{number_format($totalE,2)}}</td>
                            </tr>

                            <tr>
                                <th>Net Income</th>
                                <td>{{number_format($total-$totalE,2)}}</td>
                            </tr>
                        </table>
                    @endif

                </div>
            </div>
        </div>
    </div>


@endsection


