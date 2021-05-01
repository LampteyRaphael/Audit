@extends ('layouts.master_table')
@section('dashboard')
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
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Local Circulars</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        
        <div class="panel-body">
            <div class="table-responsive">
                @if($post)
                <div class="col-md-12">
                    {!! Form::open(['method'=>'POST','action'=>'National\PostCircularToDistrictController@localsPost']) !!}
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
                          {!! Form::close() !!}
                      </div>
                      
                  </div>
                    <table class="table table-striped mb0">
                        <tbody>
                        @foreach($post as $posts)
                            <tr>
                                <td>{{$posts->local? $posts->local->name:''}}</td>
                                <td>Local Circular</td>
                                <td><i class="fa fa-file-pdf-o btn" style="color:red;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/LocalMembers/','',$posts->name),10))}}</td>
                                <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                                <td>{{$posts->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('NatLCircularPD',$posts->id)}}" onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></a>
                                </td>
                                <td>
                                    <a class="btn btn-default btn-sm" href="{{route('districtCirLocalsShow',$posts->id)}}">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    @include('includes.promp')
@endsection

