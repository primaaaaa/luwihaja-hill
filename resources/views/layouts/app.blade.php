<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Luwihaja Hill')</title>

  {{-- Fonts & Icons --}}
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  {{-- Global CSS --}}
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
  {{-- HEADER --}}
  <svg style="display:none;">
    @include('partials.icons')
  </svg>
  @include('partials.header')

  {{-- HALAMAN SPESIFIK --}}
  <main>
    @yield('content')
  </main>

  {{-- FOOTER --}}
  @include('partials.footer')
</body>

</html>