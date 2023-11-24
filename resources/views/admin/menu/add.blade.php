@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Name category</label>
                <input type="text" name="name" class="form-control" id="menu" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label >Category</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Parent</option>
                    @foreach($menus as $menu)
                        <option value="{{$menu->id }}">{{$menu->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label > Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label > Detailed Description</label>
                <textarea name="content" id="content" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>Status</label>

                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="active" value="1" name="active" checked="">
                        <label for="active" class="custom-control-label">Active</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="no_active" value="0" name="active">
                        <label for="no_active" class="custom-control-label">Inactive</label>
                    </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="2" type="radio" id="deplay"
                           name="active" >
                    <label for="deplay" class="custom-control-label">Deplaying</label>
                </div>

            </div>

        </div>
        <!-- /.card-body -->

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
