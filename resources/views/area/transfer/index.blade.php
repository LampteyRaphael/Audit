@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">New Transfer</p>
    </li>

@endsection
@section('content')
    @include('includes.alert')
    <script>

        function Confirm()
        {
            var x = confirm("Are you sure you want to accept this church member to your local assembly?");
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
                        <a href="{{route('local.index')}}">Transfer</a>
                    </li>
                    <li>
                        <a href="javascript:;">Members</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Membership Id</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Area</th>
                            <th>District</th>
                            <th>Local</th>
                            <th>Released Acceptance</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($users)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->members_id}}</td>
                                    <td><img class="img-rounded" height="50" width="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png')}}" alt=""></td>
                                    <td><a class="btn-link" href="#">{{strtoupper($user->name)}}</a></td>
                                    <td>
                                        @foreach((App\Area::where('area_code','=',substr($user->members_id,0,2))->pluck('name')) as $area)
                                            {{$area}}
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach((App\District::where('district_code','=',substr($user->members_id,0,4))->pluck('name')) as $district)
                                            {{$district}}
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach((App\Locals::where('local_code','=',substr($user->members_id,0,6))->pluck('name')) as $local)
                                            {{$local}}
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('text.edit',$user->id)}}" onsubmit="return confirm()" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <section>
                        <nav>
                            <ul class="pager">
                                @if($users->currentPage() !== 1)
                                    <li class="previous"><a href="{{ $users->previousPageUrl() }}"><span aria-hidden="true">&larr;</span> Older</a></li>
                                @endif
                                @if($users->currentPage() !== $users->lastPage() && $users->hasPages())
                                    <li class="next"><a href="{{ $users->nextPageUrl() }}">Newer <span aria-hidden="true">&rarr;</span></a></li>
                                @endif
                            </ul>
                        </nav>
                    </section>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection