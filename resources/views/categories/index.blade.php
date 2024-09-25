@extends('layouts.app')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tabel Kategori</h4>
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Tambah Kategori Baru</a>
        <div class="table-responsive pt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th> ID Kategori </th>
                <th> Nama Kategori </th>
                <th> Dibuat Pada </th>
                <th> Aksi </th>
              </tr>
            </thead>
            <tbody id="categories-table-body">
                <!-- Data kategori akan dimuat oleh JavaScript -->
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
    // Fungsi untuk memuat data kategori
    function loadCategories() {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/categories',
            type: 'GET',
            success: function(response) {
                var categoriesTableBody = $('#categories-table-body');
                categoriesTableBody.empty();
                $.each(response.data, function(index, category) {
                    categoriesTableBody.append(`
                        <tr>
                            <td>${category.id_kategori}</td>
                            <td>${category.nama_kategori}</td>
                            <td>${category.created_at ? category.created_at : 'Tidak Tersedia'}</td>
                            <td>
                                <a href="/categories/${category.id_kategori}/edit" class="btn btn-success btn-sm">
                                    <i class="ti ti-pencil"></i>
                                </a>
                                <form action="/categories/${category.id_kategori}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    `);
                });
            },
            error: function(xhr, status, error) {
                alert('Error loading categories: ' + error);
            }
        });
    }

    // Memanggil fungsi untuk memuat data kategori
    loadCategories();
});

</script>
@endsection
