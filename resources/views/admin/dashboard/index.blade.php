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
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Grafik penjualan barang
                            </div><br>
                            <div style="display: inline;">&ensp;
                                <button id="downloadBtn2" class="btn btn-primary" style="width: 150;">Download as PNG</button>
                                <button id="downloadPdfBtn2" class="btn btn-info" style="width: 150;">Download as PDF</button><br><br>
                                &ensp;&ensp;<input type="number" name="tahun2" id="tahunInput2" style="width: 80px;" value="{{ date('Y') }}">
                            </div>
                            <canvas id="myAreaChart" width="300"></canvas>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Grafik penjualan layanan
                            </div><br>
                            <div style="display: inline;">&ensp;
                                <button id="downloadBtn3" class="btn btn-primary" style="width: 150;">Download as PNG</button>
                                <button id="downloadPdfBtn3" class="btn btn-info" style="width: 150;">Download as PDF</button><br><br>
                                &ensp;&ensp;<input type="number" name="tahun3" id="tahunInput3" style="width: 80px;" value="{{ date('Y') }}">
                            </div>
                            <canvas id="myAreaChart2" width="300"></canvas>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-line me-1"></i>
                                Grafik pembelian barang
                            </div><br>
                            <div style="display: inline;">&ensp;
                                <button id="downloadBtn" class="btn btn-primary" style="width: 150;">Download as PNG</button>
                                <button id="downloadPdfBtn" class="btn btn-info" style="width: 150;">Download as PDF</button><br><br>
                                &ensp;&ensp;<input type="number" name="tahun" id="tahunInput" style="width: 80px;" value="{{ date('Y') }}">
                            </div>
                            <canvas id="lineChart" width="300"></canvas>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar"></i>
                                Grafik customer
                            </div><br>
                            <div style="display: inline;">&ensp;
                                <button id="downloadBtn4" class="btn btn-primary" style="width: 150;">Download as PNG</button>
                                <button id="downloadPdfBtn4" class="btn btn-info" style="width: 150;">Download as PDF</button><br><br>
                                &ensp;&ensp;<input type="number" name="tahun4" id="tahunInput4" style="width: 80px;" value="{{ date('Y') }}">
                            </div>
                            <canvas id="myBarChart" width="300"></canvas>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-pie"></i>
                                Grafik supplier
                            </div><br>
                            <div style="display: inline;">&ensp;
                                <button id="downloadBtn5" class="btn btn-primary" style="width: 150;">Download as PNG</button>
                                <button id="downloadPdfBtn5" class="btn btn-info" style="width: 150;">Download as PDF</button><br><br>
                                &ensp;&ensp;<input type="number" name="tahun5" id="tahunInput5" style="width: 80px;" value="{{ date('Y') }}">
                            </div>
                            <canvas id="myPieChart" width="300"></canvas>
                        </div>
                    </div>

                </div>
            </div>


                            <script>
                            var lineChart;
                            var initialData = <?php echo $resultJson; ?>;

                            document.addEventListener('DOMContentLoaded', function () {
                                var ctx = document.getElementById('lineChart').getContext('2d');

                                lineChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: initialData.map(item => item.bulan),
                                        datasets: [{
                                            label: 'Total pembelian barang',
                                            data: initialData.map(item => item.total),
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

                                document.getElementById('tahunInput').addEventListener('change', function () {
                                    updateChart();
                                });

                                function updateChart() {
                                    var year = document.getElementById('tahunInput').value;

                                    fetch("{{ route('chart.fetchData') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        },
                                        body: 'tahun=' + year
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        lineChart.data.labels = data.map(item => item.bulan);
                                        lineChart.data.datasets[0].data = data.map(item => item.total);

                                        lineChart.update();
                                    })
                                    .catch(error => {
                                        console.error('Error fetching data:', error);
                                    });
                                }

                                updateChart();
                            });
                        </script>




                        <script>
                            var lineChart2;
                            var initialData2 = <?php echo  $resultJson2 ?>;

                            document.addEventListener('DOMContentLoaded', function() {

                            var ctx = document.getElementById("myAreaChart").getContext('2d');

                            lineChart2 = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: initialData2.map(item => item.bulan),
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
                                    data: initialData2.map(item => item.total_harga),
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

                                document.getElementById('tahunInput2').addEventListener('change', function () {
                                    updateChart2();
                                });

                                function updateChart2() {
                                var year2 = document.getElementById('tahunInput2').value;

                                fetch("{{ route('chart.fetchData2') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: 'tahun2=' + year2
                                })
                                .then(response => response.json())
                                .then(data => {
                                    lineChart2.data.labels = data.map(item => item.bulan);
                                    lineChart2.data.datasets[0].data = data.map(item => item.total_harga);

                                    lineChart2.update();
                                })
                                .catch(error => {
                                    console.error('Error fetching data:', error);
                                });
                            }
                            updateChart2();
                        });

                        </script>

                        <script>
                            var lineChart3;
                            var initialData3 = <?php echo  $resultJson3 ?>;

                            document.addEventListener('DOMContentLoaded', function() {

                            var ctx = document.getElementById("myAreaChart2").getContext('2d');

                            lineChart3 = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: initialData3.map(item => item.bulan),
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
                                    data: initialData3.map(item => item.total_harga),
                                    fill: true
                                }],
                            },
                            options: {
                                scales: {
                                xAxes: [{
                                    time: {
                                    unit: 'bulan'
                                    },
                                    gridLines: {
                                    display: false
                                    },
                                    ticks: {
                                    maxTicksLimit: 12
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                    min: 0,
                                    max: 100000000,
                                    maxTicksLimit: 20
                                    },
                                    gridLines: {
                                    color: "rgba(0, 0, 0, .125)",
                                    }
                                }],
                                },
                                legend: {
                                display: true
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

                                document.getElementById('tahunInput3').addEventListener('change', function () {
                                    updateChart3();
                                });

                                function updateChart3() {
                                var year3 = document.getElementById('tahunInput3').value;

                                fetch("{{ route('chart.fetchData3') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: 'tahun3=' + year3
                                })
                                .then(response => response.json())
                                .then(data => {
                                    lineChart3.data.labels = data.map(item => item.bulan);
                                    lineChart3.data.datasets[0].data = data.map(item => item.total_harga);

                                    lineChart3.update();
                                })
                                .catch(error => {
                                    console.error('Error fetching data:', error);
                                });
                            }
                            updateChart3();
                            });

                    </script>

                    <script >
                            var lineChart4;
                            var initialData4 = <?php echo  $resultJson4 ?>;

                        document.addEventListener('DOMContentLoaded', function() {

                            var ctx = document.getElementById("myBarChart").getContext('2d');

                            lineChart4 = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: initialData4.map(item => item.month),
                                datasets: [{
                                label: "Total customer",
                                backgroundColor: "rgba(2,117,216,1)",
                                borderColor: "rgba(2,117,216,1)",
                                data: initialData4.map(item => item.customer),
                                }],
                            },
                            options: {
                                scales: {
                                xAxes: [{
                                    time: {
                                    unit: 'month'
                                    },
                                    gridLines: {
                                    display: false
                                    },
                                    ticks: {
                                    maxTicksLimit: 6
                                    }
                                }],
                                yAxes: [{
                                    ticks: {
                                    min: 0,
                                    max: 10000,
                                    maxTicksLimit: 5
                                    },
                                    gridLines: {
                                    display: true
                                    }
                                }],
                                },
                                legend: {
                                display: true
                                }
                            }
                            });

                            var downloadBtn = document.getElementById('downloadBtn4');
                                downloadBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('myBarChart');
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

                                var downloadPdfBtn = document.getElementById('downloadPdfBtn4');
                                downloadPdfBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('myBarChart');
                                    var imageData = canvas.toDataURL('image/png');

                                    var pdf = new jsPDF({
                                        unit: 'mm',
                                        format: 'a3',
                                        orientation: 'landscape'
                                    });

                                    pdf.addImage(imageData, 'PNG', 50, 10, 330, 190);

                                    pdf.save('chart.pdf');
                                });

                                document.getElementById('tahunInput4').addEventListener('change', function () {
                                    updateChart4();
                                });

                                function updateChart4() {
                                var year4 = document.getElementById('tahunInput4').value;

                                fetch("{{ route('chart.fetchData4') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: 'tahun4=' + year4
                                })
                                .then(response => response.json())
                                .then(data => {
                                    lineChart4.data.labels = data.map(item => item.month);
                                    lineChart4.data.datasets[0].data = data.map(item => item.customer);

                                    lineChart4.update();
                                })
                                .catch(error => {
                                    console.error('Error fetching data:', error);
                                });
                            }
                            updateChart4();
                        });

                    </script>

                    <script>
                        var pieChart5;
                        var initialData5 = <?php echo  $resultJson5 ?>;

                        document.addEventListener('DOMContentLoaded', function() {

                            var ctx = document.getElementById("myPieChart").getContext('2d');

                            pieChart5 = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: initialData5.map(item => item.month),
                                datasets: [{
                                data: initialData5.map(item => item.supplier),
                                backgroundColor: ['#1e81b0', '#eab676', '#76b5c5', '#21130d', '#873e23', '#abdbe3', '#827717', '#154c79', '#E55101', '#BD3563', '#689F38', '#FFEB3B'],
                                }],
                            },
                            });

                            var downloadBtn = document.getElementById('downloadBtn5');
                                downloadBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('myPieChart');
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

                                var downloadPdfBtn = document.getElementById('downloadPdfBtn5');
                                downloadPdfBtn.addEventListener('click', function() {
                                    var canvas = document.getElementById('myPieChart');
                                    var imageData = canvas.toDataURL('image/png');

                                    var pdf = new jsPDF({
                                        unit: 'mm',
                                        format: 'a3',
                                        orientation: 'landscape'
                                    });

                                    pdf.addImage(imageData, 'PNG', 50, 10, 300, 190);

                                    pdf.save('chart.pdf');
                                });

                                document.getElementById('tahunInput5').addEventListener('change', function () {
                                    updateChart5();
                                });

                                function updateChart5() {
                                var year5 = document.getElementById('tahunInput5').value;

                                fetch("{{ route('chart.fetchData5') }}", {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: 'tahun5=' + year5
                                })
                                .then(response => response.json())
                                .then(data => {
                                    pieChart5.data.labels = data.map(item => item.month);
                                    pieChart5.data.datasets[0].data = data.map(item => item.supplier);

                                    pieChart5.update();
                                })
                                .catch(error => {
                                    console.error('Error fetching data:', error);
                                });
                            }
                            updateChart5();
                        });

                    </script>

@endsection
