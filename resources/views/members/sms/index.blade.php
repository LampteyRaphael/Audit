@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            SMS Verification
        </p>
    </li>
@endsection
@section('content')
    @include('includes.alert')

    <div class="panel animated bounceInDown">
        <div class="panel-body">
            @if($sms)
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Verification</th>
                        <th>GHS Amount</th>
                        <th>Number Of sms To Post</th>
                        <th>SMS Posted</th>
                        <th>Active SMS</th>
                        <th>Change Settings</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sms as $sm)
                        <tr>
                            @if($sm->smsGeneratedCode===$sm->smsVerificationCode)

                                <td>{{"VERIFIED"}}</td>

                                @else
                                <td>{{"NOT VERIFIED"}}</td>

                             @endif
                            <td>{{$sm->amount? $sm->amount:''}}</td>
                            <td>{{$sm->smsToPost? $sm->smsToPost:''}}</td>
                            <td>{{$sm->smsPosted? $sm->smsPosted:''}}</td>
                            <td>{{$sm->is_active==1? "Active SMS":"Not Active"}}</td>
                            <td>
                                <a href="{{route('localSms.edit',$sm->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>



             @endif
        </div>
        <div class="panel-footer"></div>
    </div>

@endsection

