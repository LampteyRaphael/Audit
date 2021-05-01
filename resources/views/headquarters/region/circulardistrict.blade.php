@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">
            Circular From National To District
        </p>
    </li>
@endsection

@section('content')

    @include('includes.form_error')

    @include('includes.alert')

    <div class="row">

        {!! Form::open(['method'=>'POST','action'=>'National\PostCircularForDistrictAdminsController@store','class'=>'modal fadeIn','id'=>'message', 'tabindex'=>'-1','aria-hidden'=>'true','role'=>'dialog'] ) !!}
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">Post Circular</div>
                <div class="modal-body">

                    <div class="form-group">
                        {!! Form::label('name','Messages',['class'=>'control-label']) !!}
                        {!! Form::textarea('name',null,['class'=>'form-control']) !!}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="form-group">
                    {!! Form::button('Close',['class'=>'btn  btn-danger','data-dismiss'=>'modal']) !!}
                    {!! Form::submit('submit',['class'=>'btn  btn-info']) !!}

                </div>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a class="btn-link" href="" data-toggle="modal" data-target="#message">National Circular</a>
                </li>
                <li>
                    <a href="javascript:;">District Circular</a>
                </li>
                <li class="active">Data tables</li>
            </ol>
        </div>
        <div class="panel-body">
            {{--{{$post}}--}}
           <div class="table-responsive">
               @if($post)
                   <table class="table table-bordered mb0">
                       <tbody>
                       @foreach($post as $posts)
                           <tr>
                               <td class="">{{$posts->created_at->format('jS F, Y')}}</td>
                               <td>
                                   {{$posts->name}}
                               </td>
                           </tr>
                       @endforeach
                       </tbody>
                   </table>
               @endif
           </div>
        </div>
    </div>
@endsection

