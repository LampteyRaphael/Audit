@extends('layouts.master_table')

@section('dashboard')

    <h4>Search Region</h4>

@endsection

@section('content')

    @if($regions)
        <div class="panel">
            <a href="{{route('region.index')}}" class="">Back</a>
            <div class="panel-body">
                <table class="table" style="color: darkblue; font-family: initial; font-size: 15px;">
                    <thead>
                    <tr>
                        <th>Region</th>
                        <th>Create at</th>
                        <th>Update at</th>
                        <th>Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($regions as $region)
                        <tr>
                            <td><a href="{{route('region.show',$region->id)}}">{{$region->name}}</a></td>
                            <td>{{$region->created_at->diffForHumans()}}</td>
                            <td>{{$region->updated_at->diffForHumans()}}</td>
                            {{--<td><a href="" class="btn btn-info btn-sm"><span class="fa fa-edit"></span></a></td>--}}
                            <td><a href="{{route('region.edit',$region->id)}}">Show more details</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    @endif


@endsection