@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Income
        </p>
    </li>
@endsection
@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    <div class="table-responsive col-md-10 col-md-offset-1">
    <div class="panel collapse shadow" id="post">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Category</a>
                </li>
                <li>
                    <a href="javascript;">{{$category->name}}</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped mb0">
                <tbody>
                {!! Form::open(['method'=>'POST','action'=>'District\DistrictIncomeCategoryController@store'] ) !!}
                <tr>
                    {!! Form::hidden('district_income_categories_id',$category->id,['class'=>'form-control']) !!}
                    {!! Form::hidden('district_id',Auth::user()->district_id,['class'=>'form-control']) !!}

                    <td>
                        <div class="form-group ">
{{--                            {!! Form::label('amount','Amount(GHS)',['class'=>'control-label']) !!}--}}
                            {!! Form::number('amount',null,['class'=>'form-control','placeholder'=>'Amount']) !!}
                        </div>
                    </td>
                    <td>
                        <div class="form-group ">
{{--                            {!! Form::label('description','Description',['class'=>'control-label']) !!}--}}
                            {!! Form::text('description',null,['class'=>'form-control','placeholder'=>'Description']) !!}
                        </div>
                    </td>
                    <td>
                        {!! Form::submit('submit',['class'=>'btn  btn-info btn-sm']) !!}

                        {!! Form::button('Close',['class'=>'btn  btn-danger','data-toggle'=>"collapse","data-target"=>"#post"]) !!}
                    </td>
                </tr>
                {!! Form::close() !!}
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="table-responsive col-md-10 col-md-offset-1">
    <div class="panel mb25 shadow">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="{{route('AccountInC.index')}}">{{$category->name}}</a>
                </li>
                <li>
                    <a href="javascript:;">Amount</a>
                </li>
                <li>
                    <a href="#post" data-toggle="collapse"  class=" btn btn-info btn-xs">Click Here To Add</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Descriptions</th>
                    <th>Error Correction</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @if($categoryAll)
                    @foreach($categoryAll as $item)
                        <tr>
                            <td>{{$item->created_at}}</td>
                            <td>{{number_format($item->amount,2)}}</td>
                            <td>{{$item->description}}</td>
                            <td><a class="btn btn-primary btn-sm" href="{{route('DistrictErrorsIncome',$item->id)}}"><i class="glyphicon glyphicon-edit"></i></a></td>
                            <td>
                                {!! Form::open(['method'=>'DELETE','action'=>['District\DistrictIncomeController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'])!!}
                                   <button class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove-sign"></i></button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    <tfooter>
                    <tr>
                        <td>Total</td>
                        <td colspan="4">{{$categoryAllTotal}}</td>
                    </tr>
                    </tfooter>
                @endif
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are You Sure You Want To Delete");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endsection