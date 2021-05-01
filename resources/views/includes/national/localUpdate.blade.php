<div class="col-md-12">
    <div class="panel shadow  mb0" id="step6">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">OFFICE USE ONLY</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('role_id',$roles,null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('is_active','Active Status',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-wrench"></i></div>
                            {!! Form::select('is_active',[1=>'Active',0=>'Not Active'],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('password','Password',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            {!! Form::password('password',['class'=>'form-control','id'=>'myInput']) !!}
                            <div class="input-group-addon"><input type="checkbox"  onclick="myFunction()">Show
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group ">
                        {!! Form::label('members_id','Membership ID',['class'=>'control-label bold']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user-secret"></i></div>
                            {!! Form::text('members_id',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group ">
                        {!! Form::label('photo_id','Photo',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-photo"></i></div>
                            {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
{{--                    <div class="pull-left">--}}
{{--                        <button id="btn11" class="btn btn-default" onclick="return step6BackFunction()">Back</button>--}}

{{--                    </div>--}}
                    <div class="pull-right">
                        <div class="form-group ">
                            <button class="btn btn-primary pull-right" type="submit" onclick='return submitFunction()'>Update</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <div class="">
                        <div class="form-group pull-right">
                            {!! Form::model($user,['method'=>'DELETE','action'=>['National\AdminEditUsersController@destroy',$user->id],'onsubmit' => 'return ConfirmDelete()',],['class'=>'form-inline'])!!}
                            <button class="btn-danger btn" type="submit">Delete</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>