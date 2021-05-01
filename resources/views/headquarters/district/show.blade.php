@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Locals
        </p>
    </li>
    <li>
        <p class="navbar-text" style="color: darkblue; font-family: initial; font-size: 15px;">
            &numero; &nbsp; {{$countDistrict}}
        </p>
    </li>
@endsection

@section('content')
    @include('includes.alert')
        {!! Form::open(['method'=>'POST','action'=>'National\LocalsController@store','class'=>'modal','id'=>'addArea', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">

                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                {!! Form::label('district_id','National\District',['class'=>'control-label']) !!}
                                {!! Form::select('district_id',[$district->id=>$district->name],null,['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                {!! Form::label('name','New local Name',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group ">
                                {!! Form::label('local_code','Local Code',['class'=>'control-label']) !!}
                                {!! Form::text('local_code',null,['class'=>'form-control']) !!}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group ">
                                {!! Form::label('date','Date  Was Created(optional)',['class'=>'control-label']) !!}
                                {!! Form::date('date',null,['class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                {!! Form::label('gps','GPS',['class'=>'control-label']) !!}
                                {!! Form::text('gps',null,['class'=>'form-control']) !!}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group ">
                                {!! Form::label('nurseringOrNot','Assembly Status',['class'=>'control-label']) !!}
                                {!! Form::select('nurseringOrNot',[0=>'Not Nursery Assembly',1=>'Nursery Assembly'],null,['class'=>'form-control']) !!}
                             </div>
                        </div>


                            <div class="col-md-6">
                                 <div class="form-group ">
                                     {!! Form::label('localmode','Is Your building Standard',['class'=>'control-label']) !!}
                                     {!! Form::select('localmode',[0=>'Not standard',1=>'Standard'],null,['class'=>'form-control']) !!}
                                 </div>
                            </div>
                        </div>
                        <div class="row">
                            <header>Upload Your Church Building Image(Format: JPG)</header>
                            <div class="col-md-6">
                              <div class="form-group ">
                                  {!! Form::label('photo1_id','Front View',['class'=>'control-label']) !!}
                                  {!! Form::file('photo1_id',null,['class'=>'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group ">
                                  {!! Form::label('photo2_id','Side View',['class'=>'control-label']) !!}
                                  {!! Form::file('photo2_id',null,['class'=>'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                  {!! Form::label('photo3_id','Back View',['class'=>'control-label']) !!}
                                   {!! Form::file('photo3_id',null,['class'=>'form-control']) !!}
                              </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer no-border">
                        <div class="form-group">
                            {!! Form::button('Close',['class'=>'btn  btn-danger','data-dismiss'=>'modal']) !!}
                            {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}

                        </div>
                    </div>
                </div>
            </div>

        {!! Form::close() !!}

    @include('includes.form_error')

    <div class="table-responsive">

    <div class="panel shadow mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a class="btn-link" href="javascript:;">
                        @if(Session::has('area_id'))
                            <a class="btn-link" href="{{route('area.show',(Session::get('area_id')))}}">{{$district->name}}</a>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="javascript:;">Local</a>
                </li>
                <li class="active">Data tables</li>
                <li>
                    <a  class="btn btn-xs btn-primary" data-toggle="modal" data-target="#addArea" href="#">+Add More Locals</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($locals)
                    <table class="table table-striped mb0">
                        {!! Form::open(['method'=>'POST', 'action'=>['National\FindAreaDistrictAndLocalController@locals']]) !!}
                        <div class="col-md-11">
                            <div class="form-group">
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                                {!! Form::hidden('id',$id,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                {!! Form::submit('search',['class'=>'btn btn-primary btn-sm','Placeholder'=>'search']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <thead>
                        <tr>
                            <th>Local Code</th>
                            <th>Locals</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Elders</th>
                            <th>Deacons</th>
                            <th>Deaconesses</th>
                            <th>Children's</th>
                            <th>Pastors</th>
                            <th>Pres.Elders</th>
                            <th>Apostles</th>
                            <th>Non Active</th>
                            <th>Total</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($locals as $local)
                            <tr>
                                <td>{{$local->local_code}}</td>
                                <td><a class="btn-link" href="{{route('locals.show',$local->id)}}">{{$local->name}}</a></td>
                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('gender','male')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('gender','female')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('officeHeld','elder')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('officeHeld','deacon')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('officeHeld','deaconess')->count()
                                    }}
                                </td>

                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('officeHeld','children ministry')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('officeHeld','pastor')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('officeHeld','presiding elder')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->where('officeHeld','apostle')->count()
                                    }}
                                </td>


                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',0)->count()
                                    }}
                                </td>

                                <td>
                                    {{
                                     App\User::where('local_id',$local->id)
                                     ->where('is_active',1)->count()
                                    }}
                                </td>
                                {{--<td>{{$local->created_at->diffForHumans()}}</td>--}}
                                {{--<td>{{$local->updated_at->diffForHumans()}}</td>--}}
                                <td class="text-center">
                                    <a class="btn btn-primary btn-xs" href="{{route('locals.edit',$local->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$locals->links()}}
                @endif
            </div>
        </div>
    </div>
</div>
@endsection