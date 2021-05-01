@if(Session::has('success1'))
        {{--<div class="alert alert-danger" id="alert">--}}
        {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
            {{--<span aria-hidden="true">&times;</span>--}}
        {{--</button>--}}
        {{--</div>--}}
        <script>
            swal("Good job!", "You clicked the button!");
        </script>
{{--    <script>--}}
{{--        var notify = $.notify('<strong>{{Session::get("success1")}}</strong> Do not close this page...', {--}}
{{--            allow_dismiss: false,--}}
{{--            showProgressbar: true--}}
{{--        });--}}

{{--        setTimeout(function() {--}}
{{--            notify.update({'type': 'success', 'message': '<strong>Please</strong> Wait...', 'progress': 25});--}}
{{--        }, 4500);--}}
{{--    </script>--}}
@endif



@if(Session::has('success'))
{{--    <script>--}}
{{--        var notify = $.notify('<strong>{{Session::get("success")}}</strong> Do not close this page...', {--}}
{{--            allow_dismiss: false,--}}
{{--            showProgressbar: true--}}
{{--        });--}}

{{--        setTimeout(function() {--}}
{{--            notify.update({'type': 'success', 'message': '<strong>Please </strong> wait...', 'progress': 25});--}}
{{--        }, 4500);--}}
{{--    </script>--}}

@endif


@if (session('error'))
    <button class="btn btn-primary btn-fill" onclick='swal({ title:" Are You Sure?", text: "You clicked the button!", type: "alert", buttonsStyling: false, confirmButtonClass: "btn btn-danger"})'>Try me!</button>

    <div class="alert alert-primary">{{ session('error') }}</div>
@endif
