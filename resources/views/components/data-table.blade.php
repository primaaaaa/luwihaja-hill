@props([
    'title' => 'Data Table', 
    'headers' => [], 
    'addButton' => true, 
    'exportButton' => false,
    'addRoute' => '#', 
    'filterOptions' => []
])

<div class="table-container">
    <h5 class="table-title">{{ $title }}</h5>
    
    <div class="table-header">
        <div class="search-box">
            <i class="bi bi-search"></i>
            <input type="text" class="form-control search-input" placeholder="Search here...">
        </div>
        
        <div class="table-actions">
            @if(!empty($filterOptions))
            <div class="dropdown">
                <button class="btn dropdown-toggle filter-btn" type="button" data-bs-toggle="dropdown">
                    Tampilkan Semua
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Semua</a></li>
                    @foreach($filterOptions as $option)
                        <li><a class="dropdown-item" href="#">{{ $option }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($exportButton)
            <button class="btn btn-export">
                <i class="bi bi-file-earmark-arrow-down"></i> Ekspor Laporan
            </button>
            @endif

            @if($addButton)
            <button class="btn btn-success btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
                <i class="bi bi-plus-lg"></i> Tambah Data
            </button>
            @endif
        </div>
    </div>

    <!-- Table -->
    <div class="table-responsive">
        <table class="table custom-table">
            <thead>
                <tr>
                    @foreach($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>

    <div class="table-footer">
        <p class="pagination-info">Menampilkan data 1 sampai 5 dari 5 data</p>
        <nav>
            <ul class="pagination custom-pagination">
                <li class="page-item disabled">
                    <a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item">
                    <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>