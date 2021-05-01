@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
          Total  {{$countDistrict}}
        </p>
    </li>
@endsection

@section('content')
    @include('includes.alert')
    @include('includes.form_error')
    <div>
        {!! Form::open(['method'=>'POST','action'=>'Area\AreaDashboardController@localstore','class'=>'modal','id'=>'addArea', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        {!! Form::label('district_id','District',['class'=>'control-label']) !!}
                        {!! Form::select('district_id',[$district->id=>$district->name],null,['class'=>'form-control','required'=>'required']) !!}
                    </div>

                    <div class="form-group ">
                        {!! Form::label('name','New local Name',['class'=>'control-label']) !!}
                        {!! Form::text('name',null,['class'=>'form-control','required'=>'required']) !!}
                    </div>

                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('local_code','Local Code',['class'=>'control-label']) !!}
                            {!! Form::text('local_code',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('date','Date  Was Created(optional)',['class'=>'control-label']) !!}
                            {!! Form::date('date',null,['class'=>'form-control']) !!}
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

    </div>


    <div class="table-responsive">

        <div class="panel shadow mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a class="btn-link" href="{{route('level.index')}}">{{$district->name}}</a>
                    </li>
                    <li>
                        <a href="javascript:;">Local</a>
                    </li>
                    <li class="active">Data tables</li>
                    <li>
                        <a class="btn btn-default btn-xs" data-toggle="modal" data-target="#addArea" href="">+Add District</a>
                    </li>
                    <li>
                        <a class="btn btn-default btn-xs" href="">Export To Excel</a>
                    </li>

                </ol>
            </div>
            <div class="panel-body">
               <div class="table-responsive">
                   @if($locals)
                       <table class="table table-striped mb0">
                           <thead>
                           <tr>
                               <th>Local Code</th>
                               <th>Locals</th>
                               <th>Male</th>
                               <th>Female</th>
                               <th>Elder</th>
                               <th>Deacon</th>
                               <th>Deaconess</th>
                               <th>Children</th>
                               <th>Pastors</th>
                               <th>Pres.Elders</th>
                               <th>Apostles</th>
                               <th>None Active</th>
                               <th>Total</th>
                               <th>Edit</th>
                           </tr>
                           </thead>
                           <tbody>
                           @foreach($locals as $local)
                               <tr>
                                   <td>{{$local->local_code}}</td>
                                   <td><a class="btn-link" href="{{route('updates.show',$local->id)}}">{{$local->name}}</a></td>
                                   <td>
                                       {{
                                        App\User::where('local_id',$local->id)->whereIn('role_id',[1,2,3,4,5])
                                        ->where('is_active',1)->where('gender','male')->count()
                                       }}
                                   </td>
                                   <td>
                                       {{
                                        App\User::where('local_id',$local->id)->whereIn('role_id',[1,2,3,4,5])
                                        ->where('is_active',1)->where('gender','female')->count()
                                       }}
                                   </td>
                                   <td>
                                       {{
                                        App\User::where('local_id',$local->id)->whereIn('role_id',[1,2,3,4,5])
                                        ->where('is_active',1)->where('officeHeld','elder')->count()
                                       }}
                                   </td>
                                   <td>
                                       {{
                                        App\User::where('local_id',$local->id)->whereIn('role_id',[1,2,3,4,5])
                                        ->where('is_active',1)->where('officeHeld','deacon')->count()
                                       }}
                                   </td>
                                   <td>
                                       {{
                                        App\User::where('local_id',$local->id)->whereIn('role_id',[1,2,3,4,5])
                                        ->where('is_active',1)->where('officeHeld','deaconess')->count()
                                       }}
                                   </td>

                                   <td>
                                       {{
                                        App\User::where('local_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                        ->where('is_active',1)->where('officeHeld','children ministry')->count()
                                       }}
                                   </td>

                                   <td>
                                       {{
                                        App\User::where('local_id',$district->id)
                                        ->where('is_active',1)->where('officeHeld','pastor')->count()
                                       }}
                                   </td>
                                   <td>
                                       {{
                                        App\User::where('local_id',$district->id)
                                        ->where('is_active',1)->where('officeHeld','presiding elder')->count()
                                       }}
                                   </td>
                                   <td>
                                       {{
                                        App\User::where('local_id',$district->id)
                                        ->where('is_active',1)->where('officeHeld','apostle')->count()
                                       }}
                                   </td>


                                   <td>
                                       {{
                                        App\User::where('local_id',$local->id)->whereIn('role_id',[1,2,3,4,5])
                                        ->where('is_active',0)->count()
                                       }}
                                   </td>

                                   <td>
                                       {{
                                        App\User::where('local_id',$local->id)->whereIn('role_id',[1,2,3,4,5])
                                        ->where('is_active',1)->count()
                                       }}
                                   </td>
                                   <td class="text-center">
                                       <a class="btn btn-primary btn-xs" href="{{route('updates.edit',$local->id)}}">
                                           <i class="fa fa-edit"></i>
                                       </a>
                                   </td>
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