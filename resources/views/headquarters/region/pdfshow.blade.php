@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
             Circular
        </p>
    </li>
@endsection
@section('content')
@include('includes.form_error')
        @include('includes.alert')
            @if($post)
                <table>
                    <tbody>
                    @foreach($post as $posts)
                        <tr>
                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                <iframe class="embed-responsive-item" src="{{$posts->name? (($posts->name)) :''}}" allowfullscreen></iframe>
                            </div>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
@endsection