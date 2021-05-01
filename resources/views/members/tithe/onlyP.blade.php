@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Posted Pledge
        </p>
    </li>
@endsection
@section('content')
    {!! Form::open(['method'=>'POST','action'=>'Locals\DonationAndPledgeController@onlyPpost','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Post Donation to Change Date
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group col-md-6 col-md-offset-3">
                            <div class="input-group-addon bg-blue"><span class="bold">Year</span></div>
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
    @if($donation)
        <div class="panel">

            <div class="panel-body">
                <div class="panel-heading">
                    <ol class="breadcrumb mb0 no-padding">
                        <li>
                            <a  href="javascript:;" >Pledge</a>
                        </li>
                        <li>{{$date}}</li>
                        <li class="active">Data tables</li>
                        <li>
                            <a href="#date" data-toggle="modal" class="btn btn-success btn-sm">Change Date</a>
                        </li>
                    </ol>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>NAMES</th>
                        <th>AMOUNT</th>

                        <th>MODE OF PAYMENT</th>

                        <th>DATE ON CHEQUE</th>

                        <th>CHEQUE NO.</th>
                        <th>POSTED AT</th>
                    </tr>
                    </thead>
                    <tbody>


                    @foreach($donation as $item)
                        <tr>
                            <td>{{$item->user->name}}</td>
                            <td>{{$item->amount}}</td>
                            @if($item->modeOfPayment==1)
                                <td>Cash</td>

                            @elseif($item->modeOfPayment==2)
                                <td>E-Payment</td>

                            @elseif($item->modeOfPayment==3)
                                <td>Cheque</td>
                            @else

                            @endif

                            <td>{{$item->dateOfCheque}}</td>
                            <td>{{$item->checkNo}}</td>
                            <td>{{$item->created_at->format('jS F, Y')}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>TOTAL</td>
                        <td>{{$donationSum}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="panel-footer"></div>
        </div>
    @endif
@endsection
