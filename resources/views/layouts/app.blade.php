<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Smart Meter') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Chart.js & Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* SCROLLBAR CANTIK */
        .custom-scroll::-webkit-scrollbar { width: 5px; }
        .custom-scroll::-webkit-scrollbar-track { background: transparent; }
        .custom-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }

        /* TRANSISI SIDEBAR */
        #sidebar { transition: width 0.3s ease, transform 0.3s ease; }

        /* LOGIKA COLLAPSED */
        #sidebar.collapsed { width: 5rem; } /* w-20 */
        #sidebar.collapsed .sidebar-header h1 { display: none; }
        #sidebar.collapsed .menu-text { display: none; }
        #sidebar.collapsed .role-badge { display: none; }
        #sidebar.collapsed .user-name { display: none; }
        #sidebar.collapsed .sidebar-header { justify-content: center; padding: 1rem 0; }

        /* Pusatkan icon saat collapsed */
        #sidebar.collapsed .menu-item { justify-content: center; padding-left: 0; padding-right: 0; }
        #sidebar.collapsed .user-section { flex-direction: column; align-items: center; text-align: center; }
        #sidebar.collapsed .user-avatar { margin-right: 0; margin-bottom: 8px; }

        /* CONTENT MARGIN */
        #content { transition: margin-left 0.3s ease; }
        #content.expanded { margin-left: 16rem; } /* w-64 */
        #content.collapsed { margin-left: 5rem; } /* w-20 */

        /* HOVER EFFECTS */
        .menu-item {
            transition: all 0.2s ease;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .menu-item:hover {
            transform: translateX(4px);
            background-color: #eff6ff; /* blue-50 */
            color: #2563eb; /* blue-600 */
        }
        #sidebar.collapsed .menu-item:hover { transform: none; background-color: #eff6ff; }

        /* BADGE ROLE */
        .role-badge {
            background: linear-gradient(135deg, #3b82f6, #0ea5e9);
            box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3);
        }
        .role-badge.admin {
            background: linear-gradient(135deg, #ef4444, #f87171);
            box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);
        }
    </style>
</head>

<body class="bg-gray-100 overflow-hidden">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <aside id="sidebar" class="w-64 bg-white border-r border-gray-200 flex flex-col fixed h-full z-30 shadow-sm">

            <!-- HEADER LOGO -->
            <div class="h-16 flex items-center justify-between px-6 border-b border-gray-100 sidebar-header shrink-0">
                <h1 class="text-xl font-bold text-blue-600 tracking-tight flex items-center gap-2">
                    <i data-lucide="droplets" class="w-6 h-6"></i>
                    <span>HydroMon</span>
                </h1>
                <button id="toggleBtn" class="p-1.5 rounded-lg text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition">
                    <i data-lucide="align-left" class="w-5 h-5"></i>
                </button>
            </div>

            <!-- MENU -->
            <nav class="flex-1 overflow-y-auto custom-scroll p-4 space-y-1">

                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-2 menu-text">Menu Utama</p>

                <a href="/dashboard" class="menu-item p-3 rounded-xl text-gray-600 {{ Request::is('dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                    <span class="menu-text">Dashboard</span>
                </a>

                <a href="/monitoring" class="menu-item p-3 rounded-xl text-gray-600 {{ Request::is('monitoring') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                    <i data-lucide="activity" class="w-5 h-5"></i>
                    <span class="menu-text">Monitoring Live</span>
                </a>

                <a href="/sensor" class="menu-item p-3 rounded-xl text-gray-600 {{ Request::is('sensor*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                    <i data-lucide="cpu" class="w-5 h-5"></i>
                    <span class="menu-text">Manajemen Sensor</span>
                </a>

                <a href="/historis" class="menu-item p-3 rounded-xl text-gray-600 {{ Request::is('historis') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                    <i data-lucide="file-clock" class="w-5 h-5"></i>
                    <span class="menu-text">Data Historis</span>
                </a>

                <a href="/notifikasi" class="menu-item p-3 rounded-xl text-gray-600 {{ Request::is('notifikasi*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="menu-text">Notifikasi</span>
                </a>

                <!-- ⬇️ MENU PROFIL SAYA (Sudah Dikembalikan) ⬇️ -->
                <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 menu-text">Akun Saya</p>

                <a href="{{ route('profile.edit') }}" class="menu-item p-3 rounded-xl text-gray-600 {{ Request::is('profile') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                    <i data-lucide="user-cog" class="w-5 h-5"></i>
                    <span class="menu-text">Profil Saya</span>
                </a>

                @if(Auth::user()->role == 'admin')
                    <p class="px-2 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 mt-6 menu-text">Administrator</p>

                    <a href="/users" class="menu-item p-3 rounded-xl text-gray-600 {{ Request::is('users*') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span class="menu-text">Kelola User</span>
                    </a>

                    <a href="/settings" class="menu-item p-3 rounded-xl text-gray-600 {{ Request::is('settings') ? 'bg-blue-50 text-blue-600 font-semibold' : '' }}">
                        <i data-lucide="settings" class="w-5 h-5"></i>
                        <span class="menu-text">Pengaturan Sistem</span>
                    </a>
                @endif
            </nav>

            <!-- FOOTER PROFILE -->
            <div class="p-4 border-t border-gray-100 shrink-0">
                @auth
                    <div class="flex items-center gap-3 mb-4 user-section">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold shrink-0 user-avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden user-name">
                            <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                            <span class="text-[10px] text-white px-2 py-0.5 rounded-full role-badge {{ Auth::user()->role == 'admin' ? 'admin' : '' }}">
                                {{ strtoupper(Auth::user()->role) }}
                            </span>
                        </div>
                    </div>

                    <button type="button" id="openLogoutModal" class="logout-btn w-full flex items-center gap-2 justify-center bg-red-50 text-red-600 hover:bg-red-600 hover:text-white p-2.5 rounded-xl transition-all font-medium">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span class="menu-text">Keluar</span>
                    </button>
                @endauth
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <div id="content" class="expanded flex-1 h-screen overflow-y-auto w-full">
            @isset($header)
                <header class="bg-white shadow-sm sticky top-0 z-20">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="p-4 md:p-6 pb-20">
                @yield('content')
            </main>
        </div>

    </div>

    <!-- LOGOUT MODAL -->
    <div id="logoutModal" class="fixed inset-0 bg-black/40 backdrop-blur-sm hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl p-6 w-80 transform transition-all scale-100">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-red-100 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="log-out" class="w-8 h-8"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Konfirmasi Keluar</h3>
                <p class="text-sm text-gray-500 mt-2">Apakah Anda yakin ingin mengakhiri sesi ini?</p>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="flex gap-3">
                @csrf
                <button type="button" id="cancelLogout" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-xl font-medium hover:bg-gray-200 transition">
                    Batal
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition shadow-lg shadow-red-600/30">
                    Ya, Keluar
                </button>
            </form>
        </div>
    </div>

    <script>
        // Init Icons
        lucide.createIcons();

        // Sidebar Logic
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const toggleBtn = document.getElementById("toggleBtn");

        // Cek LocalStorage
        let isCollapsed = localStorage.getItem("sidebar_collapsed") === "true";

        function updateSidebar() {
            if (isCollapsed) {
                sidebar.classList.add("collapsed");
                content.classList.remove("expanded");
                content.classList.add("collapsed");
            } else {
                sidebar.classList.remove("collapsed");
                content.classList.add("expanded");
                content.classList.remove("collapsed");
            }
        }

        // Apply saat load pertama
        updateSidebar();

        // Toggle Click
        toggleBtn.addEventListener("click", () => {
            isCollapsed = !isCollapsed;
            localStorage.setItem("sidebar_collapsed", isCollapsed);
            updateSidebar();
        });

        // Logout Modal Logic
        const modal = document.getElementById("logoutModal");
        const openBtn = document.getElementById("openLogoutModal");
        const cancelBtn = document.getElementById("cancelLogout");

        openBtn.addEventListener("click", () => modal.classList.remove("hidden"));
        cancelBtn.addEventListener("click", () => modal.classList.add("hidden"));

        // Tutup modal jika klik di luar
        modal.addEventListener("click", (e) => {
            if(e.target === modal) modal.classList.add("hidden");
        });
    </script>
</body>
</html>