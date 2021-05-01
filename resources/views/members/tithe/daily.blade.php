@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">Daily Tithe Statement</p>
    </li>
@endsection
@section('content')
    {!! Form::open(['method'=>'POST','action'=>'Locals\TitheController@storepost','class'=>'modal form-inline','id'=>'date', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                The Apostolic Church-Ghana
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="date" class="control-label">
                        <div class="input-group">
                            <div class="input-group-addon bg-blue"><span class="bold">Date  click me</span></div>
                            {!! Form::date('date',null,['class'=>'form-control']) !!}
                            <div class="input-group-addon bg-blue"><i class="fa fa-calendar fa-fw"></i></div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="modal-footer no-border">
                <div class="form-group">
                    {!! Form::submit('Close',['class'=>'btn  btn-danger','data-dismiss'=>'modal']) !!}
                    {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <div class="row">
        @if($tithe)
            <table class="table table-bordered table-hover" style="border: none">
                <thead>
                <tr>
                    <th>
                        <a href="#date" data-toggle="modal" class="btn btn-success btn-sm">Change Date</a>
                    </th>
                    <th class="text-center bold" style="font-family: Monaco;font-size: 30px;">
                        TITHE STATEMENT
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        {{$date}}
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($tithe as $tithes)
                    <tr>
                        <td style="border: none">
                            {{$tithes->name}}
                        </td>

                        @foreach(App\PostTithe::where('local_id',Auth::user()->local_id)

                        ->whereYear('created_at',$year)->whereMonth('created_at',$month)->whereDay('created_at',$day)
                        ->where('user_id',$tithes->id)->pluck('amount') as $item)

                            <td style="border: none"> {{number_format($item,2)}} </td>

                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>


        @endif
    </div>

@endsection