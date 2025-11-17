@extends('layouts.admin-layout')
@props(['header' => 'Dashboard'])
@section('admin-content')
 <div class="p-4">
    <div class="stats-container">
        <x-stat-card title="Total Kamar" :jumlah="10"></x-stat-card>
        <x-stat-card title="Total Reservasi" :jumlah="5"></x-stat-card>
        <x-stat-card title="Total Ulasan" :jumlah="4"></x-stat-card>
    </div>

    <div class="chart-container">
        <h3 class="chart-title">Total Reservasi</h3>
        <div class="chart-wrapper">
            <canvas id="reservasiChart"></canvas>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('reservasiChart');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Online Sales',
                data: [14, 17, 7, 15, 12, 16, 20],
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
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 25,
                    ticks: {
                        stepSize: 5,
                        font: {
                            size: 11
                        },
                        color: '#666'
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
                            size: 11
                        },
                        color: '#666'
                    }
                }
            }
        }
    });
});
</script>

@endsection