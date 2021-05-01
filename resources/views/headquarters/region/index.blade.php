@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">Regions</p>
    </li>
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
                    <a href="javascript:;">All Regions</a>
                </li>
                <li class="active">Data tables</li>
               <li><a href="{{route('region.create')}}" class="btn btn-primary btn-xs">+Add New</a></li>

            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                {{--{!! Form::open(['method'=>'POST', 'action'=>['localSearchNationalController@national']]) !!}--}}
                {{--<div class="col-md-11">--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::text('name',null,['class'=>'form-control']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col-md-1">--}}
                    {{--<div class="form-group">--}}
                        {{--{!! Form::submit('search',['class'=>'btn btn-primary btn-sm','Placeholder'=>'search']) !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--{!! Form::close() !!}--}}
                <table class="table table-striped data-table mb0">
                    <thead>
                    <tr>
                        <th>Regions</th>
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
                    <tbody>
                    {{--@if($regions)--}}
                        {{--@foreach($regions as $region)--}}
                            {{--<tr>--}}
                                {{--<td><a class="btn-link" href="{{route('region.show',$region->id)}}">{{$region->name}}</a></td>--}}
                                {{--<td>--}}
                                    {{--{{--}}
                                     {{--App\User::where('region_id',$region->id)--}}
                                     {{--->where('is_active',1)->where('gender','male')->count()--}}
                                    {{--}}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{--}}
                                     {{--App\User::where('region_id',$region->id)--}}
                                     {{--->where('is_active',1)->where('gender','female')->count()--}}
                                    {{--}}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{--}}
                                     {{--App\User::where('region_id',$region->id)--}}
                                     {{--->where('is_active',1)->where('officeHeld','elder')->count()--}}
                                    {{--}}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{--}}
                                     {{--App\User::where('region_id',$region->id)--}}
                                     {{--->where('is_active',1)->where('officeHeld','deacon')->count()--}}
                                    {{--}}--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{--}}
                                     {{--App\User::where('region_id',$region->id)--}}
                                     {{--->where('is_active',1)->where('officeHeld','deaconess')->count()--}}
                                    {{--}}--}}
                                {{--</td>--}}


                                {{--<td>--}}
                                    {{--{{--}}
                                     {{--App\User::where('region_id',$region->id)--}}
                                     {{--->where('is_active',0)->count()--}}
                                    {{--}}--}}
                                {{--</td>--}}

                                {{--<td>--}}
                                    {{--{{--}}
                                     {{--App\User::where('region_id',$region->id)--}}
                                     {{--->where('is_active',1)->count()--}}
                                    {{--}}--}}
                                {{--</td>--}}

                                {{--<td>{{$region->created_at->diffForHumans()}}</td>--}}
                                {{--<td>{{$region->updated_at->diffForHumans()}}</td>--}}
                                {{--<td class="text-center">--}}
                                    {{--<a class="btn btn-primary btn-sm" href="{{route('region.edit',$region->id)}}">--}}
                                        {{--<i class="fa fa-edit"></i>--}}
                                    {{--</a>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $('.data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    "iDisplayLength": 50,
                    ajax: "{{ route('region.index') }}",
                    columns: [
                        {data: 'actionA'},
                        {data: 'actionB'},
                        {data: 'actionC'},
                        {data: 'actionD'},
                        {data: 'actionE'},
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