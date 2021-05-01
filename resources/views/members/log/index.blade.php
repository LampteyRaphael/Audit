@extends('layouts.app', ['activePage' => 'error', 'titlePage' => __('Error Trails')])
@section('content')
    @include('includes.alert')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">System Error</h4>
                            <p class="card-category"></p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped mb0">
                        <thead>
                        <tr>
                            <th>The Admin</th>
                            <th>Reasons</th>
                            <th colspan="2">Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($log)

                            @foreach($log as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->details}}</td>
                                    <td>{{$item->created_at}}</td>
                                    <td>{{$item->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <div class="card-footer">
        {{$log->links()}}
    </div>
</div>
</div>
</div>
</div>
</div>




@endsection
