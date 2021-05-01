@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">

        </p>
    </li>
@endsection
@section('content')
    <div class="panel mb25">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Select</a>
                    </li>
                    <li>
                        <a href="javascript:;">Date</a>
                    </li>
                    <li class="active">Account Statement</li>
                </ol>
            </div>
            <div class="panel-body">
                {!! Form::open(['method'=>'POST','action'=>'Area\AreaChurchAccountController@store'] ) !!}

                <div class="form-group">
                    <div class="form-group ">
                        {!! Form::label('from','From',['class'=>'control-label']) !!}
                        {!! Form::date('from',null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group ">
                        {!! Form::label('to','To',['class'=>'control-label']) !!}
                        {!! Form::date('to',null,['class'=>'form-control','required'=>'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-group ">
                        {!! Form::label('local_id','Locals',['class'=>'control-label']) !!}
                        {!! Form::select('local_id',[''=>'--Select Option--']+$local,null,['class'=>'form-control']) !!}
                    </div>
                </div>


                <div class="form-group">
                    {!! Form::submit('submit',["class"=>"btn  btn-info"]) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    @if($category)
    <div class="panel">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">From</a>
                </li>
                <li>
                    <a href="javascript:;">{{$from}}</a>
                </li>
                <li>
                    <a href="javascript:;">to</a>
                </li>
                <li>
                    <a href="javascript:;">{{$to}}</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">


                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>Categories</th>
                            <th>Income(GHS)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($category as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    {{number_format(($sum=App\income::where("local_id",$local_id)
                                    ->whereBetween('created_at',[$from." 00:00:00",$to." 23:59:59"])
                                    ->where('category_id',$item->id)->pluck('amount')->sum()),2)}}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Tithe</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Total</td>
                            <td>{{number_format(($sum=App\income::where("local_id",$local_id)
                                    ->whereBetween('created_at',[$from." 00:00:00",$to." 23:59:59"])
                                    ->whereIn('category_id',$c)->pluck('amount')->sum()),2)}}</td>
                        </tr>
                        </tbody>
                    </table>
            </div>

        </div>
    </div>
    @endif


@if($category)
<div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">From</a>
                </li>
                <li>
                    <a href="javascript:;">{{$from}}</a>
                </li>
                <li>
                    <a href="javascript:;">to</a>
                </li>
                <li>
                    <a href="javascript:;">{{$to}}</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-bordered mb0">
                <thead>
                <tr>
                </tr>
                </thead>
                <tbody>
                @foreach($category as $item)
                    <ul class="nav nav-tabs">
                        <li><u style="color: blue">{{$item->name}}</u>

                            @foreach($a=App\income::where("local_id",$local_id)->where('category_id',$item->id)
                            ->whereBetween('created_at',[$from." 00:00:00",$to." 23:59:59"])
                            ->get(['amount','description','created_at']) as $value)

                                <ul>

                                    <li>
                                        {{$value->created_at->format('jS F,Y') . " " .$value->description. " " .$value->amount}}

                                    </li>
                                </ul>
                        </li>
                        @endforeach
                        <ul>
                            <li class="bold">
                                Total= {{number_format((App\income::where("local_id",$local_id)->where('category_id',$item->id)
                             ->whereBetween('created_at',[$from." 00:00:00",$to." 23:59:59"])
                             ->pluck('amount')->sum()),2)}}
                            </li>
                        </ul>
                    </ul>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection

