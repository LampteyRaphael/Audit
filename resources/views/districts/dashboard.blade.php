@extends ('layouts.master_table')

@section('dashboard')
<li>
    <p class="navbar-text">
        DASHBOARD
    </p>
</li>
    <li>
        <p class="navbar-text">
            {{strtoupper($district)}} DISTRICT
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{$district}} Charts
                    @include('includes.notification')
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            {!! $totalMembers->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $maleTotal->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $femaleTotal->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $totalYouth->html() !!}
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="col-md-3">
                            {!! $childrenTotal->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $newConvertTotal->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $nonactive->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $deceased->html() !!}

                        </div>
                    </div>

                    <div class="col-md-12">
                        {!! $population->html() !!}
                    </div>
                    <div class="col-md-12">
                        {!! $levelsBreakdown->html() !!}
                    </div>


                    <div class="">
                        <div class="col-md-5">
                            {!! $admins->html() !!}
                        </div>
                        <div class="col-md-7">
                            {!!$levelsCount->html() !!}
                        </div>
                    </div>



                    <div class="col-md-12">
                        <div class="col-md-4">
                            {!! $loginCounts->html() !!}

                        </div>
                        <div class="col-md-4">
                            {!! $update->html() !!}

                        </div>
                        <div class="col-md-4">
                            {!! $delete->html() !!}
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @include('includes.systemManual')
    {!! Charts::scripts() !!}
    {!! $maleTotal->script() !!}
    {!! $femaleTotal->script() !!}
    {!! $totalYouth->script() !!}
    {!! $childrenTotal->script() !!}
    {!! $newConvertTotal->script() !!}
    {!! $loginCounts->script() !!}
    {!! $update->script() !!}
    {!! $delete->script() !!}
    {!! $totalMembers->script() !!}
    {!! $population->script() !!}
    {!! $admins->script() !!}
    {!! $levelsCount->script() !!}
    {!! $levelsBreakdown->script() !!}
    {!! $nonactive->script() !!}
    {!! $deceased->script() !!}

@endsection