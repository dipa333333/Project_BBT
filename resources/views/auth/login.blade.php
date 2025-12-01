<x-guest-layout>
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
            animation: splashFade 1s ease 2s forwards;
            pointer-events: none; /* Agar klik tembus saat fading */
        }

        .splash-logo {
            animation: splashAnim 1.5s ease-in-out infinite;
            filter: drop-shadow(0 0 15px rgba(255,255,255,0.8));
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
            width: 200%; /* Lebar ganda untuk looping mulus */
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

        /* --- CONTENT WRAPPER (CENTERED) --- */
        .main-wrapper {
            position: relative;
            z-index: 10;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-bottom: 20vh; /* Sedikit offset ke atas */
        }

        /* --- MASCOT --- */
        .mascot-container {
            position: relative;
            width: 150px; height: 150px;
            margin-bottom: 15px;
            border-radius: 50%;
            background: radial-gradient(circle, #ffffff 20%, #e9f8ff 70%, #bfe7ff 100%);
            box-shadow: 0 0 40px rgba(0, 155, 255, 0.4), inset 0 0 20px rgba(255,255,255,0.8);
            animation: float 4s ease-in-out infinite;
            display: flex; align-items: center; justify-content: center;
            transition: transform 0.3s;
        }

        .mascot-img {
            width: 70px; z-index: 2; pointer-events: none;
            position: relative; top: 10px; /* Adjust sesuai gambar asset */
        }

        .eyes-wrapper {
            position: absolute;
            top: 45%; left: 50%;
            transform: translate(-50%, -50%);
            width: 70px; height: 30px;
            display: flex; justify-content: space-between;
            z-index: 3;
        }

        .eye {
            width: 24px; height: 24px;
            background: white;
            border-radius: 50%;
            border: 2px solid #e1f4ff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .pupil {
            width: 10px; height: 10px;
            background: #004564;
            border-radius: 50%;
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            transition: transform 0.05s cubic-bezier(0.1, 0.1, 0.2, 1);
        }

        /* Efek Mata Menutup (Shy Mode) */
        .mascot-container.shy .eye {
            height: 4px; /* Mata menyipit/tutup */
            margin-top: 10px;
            transition: 0.2s;
        }
        .mascot-container.shy .pupil { opacity: 0; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        /* --- LOGIN FORM --- */
        .login-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            padding: 30px 40px;
            width: 90%;
            max-width: 400px;
            text-align: center;
            color: white;
            box-shadow: 0 15px 35px rgba(0, 60, 100, 0.2);
            transform: translateY(0);
            transition: transform 0.3s;
        }

        .login-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255,255,255,0.5);
        }

        h2 { margin: 0 0 5px; text-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        p { margin-bottom: 25px; font-size: 0.95rem; opacity: 0.85; }

        .input-group { position: relative; margin-bottom: 16px; text-align: left; }

        .input-field {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.2);
            border-radius: 12px;
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: all 0.3s;
            box-sizing: border-box; /* Penting agar padding tidak jebol */
        }

        .input-field::placeholder { color: rgba(255,255,255,0.6); }

        .input-field:focus {
            background: rgba(255,255,255,0.3);
            border-color: #fff;
            box-shadow: 0 0 15px rgba(255,255,255,0.3);
        }

        .error-msg {
            color: #ffcccc;
            font-size: 0.8rem;
            margin-top: 4px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .login-btn {
            width: 100%;
            margin-top: 10px;
            padding: 14px;
            background: linear-gradient(135deg, #00C6FF, #0072FF);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 114, 255, 0.4);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 114, 255, 0.6);
        }

        .login-btn:active { transform: scale(0.98); }

        .forgot-link {
            display: inline-block;
            margin-top: 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .forgot-link:hover { color: #fff; text-decoration: underline; }

    </style>

    <div id="splash">
        <img src="{{ asset('assets/login/water-meter.svg') }}" class="splash-logo w-32">
    </div>

    <div class="water-bg" id="parallax-bg">
        <div id="bubble-container"></div>
        <img src="{{ asset('assets/login/wave1.svg') }}" class="wave wave3"> <img src="{{ asset('assets/login/wave2.svg') }}" class="wave wave2">
        <img src="{{ asset('assets/login/wave1.svg') }}" class="wave wave1"> </div>

    <div class="main-wrapper">

        <div class="mascot-container" id="mascot">
            <img src="{{ asset('assets/login/water-meter.svg') }}" class="mascot-img">

            <div class="eyes-wrapper">
                <div class="eye"><div class="pupil"></div></div>
                <div class="eye"><div class="pupil"></div></div>
            </div>
        </div>

        <div class="login-card">
            <h2 class="text-3xl font-bold">Welcome Back!</h2>
            <p>Smart Meter Dashboard</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <input type="email" name="email" class="input-field" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-group">
                    <input type="password" name="password" id="passwordInput" class="input-field" placeholder="Password" required>
                    @error('password')
                        <div class="error-msg">{{ $message }}</div>
                    @enderror
                </div>

                <button class="login-btn">MASUK SEKARANG</button>

                <div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Lupa Password?</a>
                    @endif
                </div>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            /* 1. BUBBLE GENERATOR */
            const bubbleContainer = document.getElementById("bubble-container");
            function createBubble() {
                const b = document.createElement("div");
                b.className = "bubble";
                // Random posisi horizontal & ukuran
                const size = Math.random() * 15 + 8; // 8px - 23px
                b.style.left = Math.random() * 100 + "%";
                b.style.width = size + "px";
                b.style.height = size + "px";
                b.style.animationDuration = (Math.random() * 5 + 4) + "s"; // 4s - 9s
                b.style.filter = `blur(${Math.random()}px)`; // Sedikit blur random

                bubbleContainer.appendChild(b);

                // Hapus elemen setelah animasi selesai agar DOM tidak berat
                setTimeout(() => b.remove(), 9000);
            }
            // Buat bubble baru setiap 400ms
            setInterval(createBubble, 400);


            /* 2. EYE TRACKING (Improved Math) */
            const eyes = document.querySelectorAll('.eye');
            const pupils = document.querySelectorAll('.pupil');

            // Batas pergerakan pupil (dalam pixel)
            const maxMove = 7;

            document.addEventListener('mousemove', (e) => {
                // Jika sedang mengetik password (mode shy), pupil tidak bergerak
                if(document.getElementById('mascot').classList.contains('shy')) return;

                eyes.forEach((eye, index) => {
                    const pupil = pupils[index];

                    // Dapatkan koordinat tengah mata (bukan pupil)
                    const rect = eye.getBoundingClientRect();
                    const eyeCenterX = rect.left + rect.width / 2;
                    const eyeCenterY = rect.top + rect.height / 2;

                    // Hitung sudut kursor mouse terhadap tengah mata
                    const angle = Math.atan2(e.clientY - eyeCenterY, e.clientX - eyeCenterX);

                    // Hitung jarak (distance), tapi batasi maksimal (clamping)
                    // Agar pupil tidak keluar dari mata
                    const dist = Math.min(maxMove, Math.hypot(e.clientX - eyeCenterX, e.clientY - eyeCenterY) / 15);

                    // Konversi polar ke cartesian
                    const x = Math.cos(angle) * dist;
                    const y = Math.sin(angle) * dist;

                    pupil.style.transform = `translate(-50%, -50%) translate(${x}px, ${y}px)`;
                });
            });


            /* 3. INTERAKSI PASSWORD (SHY MODE) */
            const pwdInput = document.getElementById('passwordInput');
            const mascot = document.getElementById('mascot');

            // Saat klik/fokus di password -> Maskot tutup mata
            pwdInput.addEventListener('focus', () => {
                mascot.classList.add('shy');
            });

            // Saat keluar dari password -> Maskot buka mata
            pwdInput.addEventListener('blur', () => {
                mascot.classList.remove('shy');
                // Reset posisi pupil ke tengah sesaat
                pupils.forEach(p => p.style.transform = `translate(-50%, -50%)`);
            });


            /* 4. PARALLAX EFFECT (Background Only) */
            const bg = document.getElementById('parallax-bg');
            document.addEventListener('mousemove', (e) => {
                const x = (window.innerWidth - e.pageX * 2) / 100;
                const y = (window.innerHeight - e.pageY * 2) / 100;

                // Gerakkan background sedikit berlawanan arah mouse
                bg.style.transform = `translate(${x}px, ${y}px)`;
            });

        });
    </script>
</x-guest-layout>