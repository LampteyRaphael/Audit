@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Income Categories
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')

    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
    <div class="table-responsive col-md-10 col-md-offset-1">
    <div class="panel mb25 collapse" id="i">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">+Add Category</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <table class="table table-striped mb0">
                <tbody>
                {!! Form::open(['method'=>'POST','action'=>'District\DistrictIncomeController@store'] ) !!}

                <tr>
                    <td>
{{--                        {!! Form::label('name','Category Name',['class'=>'control-label']) !!}--}}

                        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Category Name']) !!}
                    </td>
                    <td>
                        {!! Form::hidden('district_id',Auth::user()->district_id,['class'=>'form-control']) !!}
                    </td>
                    <td>
                        {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}

                        {!! Form::button('Close',['class'=>'btn  btn-danger','data-toggle'=>"collapse","data-target"=>"#i"]) !!}
                    </td>
                </tr>
                {!! Form::close() !!}
                </tbody>
            </table>
        </div>
    </div>
    </div>
    <div class="table-responsive col-md-10 col-md-offset-1">
    <div class="panel shadow">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="#i" class="btn btn-primary btn-xs" data-toggle="collapse">+Add new Category</a>
                </li>
            </ol>

        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($incomeCategory)

                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Categories</th>
                            <th>Total Income(GHS)</th>
                            <th>Cash Deposit</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomeCategory as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    {{number_format((App\DistrictIncome::where("district_id",Auth::user()->district_id)->where('district_income_categories_id',$item->id)->pluck('amount')->sum()),2)}}
                                </td>

                                <td>
                                    <a href="{{route('AccountInC.show',$item->id)}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                </td>
                                @if($item->district_id ==0)
                                    <td>
                                        <a href="{{route('AccountInC.edit',$item->id)}}" class="btn btn-success btn-xs" disabled="disabled"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE','action'=>['District\DistrictIncomeCategoryController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}

                                        <button type="submit" name="submit" class="btn btn-danger btn-xs" disabled="disabled"><i class="fa fa-remove"></i></button>
                                        {!! Form::close() !!}
                                    </td>

                                    @elseif($item->district_id !==0)
                                    <td>
                                        <a href="{{route('AccountInC.edit',$item->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>
                                    <td>
                                        {!! Form::open(['method'=>'DELETE','action'=>['District\DistrictIncomeCategoryController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}

                                        <button type="submit" name="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
                                        {!! Form::close() !!}
                                    </td>
                                @endif
                            </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total Income</td>
                                <td>{{number_format($total,2)}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
