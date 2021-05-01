@extends('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">Migration(Area To Area)</p>
    </li>
@endsection
@section('content')
    @include('includes.form_error')
    @include('includes.alert')

    <div class="row col-md-12">
        @if($districts)

            @foreach($districts as $district)
                {!! Form::open(['method'=>'PUT', 'action'=>['National\AreaSwappController@update',$district->id],'files'=>true,'onsubmit' => 'return ConfirmSend()']) !!}

                <div class="form-group">
                    <div class="col-md-1">
                        {!! Form::label('region_id','Select the Region to Migrate',['class'=>'control-label bold']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::select('region_id',[$district->region_id=>$district->region->name]+$areass,$district->region_id,['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>

                {!! Form::close() !!}
            @endforeach
        @endif
    </div>

    <div class="row">
        <div class="col-md-6 pull-left">
            <div class="table-responsive">
                <div class="panel mb25">
                    <div class="panel-heading border">
                        <ol class="breadcrumb mb0 no-padding">
                            <li>
                                <a href="javascript:;">Migration</a>
                            </li>
                            <li>
                                <a href="javascript:;">Area</a>
                            </li>
                            <li class="active">Data tables</li>
                        </ol>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered mb0" id="data-table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                </tr>
                                </thead>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            <div class="table-responsive">
                <div class="panel mb25">
                    <div class="panel-heading border">
                        <ol class="breadcrumb mb0 no-padding">
                            <li>
                                <a href="javascript:;">Region</a>
                            </li>
                            <li>
                                <a href="javascript:;">Area</a>
                            </li>
                            <li class="active">Data tables</li>
                        </ol>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            @if($districts)
                                <table class="table table-bordered mb0" id="data-table">
                                    <thead>
                                    @foreach($districts as $district)
                                        <tr>
                                            <th colspan="2">{{$district->region->name}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach((App\Area::where('region_id',$district->region_id)->get(['name','area_code'])) as $dist)
                                        <tr>
                                            <td>{{$dist->area_code}}</td>
                                            <td>{{$dist->name}}</td>
                                        </tr>
                                    @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    "iDisplayLength": 50,
                    ajax:"{{ route('AreaSwapping.index') }}",
                    columns: [
                        {data: 'name', name: 'name'},
                    ],
                });

            });

        });

        function ConfirmUpdate()
        {
            var x = confirm("Are you sure you want to edit?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmSend() {
            var x = confirm("Are you sure you want to swap this local?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endsection



