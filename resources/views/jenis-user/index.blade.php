@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tabel Jenis User</h4>
        <div class="table-responsive pt-3">
          <a href="{{ route('jenis-user.create') }}" class="btn btn-primary mb-3">Tambah Jenis User Baru</a>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th> ID </th>
                <th> Jenis User </th>
                <th> Aksi </th>
              </tr>
            </thead>
            <tbody id="jenis-user-list">
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
        function loadJenisUsers() {
            $.ajax({
                url: 'http://127.0.0.1:8000/api/jenis_users', // URL endpoint API
                type: 'GET',
                success: function(response) {
                    var list = $('#jenis-user-list');
                    list.empty(); // Mengosongkan list sebelumnya
                    $.each(response.data, function(index, data) {
                        // URL edit dan delete
                        var editUrl = '/jenis-user/' + data.id_jenis_user + '/edit';

                        // Membuat row tabel dengan form untuk delete
                        list.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${data.jenis_user}</td>
                                <td>
                                    <a href="${editUrl}" class="btn btn-success btn-sm">
                                        <i class="ti ti-pencil"></i>
                                      </a>
                                    <form action="/jenis-user/${data.id_jenis_user}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                           <i class="ti ti-trash"></i>  
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr) {
                    console.error('Error fetching data:', xhr);
                }
            });
        }

        // Memanggil fungsi loadJenisUsers saat halaman dimuat
        loadJenisUsers();
    });
</script>
@endsection
