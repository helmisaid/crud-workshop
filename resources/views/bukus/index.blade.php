@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tabel Buku</h4>
        <div class="table-responsive pt-3">
          <a href="{{ route('bukus.create') }}" class="btn btn-primary mb-3">Tambah Buku Baru</a>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th> ID </th>
                <th> Kode Buku </th>
                <th> Judul Buku </th>
                <th> Pengarang</th>
                <th> ID Kategori</th>
                <th> Dibuat Pada</th>
                <th> Aksi </th>
              </tr>
            </thead>
            <tbody>
              @foreach($bukus as $buku)
              <tr>
                <td> {{ $buku->idbuku }} </td>
                <td> {{ $buku->kode_buku }} </td>
                <td> {{ $buku->judul_buku }} </td>
                <td> {{ $buku->pengarang }} </td>
                <td> {{ $buku->id_kategori }} </td>
                <td> {{ $buku->created_at ? $buku->created_at->format('M d, Y') : 'Tidak Tersedia' }} </td>
                <td>
                  <a href="{{ route('bukus.edit', $buku->idbuku) }}" class="btn btn-success btn-sm"><i class="ti ti-pencil"></i></a>
                  
                  <form action="{{ route('bukus.destroy', $buku->idbuku) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                      <i class="ti ti-trash"></i>
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
