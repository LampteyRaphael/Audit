<header class="text-primary font-weight-bold text-md-center text-capitalize">OFFICE USE ONLY</header>
<div class="row">
{{--    @if(Auth::user()->role_id==8)--}}
{{--        <div class="col-4">--}}
{{--            <div class="input-group form-control-lg">--}}
{{--                <div class="input-group-prepend">--}}
{{--                  <span class="input-group-text">--}}
{{--                    <i class="material-icons">category</i>--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="form-group bmd-form-group is-filled has-success">--}}
{{--                    {!! Form::label('role_id','Role',['class'=>'bmd-label-floating font-weight-bold']) !!}--}}
{{--                    {!! Form::select('role_id',[4=>'Local Administrator'],4,['class'=>'form-control']) !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @elseif(Auth::user()->role_id==12)--}}
{{--        <div class="col-4">--}}
{{--            <div class="input-group form-control-lg">--}}
{{--                <div class="input-group-prepend">--}}
{{--                  <span class="input-group-text">--}}
{{--                    <i class="material-icons">category</i>--}}
{{--                  </span>--}}
{{--                </div>--}}
{{--                <div class="form-group bmd-form-group is-filled has-success">--}}
{{--                    {!! Form::label('role_id','Role',['class'=>'bmd-label-floating font-weight-bold']) !!}--}}
{{--                    {!! Form::select('role_id',[4=>'Local Administrator'],4,['class'=>'form-control']) !!}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @else--}}
        <div class="col-4" hidden>
            <div class="input-group form-control-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">category</i>
                  </span>
                </div>
                <div class="form-group bmd-form-group is-filled has-success">
                    {!! Form::label('role_id','Role',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                    {!! Form::select('role_id',[4=>'Local Administrator',5=>'Member'],null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
{{--    @endif--}}
        <div class="col-4">
            <div class="input-group form-control-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">person_pin</i>
                  </span>
                </div>
                <div class="form-group bmd-form-group is-filled has-success">
                    {!! Form::label('is_active','Active Status',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                    {!! Form::select('is_active',[1=>'Active',0=>'Not Active',3=>'Deceased'],null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="input-group form-control-lg">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <i class="material-icons">lock</i>
                  </span>
                </div>
                <div class="form-group bmd-form-group is-filled has-success">
                    {!! Form::label('password','Password',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                    {!! Form::password('password',['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
</div>

<div class="row">

    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person_pin</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('members_id','Membership ID',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                {!! Form::number('members_id',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-4">
            <div class="form-group">
                {!! Form::label('photo_id','Photo',['class'=>'control-label']) !!}
                {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
            </div>
    </div>
    <div class="col-8">
        <button class="btn btn-primary btn-sm pull-right" type="submit">Update</button>
    </div>
    {!! Form::close() !!}

    <div class="">
{{--    {!! Form::model($user,['method'=>'DELETE','action'=>['Locals\RegisterLocalMembersController@destroy',$user->id],'onsubmit' => 'return ConfirmDelete()'],['class'=>'form-inline'])!!}--}}
{{--    <button class="btn btn-danger btn-sm pull-right" type="submit">Delete</button>--}}
{{--    {!! Form::close() !!}--}}
    </div>

</div>
