@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            {{(Auth::user()->area->name)}}
        </p>
    </li>
@endsection

@section('content')
@include('includes.form_error')
@include('includes.alert')
    <div>
        <div class="panel shadow mb25">
            <div class="panel-heading">
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

                        <tbody>
                            <div>
                                {!! Form::open(['method'=>'POST','action'=>'Individuals\individualCircularController@areaPost']) !!}
                                <div class="col-md-2">
                                    Year:{!! Form::selectYear('year',2017,Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
                                 </div>
                                
                                  <div class="col-md-2">
                                     Month: {!! Form::selectMonth('month',$month,['class'=>'form-control']) !!}
                                  </div>
                                  <div class="col-md-2">
                                      <div style="padding-top:20px">
                                          {!! Form::submit('submit',['class'=>'btn  btn-primary btn-sm']) !!}
                                      </div>
                                  </div>
                                  
                              </div>
                        @foreach($post as $posts)
                            <tr>
                                <td>{{$posts->area->name}}</td>
                                <td><i class="fa fa-file-pdf-o btn" style="color:red;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/AreaLevelPdf/','',$posts->name),10))}}</td>
                                <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                                <td>{{$posts->created_at->diffForHumans()}}</td>
                                <td>
                                    <a class="btn btn-default btn-sm" href="{{route('membersAnnouncementAS',$posts->id)}}">View</a>
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



