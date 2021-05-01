@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Subscribe To SMS
        </p>
    </li>
@endsection
@section('content')
    @include('includes.alert')

    <div class="panel">
        <div class="panel-heading"></div>
        <div class="panel-body">
            {!! Form::open(['method'=>'POST','action'=>'National\NationalSMSController@store','files'=>true,'class'=>'row', 'onsubmit'=>'return ConfirmDelete()'])!!}

            <div class="form-group">
                {!! Form::label('local_id','Local Name',['class'=>'control-label bold']) !!}
                {!! Form::select('local_id',[''=>'--Select Option--']+$locals,null,['class'=>'form-control','required'=>'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('amount','Amount(GHS)',['class'=>'control-label bold']) !!}
                {!! Form::number('amount',null,['class'=>'form-control','required'=>'required','step'=>'any']) !!}
            </div>

{{--            <div class="form-group">--}}
{{--                <div class="add-on">--}}
{{--                    <a class="btn-link" href="javascript:;" id="generate">Generate Code</a>--}}
{{--                    {!! Form::label('smsGeneratedCode','Generate Code',['class'=>'control-label bold']) !!}--}}
{{--                    {!! Form::text('smsGeneratedCode',null,['class'=>'form-control','required'=>'required','id'=>'generating']) !!}--}}
{{--                </div>--}}

{{--            </div>--}}


            <div class="form-group hidden">
                {!! Form::label('is_active','Status',['class'=>'control-label']) !!}
                {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],1,['class'=>'form-control','required'=>'required']) !!}
            </div>
            <div class="form-group hidden">
                {!! Form::label('block','Block Status',['class'=>'control-label']) !!}
                {!! Form::select('block',[1=>'Not Block',0=>'Block'],1,['class'=>'form-control','required'=>'required']) !!}
            </div>

            <div class="form-group pull-right">
                {!! Form::submit('submit',['class'=>'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
        <div class="panel-footer"></div>
    </div>


    <script>

        var generate=document.getElementById('generate');

        var generating=document.getElementById('generating');

        generate.addEventListener('keyup',function (e) {

            generating.value.display=123;

        });
    </script>

@endsection

