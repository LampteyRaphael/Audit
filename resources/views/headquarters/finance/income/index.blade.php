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
    @include('sweet::alert')
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
    <div class="panel mb25 collapse" id="i">
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
                {!! Form::open(['method'=>'POST','action'=>'National\NationalIncomeCategoryController@store'] ) !!}

                <tr>
                    <td>
                        {!! Form::label('name','Category Name',['class'=>'control-label']) !!}

                        {!! Form::text('name',null,['class'=>'form-control','required'=>'required']) !!}
                    </td>
                    <td>{!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control','required'=>'required']) !!}
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
    <div class="panel">
        <div class="panel-heading">
            <a href="#i" class="btn btn-primary btn-sm" data-toggle="collapse">+Add new Category</a>

        </div>
        <div class="panel-body">
            <div class="table-responsive">
                @if($incomeCategory)

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Categories</th>
                            <th>Total Income(GHS)</th>
                            <th>Date Created</th>
                            <th>Cash Deposit</th>
                            <th>Update Category</th>
                            <th>Delete Category</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($incomeCategory as $item)
                            <tr>
                                <td>
                                    {{$item->name}}
                                </td>
                                <td>
                                    {{number_format((App\NationalIncome::where('category_id',$item->id)->pluck('amount')->sum()),2)}}
                                </td>

                                <td>{{$item->created_at->diffForHumans()}}</td>

                                <td>
                                    <a href="{{route('categoryNa.show',$item->id)}}" class="btn btn-info">Deposit</a>
                                </td>
                                <td>
                                    <a href="{{route('categoryNa.edit',$item->id)}}" class="btn btn-success">Edit</a>
                                </td>
                                <td>
                                    {!! Form::open(['method'=>'DELETE','action'=>['National\NationalIncomeCategoryController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}
                                <button type="submit" name="submit" class="btn btn-danger">Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Thanks(60%)</td>
                            <td>{{number_format($thanks,2)}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tithe(60%)</td>
                            <td>{{number_format($totalTithe,2)}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>{{number_format($allIncomeTotal+$totalTithe+$thanks,2)}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                @endif
            </div>

        </div>
    </div>

@endsection