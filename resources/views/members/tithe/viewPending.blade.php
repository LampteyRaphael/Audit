@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Edit Post Account
        </p>
    </li>
@endsection

@section('content')

    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to post?");
            if (x)
                return true;
            else
                return false;
        }

        function searchInfo()
        {
            var x = confirm("Are you ready to search?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
    @include('includes.form_error')
    @include('includes.alert')
    {{--@include('sweet::alert')--}}
    <div class="row">
        <div class="panel">
            <div class="panel-heading">
               Edit Post Amount
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    {!! Form::model($user,['method'=>'PATCH','action'=>['Locals\PostTitheController@update',$user->id],'onsubmit' => 'return ConfirmDelete()'])!!}
                    <div class="form-group bold">
                        {!! Form::label('user_id','Account Name',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                            {!! Form::select('user_id',[$user->user_id=>$user->user? $user->user->name:'UNKNOWN'],null,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('detail','Reason',['class'=>'control-label']) !!}
                            {!! Form::textarea('detail',null,['class'=>'form-control','required'=>'required','rows'=>2,'cols'=>2]) !!}
                    </div>

                    @if($user->modeOfPayment===3)
                    <div class="form-group bold">
                        <div class="">
                            {!! Form::label('modeOfPayment','Payment Mode',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon bg-blue"><i>GHS</i></div>
                                {!! Form::select('modeOfPayment',[1=>'Cash',
                                2=>'E-Payment',
                                3=>'Cheque'
                                ],$user->modeOfPayment,['class'=>'form-control','required'=>'required','id'=>'modeofpayment','disabled'=>'disabled']) !!}
                                <div class="input-group-addon bg-blue"><i>.00</i></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group bold" id='dateOfCheque'>
                        {!! Form::label('dateOfCheque','Date Written On the Cheque',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar"></i></div>
                            {!! Form::text('dateOfCheque',null,['id'=>'dateOfCheque','class'=>'form-control','placeholder'=>'YY/MM/DD']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                    <div class="form-group bold" id='checkNo'>
                        {!! Form::label('checkNo','Check Number',['class'=>'control-label']) !!}

                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i class="fa fa-check"></i></div>
                            {!! Form::text('checkNo',null,['id'=>'checkNo','class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                    <div class="form-group" id='bank'>
                        {!! Form::label('bank','Bank',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i class="fa fa-bank"></i></div>
                            {!! Form::text('bank',null,['id'=>'bank','class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                        @else
                    @endif

                    <div class="form-group ">
                        {!! Form::label('amount','Amount (GHS)',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i>GHS</i></div>
                            {!! Form::number('amount',null,['class'=>'form-control','step'=>'any','required'=>'required']) !!}
                            <div class="input-group-addon bg-blue"><i>.00</i></div>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::hidden('local_id','local id',['class'=>'control-label']) !!}
                        {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control']) !!}
                    </div>
                    <div class="col-md-12">
                        {!! Form::submit('submit',['class'=>'btn btn-primary btn-xm  btn-block']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>

    {{--<script type="text/javascript">--}}
        {{--var mode=document.getElementById('modeofpayment');--}}

        {{--var dateOfCheque=document.getElementById('dateOfCheque');--}}

        {{--var checkNo=document.getElementById('checkNo');--}}

        {{--var bank=document.getElementById('bank');--}}

        {{--if (mode.value==='3'){--}}
            {{--dateOfCheque.style.display="block";--}}
            {{--checkNo.style.display="block";--}}
            {{--bank.style.display="block";--}}
        {{--}--}}

        {{--dateOfCheque.style.display="none";--}}
        {{--checkNo.style.display="none";--}}
        {{--bank.style.display="none";--}}


        {{--mode.addEventListener('click',function (e) {--}}

            {{--if (mode.value==='3') {--}}

                {{--alert('The system will put pending on the figure entered until Cash is received.However Date and time collected the cheque will be used to update your account. Thank You');--}}

                {{--dateOfCheque.style.display="block";--}}
                {{--checkNo.style.display="block";--}}
                {{--bank.style.display="block";--}}

                {{--// alert('The system will put pending on the figure entered until Cash is received.However Date and time collected the cheque will be used to update your account. Thank You');--}}
            {{--}else {--}}
                {{--dateOfCheque.style.display="none";--}}
                {{--checkNo.style.display="none";--}}
                {{--bank.style.display="none";--}}
            {{--}--}}

        {{--});--}}
    {{--</script>--}}
@endsection

