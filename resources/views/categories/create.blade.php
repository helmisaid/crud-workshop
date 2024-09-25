@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Kategori Baru</h4>
        <form class="forms-sample" action="{{ route('categories.store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="id_kategori">ID Kategori</label>
            <input type="text" class="form-control" id="id_kategori" name="id_kategori" required>
          </div>
          <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Simpan</button>
          <a href="{{ route('categories.index') }}" class="btn btn-light">Kembali</a>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('jspage')
    <script>
      
    </script>
@endsection
