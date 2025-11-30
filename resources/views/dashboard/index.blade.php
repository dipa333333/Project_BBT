@extends('layouts.app')

@section('content')

<h2 class="text-2xl font-bold mb-4">Dashboard Sistem</h2>

<!-- CARDS -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl shadow">
        <h3 class="text-gray-600">Total Sensor</h3>
        <p class="text-3xl font-bold">{{ $totalSensor }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <h3 class="text-gray-600">Sensor Aktif</h3>
        <p class="text-3xl font-bold text-green-600">{{ $sensorAktif }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <h3 class="text-gray-600">Sensor Non-Aktif</h3>
        <p class="text-3xl font-bold text-red-600">{{ $sensorNonAktif }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <h3 class="text-gray-600">Pemakaian Hari Ini</h3>
        <p class="text-3xl font-bold">{{ $pemakaianHariIni }} L</p>
    </div>

</div>

<!-- GRAFIK -->
<div class="bg-white p-6 rounded-xl shadow">
    <h3 class="text-xl font-bold mb-4">Grafik Pemakaian Mingguan</h3>
    <canvas id="chartAir"></canvas>
</div>

<script>
var ctx = document.getElementById('chartAir').getContext('2d');

var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'Pemakaian (Liter)',
            data: @json($values),
            borderWidth: 3
        }]
    }
});
</script>

@endsection
