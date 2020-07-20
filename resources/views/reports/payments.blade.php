<div class="card shadow">
    <div class="card-header bg-transparent">
        <div class="col">
            <h6 class="text-uppercase text-muted ls-1 mb-1">Payments</h6>
            <h2 class="mb-0">Total payments</h2>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="payments-chart" class="chart-canvas"></canvas>
        </div>

    </div>
</div>


@push('js')
<script>
    var cpa = document.getElementById('payment-amount-chart').getContext('2d');
    var paymentAmountChart = new Chart(cpa, {
            // The type of chart we want to create
            type: 'line',

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

    var ctx = document.getElementById('payments-chart').getContext('2d');
    var paymentsChart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: [],
                datasets: [{
                    label: 'Quantity',
                    backgroundColor: 'rgb(255, 159, 64)',
                    borderColor: 'rgb(255, 159, 64)',
                    borderWidth: 1,
                    barPercentage: 0.6,
                    data: [],
                    fill: false,
                }]
            },

            // Configuration options go here
            options: {
                responsive: true,
                title: {
                display: true,
                text: "Payments by month",
                },
                legend: {
                display: false
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
            url: "{{route('charts.invoices')}}",
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
            addData(paymentAmountChart, labels, amounts);
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
