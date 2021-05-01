@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            {{$username->name}}
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')

    @include('includes.alert')
    @include('sweet::alert')
    {!! Form::open(['method'=>'POST','action'=>'National\NationalTitheController@memberpost','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
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
                            {!! Form::hidden('id',$username->id,['class'=>'form-control']) !!}
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
                Tithe Paid
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb0">
                        <thead>

                        <tr>
                            <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png'}}" alt=""></td>
                            <th>{{$username->name}}</th>
                            <th>{{$username->birthDate}}</th>
                            <th>{{$username->officeHeld}}</th>
                            <th><a href="#date" data-toggle="modal" class="btn btn-success btn-sm">Date</a> {{$year}}</th>
                        </tr>
                        <tr>
                            <th colspan="4">DATE</th>
                            <th>TITHE(GHS)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($tithe)
                            @foreach($tithe as $tithes)
                                <tr >
                                    <td colspan="4" style="border: none" >{{$tithes->created_at->format('jS F, Y')}}</td>
                                    <td style="border: none">{{number_format($tithes->amount,2)}}</td>
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

