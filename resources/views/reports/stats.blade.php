<div class="card shadow">
    <div class="card-header bg-transparent">
        <div class="col">
            <h6 class="text-uppercase text-muted ls-1 mb-1">Discount</h6>
            <h2 class="mb-0">Personal discount</h2>
        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="personal-chart" class="chart-canvas"></canvas>
        </div>
    </div>
</div>


@push('js')
<script>
    var cp = document.getElementById('personal-chart').getContext('2d');
    var personalChart = new Chart(cp, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: ['Amount paid', 'Amount due'],
                datasets: [{
                    label: '$',
                    backgroundColor: ["rgb(54, 162, 235)","rgb(255, 99, 132)","rgb(255, 205, 86)"],
                    data: [],
                }]
            },

            // Configuration options go here
            options: {
                responsive: true,
                title: {
                display: true,
                text: "Discount",
                },
                legend: {
                display: true
                }
            }
    });
    var ci = document.getElementById('insurance-chart').getContext('2d');
    var insuranceChart = new Chart(ci, {
            // The type of chart we want to create
            type: 'doughnut',

            // The data for our dataset
            data: {
                labels: ['Amount paid', 'Amount due'],
                datasets: [{
                    backgroundColor: ["rgb(54, 162, 235)","rgb(255, 99, 132)","rgb(255, 205, 86)"],
                    data: [],
                }]
            },

            // Configuration options go here
            options: {
                responsive: true,
                title: {
                display: true,
                text: "Insurance",
                },
                legend: {
                display: true
                }
            }
    });
    function RefreshStats(){
        $.ajax({
            url: "{{route('charts.stats')}}",
            dataType: 'json',
            type:"post",
            data: {
                "_token": "{{ csrf_token() }}",

            },
        success: function (response) {

            var personal = [];
            var insurance = [];
            personal.push(response[0][0].amount_paid, response[0][0].personal_amount_due);
            
            insurance.push(response[1][0].amount_paid, response[1][0].amount_due);

            insuranceChart.data.datasets[0].data = [];
            personalChart.data.datasets[0].data = [];

            insuranceChart.data.datasets[0].data = insuranceChart.data.datasets[0].data.concat(insurance);
            insuranceChart.update();

            personalChart.data.datasets[0].data = personalChart.data.datasets[0].data.concat(personal);
            personalChart.update();
        }});
        return false;
    }
   </script>
@endpush
