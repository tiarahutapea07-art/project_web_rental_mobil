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

<div class="row">

    <!-- Grafik -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Grafik Penyewaan 12 Bulan Terakhir
                </h6>
            </div>
            <div class="card-body">
                <canvas id="chartSewa"></canvas>
            </div>
        </div>
    </div>

    <!-- Ranking -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    Mobil Paling Laku
                </h6>
            </div>
            <div class="card-body">

                @foreach($topMobil as $item)
                <h4 class="small font-weight-bold">
                    {{ $item['nama'] }}
                    <span class="float-right">{{ $item['jumlah'] }}x</span>
                </h4>

                <div class="progress mb-3">
                    <div class="progress-bar bg-success"
                         style="width: {{ $item['jumlah'] * 4 }}%">
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('chartSewa');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'],
        datasets: [{
            label: 'Jumlah Penyewaan',
            data: @json($grafikSewa),
            borderWidth: 3,
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true
    }
});
</script>
@endsection