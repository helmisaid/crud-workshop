@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Kategori</h4>
        <form class="forms-sample" action="{{ route('categories.update', $category->id_kategori) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="nama_kategori">Nama Kategori</label>
            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="{{ $category->nama_kategori }}" required>
          </div>
          <button type="submit" class="btn btn-primary mr-2">Simpan</button>
          <a href="{{ route('categories.index') }}" class="btn btn-light">Kembali</a>
        </form>
      </div>
    </div>
  </div>
@endsection
