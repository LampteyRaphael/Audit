@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Dashboard
        </p>
    </li>
    <li>
        <p class="navbar-text">
            {{$area}} AREA
        </p>
    </li>
@endsection
@section('content')
    <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">{{$area}} AREA Chart
                    @include('includes.notification')
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            {!! $per3->html() !!}
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
                            {!! $totalNoneActive->html() !!}
                        </div>
                        <div class="col-md-3">
                            {!! $totalDeceased->html() !!}
                        </div>
                    </div>


                    <div class="col-md-12">
                        {!! $population->html() !!}
                    </div>



                    <div class="col-md-12">
                        {!!$levelsBreakdown->html() !!}

                    </div>


                    <div class="col-md-12">
                         {!!$pie->html() !!}
                    </div>



                    <div class="col-md-12">
                        <div class="col-md-4">
                            {!! $per->html() !!}
                        </div>
                        <div class="col-md-4">
                            {!! $per1->html() !!}
                        </div>
                        <div class="col-md-4">
                            {!! $per2->html() !!}
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
    {!! $totalNoneActive->script() !!}
    {!! $totalDeceased->script() !!}
    {!! $population->script() !!}
    {!! $pie->script() !!}
    {!! $levelsBreakdown->script() !!}
    {!! $per->script() !!}
    {!! $per1->script() !!}
    {!! $per2->script() !!}
    {!! $per3->script() !!}

    {{--{!! $nonactive->script() !!}--}}



    {{--<script>--}}
        {{--$.notify({--}}
            {{--// options--}}
            {{--icon: 'glyphicon glyphicon-warning-sign',--}}
            {{--title: 'Hello! Admin,',--}}
            {{--message: 'Greetings from TAC-HQ(IT Department). we acknowledge the serious registration that is going on in your local assembly ' +--}}
                {{--'to get our church members registered across Achimota Area for the Piloting.'+--}}
                {{--' God Richly Bless You',--}}
            {{--target: '_blank'--}}
        {{--},{--}}
            {{--// settings--}}
            {{--element: 'body',--}}
            {{--position: null,--}}
            {{--type: "info",--}}
            {{--allow_dismiss: true,--}}
            {{--newest_on_top: false,--}}
            {{--showProgressbar: false,--}}
            {{--placement: {--}}
                {{--from: "top",--}}
                {{--align: "right"--}}
            {{--},--}}
            {{--offset: 20,--}}
            {{--spacing: 10,--}}
            {{--z_index: 1031,--}}
            {{--delay: 10000,--}}
            {{--timer: 10000,--}}
            {{--url_target: '_blank',--}}
            {{--mouse_over: null,--}}
            {{--animate: {--}}
                {{--enter: 'animated fadeInDown',--}}
                {{--exit: 'animated fadeOutUp'--}}
            {{--},--}}
            {{--onShow: null,--}}
            {{--onShown: null,--}}
            {{--onClose: null,--}}
            {{--onClosed: null,--}}
            {{--icon_type: 'class',--}}
            {{--template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +--}}
                {{--'<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +--}}
                {{--'<span data-notify="icon"></span> ' +--}}
                {{--'<span data-notify="title">{1}</span> ' +--}}
                {{--'<span data-notify="message">{2}</span>' +--}}
                {{--'<div class="progress" data-notify="progressbar">' +--}}
                {{--'<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +--}}
                {{--'</div>' +--}}
                {{--'<a href="{3}" target="{4}" data-notify="url"></a>' +--}}
                {{--'</div>'--}}
        {{--});--}}
    {{--</script>--}}

@endsection

