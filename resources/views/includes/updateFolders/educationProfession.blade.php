<header class="text-primary font-weight-bold text-capitalize text-md-center">EDUCATION & PROFESSION</header>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">category</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('education','Level Of Education',['class'=>'bmd-label-floating font-weight-bold']) !!}
                {!! Form::select('education',[''=>'--Choose Option--',
                'non'=>'Non',
                'basic'=>'Basic',
                'vocational'=>'Vocational',
                'secondary'=>'Secondary',
                'o level'=>'O Level',
                'tertiary'=>'Tertiary'],null,['class'=>'form-control']) !!}
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
                {!! Form::label('courseStudied','Course Studied',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('courseStudied',null,['class'=>'form-control']) !!}
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
                {!! Form::label('employmentType','Employment Type',['class'=>'bmd-label-floating bmd-label-static font-weight-bold']) !!}
                {!! Form::select('employmentType',
                [''=>'--Choose Option--',
                 'self employed'=>'Self Employed',
                 'government'=>'Government',
                 'private sector'=>'Private Sector',
                 'student'=>'Student',
                 'unemployed'=>'Unemployed',
                 'retired'=>'Retired'
                ],null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">category</i>
                      </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('profOccupation','Profession/Occupation',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('profOccupation',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>


    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="material-icons">places</i>
                      </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('placeOfWork','Place Of Work',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('placeOfWork',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
