@extends ('layouts.master_table')
@section('dashboard')

    <li>
        <p class="navbar-text">The Apostolic Church-Ghana (Districts)
        </p>
    </li>

    <li>
        <p class="navbar-text">
            Per page &numero;&nbsp;{{$districtCount}}
        </p>
    </li>

@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    @include('sweet::alert')
    <div class="panel mb25 shadow">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a class="btn-link" href="{{route('districtPost.index')}}">{{$region}}</a>
                </li>
                <li>
                    <a href="javascript:;">{{$areaName}}</a>
                </li>
                <li>
                    <a href="javascript:;">Districts</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            {!! Form::open(['method'=>'POST', 'action'=>['District\SearchController@Index','class'=>'form-inline']]) !!}
            <div class="form-group">
                <div class="col-md-2">
                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                </div>
            </div>
            {!! Form::submit('search',['class'=>'btn btn-primary btn-sm','Placeholder'=>'search']) !!}
            {!! Form::close() !!}
            <table class="table table-bordered mb0">
                <thead>
                <th>District Code</th>
                <th>Name</th>
                <th>Created</th>
                <th>Updated</th>
                </thead>
                <tbody>
                @if($districts)
                    @foreach($districts as $district)
                        <tr>
                            <td>{{$district->district_code}}</td>
                            <td><a class="btn-link" href="{{route('districtPost.show',$district->id)}}">{{$district->name}}</a></td>
                            <td>{{$district->created_at->diffForHumans()}}</td>
                            <td>{{$district->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
                {{$districts->links()}}
            </table>
        </div>
    </div>
@endsection
