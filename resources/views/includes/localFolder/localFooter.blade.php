 <header class="text-primary font-weight-bold text-md-center text-capitalize">OFFICE USE ONLY</header>
 <div class="row">
     <div class="col-4" hidden>
         <div class="input-group form-control-lg">
             <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
             </div>
             <div class="form-group bmd-form-group is-filled has-success">
                 {!! Form::label('role_id','Role',['class'=>'control-label bold']) !!}
                 {!! Form::select('role_id',$roles,null,['class'=>'form-control']) !!}
             </div>
         </div>
     </div>

     <div class="col-4" hidden>
         <div class="input-group form-control-lg">
             <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
             </div>
             <div class="form-group bmd-form-group is-filled has-success">
                 {!! Form::label('is_active','Active Status',['class'=>'bmd-label-floating font-weight-bold']) !!}
                 {!! Form::select('is_active',[''=>'--Choose Option--',1=>'Active',0=>'Non Active'],1,['class'=>'form-control']) !!}
             </div>
         </div>
     </div>
     <div class="col-4">
         <div class="input-group form-control-lg">
             <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
             </div>
             <div class="form-group bmd-form-group is-filled has-success">
                 {!! Form::label('password','Password',['class'=>'control-label bold']) !!}
                 {!! Form::password('password',['class'=>'form-control','required'=>'required','id'=>'myInput']) !!}
             </div>
         </div>
     </div>
     <div class="col-4">
         <div class="input-group form-control-lg">
             <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
             </div>
             <div class="form-group bmd-form-group is-filled has-success">
                 {!! Form::label('members_id','Membership ID',['class'=>'bmd-label-floating font-weight-bold']) !!}
                 {!! Form::number('members_id',null,['class'=>'form-control form-control-danger','required'=>'required', 'placeholder'=>$membershipId . "+3-digit only" ]) !!}
             </div>
         </div>
     </div>
     <div class="col-4">
         <div class="input-group form-control-lg">
             <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">images</i>
              </span>
             </div>
             <div class="form-group bmd-form-group is-filled has-success">
                 {!! Form::label('photo_id','Photo',['class'=>'bmd-label-floating font-weight-bold']) !!}
                 {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
             </div>
         </div>
     </div>
 </div>

 <div class="card-footer text-primary">
     <div class="pull-right">
         {!! Form::submit('submit',['class'=>'btn btn-primary pull-right']) !!}
     </div>
 </div>







