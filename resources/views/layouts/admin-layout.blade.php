<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Luwihaja Hill</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
  
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  
  <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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