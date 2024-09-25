@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Menu Level</h4>
            <form action="{{ route('menu-levels.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="id_level">ID Level</label>
                    <input type="text" class="form-control" id="id_level" name="id_level" placeholder="Masukkan ID Level" required>
                </div>

                <div class="form-group">
                    <label for="level">Level</label>
                    <input type="text" class="form-control" id="level" name="level" placeholder="Masukkan Level" required>
                </div>

                <div class="form-group">
                    <label for="create_by">Dibuat Oleh</label>
                    <input type="text" class="form-control" id="create_by" name="create_by" placeholder="Masukkan nama pembuat" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
