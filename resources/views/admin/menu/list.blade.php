@extends('admin.main')


@section('content')
   <table class="table">
       <thead>
       <tr>
           <th style="width: 50px">Id</th>
           <th>Name</th>
           <th>Active</th>
           <th>Update</th>
           <th style="width: 100px">Option</th>

       </tr>
       </thead>

        <tbody>

        @foreach($menus as $key =>$menu)
            <tr>
                <td>{{ $menu->id }}</td>
                <td>{{ $menu->name }}</td>
                <td>{!! \App\Helpers\Helper::active($menu->active) !!}</td>
                <td>{{ $menu->updated_at}}</td>
                <td>
                    @can('edit product')
                        <a class="btn btn-primary btn-sm" href="/admin/menus/edit/{{ $menu->id }}">
                            <i class="fas fa-edit"></i>
                        </a>
                    @endcan
                    @role('Admin')
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $menu ->id }}, '/admin/menus/destroy')">
                        <i class="fas fa-trash"></i>
                    </a>
                    @endrole
                </td>
            </tr>
        @endforeach
        </tbody>
   </table>
@endsection

