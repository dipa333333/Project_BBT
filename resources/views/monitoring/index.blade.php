@extends('layouts.app')

@section('content')

<div class="container mx-auto px-4 py-6">

    <!-- HEADER SECTION -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-blue-700">Monitoring Realtime</h2>
            <p class="text-sm text-gray-500">Pemantauan langsung parameter sensor lapangan.</p>
        </div>
        <div class="flex items-center space-x-3">
            <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold flex items-center shadow-sm border border-green-200">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                LIVE CONNECTED
            </span>
        </div>
    </div>

    <!-- CARDS PARAMETER -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Card 1: Debit Air -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-blue-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i data-lucide="waves" class="w-16 h-16 text-blue-600"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 rounded-xl text-blue-600">
                    <i data-lucide="activity" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Debit Air (Flow)</p>
                    <h3 class="text-3xl font-bold text-gray-800 flex items-baseline gap-1">
                        <span id="val-flow">0</span>
                        <span class="text-sm font-normal text-gray-400">LPM</span>
                    </h3>
                </div>
            </div>
            <!-- Progress bar mini -->
            <div class="w-full bg-gray-100 rounded-full h-1.5 mt-4 overflow-hidden">
                <div id="bar-flow" class="bg-blue-500 h-1.5 rounded-full transition-all duration-500" style="width: 0%"></div>
            </div>
        </div>

        <!-- Card 2: Tekanan -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i data-lucide="gauge" class="w-16 h-16 text-green-600"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-50 rounded-xl text-green-600">
                    <i data-lucide="gauge-circle" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Tekanan Pipa</p>
                    <h3 class="text-3xl font-bold text-gray-800 flex items-baseline gap-1">
                        <span id="val-pressure">0</span>
                        <span class="text-sm font-normal text-gray-400">Bar</span>
                    </h3>
                </div>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-1.5 mt-4 overflow-hidden">
                <div id="bar-pressure" class="bg-green-500 h-1.5 rounded-full transition-all duration-500" style="width: 0%"></div>
            </div>
        </div>

        <!-- Card 3: Total Volume (Akumulatif) -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 relative overflow-hidden group hover:shadow-md transition">
            <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                <i data-lucide="droplet" class="w-16 h-16 text-purple-600"></i>
            </div>
            <div class="flex items-center gap-4">
                <div class="p-3 bg-purple-50 rounded-xl text-purple-600">
                    <i data-lucide="database" class="w-6 h-6"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Volume</p>
                    <h3 class="text-3xl font-bold text-gray-800 flex items-baseline gap-1">
                        <span id="val-volume">0</span>
                        <span class="text-sm font-normal text-gray-400">Liter</span>
                    </h3>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-4 flex items-center gap-1">
                <i data-lucide="trending-up" class="w-3 h-3"></i> Bertambah seiring debit air
            </p>
        </div>

    </div>

    <!-- MAIN CHART -->
    <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Grafik Debit Air (Live)</h3>
                <p class="text-sm text-gray-400">Visualisasi aliran air per detik</p>
            </div>
            <div class="flex gap-2">
                <span class="flex items-center gap-1 text-xs font-medium text-gray-500 bg-gray-100 px-2 py-1 rounded">
                    <div class="w-2 h-2 rounded-full bg-blue-500"></div> Flow (LPM)
                </span>
            </div>
        </div>

        <div class="relative h-80 w-full">
            <canvas id="liveChart"></canvas>
        </div>
    </div>

</div>

<!-- Load Libraries -->
<script src="https://unpkg.com/lucide@latest"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}} <!-- Pastikan ChartJS sudah diload di layout -->

<script>
    // Initialize Icons
    lucide.createIcons();

    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('liveChart').getContext('2d');

        // Gradient Chart Style
        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.4)'); // Biru pudar atas
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)'); // Transparan bawah

        // Setup Awal Chart (Kosong)
        const maxDataPoints = 30; // Jumlah titik data di layar
        let chartLabels = Array(maxDataPoints).fill('');
        let chartData = Array(maxDataPoints).fill(0);

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Debit (LPM)',
                    data: chartData,
                    borderColor: '#3b82f6', 
                    backgroundColor: gradient,
                    borderWidth: 2,
                    pointRadius: 0,
                    pointHoverRadius: 4,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 25, // Agar grafik tidak terlalu sering resize skala
                        grid: { borderDash: [2, 4], color: '#f1f5f9' }
                    },
                    x: {
                        display: false // Sembunyikan label X agar bersih
                    }
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                }
            }
        });

        // --- SIMULASI REALTIME LOGIC ---
        // Variabel untuk menyimpan total volume (agar tidak reset/acak)
        let currentVolume = 1250.5;

        setInterval(() => {
            // 1. Generate Data Dummy yang Realistis
            // Flow: Random antara 10 - 22 LPM
            const flow = (Math.random() * (22 - 10) + 10).toFixed(1);

            // Pressure: Random antara 1.8 - 2.5 Bar
            const pressure = (Math.random() * (2.5 - 1.8) + 1.8).toFixed(1);

            // 2. Logika Volume Akumulatif
            // Volume bertambah berdasarkan Flow per detik (dibagi 60)
            // Asumsi interval 1000ms = 1 detik
            currentVolume += parseFloat(flow / 60);

            // 3. Update Text di Card
            document.getElementById('val-flow').innerText = flow;
            document.getElementById('val-pressure').innerText = pressure;

            // Format angka ribuan untuk volume
            document.getElementById('val-volume').innerText = currentVolume.toLocaleString('id-ID', {
                minimumFractionDigits: 1,
                maximumFractionDigits: 1
            });

            // 4. Update Mini Progress Bar (Visual Only)
            // Asumsi Max Flow 30 LPM, Max Pressure 5 Bar
            document.getElementById('bar-flow').style.width = (flow / 30 * 100) + "%";
            document.getElementById('bar-pressure').style.width = (pressure / 5 * 100) + "%";

            // 5. Update Chart (Efek Berjalan Geser Kiri)
            chart.data.labels.push(''); // Label dummy baru
            chart.data.datasets[0].data.push(flow); // Data flow baru

            if (chart.data.labels.length > maxDataPoints) {
                chart.data.labels.shift(); // Hapus data terlama
                chart.data.datasets[0].data.shift();
            }

            chart.update(); // Render ulang grafik

        }, 3000); // Update setiap 1 detik (1000ms)
    });
</script>

@endsection