@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>


                        <div style="width: 200%; margin: auto;">
                            <canvas id="myAreaChart1"></canvas>
                        </div>

                        <script>
                            // Sample data
                            var data = {
                                labels: ["January", "February", "March", "April", "May"],
                                datasets: [{
                                    label: 'Monthly Sales',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1,
                                    data: [65, 59, 80, 81, 56],
                                }]
                            };

                            // Chart configuration
                            var config = {
                                type: 'line', // Area chart is a variation of the line chart
                                data: data,
                                options: {
                                    scales: {
                                        x: {
                                            type: 'category',
                                            labels: data.labels,
                                        },
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            };

                            // Get the canvas element
                            var ctx = document.getElementById('myAreaChart1').getContext('2d');

                            // Create the area chart
                            var myAreaChart = new Chart(ctx, config);
                        </script>


                        </div>
                    </div>
                </main>
@endsection
