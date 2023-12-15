<!doctype html>
<html lang="en">

<head>
    <title>Staff - Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @include('partials.header')
</head>
<style>
    
</style>
<body>
    @include('partials.sidebar')

   <section class="content">
    <div class="container-fluid p-5">
        <h1>Dashboard</h1><br>
        <div class="row">
           
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-success text-uppercase mb-1">
                                    No of Customers</div>
                                <div class="h5 mb-0 text-gray-800">
                                    {{ $totalCustomerCount ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-muted"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-success text-uppercase mb-1">
                                    Total Laundry</div>
                                <div class="h5 mb-0 text-gray-800">{{ $totalLaundry ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-jug-detergent fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs text-success text-uppercase mb-1">
                                    Total Sales As of <br>(<?= date('m-d-Y') ?>)
                                </div>
                                <?php
                                $totalSales = 0;
                                ?>
                                <div class="h5 mb-0 text-gray-800">
                                    @foreach ($orders as $order)
                                        @foreach ($order->laundries as $laundry)
                                            <?php $totalSales += $laundry->total_laundry_price; ?>
                                        @endforeach
                                    @endforeach
                                    {{ number_format($totalSales, 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs text-success text-uppercase mb-1">
                                Monthly Sales As of <br>(<?= date('m-d-Y') ?>)
                            </div>
                            <?php
                            $monthlySales = 0;
                            ?>
                            <div class="h5 mb-0 text-gray-800" id="monthlySales">
                                @foreach ($orders as $order)
                                    @foreach ($order->laundries as $laundry)
                                        <?php $monthlySales += $laundry->total_laundry_price; ?>
                                    @endforeach
                                @endforeach
                                {{ number_format($monthlySales, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         </div>
        <div class="" style="width: 500px; height: 370px; margin-left: 300px; margin-top: -10px">
            <canvas id="myPieChart"></canvas>

        </div>
    </div>

   </section>
   <script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('myPieChart').getContext('2d');

        // Fetch data from the backend
        fetch(`{{ route('staff.dashboard.mostBookedLaundryTypes') }}`)
            .then(response => response.json())
            .then(data => {
                var labels = Object.keys(data);
                var values = Object.values(data);

                var pieChartData = {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
                    }]
                };

                var options = {
                    responsive: true,
                };

                // Create the pie chart
                var myPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: pieChartData,
                    options: options
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var monthlySalesElement = document.getElementById('monthlySales');

        // Fetch monthly sales from the backend
        fetch('{{ route('staff.dashboard') }}')
            .then(response => response.json())
            .then(data => {
                var monthlySales = data.monthly_sales || 0;
                monthlySalesElement.textContent = monthlySales.toFixed(2);
            })
            .catch(error => console.error('Error fetching monthly sales:', error));
    });
</script>


</body>

</html>
