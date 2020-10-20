@extends('layouts.app')

@section('content')
{{-- Cards --}}
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Cargos') }}</h5>
                                    <p class="h2 font-weight-bold mb-0">
                                        <span class="USD" id="totalUSD">0.00</span>
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
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Abonos') }}</h5>
                                    <p id="total-amount-due-insurance" class="h2 font-weight-bold mb-0">
                                        <span class="USD" id="totalPaidUSD">$0.00</span>
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
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Créditos') }}</h5>
                                    <p id="total-amount-due-insurance" class="h2 font-weight-bold mb-0">
                                        <span class="USD" id="totalCreditUSD">$0.00</span>
                                        <span class="text-info mr-2" id="totalCreditPercentage">0.00%</span>
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">{{ __('Saldo') }}
                                    </h5>
                                    <p id="total-amount-paid" class="h2 font-weight-bold mb-0">
                                        <span class="USD" id="totalDueUSD">$0.00</span>
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
    {{-- Search row --}}
    <div class="row">
        {{--  start_date  --}}
        <div class="form-group col-md-4">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="date" name="start_date" id="input-start_date" class="form-control"
                    value="{{ $start->format('Y-m-d') }}" required>
            </div>
        </div>
        {{--  end_date  --}}
        <div class="form-group col-md-4">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                <input type="date" name="end_date" id="input-end_date" class="form-control"
                    value="{{ $end->format('Y-m-d')  }}" required>
            </div>
        </div>
        {{--  refresh  --}}
        <div class="col-md-4 text-right">
            <button id="refresh" type="button" class="btn btn-info" onclick="RefreshStats()">
                Actualizar
            </button>
        </div>
    </div>
    {{-- Reports total --}}
    <div class="row">
        <div class="col-xl-12 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">Totales</h6>
                            <h2 class="text-primary mb-0" id="period">Periodo</h2>
                        </div>
                        {{-- <div class="col">
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
                        </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div>
                        <!-- Chart wrapper -->
                        <canvas id="chart-reports" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-xl-12 mt-2">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Totales</h3>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table id="totals_table" class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Mes</th>
                                <th scope="col">Cargos</th>
                                <th scope="col">Abonos</th>
                                <th scope="col">Créditos</th>
                                <th scope="col">Saldos</th>
                                <th scope="col">% Abonos</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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
                    label: 'Cargos',
                    backgroundColor: 'rgb(243, 164, 181)',
                    borderColor: 'rgb(75, 192, 192)',
                    data: [],
                    fill: false,
                }, {
                    label: 'Abonos',
                    backgroundColor: 'rgb(45, 206, 137)',
                    borderColor: 'rgb(75, 192, 192)',
                    data: [],
                    fill: false,
                },
                {
                    label: 'Crédito',
                    backgroundColor: 'rgb(39, 206, 239)',
                    borderColor: 'rgb(75, 192, 192)',
                    data: [],
                    fill: false,
                },
                {
                    label: 'Saldo',
                    backgroundColor: 'rgb(255, 214, 0)',
                    borderColor: 'rgb(75, 192, 192)',
                    data: [],
                    fill: false,
                }
            ]
        },

        // Configuration options go here
        options: {
            responsive: true,
            title: {
                display: true,
                text: "Reportes",
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



    function RefreshStats() {

        var start = document.getElementById("input-start_date").value;
        var end = document.getElementById("input-end_date").value;
        $.ajax({
            url: "{{route('charts.invoices')}}",
            dataType: 'json',
            type: "post",
            data: {
                "_token": "{{ csrf_token() }}",
                'start_date': start,
                "end_date": end

            },
            success: function (response) {
                removeData(reportsChart);
                var total = 0;
                var total_amount_paid = 0;
                var total_amount_due = 0;
                var total_amount_credit = 0;
                reportsChart.data.datasets[1].data = []; //payments
                reportsChart.data.datasets[2].data = []; //credits
                reportsChart.data.datasets[3].data = []; //due
                for (var i = 0; i < response.length; i++) {
                    reportsChart.data.labels = reportsChart.data.labels.concat(response[i].month);
                    total += Number(response[i].total);
                    reportsChart.data.datasets[0].data = reportsChart.data.datasets[0].data.concat(response[
                        i].total);
                    total_amount_paid += Number(response[i].total_amount_paid);
                    reportsChart.data.datasets[1].data = reportsChart.data.datasets[1].data.concat(response[
                        i].total_amount_paid);
                    total_amount_credit += Number(response[i].total_amount_credit);
                    reportsChart.data.datasets[2].data = reportsChart.data.datasets[2].data.concat(response[
                        i].total_amount_credit);
                    total_amount_due += Number(response[i].total_amount_due);
                    reportsChart.data.datasets[3].data = reportsChart.data.datasets[3].data.concat(response[
                        i].total_amount_due);
                    response[i].amount_paid_percentage = Number(((response[i].total_amount_paid / response[
                        i].total) * 100)).toFixed(2);
                    response[i].amount_due_percentage = Number(((response[i].total_amount_due / response[i]
                        .total) * 100)).toFixed(2);
                    response[i].amount_credit_percentage = Number(((response[i].total_amount_credit / response[i]
                    .total) * 100)).toFixed(2);
                }
                reportsChart.update();

                //display on cards
                var amount_paid_percentage = ((total_amount_paid / total) * 100).toFixed(2);
                var amount_due_percentage = ((total_amount_due / total) * 100).toFixed(2);
                var amount_credit_percentage = ((total_amount_credit / total) * 100).toFixed(2);

                document.getElementById("totalUSD").innerHTML = formatter.format(total);
                document.getElementById("totalPaidUSD").innerHTML = formatter.format(total_amount_paid);
                document.getElementById("totalDueUSD").innerHTML = formatter.format(total_amount_due);
                document.getElementById("totalCreditUSD").innerHTML = formatter.format(total_amount_credit);
                document.getElementById("totalDuePercentage").innerHTML = amount_due_percentage + " %";
                document.getElementById("totalCreditPercentage").innerHTML = amount_credit_percentage + " %";
                document.getElementById("totalPaidPercentage").innerHTML = amount_paid_percentage + " %";
                fillTotalsTable(response);
            }
        });
        return false;
    }

    function fillTotalsTable(data) {
        var output = "";
        var bg = "";
        for (var i = 0; i < data.length; i++) {
            bg = data[i].amount_paid_percentage >= 50 ? "bg-gradient-success" : "bg-gradient-danger";
            output += "<tr>" +
                "<td>" + data[i].month + "</td>" +
                "<td>" + formatter.format(data[i].total) + "</td>" +
                "<td>" + formatter.format(data[i].total_amount_paid) + "</td>" +
                "<td>" + formatter.format(data[i].total_amount_credit) + "</td>" +
                "<td>" + formatter.format(data[i].total_amount_due) + "</td>" +
                '<td><div class="d-flex align-items-center"><span class="mr-2">' + data[i].amount_paid_percentage +
                ' %<div><div class="progress"><div class="progress-bar ' + bg + '" role="progressbar" aria-valuenow=' +
                data[i].amount_paid_percentage + ' aria-valuemin="0" aria-valuemax="100" style="width:' + data[i]
                .amount_paid_percentage + '%;"></div></div></div></div></td>' +
                "</tr>";
        }
        $('#totals_table tbody').html(output);
    }
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
    });

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
