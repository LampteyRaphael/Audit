@extends('layouts.app', ['activePage' => 'incomeAll', 'titlePage' => __('Income Categories')])
@section('content')


    <div class="content">
        <div class="container-fluid">
            <input type="hidden" value="{{Session::get('success1')}}" class="showsupdate">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-icon">
                            <h4 class="card-title ">Income Category</h4>
                            <p class="card-category"> Here you can manage users</p>
                        </div>
                        <div class="card-body">

{{--                            @include('includes.form_error')--}}
{{--                            @include('includes.alert')--}}

{{--                    <a href="#i" class="btn btn-primary btn-xs pull-right" data-toggle="modal">+Add new</a>--}}

            <div class="table-responsive">
                @if($incomeCategory)
                    <table class="table  table-striped table-success">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link btn btn-primary btn-fab btn-round" href="javascript:(0);" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                    {{--                                                <span class="notification">Church Members Sub Menu</span>--}}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#i">{{ __('Add More Income Category') }}</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#search">{{ __('Add Income') }}</a>
                                    <a class="dropdown-item" href="{{route('storeExcel')}}">{{ __('Add Expenditure') }}</a>
                                    <a class="dropdown-item" href="{{route('mychart')}}">{{ __('Add Tithe') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Add Donation') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Tithe Chart') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Tithe Chart Range') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Posted Tithe') }}</a>
                                    <a class="dropdown-item" href="#">{{ __('Posted Donation') }}</a>
                                </div>
                            </li>
                        </ul>
                        <tbody>
                        @foreach($incomeCategory as $item)
                            <tr>
{{--                                <td>--}}
{{--                                    <a href="#"><i class="material-icons">add_circle</i></a>--}}
{{--                                </td>--}}
                                <input type="hidden" class="cID" value="{{$item->id}}">
                                <td rel="tooltip" title="{{$item->name}}">{{$item->name}}</td>
                                    <td>
                                        {{number_format((App\income::where("local_id",Auth::user()->local_id)->where('category_id',$item->id)->whereYear("created_at",Carbon\Carbon::now()->year)->pluck('amount')->sum()),2)}}
                                    </td>
{{--                                <td rel="tooltip" title="Let's go">--}}
{{--                                    <a href="{{route('income.show',$item->id)}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>--}}
{{--                                </td>--}}
                                @if($item->local_id==0)
{{--                                <td rel="tooltip" title="You dont have permission">--}}
{{--                                    <a href="{{route('category.edit',$item->id)}}" class="btn btn-success btn-xs" disabled="disabled"><i class="fa fa-edit"></i></a>--}}
{{--                                </td>--}}
{{--                                <td rel="tooltip" title="You dont have permission">--}}
{{--                                    {!! Form::open(['method'=>'DELETE','action'=>['Locals\IncomeCategoryController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}--}}

{{--                                    <button rel="tooltip" title="You dont have permission" type="submit" name="submit" class="btn btn-danger btn-xs" disabled="disabled"><i class="fa fa-remove"></i></button>--}}
{{--                                    {!! Form::close() !!}--}}
{{--                                </td>--}}
                                    <td>
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                    <a data-categorys="{{$item->id}}" data-categoryname="{{$item->name}}" class="dropdown-item" data-toggle="modal" data-target="#deposit" href="#"><i class="material-icons">payment</i> {{$item->name}} </a>
                                                    <a class="dropdown-item " href="#"><i class="material-icons">update</i> {{ __('Edit') }}</a>
                                                    <a class="dropdown-item " href="#"><i class="material-icons">arrow_right</i> {{ __('Detail') }}</a>
                                                    <a class="dropdown-item deleteCategory" href="javascript:(0);"><i class="material-icons">error</i> {{ __('Delete') }}</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>
                                    @elseif($item->local_id !==0)
{{--                                    <td>--}}
{{--                                        <a href="{{route('category.edit',$item->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>--}}
{{--                                    </td>--}}
{{--                                    <td>--}}
{{--                                        {!! Form::open(['method'=>'DELETE','action'=>['Locals\IncomeCategoryController@destroy',$item->id],'onsubmit' => 'return ConfirmDelete()'] ) !!}--}}

{{--                                        <button type="submit" name="submit" class="btn btn-danger btn-xs"><i class="fa fa-remove"></i></button>--}}
{{--                                        {!! Form::close() !!}--}}
{{--                                    </td>--}}


                                    <td>
                                        <ul class="navbar-nav">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="material-icons">more_vert</i>
                                                    {{--                                                                <span class="notification">Church Members Sub Menu</span>--}}
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deposite" href="{{route('category.edit',$item->id)}}"><i class="material-icons">arrow_right</i>{{ __('Deposite') }}</a>
                                                    <a class="dropdown-item " href="{{route('category.edit',$item->id)}}"><i class="material-icons">update</i>{{ __('Edit') }}</a>
                                                    <a class="dropdown-item deleteCategory" href="javascript:(0);"><i class="material-icons">error</i>{{ __('Delete') }}</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </td>

                                    @endif
                            </tr>
                        @endforeach


{{--                        <tr>--}}
{{--                            <td>Donations</td>--}}
{{--                            <td>{{number_format($donation,2)}}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{route('donation/Pledge')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="{{route('category.edit',$item->id)}}" class="btn btn-success btn-xs" disabled="disabled"><i class="fa fa-edit"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <button type="submit" name="submit" class="btn btn-danger btn-xs" disabled="disabled" ><i class="fa fa-edit"></i></button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}

{{--                        <tr>--}}
{{--                            <td>Tithe</td>--}}
{{--                            <td>{{number_format($t=$tithe,2)}}</td>--}}
{{--                            <td>--}}
{{--                                <a href="{{route('tithe.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <a href="{{route('category.edit',$item->id)}}" class="btn btn-success btn-xs" disabled="disabled"><i class="fa fa-edit"></i></a>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <button type="submit" name="submit" class="btn btn-danger btn-xs" disabled="disabled" ><i class="fa fa-edit"></i></button>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                        </tbody>
{{--                        <tfoot>--}}
{{--                        <tr>--}}
{{--                            <td>Total</td>--}}
{{--                            <td>{{number_format($total+$tithe+$donation,2)}}</td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                            <td></td>--}}
{{--                        </tr>--}}
{{--                        </tfoot>--}}
                    </table>
                @endif
            </div>
        </div>
    </div>

        </div>
    </div>
            <div class="modal fade in" id="deposit"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Deposit</h5>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method'=>'POST','action'=>'Locals\IncomeController@store'] ) !!}

                            {!! Form::hidden('category_id',null,['class'=>'form-control','id'=>'categoruId']) !!}
                            {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control', 'id'=>' localId', 'required'=>'required']) !!}

                            <div class="form-group ">
                                {!! Form::label('amount','Amount(GHS)',['class'=>'control-label']) !!}
                                {!! Form::number('amount',null,['class'=>'form-control','required'=>'required']) !!}
                            </div>

                            <div class="form-group ">
                                {!! Form::label('description','Description',['class'=>'control-label']) !!}
                                {!! Form::text('description',null,['class'=>'form-control']) !!}
                            </div>

                        </div>
                        <div class="modal-footer">
                            {!! Form::button('Close',['class'=>'btn  btn-danger','data-toggle'=>"modal","data-target"=>"#deposit"]) !!}

                            {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="i">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-transparent">
                            <h5 class="modal-title">Add More Income Category</h5>
                        </div>
                        <div class="modal-body">
                            {!! Form::open(['method'=>'POST','action'=>'Locals\IncomeCategoryController@store'] ) !!}

                            <div class="form-group">
                                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Category Name','required'=>'required']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control','required'=>'required']) !!}
                            </div>

                        </div>
                        <div class="modal-footer">
                            {!! Form::button('Close',['class'=>'btn  btn-danger','data-toggle'=>"modal","data-target"=>"#i"]) !!}
                            {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
