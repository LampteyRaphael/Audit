<header class="text-primary text-capitalize text-md-center font-weight-bold">CHURCH DETAILS</header>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">calendar_today</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success bmd-label-static ">
                {!! Form::label('datejoinchurch','Date Join Church',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::date('datejoinchurch',null,['class'=>'form-control','placeholder'=>'YY-mm-dd)']) !!}
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
                {!! Form::label('previousdenomination','Previous Denomination',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('previousdenomination',null,['class'=>'form-control']) !!}
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
                {!! Form::label('waterBaptism','Water Baptism',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::select('waterBaptism',[''=>'--Choose Option--', 'yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('baptismBy','Baptised By',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('baptismBy',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>

    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">calendar_today</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('baptismDate','Date Of Baptism',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::date('baptismDate',null,['class'=>'form-control','placeholder'=>'YY-mm-dd)']) !!}
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
                {!! Form::label('baptismLocality','Place Of Baptism',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('baptismLocality',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('rightHandOfFellowship','Right Hand Of Fellowship',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::select('rightHandOfFellowship',[''=>'Choose Option','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
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
                {!! Form::label('communicant','Communicant',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::select('communicant',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
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
                {!! Form::label('holySpiritBaptism','Holy Spirit Baptism',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::select('holySpiritBaptism',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('anySpiritualGift','Any Spiritual Gift(s)',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::select('anySpiritualGift',[''=>'--Choose Option--','yes'=>'Yes','no'=>'No'],null,['class'=>'form-control','required'=>'required']) !!}
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
                {!! Form::label('pleaseIndicate','Indicate Any Spiritual Gift(s)',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('pleaseIndicate',null,['class'=>'form-control']) !!}
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
            <div class="form-group bmd-form-group is-filled has-success bmd-label-static ">
                {!! Form::select('officeHeld',[''=>'Choose Option', 'apostle'=>'Apostle','pastor'=>'Pastor','entrant'=>'Entrant',
                             'elder'=>'Elder','presiding elder'=>'Presiding Elder','deacon'=>'Deacon','deaconess'=>'Deaconess','member'=>'Member','new convert'=>'New Convert'
                          ],null,['class'=>'form-control','id'=>'officeHeld']) !!}
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">person</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('ordainedBy','Ordained By',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::text('ordainedBy',null,['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="input-group form-control-lg">
            <div class="input-group-prepend">
              <span class="input-group-text">
                <i class="material-icons">calendar_today</i>
              </span>
            </div>
            <div class="form-group bmd-form-group is-filled has-success">
                {!! Form::label('dateOrdained','Date Ordained',['class'=>'bmd-label-floating bmd-label-static  font-weight-bold']) !!}
                {!! Form::date('dateOrdained',null,['class'=>'form-control','placeholder'=>'YY-mm-dd)']) !!}
            </div>
        </div>
    </div>
</div>







