@extends('admin.main')

@section('head')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
    <form action="" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="menu">Tên danh mục</label>
                <input type="text" name="name" value="{{ $menu->name }}" class="form-control" id="menu" placeholder="Enter name">
            </div>

            <div class="form-group">
                <label >Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0" {{$menu->parent_id == 0 ? 'selected':''}}>Parent</option>
                    @foreach($menus as $menuParent)
                        <option value="{{$menuParent->id }}"
                            {{$menu->parent_id == $menuParent->id ? 'selected':''}}>
                            {{$menuParent->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label > Mô Tả</label>
                <textarea name="description" class="form-control">{{$menu->description}}</textarea>
            </div>

            <div class="form-group">
                <label > Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{$menu->content}}</textarea>
            </div>
            <div class="form-group">
                <label>Kích Hoạt</label>

                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="active" value="1"
{{--                    /// so sánh nếu menu checked = 1 thì check không thì bỏ trống--}}
                           name="active" {{ $menu->active == 1 ? 'checked=""' : '' }}>
                    <label for="active" class="custom-control-label">Đang hoạt động</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" type="radio" id="no_active" value="0"
{{--                    /// so sánh nếu menu checked = 0 thì check không thì bỏ trống--}}
                           name="active" {{ $menu->active == 0 ? 'checked=""' : '' }}>
                    <label for="no_active" class="custom-control-label">Ngưng hoạt động</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="2" type="radio" id="deplay"
                           name="active" {{ $menu->active == 2 ? 'checked=""' : '' }}>
                    <label for="deplay" class="custom-control-label">Đang trì hoãn</label>
                </div>


            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Cập nhật menu</button>
        </div>
        @csrf
    </form>
@endsection
@section('footer')
    <script>

        CKEDITOR.replace('content');
    </script>
@endsection
