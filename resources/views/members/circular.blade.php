@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            {{ucwords($local)}}
        </p>
    </li>
    <li>
        <p class="navbar-text">
            Local Circular
        </p>
    </li>
@endsection

@section('content')

@include('includes.form_error')

@include('includes.alert')

    <div class="panel shadow mb25">
        <div class="panel-heading">
             <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Local Circular</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            @if($post)
                <table class="table table-striped table-success">
                    <tr>
                            {!! Form::open(['method'=>'POST','action'=>'Locals\PostDistrictToLocalCircularController@store','class'=>'row']) !!}
                           <td>
                              Year:{!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
                           </td>
                          
                            <td>
                               Month: {!! Form::selectMonth('month',$month,['class'=>'form-control']) !!}
                            </td>
                            <td>
                                <div style="padding-top:20px">
                                    {!! Form::submit('submit',['class'=>'btn  btn-primary btn-sm']) !!}
                                </div>
                            </td>
                            <td></td>
                        <td></td>
                    </tr>
                    <tbody>
                    @foreach($post as $posts)
                        <tr>
                        <td>Local Circular</td>
                        <td><i class="fa fa-file-pdf-o btn" style="color:red;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/LocalMembers/','',$posts->name),10))}}</td>
                        <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                        <td>{{$posts->created_at->diffForHumans()}}</td>
                        <td>
                            <a class="btn btn-default btn-sm" href="{{route('localcircular.show',$posts->id)}}">View</a>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection

