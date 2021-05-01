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
    <div class="panel mb25 collapse " id="i">
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
                {!! Form::open(['method'=>'POST','action'=>'Area\AreaIncomeController@store'] ) !!}

                <tr>
                    <td>
{{--                        {!! Form::label('name','',['class'=>'control-label']) !!}--}}

                        {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Category Name']) !!}
                    </td>
                    <td>{!! Form::hidden('area_id',Auth::user()->area_id,['class'=>'form-control']) !!}
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
    <div class="panel shadow animated slideInDown">
        <div class="panel-heading">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="#i" class="btn btn-default btn-xs" data-toggle="collapse">+Add new Category</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($incomeCategory)

                    <table class="table table-striped table-striped">
                        <thead>
                        <tr>
                            <th>Categories</th>
                            <th>Total Income(GHS)</th>
                            <th>Cash Deposit</th>
                            <th>Update Category</th>
                            <th>Delete Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomeCategory as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    {{number_format((App\AreaIncome::where("area_id",Auth::user()->area_id)->where('area_income_categories_id',$item->id)->whereYear('created_at',$year)->pluck('amount')->sum()),2)}}
                                </td>
                                <td>
                                    <a href="{{route('AccountInCArea.show',$item->id)}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="{{route('AccountInCArea.edit',$item->id)}}" class="btn btn-success btn-xs"><i class="fa fa-recycle"></i></a>
                                </td>
                                <td>
                                    {!! Form::open(['method'=>'DELETE','action'=>['Area\AreaCategoryController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}

                                    <button type="submit" name="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        {{--<tr>--}}
                            {{--<td>Thanksgiving Offering</td>--}}
                            {{--<td>{{number_format($thanks,2)}}</td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>Tithe</td>--}}
                            {{--<td>{{$t=number_format($tithe+$thanks,2)}}</td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                            {{--<td></td>--}}
                        {{--</tr>--}}
                        </tbody>
                        <tfoot>
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($total,2)}}</td>
                            <td></td>
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
@endsection
