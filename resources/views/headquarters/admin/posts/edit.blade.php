@extends ('layouts.master_table')
@section('content')
    <h1 class="page-header">Post Edit</h1>
    @include('includes.form_error')

        {!! Form::open(['method'=>'PUT','action'=>['National\AdminPostsController@store',$posts->id]] ) !!}

        <input type="hidden" name="_method" value="PATCH">
        <div class="form-group">
            <label for="title" class="control-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{$posts->title}}">
        </div>
        <div class="form-group">
            <label for="category_id" class="control-label">Category</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="{{$posts->category_id}}">{{$posts->category->name}}</option>
                <option value="1">PHP</option>
                <option value="2">Javascript</option>
            </select>
        </div>
        <div class="form-group">
            <label for="photo_id" class="control-label">Photo:</label>
            <input type="file" name="photo_id" id="photo_id" class="form-control">
        </div>
        <div class="form-group">
            <label for="body" class="control-label">Description</label>
            <textarea name="body" id="body" class="form-control" rows="3">{{trim($posts->body)}}</textarea>
        </div>
        <div class="form-group col-lg-6">
            <input type="submit" name="submit" value="Edit Post" class="btn btn-block btn-primary">
        </div>

   {!! Form::close() !!}
    <div class="form-group col-lg-6">
        {!! Form::open(['method'=>'DELETE','action'=>['National\AdminPostsController@store',$posts->id]] ) !!}
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="delete" class="btn btn-block btn-danger">
       {!! Form::close() !!}
    </div>
@stop