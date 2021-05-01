{{--@extends ('layouts.master_table')--}}
{{--@section('dashboard')--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            Tithe Report--}}
{{--        </p>--}}
{{--    </li>--}}
{{--@endsection--}}

{{--@section('content')--}}

{{--    @include('includes.form_error')--}}
{{--    @include('includes.alert')--}}
{{--    <div class="table-responsive col-md-6 col-md-offset-2">--}}
{{--        <div class="panel shadow  animated slideInDown">--}}
{{--            <div class="panel-heading">--}}
{{--                <ol class="breadcrumb mb0 no-padding">--}}
{{--                    <li>--}}
{{--                        <a href="javascript:;">Tithe Report</a>--}}
{{--                    </li>--}}
{{--                </ol>--}}

{{--            </div>--}}
{{--            <div class="panel-body">--}}
{{--                {!! Form::open(['method'=>'POST','action'=>'DistrictTransferController@store','onsubmit' => 'return ConfirmUpdate()'] ) !!}--}}

{{--                <div class="form-group">--}}
{{--                    {!! Form::label('local_id','Locals',['class'=>'control-label']) !!}--}}
{{--                    {!! Form::select('local_id',[''=>'--Choose Option--'],null,['class'=>'form-control','required'=>'required']) !!}--}}

{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    {!! Form::label('month','Year',['class'=>'control-label']) !!}--}}
{{--                    {!! Form::selectMonth('month',Carbon\Carbon::now()->month,['class'=>'form-control']) !!}--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    {!! Form::label('year','Year',['class'=>'control-label']) !!}--}}
{{--                    {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,\Carbon\Carbon::now()->year,['class'=>'form-control']) !!}--}}
{{--                </div>--}}

{{--                <div class="form-group pull-right">--}}
{{--                    {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}--}}
{{--                </div>--}}
{{--                {!! Form::close() !!}--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <script>--}}

{{--        function ConfirmUpdate()--}}
{{--        {--}}
{{--            var x = confirm("Are you sure you want to post?");--}}
{{--            if (x)--}}
{{--                return true;--}}
{{--            else--}}
{{--                return false;--}}
{{--        }--}}
{{--    </script>--}}
{{--@endsection--}}