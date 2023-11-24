    @extends('admin.main')
    @section('head')
        <script src="/ckeditor/ckeditor.js">

        </script>
    @endsection
    @section('content')

        <div class="form-search">
            <form action=""  class="form-inline"  style="margin: 20px;">
                <div class="input-group" style="width: 100%;">
                    <input class="form-control" name="key"  value="{{ session('search_criteria.key') ?? '' }}" placeholder="Search..." >
                        <a class="btn btn-success " href="/admin/products/list/"><i class="fa fa-times" aria-hidden="true"></i></a>
{{--                    </button>--}}
                    <button type="submit" class="btn btn-primary">

                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>



                <div class="select-info" style="width: 100%;display: flex;justify-content: space-between ">

                    {{--            //--}}
                    <div class="form-group">
                        <label>Menu</label>
                        <select class="select2" name="menu_id" data-placeholder="Any" style="width: 100%; height: 35px; margin: 10px">
                            <option value="">Choose</option>
                            @foreach($menus as $menu)
                                <option value="{{ $menu->id }}" {{ Request::old('menu_id') == $menu->id ? 'selected' : '' }}>{{ $menu->name }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date"  value="{{ session('search_criteria.date') ?? '' }}" style="width: 100%; height: 35px; margin: 10px" />

                    </div>
                    <div class="form-group">
                        <label>Active</label>
                        <select class="select2" name="actived"  data-placeholder="Any" style="width: 100%; height: 35px; margin: 10px;">
                            <option value="">Choose</option>
                            <option value="0" {{ $selectedActived === '0' ? 'selected' : '' }}>Inactive</option>
                            <option value="1" {{ $selectedActived === '1' ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ $selectedActived === '2' ? 'selected' : '' }}>Deplaying</option>
                        </select>
                    </div>

                    <div class="form-group" style=" justify-content: space-between; width:30%;position: relative; bottom: 3px">
                        <label>Price</label>
                           <div class="input-price" style=" height: 45px;display: flex;  width: 100%">
                               <input style="width: 50%;margin: 5px;" type="number" name="price_min"   value="{{ session('search_criteria.price_min') ?? '' }}" placeholder="Min..."  >
                               <input style="width: 50%;margin: 5px" type="number" name="price_max"  value="{{ session('search_criteria.price_max') ?? '' }}" placeholder="Max..."  >
                           </div>
                    </div>
                </div>
            </form>
            <form action="{{ route('import-protducts') }}" method="POST" enctype="multipart/form-data" style="width: 100%;margin: 10px">
                @csrf
                @can('add product')
                <div class="form">

                    <a class="btn btn-success " href="/admin/products/add/">Insert</a>

                    <button class="btn btn-success">Import</button>
                    <a class="btn btn-success" href="{{ route('export-protducts') }}">Export</a>
                </div>

                <div class="upload" style="width: 100%;display: flex;  justify-content: space-between">
                    <div class="custom-file text-left" style="width: 30%">
                        <input type="file" name="file" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    @endcan
                    <div class="Total_record" style="right:10px;position: relative ">

                        <h6>Showing {{ $products->firstItem() }} ~ {{ $products->lastItem() }} out of {{ $products->total() }} products</h6>
                    </div>
                </div>
            </form>

        <table class="table">
            <thead>
            <tr>
                <th style="width: 80px">@sortablelink('ID')</th>
                <th>@sortablelink('Product')</th>
                <th>@sortablelink('Category')</th>
{{--                <th>@sortablelink('Image')</th>--}}
                <th>@sortablelink('Price')</th>
                <th>@sortablelink('Sale')</th>
                <th>@sortablelink('Active')</th>
                <th>@sortablelink('Update')</th>
                <th style="width: 100px">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $key => $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->menu->name }}</td>
{{--                    <td><img src="{{asset('public/storage/uploads')}}"></td>--}}
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->price_sale }}</td>
                    <td>{!! \App\Helpers\Helper::active($product->active) !!}</td>
                    <td>{{ $product->updated_at}}</td>
                    <td>
                        @can('edit product')
                        <a class="btn btn-primary btn-sm" href="/admin/products/edit/{{ $product->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan
                        @role('Admin')
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow({{ $product->id }}, '/admin/products/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                        @endrole
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


    <div class="pagination" >

        {{ $products->appends(request()->all())->links()}}

    </div>
    </div>
    @endsection


