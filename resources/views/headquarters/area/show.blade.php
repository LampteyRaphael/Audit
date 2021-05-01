@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            District
        </p>
    </li>

    <li>
        <p class="navbar-text">
           &numero; &nbsp;{{$countArea}}
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
        {!! Form::open(['method'=>'POST','action'=>'National\DistrictController@store','class'=>'modal','id'=>'addArea', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        Create New District
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <div class="form-group ">
                                {!! Form::label('area_id','District',['class'=>'control-label']) !!}
                                {!! Form::select('area_id',[$area->id=>$area->name],null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group ">
                                {!! Form::label('name','New District Name',['class'=>'control-label']) !!}
                                {!! Form::text('name',null,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group ">
                                {!! Form::label('district_code','District Code',['class'=>'control-label']) !!}
                                {!! Form::text('district_code',null,['class'=>'form-control']) !!}
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
    <div class="table-responsive">
    <div class="panel shadow mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a class="btn-link" href="javascript:;">
                        @if(Session::has('region_id'))
                                <a class="btn-link" href="{{route('region.show',(Session::get('region_id')) )}}">{{$area->name}}</a>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="javascript:;">District</a>
                </li>
                <li class="active">Data tables</li>
                <li>
                   <a style="font-size: 15px;" data-toggle="modal" data-target="#addArea" href="#" class="btn btn-xs btn-primary">+Add More District</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($districts)
                    <table class="table table-striped mb0">
                        {!! Form::open(['method'=>'POST', 'action'=>['National\FindAreaDistrictAndLocalController@district']]) !!}
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
                            <th>District Code</th>
                            <th>District</th>
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
                        @foreach($districts as $district)
                            <tr>
                                <td>{{$district->district_code}}</td>
                                <td><a class="btn-link" href="{{route('district.show',$district->id)}}">{{$district->name}}</a></td>
                                <td>
                                    {{
                                     App\User::where('district_id',$district->id)
                                     ->where('is_active',1)->where('gender','male')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('district_id',$district->id)
                                     ->where('is_active',1)->where('gender','female')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('district_id',$district->id)
                                     ->where('is_active',1)->where('officeHeld','elder')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('district_id',$district->id)
                                     ->where('is_active',1)->where('officeHeld','deacon')->count()
                                    }}
                                </td>
                                <td>
                                    {{
                                     App\User::where('district_id',$district->id)
                                     ->where('is_active',1)->where('officeHeld','deaconess')->count()
                                    }}
                                </td>

                                <td>
                                    {{
                                     App\User::where('district_id',$district->id)
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
                                     App\User::where('district_id',$district->id)
                                     ->where('is_active',0)->count()
                                    }}
                                </td>

                                <td>
                                    {{
                                     App\User::where('district_id',$district->id)
                                     ->where('is_active',1)->count()
                                    }}
                                </td>
                                {{--<td>{{$district->created_at->diffForHumans()}}</td>--}}
                                {{--<td>{{$district->updated_at->diffForHumans()}}</td>--}}
                                <td class="text-center"><a class="btn btn-primary btn-xs" href="{{route('district.edit',$district->id)}}"><i class="fa fa-edit"></i></a></td>
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




