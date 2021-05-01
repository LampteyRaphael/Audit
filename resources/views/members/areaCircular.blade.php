@extends('layouts.app', ['activePage' => 'announcement_area', 'titlePage' => __('Announcement From Area')])
@section('content')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">National Circular</h4>
                            <p class="card-category">Circular from head office</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
            @if($post)
                <table class="table table-striped table-success">
                    <tr>
                        {!! Form::open(['method'=>'POST','action'=>'Locals\PostDistrictToLocalCircularController@areaPost','class'=>'row']) !!}
                        <td>
                            Year:{!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
                        </td>

                        <td>
                            Month: {!! Form::selectMonth('month',$month,['class'=>'form-control']) !!}
                        </td>
                        <td>
                            <div style="padding-top:20px">
                                {!! Form::submit('submit',['class'=>'btn  btn-primary btn-sm']) !!}
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tbody>
                    @foreach($post as $posts)
                        <tr>
                            <td>Local Circular</td>
                            <td><i class="fa fa-file-pdf-o btn" style="color:red;"></i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/AreaLevelPdf/','',$posts->name),10))}}</td>
                            <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                            <td>{{$posts->created_at->diffForHumans()}}</td>
                            <td>
                                <a class="btn btn-default btn-sm" href="{{route('localAreaPostS',$posts->id)}}">View</a>
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
</div>
</div>
</div>

    {{--</div>--}}


@endsection

