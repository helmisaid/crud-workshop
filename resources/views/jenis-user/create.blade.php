@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Buat Jenis User</h4>
            <form id="create-jenis-user-form" class="forms-sample" method="POST" action="{{ route('jenis-user.store') }}">
                @csrf
                <div class="form-group">
                    <label for="jenis_user">Jenis User:</label>
                    <input type="text" class="form-control @error('jenis_user') is-invalid @enderror" id="jenis_user" name="jenis_user" required autofocus>
                    <span class="invalid-feedback" role="alert" id="error-jenis_user"></span>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                <a href="{{ route('jenis-user.index') }}" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection

@section('jspage')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Tambahkan logika jika diperlukan untuk menangani pengiriman form dengan AJAX di sini
</script>
@endsection
