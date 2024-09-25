@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Menu Baru</h4>
            <form action="{{ route('menus.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="menu_name">Nama Menu:</label>
                    <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="Masukkan Nama Menu" required>
                </div>

                <div class="form-group">
                    <label for="menu_link">Link Menu:</label>
                    <input type="text" class="form-control" id="menu_link" name="menu_link" placeholder="Masukkan Link Menu" required>
                </div>

                <div class="form-group">
                    <label for="menu_icon">Icon Menu:</label>
                    <input type="text" class="form-control" id="menu_icon" name="menu_icon" placeholder="Masukkan Icon Menu" required>
                </div>

                <div class="form-group">
                    <label for="level_id">Level ID:</label>
                    <select class="form-control" id="level_id" name="level_id" required>
                        <option value="" disabled selected>Pilih Level ID</option>
                        @foreach($menuLevels as $level)
                            <option value="{{ $level->id_level }}">{{ $level->level }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent ID:</label>
                    <select class="form-control" id="parent_id" name="parent_id">
                        <option value="">Tidak Ada</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->parent_id }}">{{ $menu->menu_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="create_by">Dibuat Oleh:</label>
                    <input type="text" class="form-control" id="create_by" name="create_by" placeholder="Masukkan nama pembuat" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
