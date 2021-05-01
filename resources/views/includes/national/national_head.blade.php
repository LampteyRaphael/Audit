<div class="col-md-12">
{{--    <progress id="progressbar0"  value="9" max="100" style="width:100%"></progress>--}}
    <div class="panel mb0" id="step0">
    <div class="panel-heading border">
        <ol class="breadcrumb mb0 no-padding">
            <li>
                <a href="javascript:;">LOCATION</a>
            </li>
        </ol>
    </div>
    <div class="panel-body">
        @if($user)
            <div class="col-md-4">
                <img class="img-rounded img-responsive" height="150" width="150" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt="image">
            </div>
        @else
       @endif


        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::select('region_id',$regions,null,['class'=>'form-control selectpicker','data-live-search'=>'true','required'=>'required']) !!}
                </div>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::select('area_id',$areas,null,['class'=>'form-control selectpicker','data-live-search'=>'true','required'=>'required']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group ">
                {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::select('district_id',$districts,null,['class'=>'form-control selectpicker','data-live-search'=>'true','required'=>'required']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('local_id','Local',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::select('local_id',$locals,null,['class'=>'form-control selectpicker','data-live-search'=>'true','required'=>'required']) !!}
                </div>
            </div>
        </div>
{{--        <div class="col-md-12">--}}
{{--            <button id="btn2" class="btn btn-primary pull-right" onclick="return step0NextFunction();">Continue</button>--}}
{{--        </div>--}}

    </div>
</div>
</div>