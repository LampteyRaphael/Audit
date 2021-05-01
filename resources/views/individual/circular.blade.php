@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            NATIONAL ANNOUNCEMENT
        </p>
    </li>
@endsection

@section('content')
    <div class="">
        <div class="panel shadow mb25">
            <div class="panel-heading">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Circular</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                @if($post)
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                {!! Form::open(['method'=>'POST','action'=>'Individuals\individualCircularController@store']) !!}
                                <td>
                                  Year:{!! Form::selectYear('year',2017,Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
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
                        @foreach($post as $posts)
                            <tr>
                                <td>{{Auth::user()->region->name}}</td>
                                <td><i class="fa fa-file-pdf-o btn" style="color:red; bold; font:20px;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/NationalPdf/','',$posts->name),10))}}</td>
                                <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                                <td>{{$posts->created_at->diffForHumans()}}</td>
                                <td>
                                    <a class="btn btn-default btn-sm" href="{{route('membersAGet',$posts->id)}}">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection



