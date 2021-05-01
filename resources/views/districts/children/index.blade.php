@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">Children</p>
    </li>

        <li>
            <p class="navbar-text">
                <a class="btn btn-instagram btn-xs" href="#summary" data-toggle="modal">Summary</a>
            </p>
        </li>
    <li>
        <p class="navbar-text">
            Total&numero; &nbsp;{{$countUsers}}
        </p>
    </li>

 @endsection
 @section('content')
     @include('includes.alert')
     @include('sweet::alert')
    <div class="modal" id="summary">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <table class="table">

                        <thead>
                        <tr>
                            <th>TOTAL CHILDREN</th>
                            <th>{{$countUsers}}</th>
                        </tr>
                        <tr>
                            <th>Boys</th>
                            <th>Girls</th>
                        </tr>
                        </thead>
                        <tbody >
                        <tr>
                            <td>{{$male}}</td>
                            <td>{{$female}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

     <div class="table-responsive-sm">
    <div class="panel mb25">
        <div class="panel-heading no-border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="{{route('ministry.index')}}">Home</a>
                </li>
                <li>
                    <a href="javascript:;">Active Children</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>IMAGES</th>
                        <th>NAME</th>
                        <th>GENDER</th>
                        <th>YEARS IN THE CHURCH.</th>
                        <th>OFFICE HELD </th>
                        <th>AGE</th>
                    </tr>
                    </thead>
                    <tbody>
                    {!! Form::open(['method'=>'POST','action'=>'LocalMembersSearchController@store'])!!}

                    <div class="form-group form-group-sm col-md-8 bold">
                        {!! Form::text('search',null,['class'=>'form-control input-sm']) !!}
                    </div>

                    <div class="form-group form-group-sm col-md-2">
                        {!! Form::submit('Search',['class'=>'btn btn-info btn-xs']) !!}
                    </div>
                    <div class="form-group form-group-sm col-md-2">
                        <a class="btn btn-success btn-xs" href="{{route('storeExcel')}}">Export to Excel</a>
                    </div>

                    {!! Form::close() !!}
                    @if($users)
                        @foreach($users as $user)
                            <tr>

                                <td><img class="img img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>

                                <td><a class="btn-link" href="{{route('ministry.show',$user->id)}}">{{strtoupper($user->name)}}</a></td>

                                <td>{{strtoupper($user->gender)}}</td>

                                <td>{{strtoupper(Carbon\Carbon::now()->parse(str_replace('/','-',$user->datejoinchurch))->diff(Carbon\Carbon::now())
                                 ->format('%y years,%m months,%d days'))}}</td>

                                <td>{{strtoupper($user->officeHeld)}}</td>

                                <td>{{\Carbon\Carbon::parse($user->birthDate)->age}}</td>
                            </tr>

                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>IMAGES</th>
                        <th>NAME</th>
                        <th>GENDER</th>
                        <th>YEARS IN THE CHURCH.</th>
                        <th>OFFICE HELD </th>
                        <th>AGE</th>
                    </tr>
                    </tfoot>
                </table>
                {{--<section>--}}
                    {{--<nav>--}}
                        {{--<ul class="pager">--}}
                            {{--@if($users->currentPage() !== 1)--}}
                                {{--<li class="previous"><a href="{{ $users->previousPageUrl() }}"><span aria-hidden="true">&larr;</span> Older</a></li>--}}
                            {{--@endif--}}
                            {{--@if($users->currentPage() !== $users->lastPage() && $users->hasPages())--}}
                                {{--<li class="next"><a href="{{ $users->nextPageUrl() }}">Newer <span aria-hidden="true">&rarr;</span></a></li>--}}
                            {{--@endif--}}
                        {{--</ul>--}}
                    {{--</nav>--}}
                {{--</section>--}}
                {{--{{$users->links()}}--}}
            </div>
        </div>
    </div>
</div>
@endsection