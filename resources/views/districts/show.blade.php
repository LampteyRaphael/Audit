@extends ('layouts.master_table')

@section('dashboard')

    <li>
        <p class="navbar-text">
            Per page  &numero; &nbsp;{{$countDistrict}}
        </p>
    </li>
    <li>
        <p class="navbar-text">
            Total &nbsp;{{$localsCount}}
        </p>
    </li>

@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
        {!! Form::open(['method'=>'POST','action'=>'District\RegionDistrictController@store','class'=>'modal','id'=>'addArea', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
        <div class="modal-dialog fade">
            <div class="modal-content">
                <div class="modal-header">
                    Add new local to your district
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        {!! Form::label('district_id','Local',['class'=>'control-label']) !!}
                        {!! Form::select('district_id',[$district->id=>$district->name],null,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group ">
                        {!! Form::label('name','New local Name',['class'=>'control-label']) !!}
                        {!! Form::text('name',null,['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        <div class="form-group ">
                            {!! Form::label('local_code','Local Code',['class'=>'control-label']) !!}
                            {!! Form::text('local_code',null,['class'=>'form-control']) !!}
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

<div class="table-responsive">
    <div class="panel mb25 shadow">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a class="btn-link" href="{{route('dashboard-d.index')}}">Home</a>
                    </li>

                        <li>
                            <a class="btn-link" href="javascript:;">{{$district->name}}</a>
                        </li>
                    <li>
                        <a href="javascript:;">Locals</a>
                    </li>
                    <li class="active">Data tables</li>
                    <li>
                        <a class="btn btn-default btn-xs" href="" data-toggle="modal" data-target="#addArea">+Add new</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                @if($locals)
                <table class="table table-striped mb0">
                    <thead>
                    <tr>
                        <th>LOCAL CODE</th>
                        <th>LOCAL</th>
                        <th>MALE</th>
                        <th>FEMALE</th>
                        <th>ELDER</th>
                        <th>DEACON</th>
                        <th>DEACONESS</th>
                        <th>CHILDREN</th>
                        <th>NONE ACTIVE</th>
                        <th>ACTIVE</th>
{{--                        <th>CREATED AT</th>--}}
{{--                        <th>UPDATE AT</th>--}}
                        <th>EDIT</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($locals as $local)
                        <tr>
                            <td>{{$local->local_code}}</td>
                            <td><a class="btn-link" href="{{route('search.locals',$local->id)}}">{{ucwords($local->name)}}</a></td>
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
                                 ->where('is_active',0)->count()
                                }}
                            </td>

                            <td>
                                {{
                                 App\User::where('local_id',$local->id)
                                 ->where('is_active',1)->count()
                                }}
                            </td>
{{--                            <td>{{$local->created_at->diffForHumans()}}</td>--}}
{{--                            <td>{{$local->updated_at->diffForHumans()}}</td>--}}
                            <td class="text-center"><a class="btn btn-primary btn-xs" href="{{route('messages.edit',$local->id)}}"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    {{$locals->links()}}
               @endif
            </div>
        </div>
</div>
@endsection