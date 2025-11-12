<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Luwihaja Hill</title>
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>
  <div class="d-flex">
    <x-sidebar></x-sidebar>

    <div class="main-content">
      <!-- Header -->
      <x-admin-header header="{{ $header }}"></x-admin-header>
    <!-- Isi Main Konten -->
      @yield('admin-content')
    </div>
  </div>
</body>
</html>
