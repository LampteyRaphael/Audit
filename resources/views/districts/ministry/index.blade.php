@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">{{Auth::user()->district->name}} CHILDREN MINISTRY</p>
    </li>
 @endsection
 @section('content')
     @include('includes.alert')
     <div class="table-responsive-sm">
    <div class="panel mb25 shadow">
        <div class="panel-heading no-border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Active Children</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-striped" id="data-table">
                <thead>
                <tr>
                    <th>Membership Id</th>
                    <th>Photo</th>
                    <th>User</th>
                    <th>Gender</th>
                    <th>Date Join</th>
                    <th>Office Held</th>
                    <th>Age</th>
                    <th>Edit</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
     <script>
         $(document).ready(function() {
             $(function () {
                 $('#data-table').DataTable({
                     processing: true,
                     serverSide: true,
                     "iDisplayLength": 50,
                     ajax:"{{route('DistCMinistry.index')}}",
                     columns: [
                         {data:'actionA',name:'members_id'},
                         {data:'pictures',name:'pictures'},
                         {data: 'actionB', name: 'actionB'},
                         {data: 'actionC',name: 'actionC'},
                         {data: 'actionD',name: 'actionD'},
                         {data: 'actionE',name: 'actionE'},
                         {data: 'actionF',name: 'actionF'},
                         {data: 'edit',name: 'edit',orderable: true, searchable: true},
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