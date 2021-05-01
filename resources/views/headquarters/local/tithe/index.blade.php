@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Individual Post Tithes
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    @include('sweet::alert')
    <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    {{--<li>{{$year}}</li>--}}
                    <li>
                        <a href="javascript:;">Individual</a>
                    </li>
                    <li>
                        <a href="javascript:;">Tithe</a>
                    </li>
                    <li class="active">Paid</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-condensed mb0">
                        <thead>
                        <tr>
                            <th>Posted Date And Time</th>
                            <th>GHS</th>
                            <th>Church Members</th>
                            <th>Error</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if($tithe)

                            @foreach($tithe as $item)
                                <tr>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{number_format($item->amount,2)}}</td>
                                    <td>{{$item->user? $item->user->name:'no user'}}</td>
                                    <td><a  onclick='return ConfirmDelete()'  class="btn btn-danger btn-sm" href="{{route('tithe.show',$item->id)}}"><i class="fa fa-remove"></i></a></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>Total</td>
                                <td>{{number_format($totalTithe,2)}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
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

        function ConfirmUpdate()
        {
            var x = confirm("Are you sure you want to update?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endsection

