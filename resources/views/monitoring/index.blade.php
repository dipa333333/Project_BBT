@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold mb-4">Monitoring Realtime</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    <!-- Flowmeter -->
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Debit Air (LPM)</p>
        <h3 id="flow" class="text-4xl font-bold text-blue-600">0</h3>
    </div>

    <!-- Pressure -->
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Tekanan (Bar)</p>
        <h3 id="pressure" class="text-4xl font-bold text-green-600">0</h3>
    </div>

    <!-- Volume -->
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Total Volume (Liter)</p>
        <h3 id="volume" class="text-4xl font-bold text-purple-600">0</h3>
    </div>

</div>

<!-- Grafik -->
<div class="bg-white mt-6 p-6 rounded-xl shadow">
    <canvas id="flowChart"></canvas>
</div>

<!-- Script data dummy -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Data dummy
    function random(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    setInterval(() => {
        document.getElementById('flow').innerText = random(8, 20);
        document.getElementById('pressure').innerText = random(1, 3);
        document.getElementById('volume').innerText = random(100, 500);
    }, 1500);

    // Grafik
    const ctx = document.getElementById('flowChart');
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['1', '2', '3', '4', '5', '6'],
            datasets: [{
                label: 'Debit Air (LPM)',
                data: [12, 15, 9, 13, 17, 14],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

@endsection
