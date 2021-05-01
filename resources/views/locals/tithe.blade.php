@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            <a class="btn-primary btn-sm" href="{{route('registration.index')}}">Home</a>
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')

    @include('includes.alert')
    {{--@include('sweet::alert')--}}

    <div class="table-responsive">
        <div class="panel mb25">
            <div class="panel-heading border">
                Tithe Paid
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb0">
                        <thead>
                        <tr>
                            <th>DATE</th>
                            <th>TITHE(GHS)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($tithe)
                            @foreach($tithe as $tithes)
                                <tr>
                                    <td>{{$tithes->created_at->format('jS F, Y')}}</td>
                                    <td>{{number_format($tithes->amount,2)}}</td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($total,2)}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

