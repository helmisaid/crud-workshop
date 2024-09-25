@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tabel Pengguna</h4>
            <div class="table-responsive pt-3">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Tambah Pengguna Baru</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Nama Pengguna </th>
                            <th> Username </th>
                            <th> Email </th>
                            <th> No HP </th>
                            <th> WA </th>
                            <th> PIN </th>
                            <th> Jenis Pengguna </th>
                            <th> Aksi </th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        <!-- Data user akan dimuat oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('jspage')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function() {
    // Fungsi untuk memuat data pengguna
    function loadUsers() {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/users',
            type: 'GET',
            success: function(response) {
                var usersTableBody = $('#users-table-body');
                usersTableBody.empty();
                $.each(response.data, function(index, user) {
                    usersTableBody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${user.nama_user}</td>
                            <td>${user.username}</td>
                            <td>${user.email}</td>
                            <td>${user.no_hp}</td>
                            <td>${user.wa}</td>
                            <td>${user.pin}</td>
                            <td>${user.id_jenis_user}</td>
                            <td>
                                <a href="/users/${user.id}/edit" class="btn btn-warning btn-edit btn-sm" data-id="${user.id}">
                                    <i class="ti ti-pencil"></i>
                                </a>
                                <form action="/users/${user.id}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger delete-btn btn-sm">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                alert('Error loading users: ' + error);
            }
        });
    }

    // Memanggil fungsi untuk memuat data pengguna
    loadUsers();
});

</script>
@endsection
