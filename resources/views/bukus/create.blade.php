@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Buku Baru</h4>
        <form class="forms-sample" action="{{ route('bukus.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="kode_buku">Kode Buku</label>
            <input type="text" class="form-control" id="kode_buku" name="kode_buku" placeholder="Masukkan Kode Buku" required>
          </div>
          <div class="form-group">
            <label for="judul_buku">Judul Buku</label>
            <input type="text" class="form-control" id="judul_buku" name="judul_buku" placeholder="Masukkan Judul Buku" required>
          </div>
          <div class="form-group">
            <label for="pengarang">Pengarang</label>
            <input type="text" class="form-control" id="pengarang" name="pengarang" placeholder="Masukkan Nama Pengarang" required>
          </div>
          <div class="form-group">
            <label for="id_kategori">Kategori</label>
            <select class="form-control" id="id_kategori" name="id_kategori" required>
              <option value="">Pilih Kategori</option>
              @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Tambah Buku</button>
          <button class="btn btn-light">Batal</button>
        </form>
      </div>
    </div>
</div>
@endsection


