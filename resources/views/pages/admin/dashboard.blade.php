<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - Luwihaja Hill</title>
  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
  <style>
    body {
      background-color: #f7f8fa;
      font-family: 'Poppins', sans-serif;
    }

    /* Sidebar */
    .sidebar {
      min-height: 100vh;
      background-color: #ffffff;
      border-right: 1px solid #e5e7eb;
      padding: 20px 0;
    }

    .sidebar .brand {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 40px;
      font-weight: 600;
      color: #1b4332;
    }

    .sidebar .nav-link {
      color: #6b7280;
      font-weight: 500;
      border-radius: 10px;
      padding: 10px 20px;
      margin: 5px 15px;
    }

    .sidebar .nav-link.active {
      background-color: #40723F;
      color: white;
    }

    .sidebar .nav-link:hover {
      background-color: #f1f5f9;
    }

    /* Main content */
    .main-content {
      flex-grow: 1;
      /* padding: 30px 40px; */
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
      background-color: #ffffff;
      padding: 20px;
    }

    .topbar h4 {
      font-weight: 600;
      color: #1f2937;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .profile img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .card-stat {
      border: none;
      border-radius: 15px;
      background-color: #fff;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      padding: 25px;
      text-align: center;
    }

    .card-stat h5 {
      font-size: 14px;
      color: #6b7280;
    }

    .card-stat h2 {
      font-weight: 700;
      color: #1b4332;
      margin-top: 10px;
    }

    .chart-card {
      background-color: #fff;
      border-radius: 15px;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
      padding: 25px;
      margin-top: 30px;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <x-sidebar></x-sidebar>
    <!-- Main Content -->
    <div class="main-content">
      <!-- Header -->
      <x-admin-header></x-admin-header>

      <div class="p-4">
      <!-- Statistik -->
      <div class="row g-4">
        <div class="col-md-4">
          <div class="card-stat">
            <h5>Total Kamar</h5>
            <h2>5</h2>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-stat">
            <h5>Total Reservasi</h5>
            <h2>7</h2>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card-stat">
            <h5>Total Ulasan</h5>
            <h2>6</h2>
          </div>
        </div>
      </div>

      <!-- Chart Placeholder -->
      <div class="chart-card mt-4">
        <h5>Total Reservasi</h5>
        <div class="mt-4" style="height: 300px; background-color: #f8f9fa; border-radius: 10px; display: flex; justify-content: center; align-items: center; color: #9ca3af;">
          <em>Area Grafik Chart.js di sini</em>
        </div>
      </div>
    </div>
    </div>
  </div>
</body>
</html>
