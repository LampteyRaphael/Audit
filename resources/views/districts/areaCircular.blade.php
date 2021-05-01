@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Area Circular
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')

    @include('includes.alert')

    <div class="panel mb25 shadow">
        <div class="panel-heading mb0 no-padding">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Area Circular</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            @if($post)
                <table class="table table-striped">
                    <tr>
                        {!! Form::open(['method'=>'POST','action'=>'District\DistrictPdfController@areaPost']) !!}
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
                        <td></td>
                        <td></td>
                    </tr>
                    <tbody>
                    @foreach($post as $posts)
                        <tr>
                            <td>Area Circular</td>
                            <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                            <td><i class="fa fa-file-pdf-o btn" style="color:red;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/NationalPdf/','',$posts->name),10))}}</td>
                            <td>{{$posts->created_at->diffForHumans()}}</td>
                            <td>
                                <a class="btn btn-default btn-sm" href="{{route('districtCirAreaS',$posts->id)}}">View</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection