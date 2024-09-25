@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tabel Menu</h4>
            <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Tambah Menu Baru</a>
            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Menu ID</th>
                            <th>Level ID</th>
                            <th>Nama Menu</th>
                            <th>Link Menu</th>
                            <th>Icon Menu</th>
                            <th>Parent ID</th>
                            <th>Created By</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                        <tr>
                            <td>{{ $menu->menu_id }}</td>
                            <td>{{ $menu->level_id }}</td>
                            <td>{{ $menu->menu_name }}</td>
                            <td>{{ $menu->menu_link }}</td>
                            <td><i class="{{ $menu->menu_icon }}"></i> {{ $menu->menu_icon }}</td>
                            <td>{{ $menu->parent_id ? $menu->parent_id : 'Tidak Ada' }}</td>
                            <td>{{ $menu->create_by }}</td>
                            <td>{{ $menu->created_at ? $menu->created_at->format('M d, Y') : 'Tidak Tersedia' }}</td>
                            <td>
                                <a href="{{ route('menus.edit', $menu->menu_id) }}" class="btn btn-success btn-sm">
                                    <i class="ti-pencil"></i> Edit
                                </a>
                                <form action="{{ route('menus.destroy', $menu->menu_id) }}" method="POST" style="display:inline-block;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                        <i class="ti-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jspage')
//
@endsection
