@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Cargos') }}</h5>
                                    <p class="h2 font-weight-bold mb-0">
                                        <span class="MXN" id="totalMXN">0.00</span>
                                        <span class="USD" style="display: none" id="totalUSD">0.00</span>
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-pink text-white rounded-circle shadow">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Abonos') }}</h5>
                                    <p id="total-amount-due-insurance" class="h2 font-weight-bold mb-0">
                                        <span class="MXN" id="totalPaidMXN">$0.00</span>
                                        <span class="USD" style="display: none" id="totalPaidUSD">$0.00</span>
                                        <span class="text-success mr-2" id="totalPaidPercentage">0.00%</span>
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Saldo') }}
                                    </h5>
                                    <p id="total-amount-paid" class="h2 font-weight-bold mb-0">
                                        <span class="MXN" id="totalDueMXN">$0.00</span>
                                        <span class="USD" style="display: none" id="totalDueUSD">$0.00</span>
                                        <span class="text-yellow mr-2" id="totalDuePercentage">0.00%</span></p>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card bg-gradient-default shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Reporte</h6>
                            <h2 class="text-white mb-0" id="period">Periodo</h2>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0">
                                    <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                        <span class="d-none d-md-block">Mes</span>
                                        <span class="d-md-none">M</span>
                                    </a>
                                </li>
                                <li class="nav-item" data-toggle="chart">
                                    <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                        <span class="d-none d-md-block">Año</span>
                                        <span class="d-md-none">A</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="chart-reports" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    var cr = document.getElementById('chart-reports').getContext('2d');
    var reportsChart = new Chart(cr, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: [],
            datasets: [{
                label: '$',
                backgroundColor: 'rgb(75, 192, 192)',
                borderColor: 'rgb(75, 192, 192)',
                data: [],
                fill: false,
            }]
        },

        // Configuration options go here
        options: {
            responsive: true,
            title: {
            display: true,
            text: "Payment amounts",
            },
            legend: {
            display: true
            },
            scales: {
            yAxes: [{
                ticks: {
                beginAtZero: true,
                }
            }]
            }
        }
    });



    function RefreshPayments(){

        var start = document.getElementById("input-start_date").value;
        var end = document.getElementById("input-end_date").value;
        $.ajax({
            url: "{{route('charts.payments')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",
                'start_date': start,
                "end_date": end

            },
        success: function (response) {
            var labels = [];
            var data = [];
            var amounts = [];
            for(var i = 0; i < response.length; i++){
                labels.push(response[i].date);
                data.push(response[i].total_payments);
                amounts.push(response[i].total_amount_paid);
            }
            addData(paymentsChart, labels, data);
            addData(reportsChart, labels, amounts);
            RefreshStats();
        }});
        return false;
    }

    function addData(chart, labels, data) {
        removeData(chart);
        chart.data.labels = chart.data.labels.concat(labels);
        chart.data.datasets[0].data = chart.data.datasets[0].data.concat(data);
        chart.update();
    }

    function removeData(chart) {
        chart.data.labels = [];
        chart.data.datasets[0].data = [];
    }
</script>
@endpush
@endsection
@push('headjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
@endpush
