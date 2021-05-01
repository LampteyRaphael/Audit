@extends ('layouts.master_table')
@section('dashboard')
    <li>
        <p class="navbar-text">MEMBERSHIP DATA</p>
    </li>
@endsection

@section('content')
    <script>

        function ConfirmDelete()
        {
            var x = confirm("Are you sure you want to delete?");
            if (x)
                return true;
            else
                return false;
        }

        function ConfirmUpdate()
        {
            var x = confirm("Are you sure you want to update?");
            if (x)
                return true;
            else
                return false;
        }
    </script>
    <div class="row">
        @include('includes.form_error')
        {!! Form::model($user,['method'=>'PATCH','action'=>['National\AdminCategoriesController@update',$user->id],'files'=>true,'onsubmit' => 'return ConfirmUpdate()'],['class'=>'form-inline'])!!}

        @include('includes.national.national_head')
        @include('includes.updateFolders.personal')
        @include('includes.updateFolders.contact')
        @include('includes.updateFolders.educationProfession')
        @include('includes.updateFolders.churchDetails')
        @include('includes.updateFolders.provisionServices')
        @include('includes.national.searchUpdate')
    </div>
    @include('includes.national_js')
@endsection

