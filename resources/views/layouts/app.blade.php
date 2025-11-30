<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Meter</title>

    <!-- Tailwind & Chart.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Ripple air */
        a {
            position: relative;
            overflow: hidden;
        }
        a:active::after {
            content: "";
            position: absolute;
            width: 80px;
            height: 80px;
            background: rgba(56, 189, 248, 0.35); /* sky-400 */
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.45s ease-out;
            top: var(--y);
            left: var(--x);
        }
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Hover water style */
        .menu-item {
            transition: all 0.2s ease;
        }
        .menu-item:hover {
            transform: translateX(4px);
            background-color: rgb(219 234 254); /* blue-100 */
            box-shadow: 0 0 8px rgba(96, 165, 250, 0.35); /* water glow */
        }

        /* Saat sidebar collapse */
        .sidebar-collapsed .menu-item:hover {
            transform: none;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="flex">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 transition-all duration-300 bg-white shadow-md h-screen fixed">

        <div class="p-4 border-b flex justify-between items-center">
            <h1 class="text-2xl font-bold text-blue-600" id="logoText">Smart Meter</h1>
            <button id="toggleBtn" class="p-2 rounded hover:bg-gray-200">☰</button>
        </div>

        <nav class="p-4 space-y-3">

            <!-- DASHBOARD -->
            <a href="/dashboard"
                class="menu-item block p-2 rounded hover:bg-blue-100
                {{ Request::is('dashboard') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                📊 <span class="menu-text">Dashboard</span>
            </a>

            <!-- MONITORING -->
            <a href="/monitoring"
                class="menu-item block p-2 rounded hover:bg-blue-100
                {{ Request::is('monitoring') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                📡 <span class="menu-text">Monitoring</span>
            </a>

            <!-- SENSOR -->
            <a href="/sensor"
                class="menu-item block p-2 rounded hover:bg-blue-100
                {{ Request::is('sensor*') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                🔧 <span class="menu-text">Sensor</span>
            </a>

            <!-- HISTORIS -->
            <a href="/historis"
                class="menu-item block p-2 rounded hover:bg-blue-100
                {{ Request::is('historis') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                📜 <span class="menu-text">Data Historis</span>
            </a>

            <!-- NOTIFIKASI -->
            <a href="/notifikasi"
                class="menu-item block p-2 rounded hover:bg-blue-100
                {{ Request::is('notifikasi*') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                🚨 <span class="menu-text">Notifikasi</span>
            </a>

            <!-- USER MANAGEMENT -->
            <a href="/users"
                class="menu-item block p-2 rounded hover:bg-blue-100
                {{ Request::is('users*') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                👤 <span class="menu-text">User Management</span>
            </a>

            <!-- PENGATURAN -->
            <a href="/settings"
                class="menu-item block p-2 rounded hover:bg-blue-100
                {{ Request::is('settings') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                ⚙️ <span class="menu-text">Pengaturan</span>
            </a>

            <!-- ABOUT -->
            <a href="/about"
                class="menu-item block p-2 rounded hover:bg-blue-100
                {{ Request::is('about') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                ℹ️ <span class="menu-text">Tentang Aplikasi</span>
            </a>

        </nav>
    </aside>

    <!-- CONTENT -->
    <main id="content" class="ml-64 p-6 w-full transition-all duration-300">
        @yield('content')
    </main>

</div>

<script>
   const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const toggleBtn = document.getElementById("toggleBtn");
    const logoText = document.getElementById("logoText");
    const menuTexts = document.querySelectorAll(".menu-text");

    let collapsed = localStorage.getItem("sidebar_collapsed") === "true";

    // Fungsi untuk update tampilan sidebar
    function applySidebarState() {
        if (collapsed) {
            sidebar.classList.add("w-16");
            content.classList.add("ml-16");
            logoText.classList.add("hidden");
            menuTexts.forEach(x => x.classList.add("hidden"));
        } else {
            sidebar.classList.remove("w-16");
            content.classList.remove("ml-16");
            logoText.classList.remove("hidden");
            menuTexts.forEach(x => x.classList.remove("hidden"));
        }
    }

    // Terapkan state saat halaman dibuka
    applySidebarState();

    // Tombol toggle
    toggleBtn.addEventListener("click", () => {
        collapsed = !collapsed;
        localStorage.setItem("sidebar_collapsed", collapsed);
        applySidebarState();
    });

</script>

<!-- Ripple click effect -->
<script>
    document.querySelectorAll("a").forEach(a => {
        a.addEventListener("click", function(e){
            const rect = this.getBoundingClientRect();
            this.style.setProperty("--x", e.clientX - rect.left + "px");
            this.style.setProperty("--y", e.clientY - rect.top + "px");
        });
    });
</script>

</body>
</html>
