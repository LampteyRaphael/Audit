{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            Donation--}}
{{--        </p>--}}
{{--    </li>--}}
{{--@endsection--}}

{{--@section('content')--}}

{{--    @include('includes.form_error')--}}
{{--    @include('includes.alert')--}}
{{--    --}}{{--@include('sweet::alert')--}}
{{--    <div class="row">--}}
{{--        <div class="table-responsive col-md-8 col-md-offset-2">--}}
{{--            <div class="panel shadow animated slideInDown">--}}
{{--                <div class="panel-heading">--}}
{{--                    <ol class="breadcrumb mb0 no-padding">--}}
{{--                        <li>--}}
{{--                            <a href="javascript:;">Donation</a>--}}
{{--                        </li>--}}
{{--                        <li class="active">Post Data</li>--}}
{{--                    </ol>--}}
{{--                </div>--}}
{{--                <div class="panel-body">--}}
@extends('layouts.app', ['activePage' => 'donation', 'titlePage' => __('Donations')])

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
                            <h4 class="card-title ">Tithe And Thanksgiving</h4>
                            <p class="card-category">Amount</p>
                        </div>
                        <div class="card-body">

                    {!! Form::open(['method'=>'POST','action'=>'Locals\DonationAndPledgeController@search','onsubmit' => 'return searchInfo()'])!!}
                    <div class="form-group col-sm-3">
                        {!! Form::label('code','Local Code',['class'=>'control-label']) !!}
                        {!! Form::text('code',Auth::user()->local->local_code,['class'=>'form-control','required'=>'required','disabled'=>'disabled']) !!}
                    </div>
                    <div class="form-group col-sm-6">
                        {!! Form::label('search','Last Three Digit Of Membership Id/Name/Email',['class'=>'control-label']) !!}
                        {!! Form::text('search',null,['class'=>'form-control','required'=>'required']) !!}
                    </div>

                    <div class="form-group col-sm-2" style="padding-top: 20px;">
                        {!! Form::submit('Search',['class'=>'btn btn-success']) !!}
                    </div>

                    {!! Form::close() !!}

                    <div class="col-md-12">
                        {!! Form::open(['method'=>'POST','action'=>'Locals\DonationAndPledgeController@post','onsubmit' => 'return ConfirmDelete()'])!!}

                        <div class="form-group">
                            {!! Form::label('check','Anonymous',['class'=>'control-label']) !!}
                            {!! Form::checkbox('check',1,null,['id'=>'Fictitious']) !!}
                        </div>

                        <div class="form-group bold" id="showFictitious">
                            {!! Form::label('fictitious','Account Name',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                                {!! Form::select('fictitious',[5=>'Anonymous'],5,['class'=>'form-control']) !!}
                                <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                            </div>
                        </div>

                        <div class="form-group bold" id="accountName">
                            {!! Form::label('user_id','Account Name',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                                {!! Form::select('user_id',$user,null,['class'=>'form-control selectpicker','multiple data-max-options'=>1,'data-live-search'=>'true']) !!}
                                <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                            </div>
                        </div>

                        <div class="form-group bold">
                            <div class="">
                                {!! Form::label('modeOfPayment','Payment Mode',['class'=>'control-label']) !!}
                                <div class="input-group">
                                    <div class="input-group-addon bg-blue"><i>GHS</i></div>
                                    {!! Form::select('modeOfPayment',[1=>'Cash',
                                    2=>'E-Payment',
                                    3=>'Cheque'
                                    ],'cash',['class'=>'form-control','required'=>'required','id'=>'modeofpayment']) !!}
                                    <div class="input-group-addon bg-blue"><i class="fa fa-money"></i></div>
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
                            {!! Form::label('checkNo','Cheque Number',['class'=>'control-label']) !!}

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

                        <div class="form-group bold" id="showFictitious">
                            {!! Form::label('donationOrPledge','Donation',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                                {!! Form::select('donationOrPledge',['donation'=>'Donation'],null,['class'=>'form-control','required'=>'required']) !!}
                                <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                            </div>
                        </div>

                        <div class="form-group ">
                            {!! Form::label('amount','Amount (GHS)',['class'=>'control-label']) !!}
                            <div class="input-group">
                                <div class="input-group-addon bg-blue"><i>GHS</i></div>
                                {!! Form::number('amount',null,['class'=>'form-control','step'=>'any','required'=>'required']) !!}
                                <div class="input-group-addon bg-blue"><i class="fa fa-money"></i></div>
                            </div>
                        </div>

                        <div class="form-group ">
                            {!! Form::hidden('local_id','local id',['class'=>'control-label']) !!}
                            {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control']) !!}
                        </div>
                        <div class="pull-right">
                            {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </div>
        </div>
    </div>

    <script type="text/javascript">
        var mode=document.getElementById('modeofpayment');

        var dateOfCheque=document.getElementById('dateOfCheque');

        var checkNo=document.getElementById('checkNo');

        var bank=document.getElementById('bank');


        dateOfCheque.style.display="none";
        checkNo.style.display="none";
        bank.style.display="none";


        mode.addEventListener('click',function (e) {

            if (mode.value==='3') {
                dateOfCheque.style.display="block";
                checkNo.style.display="block";
                bank.style.display="block";

            }else {
                dateOfCheque.style.display="none";
                checkNo.style.display="none";
                bank.style.display="none";
            }

        });


        var showFictitious=document.getElementById('showFictitious');
        showFictitious.style.display='none';
        var Fictitious=document.getElementById('Fictitious');


        Fictitious.onclick=function(e){

            if (Fictitious.checked){
                showFictitious.style.display="block";
                document.getElementById('accountName').style.display="none";
            }else {
                showFictitious.style.display="none";
                document.getElementById('accountName').style.display="block";
            }
        }
    </script>

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
@endsection

