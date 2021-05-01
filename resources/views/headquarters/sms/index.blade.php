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

    <div class="panel">
        <div class="panel-body">
            @if($sms)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Generated Code</th>
                        <th>Verification</th>
                        <th>GHS Amount</th>
                        <th>Number Of sms To Post</th>
                        <th>SMS Posted</th>
                        <th>Active SMS</th>
                        <th>Change Settings</th>
                        <th>Bock Settings</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sms as $sm)
                        <tr>
                            <td>{{$sm->smsGeneratedCode}}</td>

                            @if($sm->smsGeneratedCode===$sm->smsVerificationCode)

                                <td>{{"VERIFIED"}}</td>
                                @else
                                <td>{{"NOT VERIFIED"}}</td>

                             @endif
                            <td>{{$sm->amount}}</td>
                            <td>{{$sm->smsToPost}}</td>
                            <td>{{$sm->smsPosted}}</td>
                            <td>{{$sm->is_active==1? "Active SMS":"Not Active SMS"}}</td>
                            <td>{{$sm->block==1? "Not Block":"Block"}}</td>
                            <td>
                                <a href="{{route('nationalSms.edit',$sm->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
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

