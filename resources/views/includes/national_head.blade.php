<div class="col-md-10 col-md-offset-1" id="step0">
    <progress id="progressbar0"  value="9" max="100" style="width:100%"></progress>
    <div class="panel shadow mb0">
    <div class="panel-heading border">
        <ol class="breadcrumb mb0 no-padding">
            <li>
                <a href="javascript:;">LOCATION</a>
            </li>
        </ol>
    </div>
    <div class="panel-body">
        <div class="col-md-6">
            <div class="form-group ">
                {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::select('region_id',$regions,null,['class'=>'form-control selectpicker','data-live-search'=>'true','required'=>'required']) !!}
                </div>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group ">
                {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::select('area_id',$areas,null,['class'=>'form-control selectpicker','data-live-search'=>'true','required'=>'required']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group ">
                {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::select('district_id',$districts,null,['class'=>'form-control selectpicker','data-live-search'=>'true','required'=>'required']) !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {!! Form::label('local_id','Local',['class'=>'control-label bold']) !!}
                <span style="color: red">*</span>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                    {!! Form::select('local_id',$locals,null,['class'=>'form-control selectpicker','data-live-search'=>'true','required'=>'required']) !!}
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <button id="btn2" class="btn btn-primary pull-right" onclick="step0NextFunction();">Continue</button>
        </div>

    </div>
</div>
</div>