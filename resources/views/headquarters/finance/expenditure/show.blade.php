@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            Expenditure
        </p>
    </li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    @include('sweet::alert')
    <div class="panel collapse" id="post">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Category</a>
                </li>
                <li>
                    <a href="javascript:;">{{$category->name}}</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-bordered mb0">
                <tbody>
                {!! Form::open(['method'=>'POST','action'=>'National\NationalExpenditureController@store'] ) !!}

                <tr>
                    {!! Form::hidden('category_id',$category->id,['class'=>'form-control']) !!}
                    <td>
                        <div class="form-group ">
                            {!! Form::label('amount','Amount(GHS)',['class'=>'control-label']) !!}
                            {!! Form::number('amount',null,['class'=>'form-control','required'=>'required']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="form-group ">
                            {!! Form::label('description','Description',['class'=>'control-label']) !!}
                            {!! Form::text('description',null,['class'=>'form-control']) !!}
                        </div>
                    </td>
                    <td>

                        {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}

                        {!! Form::button('Close',['class'=>'btn  btn-danger','data-toggle'=>"collapse","data-target"=>"#post"]) !!}
                    </td>
                </tr>
                {!! Form::close() !!}

                </tbody>
            </table>
        </div>
    </div>
    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="{{route('ExCategory.index')}}">{{$category->name}}</a>
                </li>
                <li>
                    <a href="javascript:;">Amount</a>
                </li>
                <li>
                    <a href="#post" data-toggle="collapse"  class=" btn btn-info">Add</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-bordered mb0">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                @if($categoryAll)

                    @foreach($categoryAll as $item)

                        <tr>
                            <td>{{$item->created_at}}</td>
                            <td>{{number_format($item->amount,2)}}</td>
                            <td>{{$item->description}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td>Total</td>
                        <td style="font-size:2em;">
                            GHS &nbsp;  {{number_format($categoryAllTotal,2)}}
                        </td>
                        <td></td>
                    </tr>

                @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection