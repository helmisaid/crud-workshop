@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Menu Level</h4>
            <form action="{{ route('menu-levels.update', $menuLevel->id_level) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="id_level">ID Level:</label>
                    <input type="text" class="form-control" id="id_level" name="id_level" value="{{ old('id_level', $menuLevel->id_level) }}" readonly>
                </div>

                <div class="form-group">
                    <label for="level">Nama Level:</label>
                    <input type="text" class="form-control" id="level" name="level" value="{{ old('level', $menuLevel->level) }}" required>
                </div>

                <div class="form-group">
                    <label for="create_by">Dibuat Oleh:</label>
                    <input type="text" class="form-control" id="create_by" name="create_by" value="{{ old('create_by', $menuLevel->create_by) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('menu-levels.index') }}" class="btn btn-light">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
