@extends('layouts.app', ['activePage' => 'birthday', 'titlePage' => __('Incoming Birthdays')])
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @include('includes.form_error')
                @include('includes.alert')
                <div class="card ">
                    <div class="card-header">
                        <p class="card-category">
                    </div>
                    <div class="card-body ">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Images</th>
                                <th>Name</th>
                                <th>Date Of Birth</th>
                                <th>Age</th>
                                <th><i class="fa fa-phone"></i>Number</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($users)
                                @foreach($users as $user)
                                    <tr>
                                        <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                        <td><a href="{{route('registration.edit',$user->id)}}">{{$user->name}}</a></td>
                                        <td>{{$user->birthDate}}</td>
                                        <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>
                                        <td>{{$user->mobileNumber1."-".$user->mobileNumber2}}</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection


