@extends('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">Area Church Members</p>
    </li>
@endsection
@section('content')
    @include('includes.alert')
    <div class="table-responsive">
        <div class="panel shadow mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Users</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mb0" id="data-table">
                        <thead>
                        <tr>
                            <th>Images</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Area</th>
                            <th>District</th>
                            <th>Local</th>
                            <th>Role</th>
                            <th>Age</th>
                            <th>Created at</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            $(function () {
                $.fn.dataTable.ext.errMode="javascript";
                $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    "iDisplayLength": 50,
                    ajax:"{{route('areamembers.index')}}",
                    columns: [
                        {data:'photo_id', name: 'photo_id'},
                        {data: 'name', name: 'name'},
                        {data: 'role_id', name: 'role_id'},
                        {data: 'area_id', name: 'area_id'},
                        {data: 'district_id', name: 'district_id'},
                        {data: 'local_id', name: 'local_id'},
                        {data: 'is_active', name: 'is_active'},
                        {data: 'datesOfBirth', name: 'datesOfBirth'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'toShow',name:'toShow'},
                        {data: 'delete', name: 'delete',orderable: false, searchable: false},
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


