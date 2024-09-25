@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Jenis User</h4>
        <!-- Form untuk mengedit jenis user -->
        <form action="{{ route('jenis-user.update', $jenisUser->id_jenis_user) }}" method="POST" class="forms-sample">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="jenis_user">Jenis Pengguna</label>
            <input type="text" class="form-control @error('jenis_user') is-invalid @enderror" id="jenis_user" name="jenis_user" value="{{ old('jenis_user', $jenisUser->jenis_user) }}" required autofocus>
            @error('jenis_user')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
          <a href="{{ route('jenis-user.index') }}" class="btn btn-light">Kembali</a>
        </form>
      </div>
    </div>
</div>
@endsection
