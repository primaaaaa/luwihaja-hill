@props([
    'title' => 'Data Table', 
    'headers' => [], 
    'addButton' => true, 
    'exportButton' => false,
    'exportRoute' => null,  // TAMBAH INI
    'addRoute' => '#', 
    'filterOptions' => [],
    'data' => null
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
                    <li><a class="dropdown-item filter-item" href="#" data-filter="Semua">Semua</a></li>
                    @foreach($filterOptions as $option)
                        <li><a class="dropdown-item filter-item" href="#" data-filter="{{ $option }}">{{ $option }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($exportButton && $exportRoute)
            <a href="{{ $exportRoute }}" class="btn btn-export">
                <i class="bi bi-file-earmark-arrow-down"></i> Ekspor Laporan
            </a>
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
        @if($data && method_exists($data, 'total'))
        <p class="pagination-info">
            Menampilkan {{ $data->firstItem() ?? 0 }} sampai {{ $data->lastItem() ?? 0 }} dari {{ $data->total() }} data
        </p>
        <nav>
            <ul class="pagination custom-pagination">
                {{-- Previous Button --}}
                @if ($data->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a>
                    </li>
                @endif

                {{-- Page Numbers --}}
                @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                {{-- Next Button --}}
                @if ($data->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $data->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                    </li>
                @endif
            </ul>
        </nav>
        @else
        <p class="pagination-info">Menampilkan semua data</p>
        @endif
    </div>
</div>