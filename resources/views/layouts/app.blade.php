<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Meter') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* CSS CUSTOM SCROLLBAR (Biar menu scroll cantik) */
        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scroll::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 20px;
        }

        /* Biar header sidebar ikut mengecil */
        #sidebar.collapsed .sidebar-header {
            justify-content: center !important;
            padding-left: 0;
            padding-right: 0;
        }

        #sidebar.collapsed #logoText {
            display: none;
        }

        /* Sembunyikan text logout saat collapsed */
        #sidebar.collapsed .logout-text {
            display: none;
        }

        /* Sesuaikan padding tombol logout saat collapsed */
        #sidebar.collapsed .logout-btn {
            justify-content: center;
            padding: 0.5rem;
        }

        #sidebar.collapsed .toggle-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
        }

         /* SIDEBAR ANIMATION */
        #sidebar {
            transform: translateX(-100%);
            animation: slideIn 0.45s ease forwards;
        }

        @keyframes slideIn {
            from { transform: translateX(-100%); }
            to   { transform: translateX(0); }
        }

        .sidebar-collapsed {
            animation: slideOut 0.3s ease forwards;
        }

        @keyframes slideOut {
            from { transform: translateX(0); }
            to   { transform: translateX(-100%); }
        }

        /* PREMIUM LOGOUT BUTTON */
        .logout-btn {
            @apply w-full flex items-center gap-2 px-4 py-2 rounded-lg text-white font-semibold bg-gradient-to-r from-red-500 to-red-600;
            transition: all 0.25s ease;
            box-shadow: 0 4px 10px rgba(220, 38, 38, 0.25);
        }

        .logout-btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 6px 14px rgba(220, 38, 38, 0.45);
            background: linear-gradient(to right, #ef4444, #dc2626);
        }

        .logout-icon {
            font-size: 20px;
        }

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
            background: rgba(56, 189, 248, 0.35);
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
            white-space: nowrap; /* Mencegah text turun baris */
        }
        .menu-item:hover {
            transform: translateX(4px);
            background-color: rgb(219 234 254);
            box-shadow: 0 0 8px rgba(96, 165, 250, 0.35);
        }

        .sidebar-collapsed .menu-item:hover {
            transform: none;
        }

        /* ROLE BADGE WATER GLOW */
        .role-badge {
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            display: inline-block;
            color: white;
            backdrop-filter: blur(6px);
            border: 2px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 0 10px rgba(0, 183, 255, 0.65),
                        0 0 20px rgba(0, 183, 255, 0.45);
            animation: glowPulse 2.3s ease-in-out infinite;
        }

        /* Warna ADMIN vs USER */
        .role-badge {
            background: linear-gradient(135deg,
                rgba(0, 153, 255, 0.8),
                rgba(0, 193, 255, 0.55)
            );
        }

        .role-badge.admin {
            background: linear-gradient(135deg,
                rgba(255, 60, 60, 0.85),
                rgba(255, 95, 95, 0.55)
            );
            box-shadow: 0 0 14px rgba(255, 90, 90, 0.75),
                        0 0 22px rgba(255, 110, 110, 0.5);
        }

        /* Animation Pulse */
        @keyframes glowPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%      { transform: scale(1.06); opacity: 0.8; }
        }

    </style>

</head>

