@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Locals
        </p>
    </li>
    <li>
        <p class="navbar-text">
            Total
        </p>
    </li>
    <li>
        <p class="navbar-text">
            {{$countLocals}}
        </p>
    </li>

@endsection
@section('content')
    @include('includes.alert')
    <div class="table-responsive">
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="{{route('dashboard.index')}}">Home</a>
                    </li>
                    <li>
                        <a href="javascript:;">Locals</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    {!! Form::open(['method'=>'POST', 'action'=>['National\localSearchNationalController@local']]) !!}
                    <div class="col-md-11">
                        <div class="form-group">
                            {!! Form::text('name',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            {!! Form::submit('search',['class'=>'btn btn-primary btn-sm','Placeholder'=>'search']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <table class="table table-bordered mb0">
                        <thead>
                        <tr>
                            <th>Local Code</th>
                            <th>Local Name</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Elders</th>
                            <th>Deacons</th>
                            <th>Deaconess</th>
                            <th>None Active</th>
                            <th>Total</th>
                            <th>Create at</th>
                            <th>Update at</th>
                            <th>Edit</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($locals)
                            @foreach($locals as $local)
                                <tr>
                                    <td>
                                        {{$local->local_code}}
                                    </td>
                                    <td><a href="{{route('locals.show',$local->id)}}">{{$local->name}}</a></td>
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
                                         ->where('is_active',0)->count()
                                        }}
                                    </td>

                                    <td>
                                        {{
                                         App\User::where('local_id',$local->id)
                                         ->where('is_active',1)->count()
                                        }}
                                    </td>


                                    <td>{{$local->created_at->diffForHumans()}}</td>
                                    <td>{{$local->updated_at->diffForHumans()}}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{route('locals.edit',$local->id)}}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                    {{$locals->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection