@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Setting Menu User</h4>
            <form action="{{ route('settingmenuuser.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="no_setting">No Setting</label>
                    <input type="text" class="form-control" id="no_setting" name="no_setting" placeholder="Masukkan No Setting" required>
                </div>

                <div class="form-group">
                    <label for="id_jenis_user">Jenis User</label>
                    <select class="form-control" id="id_jenis_user" name="id_jenis_user" required>
                        
                        @foreach($JenisUsers as $jenisUser)
                            <option value="{{ $jenisUser->id_jenis_user }}">{{ $jenisUser->jenis_user }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="menu_id">Menu</label>
                    <select class="form-control" id="menu_id" name="menu_id" required>
                        <option value="" disabled selected>Pilih Menu</option>
                        @foreach($menus as $menu)
                            <option value="{{ $menu->menu_id }}">{{ $menu->menu_name }}</option>
                        @endforeach
                    </select>
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
