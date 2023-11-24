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
                <a class="btn btn-success " href="/admin/users/list/"><i class="fa fa-times" aria-hidden="true"></i></a>

                <button type="submit" class="btn btn-primary">

                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
            <div class="select-info" style="width: 100%;display: flex;justify-content: space-between ">
                <div class="form-group">
                    <label>Role</label>
                    <select class="select2" name="role" data-placeholder="Any" style="width: 100%; height: 35px; margin: 10px;">
                        <option value="">Choose</option>
                        @foreach($roles as $role)
                            <option value="{{ $role }}" {{ $selectedRole === $role ? 'selected' : '' }}>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
                {{--            //--}}
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date"  value="{{ session('search_criteria.date') ?? '' }}" style="width: 100%; height: 35px; margin: 10px" />
                </div>
                {{--            /--}}
                <div class="form-group">
                    <label>Status</label>
                    <select class="select2" name="statususer" data-placeholder="Any" style="width: 100%; height: 35px; margin: 10px;">
                        <option value="">Choose</option>
                        <option value="0" {{ $selectedstatususer === '0' ? 'selected' : '' }}>Online</option>
                        <option value="1" {{ $selectedstatususer === '1' ? 'selected' : '' }}>Offline</option>
                    </select>
                </div>
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

                            <a class="btn btn-success " href="/admin/users/add/">Insert</a>
                        @endcan
                        <h6>Showing {{ $users->firstItem() }} ~ {{ $users->lastItem() }} out of {{ $users->total() }} users</h6>
                    </div>

{{--<div class="card-body">--}}
{{--    @if(session('active'))--}}
{{--        <div class="alert alert-success" role="alert">--}}
{{--            {{ session('active') }}--}}
{{--        </div>--}}
{{--    @endif--}}
{{--    <?php--}}
{{--        $user = \App\Models\User::whereNotNull('last_login')--}}
{{--            ->orderby('last_login','desc')--}}
{{--            ->get();--}}
{{--        ?>--}}
{{--</div>--}}
        <table class="table">
            <thead>
            <tr>
                <th style="width: 80px">ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Time Login</th>
                <th>Active</th>
                <th>Time Update</th>
                <th>IP</th>
                <th style="width: 150px">&nbsp;Option</th>

            </tr>
            </thead>
{{--            <tbody>--}}
{{--            @foreach($users   as $key => $user)--}}
{{--                <tr>--}}
{{--                    <td>{{ $user->id }}</td>--}}
{{--                    <td>{{ $user->name }}</td>--}}
{{--                    <td>{{ $user->email }}</td>--}}
{{--                    <td>--}}
{{--                        @foreach($user->roles as $role)--}}
{{--                            <span>{{ $role->name }}</span><br>--}}
{{--                        @endforeach--}}
{{--                    </td>--}}
{{--                    <td>{{ \Carbon\Carbon::parse($user->last_login)->diffForHumans()}}</td>--}}
{{--                    <td>@if(Cache::has('user-is-online-' .$user->id))--}}
{{--                            <span class="text-center" style="color:green ">Online</span>--}}
{{--                        @else--}}
{{--                            <span class="text-center" style="color: red">Offline</span>--}}
{{--                    @endif</td>--}}
{{--                    <td>{{ $user->updated_at }}</td>--}}
{{--                    <td>{{ $user->ip_address }}</td>--}}
{{--                    <td>--}}
{{--                        <a class="btn btn-primary btn-sm" href="/admin/users/edit/{{ $user->id }}">--}}
{{--                            <i class="fas fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        <a href="#" class="btn btn-danger btn-sm"--}}
{{--                           onclick="removeRow({{ $user->id }}, '/admin/users/destroy')">--}}
{{--                            <i class="fas fa-trash"></i>--}}
{{--                        </a>--}}
{{--                        @if($user->delete == 1)--}}
{{--                            <a href="{{route('users.delete.update',['$user' => $user->id,])}}"></a>--}}

{{--                        @endif--}}
{{--                    </td>--}}

{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
            <tbody>
            @foreach($users as $key => $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span>{{ $role->name }}</span><br>
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($user->last_login)->diffForHumans()}}</td>
                    <td>
                        @if(Cache::has('user-is-online-' . $user->id))
                            <span class="text-center" style="color: green">Online</span>
                        @else
                            <span class="text-center" style="color: red">Offline</span>
                        @endif
                    </td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->ip_address }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/users/edit/{{ $user->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm" onclick="removeRow({{ $user->id }}, '/admin/users/destroy')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <div class="pagination" >


            {{ $users->appends(request()->all())->links()}}


        </div>
    </div>
@endsection


