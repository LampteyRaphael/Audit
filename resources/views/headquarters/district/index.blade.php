@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            District Level
        </p>
    </li>
    <li>
        <p class="navbar-text">
{{--            Per page &numero;&nbsp;{{$districtCount}}--}}
        </p>
    </li>
    <li>
        <p class="navbar-text">
{{--            &numero; &nbsp;{{$districtCount2}}--}}
        </p>
    </li>
@endsection
@section('content')
    <div class="table-responsive">
    <div class="panel shadow mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a class="btn-link" href="{{route('area.index')}}">Area</a>
                    </li>
                    <li>
                        <a href="javascript:;">All District</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
{{--                <div class="table-responsive">--}}
{{--                    {!! Form::open(['method'=>'POST', 'action'=>['National\localSearchNationalController@district']]) !!}--}}
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
{{--                    @if($districts)--}}
                        <table class="table table-striped data-table">
                            <thead>
                            <tr>
                                <th>District code</th>
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
                                <th>Delete</th>
                            </tr>
                            </thead>
{{--                            <tbody>--}}
{{--                            @foreach($districts as $district)--}}
{{--                                <tr>--}}
{{--                                    <td>{{$district->district_code}}</td>--}}
{{--                                    <td><a class="btn-link" href="{{route('district.show',$district->id)}}">{{$district->name}}</a></td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('district_id',$district->id)--}}
{{--                                         ->where('is_active',1)->where('gender','male')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('district_id',$district->id)--}}
{{--                                         ->where('is_active',1)->where('gender','female')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('district_id',$district->id)--}}
{{--                                         ->where('is_active',1)->where('officeHeld','elder')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('district_id',$district->id)--}}
{{--                                         ->where('is_active',1)->where('officeHeld','deacon')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('district_id',$district->id)--}}
{{--                                         ->where('is_active',1)->where('officeHeld','deaconess')->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}


{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('district_id',$district->id)--}}
{{--                                         ->where('is_active',0)->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}

{{--                                    <td>--}}
{{--                                        {{--}}
{{--                                         App\User::where('district_id',$district->id)--}}
{{--                                         ->where('is_active',1)->count()--}}
{{--                                        }}--}}
{{--                                    </td>--}}
{{--                                    <td>{{$district->created_at->diffForHumans()}}</td>--}}
{{--                                    <td>{{$district->updated_at->diffForHumans()}}</td>--}}
{{--                                </tr>--}}
{{--                            @endforeach--}}

{{--                            </tbody>--}}
                        </table>
{{--                        {{$districts->links()}}--}}
{{--                    @endif--}}
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
                    ajax: "{{ route('district.index') }}",
                    columns: [
                        {data: 'district_code'},
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


