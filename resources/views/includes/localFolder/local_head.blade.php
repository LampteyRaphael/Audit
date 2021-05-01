<div class="col-md-12" hidden>
    <div class="panel mb25" >
        <div class="panel-heading no-border">
            <ol class="breadcrumb mb0 no-padding">
                <li><a href="javascript:;">LOCATION</a></li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="col-md-4">
                <div class="form-group ">
                    {!! Form::label('region_id','Region',['class'=>'control-label bold']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                        {!! Form::select('region_id',$regions,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    {!! Form::label('area_id','Area',['class'=>'control-label bold']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                        {!! Form::select('area_id',$areas,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    {!! Form::label('district_id','District',['class'=>'control-label bold']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                        {!! Form::select('district_id',$districts,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {!! Form::label('local_id','Local',['class'=>'control-label bold']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-area-chart"></i></div>
                        {!! Form::select('local_id',$locals,null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
