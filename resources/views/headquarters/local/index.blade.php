@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Locals Level
        </p>
    </li>
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            Total--}}
{{--        </p>--}}
{{--    </li>--}}
{{--    <li>--}}
{{--        <p class="navbar-text">--}}
{{--            {{$countLocals}}--}}
{{--        </p>--}}
{{--    </li>--}}

@endsection
@section('content')
    @include('includes.alert')
    <div class="table-responsive">
        <div class="panel shadow mb25">
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
{{--                <div class="table-responsive">--}}
{{--                    {!! Form::open(['method'=>'POST', 'action'=>['National\localSearchNationalController@local']]) !!}--}}
{{--                    <div class="col-md-11">--}}
{{--                        <div class="form-group">--}}
{{--                            {!! Form::text('name',null,['class'=>'form-control']) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="col-md-1">--}}
{{--                        <div class="form-group">--}}
{{--                            {!! Form::submit('search',['class'=>'btn btn-primary btn-sm','Placeholder'=>'search']) !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
                    <table class="table table-striped mb0 data-table">
                        <thead>
                        <tr>
                            <th>Locals Code</th>
                            <th>Local</th>
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
                            <th>Delete</th>
                        </tr>
                        </thead>
{{--                        <tbody>--}}
{{--                        @if($locals)--}}
{{--                            @foreach($locals as $local)--}}
{{--                                <tr>--}}
{{--                                    <td>--}}
{{--                                        {{$local->local_code}}--}}
{{--                                    </td>--}}
{{--                                    <td><a href="{{route('locals.show',$local->id)}}">{{$local->name}}</a></td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('local_id',$local->id)--}}
{{--                                         ->where('is_active',1)->where('gender','male')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('local_id',$local->id)--}}
{{--                                         ->where('is_active',1)->where('gender','female')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('local_id',$local->id)--}}
{{--                                         ->where('is_active',1)->where('officeHeld','elder')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('local_id',$local->id)--}}
{{--                                         ->where('is_active',1)->where('officeHeld','deacon')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('local_id',$local->id)--}}
{{--                                         ->where('is_active',1)->where('officeHeld','deaconess')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}


{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('local_id',$local->id)--}}
{{--                                         ->where('is_active',0)->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}

{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('local_id',$local->id)--}}
{{--                                         ->where('is_active',1)->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}


{{--                                    <td>{{$local->created_at->diffForHumans()}}</td>--}}
{{--                                    <td>{{$local->updated_at->diffForHumans()}}</td>--}}
{{--                                    <td>--}}
{{--                                        <a class="btn btn-primary btn-xs" href="{{route('locals.edit',$local->id)}}">--}}
{{--                                            <i class="fa fa-edit"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}
{{--                        @endif--}}
{{--                        </tbody>--}}
                    </table>

{{--                    {{$locals->links()}}--}}
                </div>
            </div>
        </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $.fn.dataTable.ext.errMode="javascript";
                $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    "iDisplayLength": 50,
                    ajax: "{{ route('locals.index') }}",
                    columns: [
                        {data: 'local_code'},
                        {data: 'actionA'},
                        {data: 'actionB'},
                        {data: 'actionC'},
                        {data: 'actionE'},
                        {data: 'actionD'},
                        {data: 'actionF'},
                        {data: 'actionGG'},
                        {data: 'actionPastor'},
                        {data: 'actionPresidingElders'},
                        {data: 'actionApostle'},
                        {data: 'actionG'},
                        {data: 'actionH'},
                        {data: 'actionJ'},
                        {data: 'delete', name: 'delete', orderable: true, searchable: true},
                    ]
                });

            });

        } );


    </script>
@endsection