<div class="col-md-12" hidden>
<div class="panel mb25">
{{--    <div class="panel-heading no-border">--}}
{{--        <ol class="breadcrumb mb0 no-padding">--}}
{{--            <li><a href="javascript:;">LOCATION</a></li>--}}
{{--            <li> <a href="{{route('registration.index')}}" class="">Home</a></li>--}}
{{--            <li> <a href="{{route('localIndividualT',$user->id)}}" class="">Tithe</a></li>--}}
{{--            <li> <a class="" href="{{route('registration.edit',$user->id)}}" onclick="return update()">Edit</a></li>--}}
{{--        </ol>--}}
{{--    </div>--}}
    <div class="panel-body">
        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::hidden('region_id',Auth::user()->region_id,null,['class'=>'form-control','required'=>'required']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::hidden('area_id',Auth::user()->area_id,['class'=>'form-control','required'=>'required']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::hidden('district_id',Auth::user()->district_id,['class'=>'form-control','required'=>'required']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('local_id','Local',['class'=>'control-label bold']) !!}
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control','required'=>'required']) !!}
                     {!! Form::hidden('id',null,['class'=>'form-control','id'=>'userid']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
</div>


