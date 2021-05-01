@extends('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">Audit Trail</p>
    </li>
@endsection
@section('content')
    @include('includes.alert')
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure, you want to empty the recycle bin ?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmUpdate()
        {
            var x = confirm("Are you sure you want to update?");
            if (x)
                return true;
            else
                return false;
        }
    </script>

    <div class="table-responsive">
        <div class="panel mb25">
            <div class="panel-heading no-border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Audit</a>
                    </li>
                    <li>
                        <a href="javascript:;">Trail</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped mb0">
                        <thead>
                        <tr>
                            <th>Admins</th>
                            <th>Detail</th>
                            <th>Local Assembly</th>
                            <th>Date/Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->user? $user->user->name:''}}</td>
                                    <td>{{$user->category? $user->category:''}}</td>
                                    <td>{{$user->local->name? $user->local->name:''}}</td>
                                    <td>{{$user->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection


