@extends ('layouts.master_table')

@section('content')

<h1 class="page-header">Posts</h1>

<table class="table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>User</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created</th>
        <th>Updated</th>
    </tr>
    </thead>
    <tbody>
    @if($posts)
        @foreach($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td><img height="50" src="{{$user->photo? $user->photo->file :asset('images/placeholder.png'}}" alt=""></td>
                <td><a href="{{route("posts.edit",$post->id)}}">{{$post->user? $post->user->name:"no name"}}</a></td>
                <td>{{$post->category->name}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
                <td>{{$post->created_at->diffForHumans() }}</td>
                <td>{{$post->updated_at->diffForHumans() }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

@stop





