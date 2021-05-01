<header class="text-primary text-capitalize text-md-center font-weight-bold">POSITION/SERVICE IN THE CHURCH</header>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('movementGroup','Movement/Group',['class'=>'bmd-label-floating font-weight-bold']) !!}
                {!! Form::textarea('movementGroup',null,['class'=>'form-control','rows'=>2,'id'=>'moreform']) !!}
            </div>
        </div>
    </div>


    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('position','Position/Service In The Church',['class'=>'bmd-label-floating font-weight-bold']) !!}
                {!! Form::textarea('position',null,['class'=>'form-control','rows'=>2]) !!}
            </div>
        </div>
    </div>
</div>








