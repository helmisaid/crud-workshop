@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Buku</h4>
        <form class="forms-sample" action="{{ route('bukus.update', $buku->idbuku) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="kode_buku">Kode Buku</label>
            <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="{{ $buku->kode_buku }}" required>
          </div>
          <div class="form-group">
            <label for="judul_buku">Judul Buku</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" value="{{ $buku->judul_buku }}" required>
          </div>
          <div class="form-group">
            <label for="pengarang">Pengarang</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" value="{{ $buku->pengarang }}" required>
          </div>
          <div class="form-group">
            <label for="id_kategori">ID Kategori</label>
            <input type="text" class="form-control" id="id_kategori" name="id_kategori" value="{{ $buku->id_kategori }}" required>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Simpan</button>
          <a href="{{ route('bukus.index') }}" class="btn btn-light">Kembali</a>
        </form>
      </div>
    </div>
  </div>
@endsection
