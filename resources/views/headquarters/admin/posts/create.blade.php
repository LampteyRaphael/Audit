@extends ('layouts.master_table')
@section('content')
    <h1 class="page-header">Create Post</h1>
    @include('includes.form_error')
        {!! Form::open(['method'=>'POST','action'=>'National\AdminPostsController@index'])!!}

        <div class="form-group">
            <label for="title" class="control-label">Title</label>
            <input type="text" name="title" id="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="category_id" class="control-label">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="1">PHP</option>
            </select>
        </div>
        <div class="form-group">
            <label for="photo_id" class="control-label">Photo:</label>
            <input type="file" name="photo_id" id="photo_id" class="form-control">
        </div>
        <div class="form-group">
            <label for="body" class="control-label">Description</label>
            <textarea name="body" id="body" class="form-control" rows="3"></textarea>
        </div>

        <input type="submit" name="submit" value="Create Post" class="btn btn-primary">

    {!! Form::close() !!}



@stop