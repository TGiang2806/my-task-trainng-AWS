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
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control"  placeholder="Enter name...">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type">

                            <option value="">Choose</option>
                            <option value="0" >New</option>
                            <option value="1" >Regular</option>
                            <option value="2" >Vip</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group" >
                <label>Gender</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="male" name="gender" checked="">
                    <label for="male" class="custom-control-label">Male</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="female" name="gender" >
                    <label for="female" class="custom-control-label">Female</label>
                </div>


            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password"  class="form-control">{{ old('	password') }}</input>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="number" name="phone_number" class="form-control">{{ old('phone_number') }}</input>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" id="email" class="form-control">{{ old('email') }}</input>
            </div>

            <div class="form-group">
                <label>Status</label>
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
