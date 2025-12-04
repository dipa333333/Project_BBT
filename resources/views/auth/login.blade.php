<x-guest-layout>
    <!-- Load Lucide Icons (Untuk icon mata password) -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* --- CORE LAYOUT --- */
        body, html {
            margin: 0; padding: 0;
            width: 100%; height: 100%;
            overflow: hidden;
            background: #004564;
            font-family: 'Figtree', sans-serif;
        }

        /* --- SPLASH SCREEN --- */
        #splash {
            position: fixed; inset: 0;
            background: linear-gradient(180deg, #009BFF, #005A99);
            display: flex; align-items: center; justify-content: center;
            z-index: 100;
            animation: splashFade 0.8s ease 2s forwards;
            pointer-events: none;
        }

        .splash-logo {
            animation: splashAnim 1.5s ease-in-out infinite;
            filter: drop-shadow(0 0 15px rgba(255,255,255,0.8));
            width: 120px;
        }

        @keyframes splashAnim {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
        }

        @keyframes splashFade {
            to { opacity: 0; visibility: hidden; }
        }

        /* --- BACKGROUND LAYERS --- */
        .water-bg {
            position: fixed; inset: 0;
            overflow: hidden;
            background: linear-gradient(180deg, #3dc9ff 0%, #006092 100%);
            z-index: 0;
        }

        .wave {
            position: absolute;
            width: 200%;
            height: auto;
            bottom: -5px; left: 0;
            background-repeat: repeat-x;
            animation: waveMove 10s linear infinite;
        }

        .wave1 { opacity: 0.6; z-index: 3; animation-duration: 12s; bottom: 0; }
        .wave2 { opacity: 0.4; z-index: 2; animation-duration: 18s; bottom: 10px; }
        .wave3 { opacity: 0.2; z-index: 1; animation-duration: 25s; bottom: 20px; }

        @keyframes waveMove {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        /* --- BUBBLES --- */
        .bubble {
            position: absolute; bottom: -50px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            pointer-events: none;
            box-shadow: inset 0 0 4px rgba(255,255,255,0.5);
            animation: bubbleUp linear forwards;
        }

        @keyframes bubbleUp {
            0% { transform: translateY(0) scale(0.8); opacity: 0.6; }
            100% { transform: translateY(-110vh) scale(1.2); opacity: 0; }
        }

        /* --- CONTENT WRAPPER --- */
        .main-wrapper {
            position: relative;
            z-index: 10;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-bottom: 5vh;
        }

        /* --- MASCOT --- */
        .mascot-container {
            position: relative;
            width: 140px; height: 140px;
            margin-bottom: -40px; /* Overlap dengan card sedikit */
            z-index: 20;
            border-radius: 50%;
            background: radial-gradient(circle, #ffffff 20%, #e9f8ff 70%, #bfe7ff 100%);
            box-shadow: 0 0 40px rgba(0, 155, 255, 0.4), inset 0 0 20px rgba(255,255,255,0.8);
            animation: float 4s ease-in-out infinite;
            display: flex; align-items: center; justify-content: center;
            transition: transform 0.3s;
        }

        .mascot-img {
            width: 65px; z-index: 2; pointer-events: none;
            position: relative; top: 8px;
        }

        .eyes-wrapper {
            position: absolute;
            top: 42%; left: 50%;
            transform: translate(-50%, -50%);
            width: 60px; height: 30px;
            display: flex; justify-content: space-between;
            z-index: 3;
        }

        .eye {
            width: 22px; height: 22px;
            background: white;
            border-radius: 50%;
            border: 2px solid #e1f4ff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.2s;
        }

        .pupil {
            width: 9px; height: 9px;
            background: #004564;
            border-radius: 50%;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.05s cubic-bezier(0.1, 0.1, 0.2, 1);
        }

        /* --- MASCOT STATES --- */
        /* Shy Mode (Tutup Mata) */
        .mascot-container.shy .eye {
            height: 4px;
            margin-top: 10px;
            background: #cbd5e1;
            border-color: #94a3b8;
        }
        .mascot-container.shy .pupil { opacity: 0; }

        /* Peek Mode (Mengintip/Kaget) */
        .mascot-container.peek .eye {
            height: 26px; width: 26px; /* Mata membesar */
            border-color: #00C6FF;
        }
        .mascot-container.peek .mascot-img {
            transform: translateY(-5px); /* Sedikit loncat */
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        /* --- LOGIN CARD --- */
        .login-card {
            background: rgba(255, 255, 255, 0.15); /* Sedikit lebih terang */
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            border-radius: 24px;
            padding: 50px 40px 30px 40px; /* Padding atas besar utk maskot */
            width: 90%;
            max-width: 380px;
            text-align: center;
            color: white;
            box-shadow: 0 20px 40px rgba(0, 40, 80, 0.25);
            transform: translateY(0);
            transition: transform 0.3s;
        }

        /* Animasi Getar saat Error */
        .login-card.shake {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
            border-color: #ffcccc;
        }

        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }

        .input-group { position: relative; margin-bottom: 20px; text-align: left; }

        .input-field {
            width: 100%;
            padding: 14px 45px 14px 16px; /* Kanan padding besar utk icon mata */
            background: rgba(255,255,255,0.25);
            border: 2px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            color: #fff;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s;
        }
        .input-field::placeholder { color: rgba(255,255,255,0.7); }
        .input-field:focus {
            background: rgba(255,255,255,0.35);
            border-color: #fff;
            box-shadow: 0 0 15px rgba(255,255,255,0.2);
        }

        /* Tombol Mata (Show/Hide) */
        .toggle-password {
            position: absolute;
            right: 12px; top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.7);
            cursor: pointer;
            transition: color 0.2s;
            z-index: 5;
        }
        .toggle-password:hover { color: #fff; }

        .error-msg {
            color: #ffcccc; font-size: 0.8rem; margin-top: 5px;
            display: flex; align-items: center; gap: 4px;
        }

        .login-btn {
            width: 100%; margin-top: 10px; padding: 14px;
            background: linear-gradient(135deg, #00C6FF, #0072FF);
            border: none; border-radius: 12px;
            color: white; font-size: 16px; font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 114, 255, 0.4);
            transition: all 0.2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .login-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(0, 114, 255, 0.6); }
        .login-btn:active { transform: scale(0.98); }
        .login-btn:disabled { opacity: 0.7; cursor: not-allowed; }

        .forgot-link {
            display: inline-block; margin-top: 20px;
            color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.85rem;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: #fff; text-decoration: underline; }

        /* Loader */
        .spinner {
            width: 18px; height: 18px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            display: none;
        }
        .login-btn.loading .spinner { display: block; }
        .login-btn.loading span { display: none; }

        @keyframes spin { to { transform: rotate(360deg); } }

    </style>

    <!-- SPLASH -->
    <div id="splash">
        <img src="{{ asset('assets/login/water-meter.svg') }}" class="splash-logo">
    </div>

    <!-- BACKGROUND PARALLAX -->
    <div class="water-bg" id="parallax-bg">
        <div id="bubble-container"></div>
        <img src="{{ asset('assets/login/wave1.svg') }}" class="wave wave3">
        <img src="{{ asset('assets/login/wave2.svg') }}" class="wave wave2">
        <img src="{{ asset('assets/login/wave1.svg') }}" class="wave wave1">
    </div>

    <div class="main-wrapper">

        <!-- MASKOT -->
        <div class="mascot-container" id="mascot">
            <img src="{{ asset('assets/login/water-meter.svg') }}" class="mascot-img">
            <div class="eyes-wrapper">
                <div class="eye"><div class="pupil"></div></div>
                <div class="eye"><div class="pupil"></div></div>
            </div>
        </div>

        <!-- FORM CARD -->
        <div class="login-card {{ $errors->any() ? 'shake' : '' }}">
            <h2 class="text-2xl font-bold mb-1">Selamat Datang!</h2>
            <p class="text-sm opacity-80 mb-6">Masuk untuk mengakses Dashboard</p>

            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf

                <!-- Email -->
                <div class="input-group">
                    <input type="email" name="email" class="input-field" placeholder="Email Address"
                           value="{{ old('email') }}" required autofocus autocomplete="username">
                    @error('email')
                        <div class="error-msg"><i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="input-group">
                    <input type="password" name="password" id="passwordInput" class="input-field"
                           placeholder="Password" required autocomplete="current-password">

                    <!-- Toggle Show/Hide -->
                    <div class="toggle-password" id="togglePwd">
                        <i data-lucide="eye" class="w-5 h-5"></i>
                    </div>

                    @error('password')
                        <div class="error-msg"><i data-lucide="alert-circle" class="w-3 h-3"></i> {{ $message }}</div>
                    @enderror
                </div>

                <button class="login-btn" id="submitBtn">
                    <span>MASUK SEKARANG</span>
                    <div class="spinner"></div>
                </button>

                <div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password Saya?</a>
                    @endif
                </div>
            </form>
        </div>

    </div>

    <script>
        // Init Icons
        lucide.createIcons();

        document.addEventListener('DOMContentLoaded', () => {

            /* 1. BUBBLE ANIMATION */
            const bubbleContainer = document.getElementById("bubble-container");
            setInterval(() => {
                const b = document.createElement("div");
                b.className = "bubble";
                const size = Math.random() * 15 + 8;
                b.style.left = Math.random() * 100 + "%";
                b.style.width = size + "px"; b.style.height = size + "px";
                b.style.animationDuration = (Math.random() * 5 + 4) + "s";
                bubbleContainer.appendChild(b);
                setTimeout(() => b.remove(), 9000);
            }, 500);

            /* 2. EYE TRACKING */
            const eyes = document.querySelectorAll('.eye');
            const pupils = document.querySelectorAll('.pupil');
            const mascot = document.getElementById('mascot');
            const maxMove = 6;

            document.addEventListener('mousemove', (e) => {
                if(mascot.classList.contains('shy')) return; // Jangan gerak kalau lagi tutup mata

                eyes.forEach((eye, index) => {
                    const rect = eye.getBoundingClientRect();
                    const centerX = rect.left + rect.width/2;
                    const centerY = rect.top + rect.height/2;
                    const angle = Math.atan2(e.clientY - centerY, e.clientX - centerX);
                    const dist = Math.min(maxMove, Math.hypot(e.clientX - centerX, e.clientY - centerY) / 15);
                    const x = Math.cos(angle) * dist;
                    const y = Math.sin(angle) * dist;
                    pupils[index].style.transform = `translate(-50%, -50%) translate(${x}px, ${y}px)`;
                });
            });

            /* 3. PASSWORD INTERACTION (LOGIKA BARU) */
            const pwdInput = document.getElementById('passwordInput');
            const toggleBtn = document.getElementById('togglePwd');
            const iconEye = toggleBtn.querySelector('i'); // Select icon lucide di dalam

            // Toggle Show/Hide Password
            toggleBtn.addEventListener('click', () => {
                const type = pwdInput.getAttribute('type') === 'password' ? 'text' : 'password';
                pwdInput.setAttribute('type', type);

                // Ubah Icon (Perbaiki cara ganti icon Lucide)
                if(type === 'text') {
                    // Show Password -> Mata Terbuka Lebar (Peek Mode)
                    toggleBtn.innerHTML = '<i data-lucide="eye-off" class="w-5 h-5"></i>';
                    mascot.classList.remove('shy');
                    mascot.classList.add('peek');
                    // Reset pupil ke tengah saat peek
                    pupils.forEach(p => p.style.transform = `translate(-50%, -50%)`);
                } else {
                    // Hide Password -> Mode Malu jika sedang fokus
                    toggleBtn.innerHTML = '<i data-lucide="eye" class="w-5 h-5"></i>';
                    mascot.classList.remove('peek');
                    if(document.activeElement === pwdInput) {
                        mascot.classList.add('shy');
                    }
                }
                lucide.createIcons(); // Re-render icon baru
            });

            // Focus Logic
            pwdInput.addEventListener('focus', () => {
                // Hanya tutup mata jika password tersembunyi
                if(pwdInput.getAttribute('type') === 'password') {
                    mascot.classList.add('shy');
                }
            });

            pwdInput.addEventListener('blur', () => {
                mascot.classList.remove('shy');
            });

            /* 4. LOADING STATE ON SUBMIT */
            const form = document.getElementById('loginForm');
            const btn = document.getElementById('submitBtn');

            form.addEventListener('submit', () => {
                btn.classList.add('loading');
                btn.disabled = true;
            });

            /* 5. PARALLAX */
            const bg = document.getElementById('parallax-bg');
            document.addEventListener('mousemove', (e) => {
                const x = (window.innerWidth - e.pageX * 2) / 100;
                const y = (window.innerHeight - e.pageY * 2) / 100;
                bg.style.transform = `translate(${x}px, ${y}px)`;
            });

        });
    </script>
</x-guest-layout>