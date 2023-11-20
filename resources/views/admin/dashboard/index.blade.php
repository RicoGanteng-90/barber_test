@extends('admin.layout.layout')

@section('title', 'Dashboard')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 style="font-family: Garamond, serif;" class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li style="font-family: Garamond, serif;" class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </main>

                        <div class="container-fluid px-4">

                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Grafik penjualan barang
                                </div><br>
                                <div style="display: inline;">&ensp;
                                    <button id="downloadBtn2" class="btn btn-primary" style="width: 190px;">Download as PNG</button>
                                    <button id="downloadPdfBtn2" class="btn btn-info" style="width: 190px;">Download as PDF</button><br><br>
                                </div>
                                    <canvas id="myAreaChart" width="100%" height="40"></canvas>
                            </div>

                            <br>

                            <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-line me-1"></i>
                                Grafik pembelian barang
                            </div><br>
                                <div style="display: inline;">&ensp;
                                    <button id="downloadBtn" class="btn btn-primary" style="width: 190px;">Download as PNG</button>
                                    <button id="downloadPdfBtn" class="btn btn-info" style="width: 190px;">Download as PDF</button><br><br>
                                </div>
                                    <canvas id="lineChart" width="100%" height="40"></canvas>
                            </div>

                            <br>

                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Grafik penjualan layanan
                                </div><br>
                                <div style="display: inline;">&ensp;
                                    <button id="downloadBtn3" class="btn btn-primary" style="width: 190px;">Download as PNG</button>
                                    <button id="downloadPdfBtn3" class="btn btn-info" style="width: 190px;">Download as PDF</button>
                                </div>
                                    <canvas id="myAreaChart2" width="100%" height="40"></canvas>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                            var resultData = <?php echo $resultJson; ?>;

                            var ctx = document.getElementById('lineChart').getContext('2d');
                            var lineChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: resultData.map(item => item.bulan),
                                    datasets: [{
                                        label: 'Total pembelian barang',
                                        data: resultData.map(item => item.total),
                                        borderColor: 'rgba(75, 192, 192, 1)',
                                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                        borderWidth: 2,
                                        fill: true
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                                var downloadBtn = document.getElementById('downloadBtn');
                                downloadBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('lineChart');
                                    var ctx = canvas.getContext('2d');

                                    var newCanvas = document.createElement('canvas');
                                    newCanvas.width = canvas.width;
                                    newCanvas.height = canvas.height;
                                    var newCtx = newCanvas.getContext('2d');
                                    newCtx.fillStyle = 'white';
                                    newCtx.fillRect(0, 0, newCanvas.width, newCanvas.height);

                                    newCtx.drawImage(canvas, 0, 0);

                                    var url = newCanvas.toDataURL('image/png');

                                    var a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'chart.png';
                                    a.click();
                                });

                                var downloadPdfBtn = document.getElementById('downloadPdfBtn');
                                downloadPdfBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('lineChart');
                                    var imageData = canvas.toDataURL('image/png');

                                    var pdf = new jsPDF({
                                        unit: 'mm',
                                        format: 'a3',
                                        orientation: 'landscape'
                                    });

                                    pdf.addImage(imageData, 'PNG', 50, 10, 330, 190);

                                    pdf.save('chart.pdf');
                                });

                            });
                        </script>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {

                            var resultData2 = <?php echo $resultJson2; ?>;
                            var ctx = document.getElementById("myAreaChart");
                            var myLineChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: resultData2.map(item => item.bulan),
                                datasets: [{
                                    label: "Total penjualan barang",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(2,117,216,0.2)",
                                    borderColor: "rgba(2,117,216,1)",
                                    pointRadius: 5,
                                    pointBackgroundColor: "rgba(2,117,216,1)",
                                    pointBorderColor: "rgba(255,255,255,0.8)",
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                                    pointHitRadius: 50,
                                    pointBorderWidth: 2,
                                    data: resultData2.map(item => item.total_harga),
                                    fill: true
                                }],
                            },
                            options: {
                                scales: {
                                xAxes: [{
                                    time: {
                                    unit: 'date'
                                    },
                                    gridLines: {
                                    display: false
                                    },
                                    ticks: {
                                    maxTicksLimit: 7
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                    min: 0,
                                    max: 80000,
                                    maxTicksLimit: 5
                                    },
                                    gridLines: {
                                    color: "rgba(0, 0, 0, .125)",
                                    }
                                }],
                                },
                                legend: {
                                display: false
                                }
                            }
                            });

                            var downloadBtn = document.getElementById('downloadBtn2');
                                downloadBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('myAreaChart');
                                    var ctx = canvas.getContext('2d');

                                    var newCanvas = document.createElement('canvas');
                                    newCanvas.width = canvas.width;
                                    newCanvas.height = canvas.height;
                                    var newCtx = newCanvas.getContext('2d');
                                    newCtx.fillStyle = 'white';
                                    newCtx.fillRect(0, 0, newCanvas.width, newCanvas.height);

                                    newCtx.drawImage(canvas, 0, 0);

                                    var url = newCanvas.toDataURL('image/png');

                                    var a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'chart.png';
                                    a.click();
                                });

                                var downloadPdfBtn = document.getElementById('downloadPdfBtn2');
                                downloadPdfBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('myAreaChart');
                                    var imageData = canvas.toDataURL('image/png');

                                    var pdf = new jsPDF({
                                        unit: 'mm',
                                        format: 'a3',
                                        orientation: 'landscape'
                                    });

                                    pdf.addImage(imageData, 'PNG', 50, 10, 330, 190);

                                    pdf.save('chart.pdf');
                                });

                        });
                        </script>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {

                            var resultData3 = <?php echo $resultJson3; ?>;
                            var ctx = document.getElementById("myAreaChart2");
                            var myLineChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: resultData3.map(item => item.bulan),
                                datasets: [{
                                    label: "Total penjualan layanan",
                                    lineTension: 0.3,
                                    backgroundColor: "rgba(2,117,216,0.2)",
                                    borderColor: "rgba(2,117,216,1)",
                                    pointRadius: 5,
                                    pointBackgroundColor: "rgba(2,117,216,1)",
                                    pointBorderColor: "rgba(255,255,255,0.8)",
                                    pointHoverRadius: 5,
                                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                                    pointHitRadius: 50,
                                    pointBorderWidth: 2,
                                    data: resultData3.map(item => item.total_harga),
                                    fill: true
                                }],
                            },
                            options: {
                                scales: {
                                xAxes: [{
                                    time: {
                                    unit: 'date'
                                    },
                                    gridLines: {
                                    display: false
                                    },
                                    ticks: {
                                    maxTicksLimit: 7
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                    min: 0,
                                    max: 80000,
                                    maxTicksLimit: 5
                                    },
                                    gridLines: {
                                    color: "rgba(0, 0, 0, .125)",
                                    }
                                }],
                                },
                                legend: {
                                display: false
                                }
                            }
                            });

                            var downloadBtn = document.getElementById('downloadBtn3');
                                downloadBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('myAreaChart2');
                                    var ctx = canvas.getContext('2d');

                                    var newCanvas = document.createElement('canvas');
                                    newCanvas.width = canvas.width;
                                    newCanvas.height = canvas.height;
                                    var newCtx = newCanvas.getContext('2d');
                                    newCtx.fillStyle = 'white';
                                    newCtx.fillRect(0, 0, newCanvas.width, newCanvas.height);

                                    newCtx.drawImage(canvas, 0, 0);

                                    var url = newCanvas.toDataURL('image/png');

                                    var a = document.createElement('a');
                                    a.href = url;
                                    a.download = 'chart.png';
                                    a.click();
                                });

                                var downloadPdfBtn = document.getElementById('downloadPdfBtn3');
                                downloadPdfBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('myAreaChart2');
                                    var imageData = canvas.toDataURL('image/png');

                                    var pdf = new jsPDF({
                                        unit: 'mm',
                                        format: 'a3',
                                        orientation: 'landscape'
                                    });

                                    pdf.addImage(imageData, 'PNG', 50, 10, 330, 190);

                                    pdf.save('chart.pdf');
                                });

                        });
                        </script>

@endsection
