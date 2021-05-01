@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Post tithe to individual Account
        </p>
    </li>
@endsection

@section('content')
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to post?");
            if (x)
                return true;
            else
                return false;
        }

        function searchInfo()
        {
            var x = confirm("Are you ready to search?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
    @include('includes.form_error')

    @include('includes.alert')
    @include('sweet::alert')

    <div class="row">
        <div class="panel">
            <div class="panel-heading">Post tithe to individual Account</div>
            <div class="panel-body">

                {!! Form::open(['method'=>'POST','action'=>'Locals\SearchTitheController@search','onsubmit' => 'return searchInfo()'])!!}
                <div class="form-group col-md-3 bold">
                    {!! Form::label('code','Local Code',['class'=>'control-label']) !!}
                    {!! Form::text('code',Auth::user()->local->local_code,['class'=>'form-control input-lg','required'=>'required','disabled'=>'disabled']) !!}
                </div>
                <div class="form-group col-md-6 bold">
                    {!! Form::label('search','Search',['class'=>'control-label']) !!}
                    {!! Form::text('search',null,['class'=>'form-control input-lg','required'=>'required','multiple'=>'multiple']) !!}
                </div>

                <div class="form-group col-md-2">
                    {!! Form::submit('Search',['class'=>'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}

                <div class="col-md-12">
                    {!! Form::open(['method'=>'POST','action'=>'Locals\PostTitheController@store','onsubmit' => 'return ConfirmDelete()'])!!}
                    <div class="form-group ">
                        {!! Form::label('user_id','Account Name',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                            {!! Form::select('user_id',$user,null,['class'=>'form-control input-lg','required'=>'required']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-user"></i></div>
                        </div>
                    </div>
                    <div class="form-group ">
                        {!! Form::label('amount','Amount (GHS)',['class'=>'control-label']) !!}
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><i>GHS</i></div>
                            {!! Form::number('amount',null,['class'=>'form-control input-lg','required'=>'required']) !!}
                            <div class="input-group-addon bg-blue"><i>.00</i></div>
                        </div>
                    </div>

                    <div class="form-group ">
                        {!! Form::hidden('local_id','local id',['class'=>'control-label']) !!}
                        {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control']) !!}
                    </div>
                </div>


            </div>
            <div class="panel-footer">{!! Form::submit('submit',['class'=>'btn btn-primary']) !!}</div>
            {!! Form::close() !!}
        </div>

    </div>

@endsection

