@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Areas
        </p>
    </li>
    <li>
        <p class="navbar-text" style="color: darkblue; font-family: initial; font-size: 15px;">
            &nbsp;&numero; {{$countArea}}
        </p>
    </li>
    <li>
        <p class="navbar-text" style="color: darkblue; font-family: initial; font-size: 15px;">
            Total ={{$countAreas}}
        </p>
    </li>
@endsection

@section('content')

 @include('includes.alert')
<div class="col-sm-12">
    {!! Form::open(['method'=>'POST','action'=>'National\AreaController@store','class'=>'modal','id'=>'addArea', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Create New Area
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('region_id','Region',['class'=>'control-label']) !!}
                            {!! Form::select('region_id',[$regions->id=>$regions->name],null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <div class="form-group ">
                                {!! Form::label('name','New Area Name',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('area_code','Area Code',['class'=>'control-label']) !!}
                            {!! Form::text('area_code',null,['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('date','Date Area Was Created(optional)',['class'=>'control-label']) !!}
                            {!! Form::date('date',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="modal-footer no-border">
                    <div class="form-group">
                        <button name="close" type="submit" data-dismiss="modal" class="btn btn-danger">Close</button>
                        <button name="submit" type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
        </div>

    {!! Form::close() !!}
</div>

@include('includes.form_error')

<div class="panel shadow mb25">
    <div class="panel-heading border">
        <ol class="breadcrumb mb0 no-padding">
            <li>
                <a class="btn-link" href="{{route('region.index')}}"> {{$regions->name}}</a>
            </li>
            <li>
                <a href="javascript:;">Area</a>
            </li>
            <li class="active">Data tables</li>
            <li>
                <a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addArea" href="">Add New Area</a>
            </li>
        </ol>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            @if($areas)
                <table class="table table-striped mb0">
                    {!! Form::open(['method'=>'POST', 'action'=>['National\FindAreaDistrictAndLocalController@area']]) !!}
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
                        <th>Area code</th>
                        <th>Area Name</th>
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
                    @foreach($areas as $area)
                        <tr>
                            <td>{{$area->area_code}}</td>
                            <td><a class="btn-link" href="{{route('area.show',$area->id)}}">{{$area->name}}</a></td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('gender','male')->count()
                                }}
                            </td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('gender','female')->count()
                                }}
                            </td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('officeHeld','elder')->count()
                                }}
                            </td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('officeHeld','deacon')->count()
                                }}
                            </td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('officeHeld','deaconess')->count()
                                }}
                            </td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('officeHeld','children ministry')->count()
                                }}
                            </td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('officeHeld','pastor')->count()
                                }}
                            </td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('officeHeld','presiding elder')->count()
                                }}
                            </td>
                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->where('officeHeld','apostle')->count()
                                }}
                            </td>

                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',0)->count()
                                }}
                            </td>

                            <td>
                                {{
                                 App\User::where('area_id',$area->id)
                                 ->where('is_active',1)->count()
                                }}
                            </td>
                            {{--<td>{{$area->created_at->diffForHumans()}}</td>--}}
                            {{--<td>{{$area->updated_at->diffForHumans()}}</td>--}}
                            <td class="text-center"><a class="btn btn-primary btn-xs" href="{{route('area.edit',$area->id)}}"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            {{$areas->links()}}
        </div>

    </div>
</div>
@endsection