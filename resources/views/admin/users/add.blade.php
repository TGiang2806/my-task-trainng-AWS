@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')

    <form action="" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="menu">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Enter name...">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"  class="form-control">{{ old('	password') }}</input>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control">{{ old('email') }}</input>
            </div>

            <div class="form-group">
                <label>Active</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked="">
                    <label for="active" class="custom-control-label">Active</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active" >
                    <label for="no_active" class="custom-control-label">Inactive</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="2" type="radio" id="deplay" name="active" >
                    <label for="deplay" class="custom-control-label">Deplaying</label>
                </div>

            </div>
            <div class="form-group">
                <label>Status</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="delete" name="delete" checked="">
                    <label for="delete" class="custom-control-label">Enable</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_delete" name="delete" >
                    <label for="no_delete" class="custom-control-label">Disable</label>
                </div>

            </div>
            <div class="form-group">
                <label for="role">Select Role</label>
                @foreach($roles as $role)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="roles[]" id="{{ $role->id }}" value="{{ $role->name }}"
                            >
                        <label class="form-check-label" for="{{ $role->id }}">{{ $role->name }}</label>
                    </div>
                @endforeach

            </div>
        </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        @csrf
    </form>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
