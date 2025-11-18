@php
                $statusClass = match($room['status']) {
                'Nonaktif' => 'badge-nonaktif',
                'Tersedia' => 'badge-tersedia',
                'Terisi' => 'badge-terisi',
                'Dipesan' => 'badge-dipesan',
                default => 'badge-tersedia'
                };
                @endphp

                <!-- Status Dropdown -->
                <div class="dropdown">
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" type="button"
                        data-bs-toggle="dropdown">
                        {{ $room['status'] }}
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Nonaktif</a></li>
                        <li><a class="dropdown-item" href="#">Tersedia</a></li>
                        <li><a class="dropdown-item" href="#">Terisi</a></li>
                        <li><a class="dropdown-item" href="#">Dipesan</a></li>
                    </ul>
                </div>