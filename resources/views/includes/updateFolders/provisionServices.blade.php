{{--<div class="col-md-12">--}}
{{--    <div class="panel mb0" id="step5">--}}
{{--        <div class="panel-heading border">--}}
{{--            <ol class="breadcrumb mb0 no-padding">--}}
{{--                <li>--}}
{{--                    <a href="javascript:;">POSITION/SERVICE IN THE CHURCH</a>--}}
{{--                </li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--        <div class="panel-body">--}}
{{--            <ul class="nav">--}}
{{--                <li><span id="name_error5" class="text text-danger bold "></span></li>--}}
{{--            </ul>--}}
{{--            <div class="col-sm-12">--}}
{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group ">--}}
{{--                        {!! Form::label('movementGroup','Movement/Group',['class'=>'control-label']) !!}--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>--}}
{{--                            {!! Form::textarea('movementGroup',null,['class'=>'form-control','rows'=>2,'id'=>'moreform']) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                <div class="col-sm-6">--}}
{{--                    <div class="form-group ">--}}
{{--                        {!! Form::label('position','Position/Service In The Church',['class'=>'control-label']) !!}--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-addon"><i class="fa fa-list-ul"></i></div>--}}
{{--                            {!! Form::textarea('position',null,['class'=>'form-control','rows'=>2]) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <button id="btn9" class="btn btn-primary pull-right" onclick="return step5NextFunction()">Continue</button>--}}
{{--                <button id="btn10" class="btn btn-danger pull-right" onclick="return step5BackFunction()">Back</button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


<header class="text-primary text-capitalize text-md-center font-weight-bold">POSITION/SERVICE IN THE CHURCH</header>
<div class="row">
    <div class="col-6">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('movementGroup','Movement/Group',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::textarea('movementGroup',null,['class'=>'form-control','rows'=>2]) !!}
            </div>
        </div>
    </div>


    <div class="col-6">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('position','Position/Service In The Church',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::textarea('position',null,['class'=>'form-control','rows'=>2]) !!}
            </div>
        </div>
    </div>
</div>










