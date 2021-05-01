{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            Individual Posted Tithe--}}
{{--        </p>--}}
{{--    </li>--}}
{{--@endsection--}}

{{--@section('content')--}}
{{--    @include('includes.form_error')--}}
{{--    @include('includes.alert')--}}
    {{--@include('sweet::alert')--}}
@extends('layouts.app', ['activePage' => 'postedTithe', 'titlePage' => __('Tithe')])

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    {{--@include('sweet::alert')--}}
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title "> Individual Posted Tithe</h4>
                            <p class="card-category">Amount</p>
                        </div>
                        <div class="card-body">
                            {!! Form::open(['method'=>'POST','action'=>'Locals\ShowIndividualTitheAtLocalController@index2','class'=>'modal form-row','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        The Apostolic Church-Ghana
                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            {!! Form::date('date',Carbon\Carbon::now(),['class'=>'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group">
                                            {!! Form::submit('Close',['class'=>'btn  btn-danger','data-dismiss'=>'modal']) !!}
                                            {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}

                <h6 class="pull-center">{{$date}}</h6>
                    <a class="btn btn-xs btn-primary pull-right" href="#date" data-toggle="modal">Change Date</a>
                <div class="table-responsive">
                    <table class="table table-striped  table-hover table-sm">
                        <thead>
                        <tr>
                            <th>Posted Date And Time</th>
                            <th>GHS</th>
                            <th>Names</th>
                            <th>Mode Of Payment</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($tithe)

                            @foreach($tithe as $item)
                                <tr>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{number_format($item->amount,2)}}</td>
                                    <td>{{$item->user? $item->user->name:'UNKNOWN'}}</td>
                                    <td>
                                        @if($item->modeOfPayment==1)
                                            <a  onclick='return ConfirmDelete()'  class="btn btn-info btn-sm" href="{{route('tithe.show',$item->id)}}">{{'cash'}}</a>
                                        @elseif($item->modeOfPayment==2)
                                            <a  onclick='return ConfirmDelete()'  class="btn btn-info btn-sm" href="{{route('tithe.show',$item->id)}}">{{'E-Payment'}}<i class="fa fa-wrench"></i></a>
                                        @elseif($item->modeOfPayment==3)

                                            <a  onclick='return ConfirmDelete()'  class=" btn btn-info btn-sm" href="{{route('tithe.show',$item->id)}}">{{'cheque'}}</a>

                                        @elseif($item->modeOfPayment==5)

                                            <a  onclick='return ConfirmDelete()'  class="btn btn-sm btn-info " href="{{route('tithe.show',$item->id)}}">{{'UNKNOWN TITHE PAID'}}</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Total</td>
                                <td>{{number_format($totalTithe,2)}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
</div>

    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmUpdate()
        {
            var x = confirm("Are you sure you want to update?");
            if (x)
                return true;
            else
                return false;
        }


        function  cashReceived() {
            var x = confirm("Are you sure the cheque goes through? if yes click Ok to stop the person from pending... thank you");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endsection

