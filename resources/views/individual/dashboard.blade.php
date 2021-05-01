@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Tithe
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')

    @include('includes.alert')
    {{--@include('sweet::alert')--}}


    <div class="table-responsive col-md-10 col-md-offset-1">
        <div class="panel shadow animated slideInDown mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Tithe Paid</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mb0">
                        <thead>
                            <div>
                                {!! Form::open(['method'=>'POST','action'=>'Individuals\IndividualDashboardController@store']) !!}
                               <div class="col-md-2">
                                  Year:{!! Form::selectYear('year',2017,Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
                               </div>
                              
                                <div class="col-md-2">
                                   Month: {!! Form::selectMonth('month',$month,['class'=>'form-control']) !!}
                                </div>
                                <div class="col-md-2">
                                    <div style="padding-top:20px">
                                        {!! Form::submit('submit',['class'=>'btn  btn-primary btn-sm']) !!}
                                    </div>
                                </div>
                                
                            </div>
                        <tr>
                            <th>DATE</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($tithe)
                            @foreach($tithe as $tithes)
                                <tr>
                                    <td>{{$tithes->created_at->format('jS F, Y')}}</td>
                                    <td>{{number_format($tithes->amount,2)}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

