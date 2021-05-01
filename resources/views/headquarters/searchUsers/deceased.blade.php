@extends('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">Deceased Members</p>
    </li>
@endsection
@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    {{--@include('sweet::alert')--}}
    <div class="table-responsive">
        <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Deceased</a>
                    </li>
                    <li>
                        <a href="javascript:;">Members</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    {{--{!! Form::open(['method'=>'POST', 'action'=>['localSearchNationalController@admins']]) !!}--}}
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
                    <table class="table table-bordered mb0" id="data-table">
                        <thead>
                        <tr>
                            <th>Images</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>District</th>
                            <th>Local</th>
                            <th>Role</th>
                            <th>Age</th>
                            <th>Start Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <script>
        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax:"{{ route('searchPost.index') }}",
                    columns: [
                        {data:'pictures'},
                        {data: 'name', name: 'name'},
                        {data: 'actionA'},
                        {data: 'actionG'},
                        {data: 'action3'},
                        {data: 'action4'},
                        {data: 'datesOfBirth'},
                        {data: 'action', name: 'action', orderable: true, searchable: true},
                        {data: 'toShow',name:'toShow'},
                        {data: 'delete', name: 'delete'},
                    ],
                });

            });

        });






        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmUpdate()
        {
            var x = confirm("Are you sure you want to edit?");
            if (x)
                return true;
            else
                return false;
        }

    </script>

@endsection