<body class="bg-gray-100 overflow-hidden"> <div class="flex h-screen"> <aside id="sidebar"
        class="w-64 flex flex-col transition-all duration-300 bg-white shadow-md h-screen fixed z-30">

        <div class="p-4 border-b flex justify-between items-center sidebar-header flex-shrink-0 h-16">
            <h1 class="text-2xl font-bold text-blue-600 truncate" id="logoText">Smart Meter</h1>

            <div class="toggle-wrapper">
                <button id="toggleBtn" class="p-2 rounded hover:bg-gray-200">☰</button>
            </div>
        </div>

        <nav class="p-4 space-y-3 flex-1 overflow-y-auto overflow-x-hidden custom-scroll">

            <a href="/dashboard"
               class="menu-item block p-2 rounded
               {{ Request::is('dashboard') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
               📊 <span class="menu-text">Dashboard</span>
            </a>

            <a href="/monitoring"
               class="menu-item block p-2 rounded
               {{ Request::is('monitoring') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
               📡 <span class="menu-text">Monitoring</span>
            </a>

            <a href="/sensor"
               class="menu-item block p-2 rounded
               {{ Request::is('sensor*') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
               🔧 <span class="menu-text">Sensor</span>
            </a>

            <a href="/historis"
               class="menu-item block p-2 rounded
               {{ Request::is('historis') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
               📜 <span class="menu-text">Data Historis</span>
            </a>

            <a href="/notifikasi"
               class="menu-item block p-2 rounded
               {{ Request::is('notifikasi*') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
               🚨 <span class="menu-text">Notifikasi</span>
            </a>

            @if(Auth::user()->role == 'admin')
                <a href="/users"
                class="menu-item block p-2 rounded
                {{ Request::is('users*') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                👤 <span class="menu-text">User Management</span>
                </a>

                <a href="/settings"
                class="menu-item block p-2 rounded
                {{ Request::is('settings') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                ⚙️ <span class="menu-text">Pengaturan</span>
                </a>
            @endif

            <a href="/about"
               class="menu-item block p-2 rounded
               {{ Request::is('about') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
               ℹ️ <span class="menu-text">Tentang Aplikasi</span>
            </a>

        </nav>

        <div class="p-4 border-t space-y-2 flex-shrink-0 bg-white z-20">

            @auth
                <div class="text-gray-700 text-sm mb-2 truncate">
                     <span class="menu-text font-bold">{{ Auth::user()->name }}</span>
                </div>

                @if(Auth::check())
                    <div class="mb-3">
                        <span class="role-badge {{ Auth::user()->role == 'admin' ? 'admin' : '' }}">
                            {{ strtoupper(Auth::user()->role) }}
                        </span>
                    </div>
                @endif


                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('profile.edit') }}"
                        class="menu-item block p-2 rounded
                        {{ Request::is('profile') ? 'bg-blue-200 font-bold text-blue-700' : '' }}">
                        👤 <span class="menu-text">Profil Saya</span>
                    </a>

                    <button type="button" id="openLogoutModal" class="logout-btn flex items-center justify-center gap-3 mt-2 rounded-full px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold shadow-md">
                        <span class="logout-icon text-xl">🚪</span>
                        <span class="logout-text font-semibold">Keluar</span>
                    </button>

                </form>

            @endauth

        </div>

    </aside>

    <div id="content" class="ml-64 w-full h-screen overflow-y-auto transition-all duration-300">

        @isset($header)
            <header class="bg-white shadow p-4 sticky top-0 z-10">
                <div class="max-w-7xl mx-auto">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="p-6">
            @yield('content')

            <div class="mt-4 text-gray-400 text-sm">
                &copy; {{ date('Y') }} Smart Meter System
            </div>
        </main>

    </div>

</div>

<div id="logoutModal"
     class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-sm hidden justify-center items-center z-50">

    <div class="bg-white rounded-xl shadow-xl p-6 w-80 animate-[fadeIn_0.25s_ease]">
        <h3 class="font-semibold text-lg text-gray-800 mb-3">Konfirmasi Logout</h3>
        <p class="text-gray-600 text-sm mb-5">Yakin ingin keluar dari akun ini?</p>

        <div class="flex justify-end gap-3">
            <button id="cancelLogout"
                class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-800">
                Batal
            </button>

            <button id="confirmLogout"
                class="px-4 py-2 rounded-lg bg-gradient-to-r from-red-500 to-red-600 text-white shadow-md hover:shadow-lg hover:scale-[1.03] transition">
                Logout
            </button>
        </div>
    </div>
</div>


<script>
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const toggleBtn = document.getElementById("toggleBtn");
    const menuTexts = document.querySelectorAll(".menu-text");
    const logoutTexts = document.querySelectorAll(".logout-text"); // Handle text logout terpisah

    let collapsed = localStorage.getItem("sidebar_collapsed") === "true";

    // === APPLY STATE SAAT PERTAMA LOAD ===
    applySidebarState();

    function applySidebarState() {
        if (collapsed) {
            sidebar.classList.add("w-16", "collapsed");
            sidebar.classList.remove("w-64");

            content.classList.add("ml-16");
            content.classList.remove("ml-64");

            menuTexts.forEach(el => el.classList.add("hidden"));
            logoutTexts.forEach(el => el.classList.add("hidden")); // Sembunyikan text Keluar
        } else {
            sidebar.classList.add("w-64");
            sidebar.classList.remove("w-16", "collapsed");

            content.classList.add("ml-64");
            content.classList.remove("ml-16");

            menuTexts.forEach(el => el.classList.remove("hidden"));
            logoutTexts.forEach(el => el.classList.remove("hidden")); // Tampilkan text Keluar
        }
    }

    // === KLIK TOGGLE ===
    toggleBtn.addEventListener("click", () => {
        collapsed = !collapsed;
        localStorage.setItem("sidebar_collapsed", collapsed);
        applySidebarState();
    });

    // === Ripple Effect ===
    document.querySelectorAll("a").forEach(a => {
        a.addEventListener("click", function(e){
            let rect = this.getBoundingClientRect();
            this.style.setProperty("--x", e.clientX - rect.left + "px");
            this.style.setProperty("--y", e.clientY - rect.top + "px");
        });
    });

    const logoutModal = document.getElementById("logoutModal");
    const openLogoutModal = document.getElementById("openLogoutModal");
    const cancelLogout = document.getElementById("cancelLogout");
    const confirmLogout = document.getElementById("confirmLogout");
    const logoutForm = document.getElementById("logoutForm");

    openLogoutModal.addEventListener("click", () => {
        logoutModal.classList.remove("hidden");
        logoutModal.classList.add("flex");
    });

    // Tutup modal
    cancelLogout.addEventListener("click", () => {
        logoutModal.classList.add("hidden");
    });

    // Tombol konfirmasi logout
    confirmLogout.addEventListener("click", () => {
        confirmLogout.disabled = true;
        confirmLogout.innerHTML = `<span class="animate-spin mr-2">⏳</span> Keluar...`;
        logoutForm.submit();
    });
    </script>
</body>
</html> 