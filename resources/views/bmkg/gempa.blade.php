@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Latest Earthquake Information</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Coordinates</th>
                <th>Magnitude</th>
                <th>Depth</th>
                <th>Region</th>
                <th>Tsunami Potential</th>
            </tr>
        </thead>
        <tbody id="earthquake-table">
            <!-- Data will be appended here -->
        </tbody>
    </table>
</div>
@endsection

@section('jspage')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
    // Fungsi untuk memuat data gempa
    function loadEarthquakes() {
        $.ajax({
            url: 'https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const gempa = data.Infogempa.gempa; // Akses data gempa
                const tbody = $('#earthquake-table');
                tbody.empty(); // Kosongkan tabel sebelum mengisi data baru

                // Buat baris baru untuk data gempa
                const row = `
                    <tr>
                        <td>${gempa.Tanggal}</td>
                        <td>${gempa.Jam}</td>
                        <td>${gempa.Coordinates}</td>
                        <td>${gempa.Magnitude}</td>
                        <td>${gempa.Kedalaman}</td>
                        <td>${gempa.Wilayah}</td>
                        <td>${gempa.Potensi}</td>
                    </tr>
                `;
                tbody.append(row); // Tambahkan baris ke tabel
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Panggil fungsi loadEarthquakes ketika halaman selesai dimuat
    loadEarthquakes();
});

</script>
@endsection




