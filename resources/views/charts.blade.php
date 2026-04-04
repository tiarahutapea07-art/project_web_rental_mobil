@extends('layouts.admin')

@section('content')
<h1 class="h3 mb-4 text-gray-800">Charts</h1>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-8">
        <!-- Area Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Area Chart Example</h6>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
                <hr>
                Styling for the area chart has been moved to a separate file for cleanliness and
                organization. It can be found within the template at
                <code>/sbadmin2/css/demo/chart-area-demo.css</code>.
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Pie Chart -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pie Chart Example</h6>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <hr>
                Styling for the pie chart has been moved to a separate file for cleanliness and
                organization. It can be found within the template at
                <code>/sbadmin2/css/demo/chart-pie-demo.css</code>.
            </div>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="{{ asset('sbadmin2/vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('sbadmin2/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('sbadmin2/js/demo/chart-pie-demo.js') }}"></script>
@endsection
