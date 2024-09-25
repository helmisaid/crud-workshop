@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Menu</h4>
            <form action="{{ route('menus.update', $menu->menu_id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="menu_name">Nama Menu:</label>
                    <input type="text" class="form-control" id="menu_name" name="menu_name" value="{{ $menu->menu_name }}" required>
                </div>

                <div class="form-group">
                    <label for="menu_link">Link Menu:</label>
                    <input type="text" class="form-control" id="menu_link" name="menu_link" value="{{ $menu->menu_link }}" required>
                </div>

                <div class="form-group">
                    <label for="menu_icon">Icon Menu:</label>
                    <input type="text" class="form-control" id="menu_icon" name="menu_icon" value="{{ $menu->menu_icon }}" required>
                </div>

                <div class="form-group">
                    <label for="level_id">Level ID:</label>
                    <select class="form-control" id="level_id" name="level_id" required>
                        <option value="" disabled>Pilih Level ID</option>
                        @foreach($menuLevels as $level)
                            <option value="{{ $level->id_level }}">
                                {{ $level->level }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="parent_id">Parent ID:</label>
                    <input type="text" class="form-control" id="parent_id" name="parent_id" value="{{ $menu->parent_id }}" required>
                </div>

                <div class="form-group">
                    <label for="create_by">Dibuat Oleh:</label>
                    <input type="text" class="form-control" id="create_by" name="create_by" value="{{ $menu->create_by }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
