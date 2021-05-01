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


    <div class="col-md-10 col-md-offset-1">

        <div class="shadow widget bg-white">

            {!! Form::open(['method'=>'POST','action'=>'Locals\TextFieldController@store'])!!}
            <div class="form-group">
                {!! Form::hidden('user_id',Auth::user()->id,['class'=>'form-control input-sm']) !!}
                {!! Form::hidden('local_id',Auth::user()->local_id,['class'=>'form-control input-sm']) !!}
                {!! Form::textarea('text',null,['class'=>'form-control','rows'=>5]) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('submit',['class'=>'btn  btn-info pull-right']) !!}
            </div>

        </div>

    </div>

    <div class="col-md-10 col-md-offset-1">
        <table class="table shadow">
            <tbody>
            @if($users)
                @foreach($users as $user)
                    @if(($user->text))
                        <tr>
                            <td class="text-left">
                                <div>
                                    <span>
                                        <p>
                                         <img src="{{$user->photo? $user->photo->file:""}}" class="header-avatar img-circle ml10" alt="user" title="user" height="40" width="40">
                                          {{$user->created_at->diffForHumans() }}
                                        </p>
                                    </span>
                                    <span>
                                        <p>
                                           {{$user->text}}
                                        </p>
                                     </span>
                                </div>
                            </td>
                            @else
                            @endif
                            @if(($user->reply))
                                <td class="text-right">
                                    <div class="text-right">
                                        <span>
                                            <p class="text-right">
                                            <img src="{{asset('images/face3.jpg')}}" height="40" width="40" alt="" class="img-circle pull-right">
                                            {{$user->updated_at->diffForHumans() }}
                                            </p>
                                            </span>
                                        <span class="text-right">
                                            <p class="pull-right">
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

@endsection

