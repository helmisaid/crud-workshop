@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tabel Kategori</h4>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori Baru</a>
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th> ID Kategori </th>
                <th> Nama Kategori </th>
                <th> Dibuat Pada </th>
                <th> Aksi </th>
              </tr>
            </thead>
            <tbody>
              @foreach($categories as $category)
              <tr>
                <td> {{ $category->id_kategori }} </td>
                <td> {{ $category->nama_kategori }} </td>
                <td> {{ $category->created_at ? $category->created_at->format('M d, Y') : 'Tidak Tersedia' }} </td>
                <td>
                  <a href="{{ route('categories.edit', $category->id_kategori) }}" class="btn btn-success btn-sm"><i class="ti ti-pencil"></i></a>
                  <form action="{{ route('categories.destroy', $category->id_kategori) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')"><i class="ti ti-trash"></i></button>
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
