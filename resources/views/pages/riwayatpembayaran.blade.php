@extends('layouts.app')

@section('title', ' Riwayat Pembayaran | Luwihaja Hill')

@section('content')

<!-- Hero -->
<section class="hero">
    <div class="overlay"></div>
    <div class="hero-inner">
        <h1>Riwayat <span class="accent">Pembayaran</span></h1>
        <p>Kelola dan pantau seluruh transaksi Anda di sini. Pastikan semua reservasi tercatat dengan jelas dan aman.
        </p>
    </div>

</section>

<!-- Table Section -->
<section class="table-section">
    <div class="container">
        <!-- Header with Title and Search -->
        <div class="section-header">
            <h2 class="section-title">Daftar Pengajuan Refund</h2>

            <div class="search-wrapper">
                <div class="search-box-riwayat">
                    <input type="text" id="searchInput" placeholder="Cari pengajuan refund...">
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
                        <th>Aksi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td>Alhamid A..</td>
                        <td>V101</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>
                            <button class="btn-refund">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" />
                                </svg>
                                Buat Pengajuan Refund
                            </button>
                        </td>
                        <td><span class="badge badge-warning">Tidak ada</span></td>
                    </tr>
                    <tr>
                        <td>Alhamid A..</td>
                        <td>V102</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>
                            <button class="btn-refund">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" />
                                </svg>
                                Buat Pengajuan Refund
                            </button>
                        </td>
                        <td><span class="badge badge-success">Disetujui</span></td>
                    </tr>
                    <tr>
                        <td>Alhamid A..</td>
                        <td>V103</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>
                            <button class="btn-refund">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" />
                                </svg>
                                Buat Pengajuan Refund
                            </button>
                        </td>
                        <td><span class="badge badge-danger">Ditolak</span></td>
                    </tr>
                    <tr>
                        <td>Alhamid A..</td>
                        <td>V104</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>
                            <button class="btn-refund">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" />
                                </svg>
                                Buat Pengajuan Refund
                            </button>
                        </td>
                        <td><span class="badge badge-success">Disetujui</span></td>
                    </tr>
                    <tr>
                        <td>Alhamid A..</td>
                        <td>V105</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>
                            <button class="btn-refund">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" />
                                </svg>
                                Buat Pengajuan Refund
                            </button>
                        </td>
                        <td><span class="badge badge-success">Disetujui</span></td>
                    </tr>
                    <tr>
                        <td>Alhamid A..</td>
                        <td>V106</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>
                            <button class="btn-refund">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" />
                                </svg>
                                Buat Pengajuan Refund
                            </button>
                        </td>
                        <td><span class="badge badge-danger">Ditolak</span></td>
                    </tr>
                    <tr>
                        <td>Alhamid A..</td>
                        <td>V107</td>
                        <td>2025-09-12</td>
                        <td>2025-09-14</td>
                        <td>
                            <button class="btn-refund">
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2.5"
                                        stroke-linecap="round" />
                                </svg>
                                Buat Pengajuan Refund
                            </button>
                        </td>
                        <td><span class="badge badge-danger">Ditolak</span></td>
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