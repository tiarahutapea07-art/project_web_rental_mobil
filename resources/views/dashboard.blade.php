@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Dashboard Overview</h1>

<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Armada</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMobil }} Unit</div>
                    </div>
                    <div class="col-auto pr-4"><i class="fas fa-car fa-2x text-gray-30"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Mobil Tersedia</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mobilTersedia }} Unit</div>
                    </div>
                    <div class="col-auto pr-4"><i class="fas fa-check-circle fa-2x text-gray-30"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Mobil Sedang Disewa</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $mobilDisewa }} Unit</div>
                    </div>
                    <div class="col-auto pr-4"><i class="fas fa-handshake fa-2x text-gray-30"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== NEW: PAYMENT STATUS CARDS ===== -->
<div class="row">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pembayaran Lunas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pembayaranLunas }} Transaksi</div>
                    </div>
                    <div class="col-auto pr-4"><i class="fas fa-check-circle fa-2x text-success"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Menunggu Konfirmasi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pembayaranMenunggu }} Transaksi</div>
                    </div>
                    <div class="col-auto pr-4"><i class="fas fa-clock fa-2x text-warning"></i></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Belum Lunas</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pembayaranBelum }} Transaksi</div>
                    </div>
                    <div class="col-auto pr-4"><i class="fas fa-exclamation-triangle fa-2x text-danger"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===== NEW: MONTHLY STATISTICS SECTION ===== -->
<div class="row mt-5">
    <!-- Monthly Transactions Chart -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 10px; overflow: hidden;">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="m-0 font-weight-bold" style="color: #3b82f6;">Monthly Transactions</h6>
                <p class="text-muted small mt-1 mb-0">Total transactions for {{ date('Y') }}</p>
            </div>
            <div class="card-body p-4">
                <div style="position: relative; height: 320px;">
                    <canvas id="transactionChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue Chart -->
    <div class="col-xl-6 col-md-12 mb-4">
        <div class="card border-0 shadow-sm" style="border-radius: 10px; overflow: hidden;">
            <div class="card-header bg-white border-0 pt-4 px-4">
                <h6 class="m-0 font-weight-bold" style="color: #3b82f6;">Monthly Revenue (IDR)</h6>
                <p class="text-muted small mt-1 mb-0">Revenue collection for {{ date('Y') }}</p>
            </div>
            <div class="card-body p-4">
                <div style="position: relative; height: 320px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>

<script>
    // Data from Laravel controller
    const transactionDbData = @json($transactionData);
    const revenueDbData = @json($revenueData);

    const monthLabels = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];

    // ===== TRANSACTIONS LINE CHART =====
    const transactionCtx = document.getElementById('transactionChart').getContext('2d');
    new Chart(transactionCtx, {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Transactions Count',
                data: transactionDbData,
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: { size: 13 },
                    bodyFont: { size: 12 },
                    borderColor: '#3b82f6',
                    borderWidth: 1
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { size: 11 },
                        color: '#6b7280'
                    },
                    grid: {
                        color: 'rgba(107, 114, 128, 0.1)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: { size: 11 },
                        color: '#6b7280'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });

    // ===== REVENUE BAR CHART =====
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Revenue (IDR)',
                data: revenueDbData,
                backgroundColor: '#3b82f6',
                borderColor: '#1e40af',
                borderWidth: 1,
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 12,
                    titleFont: { size: 13 },
                    bodyFont: { size: 12 },
                    borderColor: '#3b82f6',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed.y;
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { size: 11 },
                        color: '#6b7280',
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(0) + 'M';
                        }
                    },
                    grid: {
                        color: 'rgba(107, 114, 128, 0.1)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        font: { size: 11 },
                        color: '#6b7280'
                    },
                    grid: {
                        display: false,
                        drawBorder: false
                    }
                }
            }
        }
    });
</script>

@endpush
