@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            District Circular
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')

    @include('includes.alert')

    <div class="row">

        {!! Form::open(['method'=>'POST','action'=>'District\DistrictCircularController@store','class'=>'modal fadeIn','id'=>'message', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog','files'=>true] ) !!}
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">Post Circular</div>
                <div class="modal-body">

                    <div class="form-group ">
                        {!! Form::label('name','upload Pdf',['class'=>'control-label']) !!}
                        {!! Form::file('name',null,['class'=>'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::hidden('district_id',Auth::user()->district_id,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group">
                    {!! Form::button('Close',['class'=>'btn  btn-danger','data-dismiss'=>'modal']) !!}
                    {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}

                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;"> Circular</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            @if($post)
                <table class="table table-striped">
                    <tr>
                        {!! Form::open(['method'=>'PUT','action'=>['District\DistrictCircularController@update','district-post-update'],'onsubmit'=>'return confirmDelete()']) !!}
                        <td>
                            Year:{!! Form::selectYear('year',2017,Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
                        </td>

                        <td>
                            Month: {!! Form::selectMonth('month',$month,['class'=>'form-control']) !!}
                        </td>
                        <td>
                            <div style="padding-top:20px">
                                {!! Form::submit('submit',['class'=>'btn  btn-primary btn-sm']) !!}

                                {!! Form::close() !!}
                            </div>
                        </td>
                        <td>
                            <a class="btn btn-success btn-xs pull-right" href="" data-toggle="modal" data-target="#message">+ Add Circular</a>
                        </td>
                        <td></td>
                    </tr>
                    <tbody>
                    @foreach($post as $posts)
                        <tr>
                            <td>District Circular</td>
                            <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                            <td><i class="fa fa-file-pdf-o btn" style="color:red;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/DistrictPdf/','',$posts->name),10))}}</td>
                            <td>{{$posts->created_at->diffForHumans()}}</td>
                            <td>
                                {!! Form::open(['method'=>'DELETE','action'=>['District\DistrictCircularController@destroy',$posts->id],'onsubmit' => 'return ConfirmDelete()']) !!}
                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-recycle"></i></button>
                                {!! Form::close() !!}
                            </td>
                            <td>
                                <a class="btn btn-default btn-sm" href="{{route('circular1.show',$posts->id)}}">View</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    @include('includes.promp')
@endsection