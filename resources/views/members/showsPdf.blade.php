@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            National Circular-Locals
        </p>
    </li>
@endsection

@section('content')
    <div class="row">
    <div class="panel shadow mb25">
        <div class="panel-body">
            @if($post)
                <table class="table">
                    <tbody>
                    @foreach($post as $posts)
                        <tr>
                          
                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                <iframe class="embed-responsive-item" src="{{$posts->name? (($posts->name)) :'no file yet'}}" allowfullscreen></iframe>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection



