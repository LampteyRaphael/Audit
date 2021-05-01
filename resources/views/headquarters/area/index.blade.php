@extends ('layouts.master_table')
@section('dashboard')
    {{--<li>--}}
        {{--<p class="navbar-text">--}}
        {{--The Apostolic Church-Ghana (Areas)--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text">--}}
            {{--Per page &numero;&nbsp;{{$areaCount}}--}}
        {{--</p>--}}
    {{--</li>--}}
    {{--<li>--}}
        {{--<p class="navbar-text">--}}
            {{--&numero; &nbsp;{{$areaCount2}}--}}
        {{--</p>--}}
    {{--</li>--}}
@endsection
@section('content')
    <div class="table-responsive">
    <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a class="btn-link" href="{{route('region.index')}}">Areas</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                    {{--@if($area)--}}
                            {{--{!! Form::open(['method'=>'POST', 'action'=>['localSearchNationalController@area']]) !!}--}}
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
                                    <th>Area Code</th>
                                    <th>Areas</th>
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
                                </tbody>
                        </table>
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
                    ajax: "{{ route('area.index') }}",
                    columns: [
                        {data: 'area_code'},
                        {data: 'name',name:'name'},
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


