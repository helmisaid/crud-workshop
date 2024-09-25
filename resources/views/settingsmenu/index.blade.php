@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Setting Menu User</h4>
            <a href="{{ route('settingmenuuser.create') }}" class="btn btn-primary mb-3">Tambah Setting Menu User</a>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No Setting</th>
                            <th>Jenis User</th>
                            <th>Menu</th>
                            <th>Dibuat Oleh</th>
                            <th>Dibuat Pada</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($settings as $settingMenuUser)
                        <tr>
                            <td>{{ $settingMenuUser->no_setting }}</td>
                            <td>{{ $settingMenuUser->jenisUser->jenis_user }}</td>
                            <td>{{ $settingMenuUser->menu->menu_name }}</td>
                            <td>{{ $settingMenuUser->create_by }}</td>
                            <td>{{ $settingMenuUser->created_at ? $settingMenuUser->created_at->format('M d, Y') : 'Tidak Tersedia' }}</td>
                            <td>
                                <a href="{{ route('settingmenuuser.edit', $settingMenuUser->no_setting) }}" class="btn btn-success btn-sm">
                                    <i class="ti-pencil"></i> Edit
                                </a>
                                
                                <form action="{{ route('settingmenuuser.destroy', $settingMenuUser->no_setting) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                        <i class="ti-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{-- <div class="d-flex justify-content-center mt-3">
                {{ $settings->links() }}
            </div> --}}
        </div>
    </div>
</div>
@endsection
