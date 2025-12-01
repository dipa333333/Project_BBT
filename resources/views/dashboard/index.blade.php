@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Dashboard Sistem (Live Monitor)</h2>
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

{{-- Pastikan Chart.js sudah diload. Uncomment jika belum ada di layout --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

<script>
document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('chartAir').getContext('2d');

    // --- SETUP DATA ---
    // Menggunakan directive json untuk parsing data PHP ke JS dengan aman
    var initialLabels = @json($labels);
    var initialValues = @json($values);
    var rawPemakaian = @json($pemakaianHariIni);

    // Konversi nilai pemakaian ke Float (hapus koma jika format ribuan, misal "1,200")
    var currentTotal = parseFloat(String(rawPemakaian).replace(/,/g, '')) || 0;

    // Setup Grafik
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: initialLabels,
            datasets: [{
                label: 'Debit Air (Liter/menit)',
                data: initialValues,
                borderColor: 'rgba(6, 182, 212, 1)', // Warna Cyan
                backgroundColor: 'rgba(6, 182, 212, 0.1)',
                borderWidth: 2,
                pointRadius: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: 'rgba(6, 182, 212, 1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        borderDash: [2, 4],
                        color: '#f3f4f6'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            animation: {
                duration: 0 // Matikan animasi default agar pergerakan mulus
            }
        }
    });

    // Logika Real-time
    setInterval(function() {
        // Generate data palsu
        var randomValue = Math.floor(Math.random() * (50 - 10 + 1)) + 10;

        var now = new Date();
        var timeLabel = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();

        // Update Data Grafik
        chart.data.labels.push(timeLabel);
        chart.data.datasets[0].data.push(randomValue);

        // Batasi hanya 20 data yang tampil
        if (chart.data.labels.length > 20) {
            chart.data.labels.shift();
            chart.data.datasets[0].data.shift();
        }

        chart.update();

        // Update Angka Pemakaian di Card
        currentTotal += (randomValue / 60);

        var element = document.getElementById('pemakaian-text');
        if(element) {
            element.innerText = currentTotal.toFixed(2);
        }

    }, 2000);
});
</script>

@endsection