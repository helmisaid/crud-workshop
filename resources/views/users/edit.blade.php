@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Pengguna</h4>
        <!-- Form mengarah langsung ke route update -->
        <form action="{{ route('users.update', $users->id) }}" method="POST" class="forms-sample">
          @csrf
          @method('PUT')
          <input type="hidden" name="user_id" id="user_id" value="{{ $users->id }}">
          
          <!-- Nama Pengguna -->
          <div class="form-group">
            <label for="nama_user">Nama Pengguna</label>
            <input type="text" class="form-control @error('nama_user') is-invalid @enderror" id="nama_user" name="nama_user" value="{{ $users->nama_user }}" required autofocus>
            @error('nama_user')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Username -->
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $users->username }}" required>
            @error('username')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Password -->
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" value="{{ $users->password}}" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kosongkan jika tidak diubah">
            @error('password')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $users->email }}" required>
            @error('email')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- Jenis Pengguna -->
          <div class="form-group">
            <label for="id_jenis_user">Jenis Pengguna</label>
            <select id="id_jenis_user" name="id_jenis_user" class="form-control @error('id_jenis_user') is-invalid @enderror" required>
                <option value="">Pilih Jenis Pengguna</option>
                @foreach($jenisUsers as $jenisUser)
                    <option value="{{ $jenisUser->id_jenis_user }}" {{ $users->id_jenis_user == $jenisUser->id_jenis_user ? 'selected' : '' }}>{{ $jenisUser->jenis_user }}</option>
                @endforeach
            </select>
            @error('id_jenis_user')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- No HP -->
          <div class="form-group">
            <label for="no_hp">No HP</label>
            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" value="{{ $users->no_hp }}" placeholder="Optional">
            @error('no_hp')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- WA -->
          <div class="form-group">
            <label for="wa">WA</label>
            <input type="text" class="form-control @error('wa') is-invalid @enderror" id="wa" name="wa" value="{{ $users->wa }}" placeholder="Optional">
            @error('wa')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>
          
          <!-- PIN -->
          <div class="form-group">
            <label for="pin">PIN</label>
            <input type="text" class="form-control @error('pin') is-invalid @enderror" id="pin" name="pin" value="{{ $users->pin }}" placeholder="Optional">
            @error('pin')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
            @enderror
          </div>

          <!-- Tombol Submit -->
          <button type="submit" class="btn btn-primary mr-2">Simpan Perubahan</button>
          <a href="{{ route('users.index') }}" class="btn btn-light">Kembali</a>
        </form>
      </div>
    </div>
</div>
@endsection
