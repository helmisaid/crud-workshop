@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Pengguna Baru</h4>
        <!-- Ubah form agar mengarah ke route dan ditangani oleh Laravel -->
        <form action="{{ route('users.store') }}" method="POST" class="forms-sample" id="formSubmit">
          @csrf
          <div class="form-group">
            <label for="nama_user">Nama Pengguna</label>
            <input type="text" class="form-control @error('nama_user') is-invalid @enderror" id="nama_user" name="nama_user" value="{{ old('nama_user') }}" required autofocus>
            @error('nama_user')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="id_jenis_user">Jenis Pengguna</label>
            <select id="id_jenis_user" name="id_jenis_user" required>
                <option value="">Pilih Jenis Pengguna</option>
                @foreach($jenisUsers as $jenisUser)
                    <option value="{{ $jenisUser->id_jenis_user }}">{{ $jenisUser->jenis_user }}</option>
                @endforeach
            </select>
            @error('id_jenis_user')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
          <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Optional">
            @error('no_hp')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="wa">WA</label>
            <input type="text" class="form-control @error('wa') is-invalid @enderror" id="wa" name="wa" value="{{ old('wa') }}" placeholder="Optional">
            @error('wa')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="pin">PIN</label>
            <input type="text" class="form-control @error('pin') is-invalid @enderror" id="pin" name="pin" value="{{ old('pin') }}" placeholder="Optional">
            @error('pin')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary mr-2">Tambah Pengguna</button>
          <a href="{{ route('users.index') }}" class="btn btn-light">Kembali</a>
        </form>
      </div>
    </div>
  </div>
@endsection
