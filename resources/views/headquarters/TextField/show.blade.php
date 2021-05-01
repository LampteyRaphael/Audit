@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Chart Room
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')
    @include('includes.alert')

    <div class="table-responsive">
        <div class="panel mb25" style="background: url('{{asset('photos/background.png')}}')">
            <div class="panel-heading no-border">
                <ol class="breadcrumb mb0 no-padding">
                    <li>
                        <a href="{{route('local.index')}}">Admins</a>
                    </li>
                    <li>
                        <a href="javascript:;">Chart Room</a>
                    </li>
                    <li class="active">Data tables</li>
                </ol>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered" style="border: none;background: inherit">
                        <tbody style="border: none; ">
                        @if($users)
                            @foreach($users as $user)
                                @if(($user->text))
                                    <tr style="border: none">
                                        <td class="pull-left" style="border: none">
                                            <div class="animated bounceInRight fadeInUp" style="border-radius: 1px 70px  70px 10px;background:white;color:black;font-family: sans-serif; font-weight:bold;padding: 10px;">
                                            <span>
                                                <p>
                                                 <img src="{{Auth::user()->photo? Auth::user()->photo->file:asset('images/logo 2.png')}}" class="header-avatar img-circle ml10" alt="user" title="user" height="40" width="40">
                                                  {{$user->created_at->diffForHumans() }}
                                                </p>
                                            </span>
                                                <span>
                                                <p style="padding:0 20px; margin:0px">
                                                   {{$user->text}}
                                                </p>
                                            </span>

                                            </div>
                                        </td>
                                        @else
                                        @endif
                                        @if(($user->reply))
                                            <td class="pull-left" style="border: none">
                                                <div class="animated bounceInRight fadeInUp" style="border-radius: 70px 0px  0px 70px;background:#dcf8c6;
                                         color:black;font-family: sans-serif; font-weight:bold;padding: 10px;">


                                                <span>
                                                <p>
                                                <img src="{{asset('images/face3.jpg')}}" height="40" width="40" alt="" class="img-circle">
                                                {{$user->updated_at->diffForHumans() }}
                                                </p>
                                            </span>
                                                    <span>

                                                <p style="padding:0 20px; margin:0px">
                                                        {{$user->reply}}
                                                </p>
                                            </span>
                                                </div>
                                            </td>
                                        @else
                                        @endif

                                    </tr>
                                    @endforeach

                                @endif
                        </tbody>

                    </table>

                </div>
                <div class="panel-footer">
                    {!! Form::open(['method'=>'POST','action'=>'National\NationalChartRoomController@store'])!!}
                    {!! Form::hidden('user_id',$user->user_id,['class'=>'form-control input-sm']) !!}
                    {!! Form::hidden('local_id',$user->local_id,['class'=>'form-control input-sm']) !!}
                    {!! Form::hidden('region_id',Auth::user()->region_id,['class'=>'form-control input-sm']) !!}
                    {!! Form::textarea('reply',null,['class'=>'form-control','rows'=>2]) !!}
                    {!! Form::submit('submit',['class'=>'btn  btn-info pull-right']) !!}

                </div>
            </div>
        </div>
    </div>
@endsection

