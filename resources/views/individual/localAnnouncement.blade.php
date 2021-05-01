@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            {{(Auth::user()->local->name)}}
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
                        <a href="javascript:;">Locals Circular</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                @if($post)
                    <table class="table table-striped">
                        <div class="col-md-12">
                            {!! Form::open(['method'=>'POST','action'=>'Individuals\individualCircularController@store2']) !!}
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
                        <tbody>
                        @foreach($post as $posts)
                            <tr>
                                <td>{{$posts->local->name}}</td>
                                <td><i class="fa fa-file-pdf-o btn" style="color:red; bold; font:20px;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/LocalMembers/','',$posts->name),10))}}</td>
                                <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                                <td>{{$posts->created_at->diffForHumans()}}</td>
                                <td>
                                    <a class="btn btn-default btn-sm" href="{{route('tolocalAnnouncements',$posts->id)}}">View</a>
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



