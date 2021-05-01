@extends('layouts.app', ['activePage' => 'attendance', 'titlePage' => __('Post Attendance')])

@section('content')
    @include('includes.alert')
    @include('includes.form_error')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Church Attendance</h4>
                            <p class="card-category">Post church attendance</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                <div class="table-responsive">

                <div class="table-responsive">

                   {!! Form::open(['method'=>'POST','action'=>'Locals\AttendanceController@store','files'=>true,'onsubmit' => 'return ConfirmUpdate()'])!!}

                    <div class="form-group">
                        {!! Form::label('category','Choose Date',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            {!! Form::date('created_at',Carbon\Carbon::now(),['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('category','Category',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::select('category',
                        [
                        'sunday'=>'Sunday Service',
                        'wednesday'=>'Wednesday Teaching Service',
                        'Friday'=>'Friday Prayer Service',
                        'other'=>'Others'
                        ],null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('ministers','Ministers',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('ministers',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-user-plus"></i></div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('elders','Elders',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::text('elders',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-user-plus"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('deacon','Deacon',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::text('deacon',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-user-plus"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('deaconess','Deaconess',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                            {!! Form::text('deaconess',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-user-plus"></i></div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('male','Male',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::text('male',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-user-plus"></i></div>
                        </div>
                    </div>


                    <div class="form-group">
                        {!! Form::label('female','Female',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::text('female',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-user-plus"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('children','Children',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::text('children',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-user-plus"></i></div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('visitors','Visitors',['class'=>'label-control']) !!}
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-user"></i></div>
                        {!! Form::text('visitors',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon"><i class="fa fa-user-plus"></i></div>
                        </div>
                    </div>

                    {!! Form::hidden('local_id',$id,['class'=>'form-control']) !!}

                    {!! Form::hidden('talley',1,['class'=>'form-control']) !!}

                   {!! Form::submit('submit',['class'=>'btn btn-primary pull-right']) !!}


                   {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<script>

    function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }

    function ConfirmUpdate()
    {
        var x = confirm("Are you sure you want to Post?");
        if (x)
            return true;
        else
            return false;
    }
</script>
@endsection

