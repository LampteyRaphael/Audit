@extends('layouts.app', ['activePage' => 'incomeAll', 'titlePage' => __($category->name)])
@section('content')
<div class="modal fade modal-mini modal-primary" id="myModal10" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-small">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
            </div>
            <div class="modal-body">
                <p>ADD INCOME</p>
                    {!! Form::open(['method'=>'POST','action'=>'Locals\IncomeController@store'] ) !!}

                        {!! Form::hidden('category_id',$category->id,['class'=>'form-control']) !!}
                        {!! Form::hidden('local_id',$ids,['class'=>'form-control','required'=>'required']) !!}

                            <div class="form-group ">
                                {!! Form::label('amount','Amount(GHS)',['class'=>'control-label']) !!}
                                {!! Form::number('amount',null,['class'=>'form-control','required'=>'required']) !!}
                            </div>

                            <div class="form-group ">
                                {!! Form::label('description','Description',['class'=>'control-label']) !!}
                                {!! Form::text('description',null,['class'=>'form-control']) !!}
                            </div>
            </div>
            <div class="modal-footer justify-content-center">
                {!! Form::button('Close',['class'=>'btn  btn-danger','data-toggle'=>"modal","data-target"=>"#myModal10"]) !!}

                {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">Income Category</h4>
                        <p class="card-category">
                        </p>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-rose btn-round pull-right" data-toggle="modal" data-target="#myModal10">
                            ADD INCOME
                            <div class="ripple-container"></div></button>
                        @include('includes.form_error')
                        @include('includes.alert')
                <table class="table table-striped mb0 mt0">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Error Correction</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($categoryAll)
                        @foreach($categoryAll as $item)
                            <tr>
                                <td>{{$item->created_at}}</td>
                                <td>{{number_format($item->amount,2)}}</td>
                                <td>{{$item->description}}</td>
                                <td><a href="{{route('income.edit',$item->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>Total</td>
                            <td style="font-size:1em;">
                              GHS &nbsp;  {{number_format($categoryAllTotal,2)}}
                            </td>
                            <td colspan="2"></td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
     </div>
   </div>
  </div>
</div>
@endsection
