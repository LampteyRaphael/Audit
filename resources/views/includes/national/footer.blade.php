<div class="col-md-12">
    <div class="panel  mb0" id="step6">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">OFFICE USE ONLY</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
{{--            <ul class="nav">--}}
{{--                <li><span id="name_error5" class="text text-danger bold "></span></li>--}}
{{--            </ul>--}}
            <div class="col-sm-12">

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-4 hidden">
                    <div class="form-group ">
                        {!! Form::label('is_active','Active Status',['class'=>'control-label bold']) !!}
                        <span style="color: red">*</span>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('is_active',[''=>'--Choose Option--',1=>'Active',0=>'Non Active'],1,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('password','Password',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            {!! Form::password('password',['class'=>'form-control','required'=>'required','id'=>'myInput']) !!}
                            <div class="input-group-addon"><input type="checkbox"  onclick="myFunction()">Show
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group ">
                        {!! Form::label('members_id','Membership ID',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-secret"></i></div>
                            {!! Form::number('members_id',null,['class'=>'form-control','required'=>'required', 'placeholder'=>$membershipId . "+3-digit only" ]) !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-12">
                    <div class="form-group ">
                        {!! Form::label('photo_id','Photo',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-photo"></i></div>
                            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="pull-right">
                    <div class="form-group ">
{{--                        <button id="btn11" class="btn btn-danger" onclick="step6BackFunction()">Back</button>--}}
                        {!! Form::submit('submit',['class'=>'btn btn-primary','id'=>'submit','onclick'=>'submitFunction()']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>