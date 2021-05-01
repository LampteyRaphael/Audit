@extends('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">Search</p>
    </li>
@endsection
@section('content')
    @include('includes.form_error')
    @include('includes.alert')

    <div class="row">
        {!! Form::open(['method'=>'POST', 'action'=>['National\localSearchNationalController@missing']]) !!}
        <div class="col-md-11">
            <div class="form-group">
                {!! Form::text('search',null,['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-md-1">
            <div class="form-group">
                {!! Form::submit('search',['class'=>'btn btn-primary btn-sm','Placeholder'=>'search']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    @if($users)
    <div class="table-responsive">
        <table class="table table-bordered" id="data-table" >
            <thead>
            <tr>
                <th>MEMBERSHIP ID</th>
                <th>IMAGES</th>
                <th>NAME</th>
                <th>GENDER</th>
                <th>YEARS IN THE CHURCH.</th>
                <th>OFFICE HELD </th>
                <th>AGE</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->members_id}}</td>
                        <td>
                            <img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png') }}" alt="">
                        </td>
                        <td><a class="btn-link" href="{{route('searchPost.edit',$user->id)}}">{{strtoupper($user->name)}}</a></td>

                        <td>{{strtoupper($user->gender ?$user->gender:'')}}</td>

                        <td>{{strtoupper(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch ? $user->datejoinchurch:\Carbon\Carbon::now()->format('Y-m-d') ))->diff(Carbon\Carbon::now())
                        ->format('%y years,%m months,%d days'))}}</td>

                        <td>{{strtoupper($user->officeHeld)}}</td>

                        <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>
                        <td><a class="btn btn-primary btn-xs" href="{{route('searchPost.edit',$user->id)}}"><i class="fa fa-edit"></i></a></td>
                        <td>
                            {!! Form::model($user,['method'=>'DELETE','action'=>['National\AdminCategoriesController@destroy',$user->id],'onsubmit' => 'return ConfirmDelete()',],['class'=>'form-inline'])!!}
                            <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-edit"></i></button>
                            {!! Form::close() !!}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$users->links()}}
        @endif
    </div>

@endsection



