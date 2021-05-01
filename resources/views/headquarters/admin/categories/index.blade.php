@extends ('layouts.master_table')

@section('content')

    <h1 class="page-header">Categories</h1>

    @include('includes.form_error')

    <div class="col-md-4">

        <form action="/admin/categories" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="control-label">Name</label>
                <input type="text" name="name" value="" class="form-control">
            </div>
            <input type="submit" name="submit" value="submit" class="btn btn-block btn-danger">
        </form>
    </div>

    <div class="col-md-8">
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
            </thead>
            <tbody>
            @if($categories)
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->created_at->diffForHumans() }}</td>
                        <td>{{$category->updated_at->diffForHumans() }}</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@stop