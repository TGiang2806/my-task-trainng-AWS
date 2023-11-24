@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')

    <form action="" method="POST">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Name</label>
                        <input type="text" name="name" value="{{ $usercustomer->name }}" class="form-control"  placeholder="Nhập tên KH">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type">
                            <option value="0" @if($usercustomer->type == 0) selected @endif>New</option>
                            <option value="1" @if($usercustomer->type == 1) selected @endif>Regular</option>
                            <option value="2" @if($usercustomer->type == 2) selected @endif>Vip</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" >
                <label>Gender</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="male" name="gender" checked="" {{$usercustomer->gender == 0 ?' checked=""' : '' }}>
                    <label for="male" class="custom-control-label">Male</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="female" name="gender" {{$usercustomer->gender == 1 ?' checked=""' : '' }} >
                    <label for="female" class="custom-control-label">Female</label>
                </div>


            </div>

{{--            <div class="form-group">--}}
{{--                <label>Password</label>--}}
{{--                <input type="password" name="password" class="form-control" value="{{$usercustomer->password}}">--}}
{{--            </div>--}}

            <div class="form-group">
                <label>Phone</label>
                <input type="number" name="phone_number" class="form-control" value="{{ $usercustomer->phone_number }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $usercustomer->email }}">
            </div>

            <div class="form-group">
                <label>Status</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active" checked=""
                        {{ $usercustomer->active == 1 ? ' checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Active</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $usercustomer->active == 0 ? ' checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Inactive</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="2" type="radio" id="deplay" name="active"
                        {{ $usercustomer->active == 2 ? ' checked=""' : '' }}>
                    <label for="deplay" class="custom-control-label">Deplaying</label>
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
