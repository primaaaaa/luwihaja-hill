@extends('layouts.admin-layout')
@props(['header' => 'Dashboard'])
@section('admin-content')
 <div class="p-4">
    <div class="stats-container">
        <x-stat-card title="Total Kamar" :jumlah="$jml_kamar"></x-stat-card>
        <x-stat-card title="Total Reservasi" :jumlah="$jml_reservasi"></x-stat-card>
        <x-stat-card title="Total Ulasan" :jumlah="$jml_ulasan"></x-stat-card>
    </div>

    <div class="chart-container">
        <h3 class="chart-title">Total Reservasi (7 Hari Terakhir)</h3>
        <div class="chart-wrapper">
            <canvas id="reservasiChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('reservasiChart');
    
    const dataChart = @json($dataChart);
    const labels = @json($labels);
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Reservasi',
                data: dataChart,
                backgroundColor: '#40723F',
                borderRadius: 4,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        usePointStyle: true,
                        pointStyle: 'circle',
                        padding: 20,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(context) {
                            return 'Reservasi: ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            size: 11
                        },
                        color: '#666',
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                        }
                    },
                    grid: {
                        color: '#f0f0f0',
                        drawBorder: false
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 10
                        },
                        color: '#666',
                        maxRotation: 45,
                        minRotation: 45
                    }
                }
            }
        }
    });
});
</script>

@endsection