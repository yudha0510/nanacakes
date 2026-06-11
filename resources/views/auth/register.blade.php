<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar – NanaCakes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,400&family=Lato:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body { height: 100%; font-family: 'Lato', sans-serif; }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(160deg,
                #3b1a0a 0%, #6b2d0f 30%, #8b4513 55%,
                #c47a3a 75%, #e8b87a 90%, #f5deb3 100%
            );
            position: relative;
            overflow-x: hidden;
            padding: 40px 16px;
        }

        .glow { position: fixed; border-radius: 50%; pointer-events: none; }
        .glow-1 { width:600px;height:600px;top:-150px;left:-150px;background:radial-gradient(circle,rgba(255,240,210,0.12),transparent 70%); }
        .glow-2 { width:400px;height:400px;bottom:-100px;right:-80px;background:radial-gradient(circle,rgba(255,220,150,0.10),transparent 70%); }

        .sprinkle { position:fixed;border-radius:4px;pointer-events:none;opacity:0.20; }

        .back-link {
            position: fixed;
            top: 24px; left: 28px;
            z-index: 20;
            color: rgba(255,235,185,0.7);
            text-decoration: none;
            font-size: 13px;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s;
        }
        .back-link:hover { color: #fff8ee; }
        .back-link svg { width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round; }

        .card {
            position: relative;
            z-index: 10;
            width: 90%;
            max-width: 460px;
            background: rgba(255,245,225,0.11);
            border: 1px solid rgba(255,235,190,0.22);
            border-radius: 24px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            padding: 44px 40px 40px;
            box-shadow: 0 20px 80px rgba(60,20,0,0.45);
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            color: #fff8ee;
            text-align: center;
            line-height: 1;
            margin-bottom: 4px;
            text-shadow: 0 2px 20px rgba(180,90,20,0.45);
        }
        .subtitle {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: 14px;
            color: #f5d9a8;
            text-align: center;
            margin-bottom: 26px;
        }
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 26px;
        }
        .divider hr { flex:1;border:none;border-top:1px solid rgba(255,220,150,0.25); }
        .divider span { font-size:16px; }

        .field { margin-bottom: 18px; }

        label.field-label {
            display: block;
            font-size: 11px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(245,220,170,0.7);
            margin-bottom: 7px;
        }

        .input-wrap { position: relative; }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            background: rgba(255,240,210,0.08);
            border: 1px solid rgba(255,220,150,0.25);
            border-radius: 10px;
            padding: 12px 42px 12px 16px;
            color: #fff8ee;
            font-size: 15px;
            font-family: 'Lato', sans-serif;
            outline: none;
            transition: border-color 0.2s, background 0.2s;
            caret-color: #f5d9a8;
        }
        input::placeholder { color: rgba(245,220,170,0.30); }
        input:focus {
            border-color: rgba(255,200,100,0.55);
            background: rgba(255,240,210,0.13);
        }

        /* Phone field has flag prefix */
        .phone-wrap { display: flex; gap: 8px; }
        .phone-prefix {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,240,210,0.08);
            border: 1px solid rgba(255,220,150,0.25);
            border-radius: 10px;
            padding: 12px 14px;
            color: #f5d9a8;
            font-size: 14px;
            white-space: nowrap;
            flex-shrink: 0;
        }
        .phone-wrap input[type="tel"] { flex: 1; padding-right: 16px; }

        .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(245,220,170,0.38);
            pointer-events: none;
        }
        .input-icon svg { width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:1.8;stroke-linecap:round;stroke-linejoin:round; }

        .error-msg {
            margin-top: 6px;
            font-size: 12px;
            color: #ffaaaa;
        }

        .btn-register {
            width: 100%;
            background: linear-gradient(135deg, #c47a3a, #e09040);
            color: #fff8ee;
            font-family: 'Lato', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            padding: 15px;
            border-radius: 50px;
            border: 1px solid rgba(255,200,120,0.35);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 24px rgba(180,90,20,0.38);
            margin-top: 10px;
        }
        .btn-register:hover { transform:translateY(-2px);box-shadow:0 8px 32px rgba(180,90,20,0.55); }
        .btn-register:active { transform:scale(0.97); }

        .login-row {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: rgba(245,220,170,0.5);
        }
        .login-row a {
            color: rgba(245,220,170,0.85);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }
        .login-row a:hover { color: #fff8ee; }
    </style>
</head>
<body>

    <div class="glow glow-1"></div>
    <div class="glow glow-2"></div>
    <div id="sprinkles"></div>

    <a href="{{ route('login') }}" class="back-link">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali ke Login
    </a>

    <div class="card">

        <div class="logo">NanaCakes</div>
        <div class="subtitle">Buat akun untuk mulai memesan</div>

        <div class="divider">
            <hr><span>🍰</span><hr>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Nama --}}
            <div class="field">
                <label class="field-label" for="name">Nama Lengkap</label>
                <div class="input-wrap">
                    <input
                        id="name" type="text" name="name"
                        value="{{ old('name') }}"
                        placeholder="Nama kamu"
                        required autofocus autocomplete="name"
                    >
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                    </span>
                </div>
                @error('name')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="field">
                <label class="field-label" for="email">Email</label>
                <div class="input-wrap">
                    <input
                        id="email" type="email" name="email"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        required autocomplete="username"
                    >
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><polyline points="2,4 12,13 22,4"/></svg>
                    </span>
                </div>
                @error('email')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nomor HP -->
            <div class="mt-4">
                <label class="field-label" for="password">Nomor HP</label>
                <x-text-input id="phone"
                            class="block mt-1 w-full"
                            type="text"
                            name="phone"
                            :value="old('phone')"
                            required />

                <x-input-error :messages="$errors->get('phone')"
                            class="mt-2" />
            </div>

                
            {{-- Password --}}
            <div class="field">
                <label class="field-label" for="password">Password</label>
                <div class="input-wrap">
                    <input
                        id="password" type="password" name="password"
                        placeholder="••••••••"
                        required autocomplete="new-password"
                    >
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </span>
                </div>
                @error('password')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="field">
                <label class="field-label" for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrap">
                    <input
                        id="password_confirmation" type="password"
                        name="password_confirmation"
                        placeholder="••••••••"
                        required autocomplete="new-password"
                    >
                    <span class="input-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/><path d="M9 16l2 2 4-4"/></svg>
                    </span>
                </div>
                @error('password_confirmation')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn-register">Daftar Sekarang</button>

            <p class="login-row">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </p>

        </form>
    </div>

    <script>
        const colors = ['#e07030','#d4a030','#c85050','#9b4fc8','#3a8fc8','#5aaa5a','#e06090'];
        const wrap = document.getElementById('sprinkles');
        for (let i = 0; i < 35; i++) {
            const s = document.createElement('div');
            s.className = 'sprinkle';
            s.style.cssText = `
                left:${Math.random()*100}%;
                top:${Math.random()*100}%;
                width:${6+Math.random()*10}px;
                height:${3+Math.random()*3}px;
                background:${colors[Math.floor(Math.random()*colors.length)]};
                transform:rotate(${Math.random()*360}deg);
            `;
            wrap.appendChild(s);
        }
    </script>

</body>
</html>