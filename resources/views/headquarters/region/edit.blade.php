@extends ('layouts.master_table')

@section('content')
 @include('includes.alert')
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
<div class="col-md-6 col-md-offset-3">
    <div class="panel mb25">
        <div class="panel-heading border">
            <ol class="breadcrumb mb0 no-padding">
                <li>
                    <a href="javascript:;">Edit region</a>
                </li>
            </ol>
        </div>
        <div class="panel-body">
                @include('includes.form_error')
                <form action="/admin/region/{{$regions->id}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PATCH">
                    <div class="form-group">
                        <label for="name" class="control-label">Name</label>
                        <input type="text" name="name" value="{{$regions->name}}" class="form-control">
                    </div>

                    <div class="form-group col-lg-6">
                        <button type="submit" name="submit"  class="btn btn-info btn-block">Update Region</button>
                    </div>
                </form>

                <div class="form-group col-lg-6">
                    <form action="/admin/region/{{$regions->id}}" method="post" onsubmit ="return ConfirmDelete()">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" name="submit" class="btn btn-danger btn-block">Delete Region</button>
                    </form>
                </div>
            </div>
        </div>
</div>


@endsection

