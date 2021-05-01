@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
           (District)
        </p>
    </li>

    <li>
        <p class="navbar-text">
            &numero; &nbsp;{{$countArea}}
        </p>
    </li>
@endsection

@section('content')
    @include('includes.alert')
    <div class="col-sm-12">
        {!! Form::open(['method'=>'POST','action'=>'Area\AreaDashboardController@store','class'=>'modal','id'=>'addArea', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Create New District
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('area_id','Area',['class'=>'control-label']) !!}
                            {!! Form::select('area_id',[$id=>$areaName],null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('name','New District Name',['class'=>'control-label']) !!}
                            {!! Form::text('name',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('district_code','District Code',['class'=>'control-label']) !!}
                            {!! Form::text('district_code',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('date','Date District Was Created(optional)',['class'=>'control-label']) !!}
                            {!! Form::date('date',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="modal-footer no-border">
                    <div class="form-group">
                        {!! Form::submit('Close',["class"=>"btn btn-danger" ,"data-dismiss"=>"modal"]) !!}
                        {!! Form::submit('submit',["class"=>"btn  btn-info"]) !!}
                    </div>
                </div>
            </div>

        </div>

        {!! Form::close() !!}

    </div>

    @include('includes.form_error')
    <div class="">
        <div>
            <div class="panel shadow mb25">
                <div class="panel-heading border">
                    <ol class="breadcrumb mb0 no-padding">
                        <li>
                            <a class="btn-link btn btn-xs" href="{{route('areaDashboard.index')}}">
                                Home
                            </a>
                        </li>
                        <li>
                            <a class="btn-link" href="javascript:;">
                                <a class="btn-link btn btn-default btn-xs" href="">{{ucwords($areaName)}}</a>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;">District</a>
                        </li>
                        <li class="active">Data tables</li>
                        <li>
                            <a class="btn btn-default btn-xs"  data-toggle="modal" data-target="#addArea" href="">+Add District</a>
                        </li>
                        <li>
                            <a class="btn btn-default btn-xs" href="">Export To Excel</a>
                        </li>
                    </ol>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <div>
                            @if($districts)
                                <table class="table table-striped mb0 table-responsive">
                                    <thead>
                                    <tr>
                                        <th>District Code</th>
                                        <th>District</th>
                                        <th>Male</th>
                                        <th>Female</th>
                                        <th>Elder</th>
                                        <th>Deacon</th>
                                        <th>Deaconess</th>
                                        <th>Children</th>
                                        <th>Pastors</th>
                                        <th>Pres.Elders</th>
                                        <th>Apostles</th>
                                        <th>Non Active</th>
                                        <th>Total</th>
                                        <th>Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($districts as $district)
                                        <tr>
                                            <td>{{$district->district_code}}</td>
                                            <td><a class="btn-link" href="{{route('level.show',$district->id)}}">{{$district->name}}</a></td>
                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                                 ->where('is_active',1)->where('gender','male')->count()
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                                 ->where('is_active',1)->where('gender','female')->count()
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                                 ->where('is_active',1)->where('officeHeld','elder')->count()
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                                 ->where('is_active',1)->where('officeHeld','deacon')->count()
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                                 ->where('is_active',1)->where('officeHeld','deaconess')->count()
                                                }}
                                            </td>

                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                                 ->where('is_active',1)->where('officeHeld','children ministry')->count()
                                                }}
                                            </td>

                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)
                                                 ->where('is_active',1)->where('officeHeld','pastor')->count()
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)
                                                 ->where('is_active',1)->where('officeHeld','presiding elder')->count()
                                                }}
                                            </td>
                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)
                                                 ->where('is_active',1)->where('officeHeld','apostle')->count()
                                                }}
                                            </td>


                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                                 ->where('is_active',0)->count()
                                                }}
                                            </td>

                                            <td>
                                                {{
                                                 App\User::where('district_id',$district->id)->whereIn('role_id',[1,2,3,4,5])
                                                 ->where('is_active',1)->count()
                                                }}
                                            </td>

                                            <td class="text-center"><a class="btn btn-primary btn-xs" href="{{route('level.edit',$district->id)}}"><i class="fa fa-edit"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{$districts->links()}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




