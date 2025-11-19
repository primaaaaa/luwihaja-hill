<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login - Luwihaja Hill</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
  <script src="{{ asset('js/auth.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <div class="left-section"
             style="--bg-image: url('https://www.rumah123.com/seo-cms/assets/Luwihaja_Hill_ea834e4998/Luwihaja_Hill_ea834e4998.jpg');">
            <div class="welcome-text">
                <h1>
                    Selamat Datang<br>
                    Kembali di<br>
                    <span class="highlight">Luwihaja Hill</span>
                </h1>
            </div>
        </div>

        <div class="right-section">
            <div class="form-container">
                <div class="form-header">
                    <h2>Login Akun</h2>
                    <h3>Luwihaja Hill</h3>
                </div>

                @if(session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form id="loginForm">
                    @csrf
                    <!-- EMAIL -->
                    <div class="input-group">
                        <div class="input-wrapper" id="emailWrapper">
                            <input type="email" id="email" name="email" placeholder="Email" required>
                            <span class="input-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                    <path d="M112 128C85.5 128 64 149.5 64 176C64 191.1 71.1 205.3 83.2 214.4L291.2 370.4C308.3 383.2 331.7 383.2 348.8 370.4L556.8 214.4C568.9 205.3 576 191.1 576 176C576 149.5 554.5 128 528 128L112 128zM64 260L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 260L377.6 408.8C343.5 434.4 296.5 434.4 262.4 408.8L64 260z"/>
                                </svg>
                            </span>
                        </div>
                        <div class="error-message" id="emailError">Anda belum mengisi field ini.</div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="input-group">
                        <div class="input-wrapper" id="passwordWrapper">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <span class="input-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                    <path d="M400 416C497.2 416 576 337.2 576 240C576 142.8 497.2 64 400 64C302.8 64 224 142.8 224 240C224 258.7 226.9 276.8 232.3 293.7L71 455C66.5 459.5 64 465.6 64 472L64 552C64 565.3 74.7 576 88 576L168 576C181.3 576 192 565.3 192 552L192 512L232 512C245.3 512 256 501.3 256 488L256 448L296 448C302.4 448 308.5 445.5 313 441L346.3 407.7C363.2 413.1 381.3 416 400 416zM440 160C462.1 160 480 177.9 480 200C480 222.1 462.1 240 440 240C417.9 240 400 222.1 400 200C400 177.9 417.9 160 440 160z"/>
                                </svg>
                            </span>
                        </div>
                        <div class="error-message" id="passwordError">Anda belum mengisi field ini.</div>
                    </div>

                    <button type="submit" class="btn" id="loginBtn">Login</button>
                </form>

                <div class="form-footer">
                    Belum mempunyai akun? <a href="{{ route('register') }}">Register</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>