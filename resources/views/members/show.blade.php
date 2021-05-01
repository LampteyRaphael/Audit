@extends('layouts.app', ['activePage' => 'announcement_national', 'titlePage' => __('Announcement From National')])
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
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th colspan="5">
                                {!! Form::open(['method'=>'POST','action'=>'Locals\NationShowCircularController@indexpost']) !!}

                                    {!! Form::label('month','Select Month',['class'=>'control-label']) !!}
                                    <div class="input-group">
                                        {!! Form::selectMonth('month',$month,['class'=>'form-control']) !!}
                                    </div>


                                <div>
                                    {!! Form::label('year','Select year',['class'=>'control-label']) !!}
                                    <div class="input-group">
{{--                                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>--}}
                                        {!! Form::selectYear('year',2017,\Carbon\Carbon::now()->year,$year,['class'=>'form-control']) !!}
{{--                                        <div class="input-group-addon"><i class="fa fa-wrench fa-fw"></i></div>--}}
                                    </div>
                                </div>
                                <div>
                                    {!! Form::submit('submit',['class'=>'btn  btn-info ']) !!}
                                </div>

                                {!! Form::close() !!}
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($post as $posts)
                        <tr>
                            <td>National Circular</td>
                            <td>{{Carbon\Carbon::parse($posts->created_at)->format('jS-F-Y')}}</td>
                            <td><i class="material-icons" style="color:red;">books</i>&nbsp;&nbsp;{{strtoupper(substr(str_replace( '/NationalPdf/','',$posts->name),10))}}</td>
                            <td>{{$posts->created_at->diffForHumans()}}</td>
                        <td><a class="btn btn-success btn-sm" href="{{route('nationalcircular.get',$posts->id)}}">View</a></td>
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
@endsection



