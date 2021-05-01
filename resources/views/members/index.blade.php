@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Circular From National To District
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    {{--@include('sweet::alert')--}}

    <div class="row">
    <div class="table-responsive">
    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a  href="javascript:;" >District Circular</a>
                </li>
                <li>
                    <a href="javascript:;">Local Circular</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            @if($post)
                <table class="table table-bordered mb0">
                    <tbody>
                    @foreach($post as $posts)
                        <tr>
                            <td class="">{{$posts->created_at}}</td>
                            <td>
                                {{$posts->name}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    </div>
</div>

@endsection

