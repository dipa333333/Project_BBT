@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-blue-700">Dashboard Sistem (Live Monitor)</h2>
        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-semibold flex items-center">
            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
            Realtime Active
        </span>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-blue-500">
            <h3 class="text-gray-600 font-medium">Total Sensor</h3>
            <p class="text-3xl font-bold mt-2">{{ $totalSensor }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-green-500">
            <h3 class="text-gray-600 font-medium">Sensor Aktif</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $sensorAktif }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-red-500">
            <h3 class="text-gray-600 font-medium">Sensor Non-Aktif</h3>
            <p class="text-3xl font-bold text-red-600 mt-2">{{ $sensorNonAktif }}</p>
        </div>

        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-cyan-500">
            <h3 class="text-gray-600 font-medium">Pemakaian Hari Ini</h3>
            <p class="text-3xl font-bold mt-2">
                <span id="pemakaian-text">{{ $pemakaianHariIni }}</span> L
            </p>
        </div>

    </div>

    <!-- GRAFIK -->
    <div class="bg-white p-6 rounded-xl shadow">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Grafik Pemakaian Air (Live)</h3>
            <p class="text-sm text-gray-500">Update setiap 2 detik</p>
        </div>
        <div class="relative h-80 w-full">
            <canvas id="chartAir"></canvas>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('chartAir').getContext('2d');

        var chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Debit Air (Liter/menit)',
                    data: [],
                    borderColor: 'rgba(6, 182, 212, 1)',
                    backgroundColor: 'rgba(6, 182, 212, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: { duration: 0 },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        async function loadChart() {
            try {
                const response = await fetch("{{ url('/api/monitoring/chart') }}");
                const result = await response.json();

                const labels = result.data.map(item => {
                    const date = new Date(item.created_at);
                    return date.toLocaleTimeString();
                });

                const values = result.data.map(item => item.flow_rate ?? item.value);

                chart.data.labels = labels;
                chart.data.datasets[0].data = values;
                chart.update();
            } catch (error) {
                console.error("Error load chart:", error);
            }
        }

        async function loadLatest() {
            try {
                const response = await fetch("{{ url('/api/monitoring/latest') }}");
                const result = await response.json();

                if (result.data) {
                    document.getElementById('pemakaian-text').innerText =
                         parseFloat(result.data.total_volume ?? 0).toFixed(2);
                }
            } catch (error) {
                console.error("Error load latest:", error);
            }
        }

        function startRealtime() {
            loadChart();
            loadLatest();

            setInterval(() => {
                fetch("{{ url('/api/simulate/flow') }}");
                loadChart();
                loadLatest();
            }, 8000); // update tiap 5 detik
        }

        startRealtime();
    });
    </script>

@endsection