@extends('layouts.app', ['activePage' => 'system_trail', 'titlePage' => __('Audit Trail')])
@section('content')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Audit Trails</h4>
                            <p class="card-category">Users in/out of the system</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped mb0">
                        <thead>
                        <tr>
                            <th>Admins</th>
                            <th>Detail</th>
                            <th>Date/Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->user->name}}</td>
                                    <td>{{$user->category}}</td>
                                    <td>{{$user->created_at}}</td>

                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{$users->links()}}
                        </div>

            </div>
        </div>
    </div>
        </div>
    </div>
@endsection


