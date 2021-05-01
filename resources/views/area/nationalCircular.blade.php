@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            National Circular
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')

    @include('includes.alert')

    <div class="row">
    <div class="panel shadow mb25">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">National Circular</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
            {{-- <div class="col-md-12">
                {!! Form::open(['method'=>'POST','action'=>'Area\AreaUsersUpdatingController@store']) !!}

                <div class="col-md-4">
                    {!! Form::label('month','Select Month',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {!! Form::selectMonth('month',\Carbon\Carbon::now()->month,['class'=>'form-control selectpicker','multiple data-max-options'=>1]) !!}
                        <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                    </div>
                </div>

                <div class="col-md-4">
                    {!! Form::label('year','Select year',['class'=>'control-label']) !!}
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,\Carbon\Carbon::now()->year,['class'=>'form-control selectpicker','multiple data-max-options'=>1]) !!}
                        <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                    </div>
                </div>
                <div class="col-md-4" style="padding-top: 23px;">
                    {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                </div>

                {!! Form::close() !!}
            </div> --}}

        </div>
        <div class="panel-body">
            {{--{{$post}}--}}
           <div class="table-responsive">
               @if($post)
                   <table class="table table-striped mb0">
                    <thead>
                        <tr>
                            <th colspan="3">
                                {!! Form::open(['method'=>'POST','action'=>'Area\AreaUsersUpdatingController@store']) !!}

                                <div class="col-md-4">
                                    {!! Form::label('month','Select Month',['class'=>'control-label']) !!}
                                    <div class="input-group">
                                         <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        {!! Form::selectMonth('month',$month,['class'=>'form-control']) !!}
                                        <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                                    </div>
                                </div>
                
                                <div class="col-md-4">
                                    {!! Form::label('year','Select year',['class'=>'control-label']) !!}
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                        {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
                                        <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-top: 23px;">
                                    {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                                </div>
                
                                {!! Form::close() !!}
                            </th>
                        </tr>
                    </thead>
                       <tbody>
                       @foreach($post as $posts)
                           <tr>
                                <td>National Circular</td>
                                <td><i class="fa fa-file-pdf-o btn" style="color:red;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/NationalPdf/','',$posts->name),10))}}</td>
                                <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                                <td>{{$posts->created_at->diffForHumans()}}</td>
                                <td><a class="btn btn-default btn-sm" href="{{route('nationalPdfShow',$posts->id)}}">View</a></td>
                           </tr>
                       @endforeach
                       </tbody>
                   </table>
               @endif
           </div>
        </div>
    </div>
    </div>
@endsection

