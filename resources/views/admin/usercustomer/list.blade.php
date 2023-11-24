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
                <a class="btn btn-success " href="/admin/usercustomers/list/"><i class="fa fa-times" aria-hidden="true"></i></a>

                <button type="submit" class="btn btn-primary">

                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>



            <div class="select-info" style="width: 100%;display: flex;justify-content: space-between ">

                {{--            //--}}
                <div class="form-group">
                    <label>Type</label>
                    <select class="select2" name="type" data-placeholder="Any" style="width: 100%; height: 35px; margin: 10px;">
                        <option value="">Choose</option>
                        <option value="0" {{ $selectedType === '0' ? 'selected' : '' }}>New</option>
                        <option value="1" {{ $selectedType === '1' ? 'selected' : '' }}>Regular</option>
                        <option value="2" {{ $selectedType === '2' ? 'selected' : '' }}>Vip</option>
                    </select>
                </div>


                {{--            //--}}
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date"  value="{{ session('search_criteria.date') ?? '' }}" style="width: 100%; height: 35px; margin: 10px" />

                </div>
                {{--            /--}}
                <div class="form-group">
                    <label>Active</label>
                    <select class="select2" name="actived"  data-placeholder="Any" style="width: 100%; height: 35px; margin: 10px;">
                        <option value="">Choose</option>
                        <option value="0" {{ $selectedActived === '0' ? 'selected' : '' }}>Inactive</option>
                        <option value="1" {{ $selectedActived === '1' ? 'selected' : '' }}>Active</option>
                        <option value="2" {{ $selectedActived === '2' ? 'selected' : '' }}>Deplaying</option>
                    </select>
                </div>

                {{--                //--}}
                <div class="form-group" style=" justify-content: space-between; width:30%;position: relative; bottom: 3px">
                    <label>Phone</label>
                    <div class="input-price" style=" height: 45px;display: flex;  width: 100%">
                        <input style="width: 50%;margin: 5px;" type="text" name="phone"   value="{{ session('search_criteria.phone') ?? '' }}" placeholder="Phone..."  >
                    </div>
                </div>

                {{--                //--}}
                <div class="btn-filter" style="margin: 10px">
                    <br/>
                    <button type="submit" class="btn btn-primary" >
                        <i class="fa fa-filter" aria-hidden="true"></i>
                    </button>

                </div>
            </div>
        </form>
        <div class="Total_record" style="margin: 0 10px;justify-content: space-between ;position: relative;display: flex">
            @can('add product')

                <a class="btn btn-success " href="/admin/usercustomers/add/">Insert</a>



            @endcan
            <h6>    Showing{{ $usercustomers->firstItem() }} ~ {{ $usercustomers->lastItem() }} out of{{ $usercustomers->total() }} customer</h6>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th style="width: 80px">@sortablelink('ID')</th>
                <th>@sortablelink('Name')</th>
                <th>@sortablelink('Gender')</th>
                <th>@sortablelink('Email')</th>
                <th>@sortablelink('Group')</th>
                <th>@sortablelink('Phone')</th>
                <th>@sortablelink('Active')</th>
                <th>@sortablelink('Time Login')</th>
                <th style="width: 150px">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usercustomers   as $key => $usercustomer)
                <tr>
                    <td>{{ $usercustomer->id }}</td>
                    <td>{{ $usercustomer->name }}</td>
                    <td>{!! \App\Helpers\Helper::gender($usercustomer->gender) !!}</td>
                    <td>{{ $usercustomer->email }}</td>
                    <td>{!! \App\Helpers\Helper::type($usercustomer->type) !!}</td>
                    <td>{{ $usercustomer->phone_number }}</td>
                    <td>{!! \App\Helpers\Helper::active($usercustomer->active) !!}</td>
                    <td>{{ $usercustomer->updated_at }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/usercustomers/edit/{{ $usercustomer->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow({{ $usercustomer->id }}, '/admin/usercustomers/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                           onclick="removeRow({{ $usercustomer->id }}, '/admin/usercustomers/destroy')">
                            <i class="fa fa-ban" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <div class="pagination" >

            {{ $usercustomers->appends(request()->all())->links()}}

        </div>
    </div>
@endsection


