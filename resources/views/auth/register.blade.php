<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Luwihaja Hill</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  {{-- @vite(entrypoints: ['resources/css/auth.css', 'resources/js/auth.js']) --}}
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <script src="{{ asset('js/auth.js') }}" defer></script></head>
<body>
  <div class="container">
    <div class="left-section"
      style="--bg-image: url('https://www.rumah123.com/seo-cms/assets/Luwihaja_Hill_ea834e4998/Luwihaja_Hill_ea834e4998.jpg');">
      <div class="welcome-text">
        <h1>
          Nikmati Suasana Tepi Sungai di<br>
          <span class="highlight">Luwihaja Hill</span>
        </h1>
      </div>
    </div>

    <div class="right-section">
      <div class="form-container">
        <div class="form-header">
          <h2>Daftar Akun</h2>
          <h3>Luwihaja Hill</h3>
        </div>

        <form id="registerForm">
          <div class="input-group">
            <div class="input-wrapper" id="nameWrapper">
              <input type="text" id="name" placeholder="Nama lengkap" required>
              <span class="input-icon" aria-hidden="true">
                <svg viewBox="0 0 640 640" xmlns="http://www.w3.org/2000/svg">
                  <path d="M320 352c88.4 0 160-71.6 160-160S408.4 32 320 32 160 103.6 160 192s71.6 160 160 160zm0 48C203.1 400 64 439.1 64 544v32a32 32 0 0 0 32 32h448a32 32 0 0 0 32-32v-32c0-104.9-139.1-144-256-144z"/>
                </svg>
              </span>
            </div>
            <div class="error-message" id="nameError">Nama wajib diisi.</div>
          </div>

          <div class="input-group" id="phoneGroup">
            <div class="input-wrapper" id="phoneWrapper">
              <input type="tel" id="phone" placeholder="No. Telepon" required>
              <span class="input-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor">
                  <path d="M224.2 89C216.3 70.1 195.7 60.1 176.1 65.4L170.6 66.9C106 84.5 50.8 147.1 66.9 223.3C104 398.3 241.7 536 416.7 573.1C493 589.3 555.5 534 573.1 469.4L574.6 463.9C580 444.2 569.9 423.6 551.1 415.8L453.8 375.3C437.3 368.4 418.2 373.2 406.8 387.1L368.2 434.3C297.9 399.4 241.3 341 208.8 269.3L253 233.3C266.9 222 271.6 202.9 264.8 186.3L224.2 89z"/>
                </svg>
              </span>
            </div>
            <div class="error-message" id="phoneError">No. telepon wajib diisi.</div>
          </div>

          <div class="input-group">
            <div class="input-wrapper" id="emailWrapper">
              <input type="email" id="email" placeholder="Email" required>
              <span class="input-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                  <path d="M112 128C85.5 128 64 149.5 64 176C64 191.1 71.1 205.3 83.2 214.4L291.2 370.4C308.3 383.2 331.7 383.2 348.8 370.4L556.8 214.4C568.9 205.3 576 191.1 576 176C576 149.5 554.5 128 528 128L112 128zM64 260L64 448C64 483.3 92.7 512 128 512L512 512C547.3 512 576 483.3 576 448L576 260L377.6 408.8C343.5 434.4 296.5 434.4 262.4 408.8L64 260z"/>
                </svg>
              </span>
            </div>
            <div class="error-message" id="emailError">Email wajib diisi.</div>
          </div>

          <div class="input-group">
            <div class="input-wrapper" id="passwordWrapper">
              <input type="password" id="password" placeholder="Password" required>
              <span class="input-icon" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                  <path d="M400 416C497.2 416 576 337.2 576 240C576 142.8 497.2 64 400 64C302.8 64 224 142.8 224 240C224 258.7 226.9 276.8 232.3 293.7L71 455C66.5 459.5 64 465.6 64 472L64 552C64 565.3 74.7 576 88 576L168 576C181.3 576 192 565.3 192 552L192 512L232 512C245.3 512 256 501.3 256 488L256 448L296 448C302.4 448 308.5 445.5 313 441L346.3 407.7C363.2 413.1 381.3 416 400 416zM440 160C462.1 160 480 177.9 480 200C480 222.1 462.1 240 440 240C417.9 240 400 222.1 400 200C400 177.9 417.9 160 440 160z"/>
                </svg>
              </span>
            </div>
            <div class="error-message" id="passwordError">Password wajib diisi.</div>
          </div>

          <button type="submit" class="btn">Register</button>
        </form>

        <div class="form-footer">
          Sudah mempunyai akun? <a href="/login">Login</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
