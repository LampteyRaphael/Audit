@extends ('layouts.master_table')
@section('dashboard')
    <h3 class="page-title">Add New Area</h3>
@endsection

@section('content')

@include('includes.form_error')

    <form action="/admin/area" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="region_id" class="control-label">Region</label>
            <select name="region_id" id="region_id" class="form-control">
                <option  value="0">--Choose Options--</option>
               @if($regions)
                   @foreach($regions as $region)
                        <option value="{{$region->id}}">{{$region->name}}</option>
                   @endforeach
               @endif
            </select>
        </div>
        <div class="form-group">
            <label for="name" class="control-label">Add Area Name</label>
            <input type="text" name="name" value="" class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <input type="submit" name="submit" value="submit" class="btn btn-block btn-info">
        </div>
    </form>

@endsection

