@extends ('layouts.master_table')

@section('content')
    <h1 class="page-header">Create Users</h1>
@include('includes.form_error')

    @if(Session::has('area_id'))
        <u>
            <a href="{{route('area.show',(Session::get('area_id')))}}">{{$district->name}}</a>
        </u>
    @endif

    <form action="/admin/users" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" name="name" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="email" class="control-label">Email</label>
            <input type="email" name="email" value="" class="form-control">
        </div>
        <div class="form-group">
            <label for="role_id" class="control-label">Role</label>
            <select name="role_id" id="role_id" class="form-control">
                <option disabled selected value="0">--Choose Role--</option>
                <option value="1">Administrator</option>
                <option value="2">Subscriber</option>
            </select>
        </div>
        <div class="form-group">
            <label for="is_active" class="control-label">Status</label>
            <select name="is_active" id="is_active" class="form-control">
                <option disabled selected value="">Choose Status</option>
                <option value="1">Active</option>
                <option value="0">Not Active</option>
            </select>
        </div>
        <div class="form-group">
            <input type="file" name="photo_id" value="file" class="form-control">
        </div>
        <div class="form-group">
            <label for="password" class="control-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <input type="submit" name="submit" value="submit" class="btn btn-block btn-danger">
    </form>

@endsection

