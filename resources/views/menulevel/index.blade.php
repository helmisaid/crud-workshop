@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tabel Level Menu</h4>
            <a href="{{ route('menu-levels.create') }}" class="btn btn-primary mb-3">Tambah Level Menu Baru</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive pt-3">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Level</th>
                            <th>Nama Level</th>
                            <th>Dibuat Oleh</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menuLevels as $menulevel)
                        <tr>
                            <td>{{ $menulevel->id_level }}</td>
                            <td>{{ $menulevel->level }}</td>
                            <td>{{ $menulevel->create_by }}</td>
                            <td>
                                <a href="{{ route('menu-levels.edit', $menulevel->id_level) }}" class="btn btn-success btn-sm">
                                    <i class="ti-pencil"></i> Edit
                                </a>
                                <form action="{{ route('menu-levels.destroy', $menulevel->id_level) }}" method="POST" style="display:inline-block;" class="delete-form">
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
