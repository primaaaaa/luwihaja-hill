@extends('layouts.app')

@section('title', ' Riwayat Reservasi | Luwihaja Hill')

@section('content')


<!-- Hero -->
<section class="hero">
    <div class="overlay"></div>
    <div class="hero-inner">
        <h1>Riwayat <span class="accent">Reservasi</span></h1>
        <p>Lihat kembali pemesanan villa yang sudah Anda lakukan, termasuk status pembayaran dan detail perjalanan Anda
            sebelumnya.</p>
    </div>
</section>

<!-- Table Section -->
<section class="table-section">
    <div class="container">
        <!-- Header with Title and Search -->
        <div class="section-header">
            <h2 class="section-title">Daftar Reservasi Saya</h2>

            <div class="search-wrapper">
                <div class="search-box-riwayat">
                    <input type="text" id="searchInput" placeholder="Cari reservasi...">
                    <span class="search-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                            <path d="M20 20L17 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Tamu</th>
                        <th>Kode Reservasi</th>
                        <th>Tanggal Check-in</th>
                        <th>Tanggal Check-out</th>
                        <th>Kode Kamar</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td>Rafi</td>
                        <td>V101</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>K101</td>
                        <td><span class="badge badge-success">Konfirmasi</span></td>
                    </tr>
                    <tr>
                        <td>Rafi</td>
                        <td>V101</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>K102</td>
                        <td><span class="badge badge-success">Konfirmasi</span></td>
                    </tr>
                    <tr>
                        <td>Rafi</td>
                        <td>V101</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>K103</td>
                        <td><span class="badge badge-danger">Dibatalkan</span></td>
                    </tr>
                    <tr>
                        <td>Rafi</td>
                        <td>V101</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>K104</td>
                        <td><span class="badge badge-success">Konfirmasi</span></td>
                    </tr>
                    <tr>
                        <td>Rafi</td>
                        <td>V101</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>K104</td>
                        <td><span class="badge badge-success">Konfirmasi</span></td>
                    </tr>
                    <tr>
                        <td>Rafi</td>
                        <td>V101</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>K105</td>
                        <td><span class="badge badge-danger">Dibatalkan</span></td>
                    </tr>
                    <tr>
                        <td>Rafi</td>
                        <td>V101</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>K106</td>
                        <td><span class="badge badge-danger">Dibatalkan</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            <div class="pagination-info">Menampilkan data 1 sampai 8 dari 20 data</div>
            <div class="pagination">
                <button disabled>‹</button>
                <button class="active">1</button>
                <button>2</button>
                <button>3</button>
                <button>›</button>
            </div>
        </div>
    </div>
</section>

<script>
    // Mobile menu toggle
      const hamburger = document.querySelector('.hamburger');
      const nav = document.querySelector('.nav-menu');

      hamburger.addEventListener('click', () => {
        nav.classList.toggle('open');
      });

      // Close menu when clicking on a link
      const navLinks = document.querySelectorAll('.nav-menu a');
      navLinks.forEach(link => {
        link.addEventListener('click', () => {
          nav.classList.remove('open');
        });
      });

      // Search functionality
      const searchInput = document.getElementById('searchInput');
      const tableBody = document.getElementById('tableBody');
      const rows = tableBody.querySelectorAll('tr');

      searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        rows.forEach(row => {
          const text = row.textContent.toLowerCase();
          if (text.includes(searchTerm)) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
</script>

@endsection