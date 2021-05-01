@extends ('layouts.master_table')
@section('content')
<h1>Edit Users</h1>
<div class="col-sm-4">
    <img height="200" width="200" src="{{$user->photo? $user->photo->file :''}}" alt="">
</div>
<div class="col-sm-8">
    @include('includes.form_error')
    <form action="/admin/users/{{$user->id}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" name="name" value="{{$user->name}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="text" name="email" value="{{$user->email}}" class="form-control">
        </div>
        <div class="form-group">
            <label for="role_id" class="control-label">Role</label>
            <select name="role_id" id="role_id" class="form-control">
                <option value="{{$user->role_id}}">{{$user->role->name}}</option>
                @if($roles)
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="is_active" class="control-label">Status</label>
            <select name="is_active" id="is_active" class="form-control">
                <option value="1">Active</option>
                <option value="0">Not Active</option>
            </select>
        </div>
        <div class="form-group">
            <input type="file" name="photo_id" value="file" class="form-control">
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input type="password" name="password" value="" class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <input type="submit" name="submit" value="submit" class="btn btn-block btn-info">
        </div>
    </form>
    <div class="form-group col-lg-6">
        <form action="/admin/users/{{$user->id}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">
            <input type="submit" name="submit" value="delete" class="btn btn-block btn-danger">
        </form>
    </div>

</div>
@endsection

