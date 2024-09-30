@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        <h4>Weather Forecast</h4>

        <!-- Table to display weather data -->
        <div class="mt-3">
            <table id="tabel-cuaca">
                <thead>
                  <tr>
                    <th>Datetime</th>
                    <th>Cuaca</th>
                    <th>Suhu (°C)</th>
                    <th>Kelembaban (%)</th>
                  </tr>
                </thead>
                <tbody id="tabel-cuaca-body">
                </tbody>
              </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            type: 'GET',
            url: 'https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=35.78.08.1003',
            dataType: 'json',
            success: function(data) {
                console.log(data); // Debugging: Check the structure of the data
                var cuaca = data.data[0].cuaca;
                $.each(cuaca, function(index, value) {
                    $.each(value, function(i, cuacaDetail) {
                        $('#tabel-cuaca-body').append(`
                            <tr>
                                <td>${cuacaDetail.datetime}</td>
                                <td>${cuacaDetail.weather_desc}</td>
                                <td>${cuacaDetail.t}°C</td>
                                <td>${cuacaDetail.hu}%</td>
                            </tr>
                        `);
                    });
                });
            },
            error: function(xhr, status, error) {
                console.log('Error: ' + error);
            }
        });
    });
</script>
@endsection
