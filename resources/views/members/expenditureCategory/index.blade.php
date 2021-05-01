@extends ('layouts.master_table')
@section('dashboard')
<li>
    <p class="navbar-text">
        Expenditure Categories
    </p>
</li>
@endsection

@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    <div class="row">
        <div class="table-responsive col-md-12">
        <div class="panel mb25 collapse shadow" id="i">
            <div class="panel-heading border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">+Add Category</a>
                    </li>
                </ol>
            </div>
            <div class="panel-body">
                <table class="table table-bordered mb0">
                    <tbody>
                    {!! Form::open(['method'=>'POST','action'=>'Locals\ExpenditureCategoryController@store'] ) !!}

                    <tr>
                        <td>
                            {!! Form::label('name','Category Name',['class'=>'control-label']) !!}

                            {!! Form::text('name',null,['class'=>'form-control','required'=>'required']) !!}
                        </td>
                        <td>{!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control','required'=>'required']) !!}
                        </td>
                        <td>
                            {!! Form::submit('submit',['class'=>'btn  btn-info ']) !!}

                            {!! Form::button('Close',['class'=>'btn  btn-danger','data-toggle'=>"collapse","data-target"=>"#i"]) !!}
                        </td>
                    </tr>
                    {!! Form::close() !!}
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>


    <div class="row">
        <div class="table-responsive col-md-12">
        <div class="panel shadow">
            <div class="panel-heading">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="javascript:;">Expenditure Category</a>
                    </li>
                    <li class="active">Post Data</li>
                    <li>
                        <a href="#i" class="btn btn-primary btn-xs" data-toggle="collapse">+Add new Category</a>
                    </li>
                </ol>

            </div>
            <div class="table-responsive">
                <div class="panel-body">
                    @if($expenditureCategory)
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Categories</th>
                                <th>Total Income(GHS)</th>
                                <th>Deposit</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($expenditureCategory as $item)
                                <tr>
                                    <td>{{$item->name}}</td>

                                    <td>
                                        {{number_format((App\Expenditure::where("local_id",Auth::user()->local_id)->where('category_id',$item->id)->whereYear('created_at',Carbon\Carbon::now()->year)->pluck('amount')->sum()),2)}}
                                    </td>
                                    <td>
                                        <a href="{{route('expenditure.show',$item->id)}}" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>
                                    </td>

                                    @if($item->local_id==0)
                                        <td>
                                            <a href="{{route('expenditureC.edit',$item->id)}}" class="btn btn-success btn-xs" disabled="disabled"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td>
                                            {!! Form::open(['method'=>'DELETE','action'=>['Locals\ExpenditureCategoryController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}

                                            <button type="submit" name="submit" class="btn btn-danger btn-sm" disabled="disabled"><i class="fa fa-remove"></i></button>
                                            {!! Form::close() !!}
                                        </td>
                                    @elseif($item->local_id !==0)
                                        <td>
                                            <a href="{{route('expenditureC.edit',$item->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td>
                                            {!! Form::open(['method'=>'DELETE','action'=>['Locals\ExpenditureCategoryController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}

                                            <button type="submit" name="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>
                                            {!! Form::close() !!}
                                        </td>

                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>Total</td>
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
    </div>
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
@endsection