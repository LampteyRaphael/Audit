@extends ('layouts.master_table')

@section('dashboard')
    <li>
        <p class="navbar-text">
            The Apostolic Church-Ghana (Districts)
        </p>
    </li>
@endsection
@section('content')
    @include('includes.form_error')
    @include('includes.alert')
    @include('sweet::alert')
  <div class="panel mb25">
          {{--<div class="panel-heading border">--}}
              {{--<ol class="breadcrumb mb0 no-padding">--}}
                  {{--<li>--}}
                      {{--<a class="btn-link" href="{{route('districtPost.index')}}">District</a>--}}
                  {{--</li>--}}
                  {{--<li>--}}
                      {{--<a href="javascript:;">Search</a>--}}
                  {{--</li>--}}
                  {{--<li class="active">Data tables</li>--}}
              {{--</ol>--}}
          {{--</div>--}}
          <div class="panel-body">
              @if($districts)
                  <table class="table table-bordered dataTable">
                      <thead>
                      <tr>
                          <th>District Code</th>
                          <th>Name</th>
                          <th>Created</th>
                          <th>Updated</th>
                      </tr>
                      </thead>
                      <tbody>
                      {{--@foreach($districts as $district)--}}
                          {{--<tr>--}}
                              {{--<td>{{$district->district_code}}</td>--}}
                              {{--<td><a class="btn-link" href="{{route('districtPost.show',$district->id)}}">{{$district->name}}</a></td>--}}
                              {{--<td>{{$district->created_at->diffForHumans()}}</td>--}}
                              {{--<td>{{$district->updated_at->diffForHumans()}}</td>--}}
                          {{--</tr>--}}
                      {{--@endforeach--}}

                      </tbody>
                  </table>
              @endif
          </div>
      </div>
@endsection