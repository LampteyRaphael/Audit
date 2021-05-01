@extends('layouts.master_table')

@section('dashboard')
<li>
    <p class="navbar-text">
       Dashboard-National
    </p>
</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">National Charts
                    <span style="color: red; font-size: 12px; text-transform: uppercase">
             <marquee behavior="rotate" direction="left">
                shift to the cutting edge, shift in the power of the holy spirit, shift to the right direction
             </marquee>
         </span>
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
                        <div class="col-md-3">
                            {!! $region_numbers->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $areas_numbers->html() !!}
                        </div>

                        <div class="col-md-3">
                            {!! $districts_numbers->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $locals_numbers->html() !!}
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

    @include('includes.alert')
    {!! Charts::scripts() !!}
    {!! $region_numbers->script() !!}
    {!! $areas_numbers->script() !!}
    {!! $districts_numbers->script() !!}
    {!! $locals_numbers->script() !!}
    {!! $maleTotal->script() !!}
    {!! $femaleTotal->script() !!}
    {!! $childrenTotal->script() !!}
    {!! $newConvertTotal->script() !!}
    {!! $loginCounts->script() !!}
    {!! $update->script() !!}
    {!! $delete->script() !!}
    {!! $totalMembers->script() !!}
    {!! $totalYouth->script() !!}
    {!! $population->script() !!}
    {!! $admins->script() !!}
    {!! $levelsCount->script() !!}
    {!! $levelsBreakdown->script() !!}
    {!! $nonactive->script() !!}
    {!! $deceased->script() !!}
 @endsection