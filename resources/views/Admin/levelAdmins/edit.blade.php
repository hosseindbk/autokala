@extends('Admin.admin')

@section('script')
    <script>
        $(document).ready(function () {
            $('#role_id').selectpicker();
        })
    </script>
@endsection


@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div class="page-header head-section">
            <h2>ویرایش مقام</h2>
        </div>
        @foreach($user as $user)
        <form class="form-horizontal" action="{{ route('levelAdmins.update' ,  $user->id) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <div class="col-sm-12">
                    <label for="role_id" class="control-label"> مقام ها - {{ $user->email }}</label>
                    <select class="form-control" name="role_id" id="role_id">
                        @foreach(\App\Role::all() as $role)
                            <option value="{{ $role->id }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }} - {{ $role->label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-danger">ارسال</button>
                </div>
            </div>
        </form>
        @endforeach
    </div>
@endsection
