<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../../../../assets/css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- DataTables CSS -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

        <!-- DataTables JavaScript -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Halo</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <form id="logout-admin" action="{{route('adminsession.destroy')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <li style="cursor: pointer;"><a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-admin').submit();">Logout</a></li>
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="{{route('admindashboard.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Pengelolaan</div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pembelian" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Pembelian
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="pembelian" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('adminproduct.index')}}">Transaksi barang</a>
                                    <a class="nav-link" href="{{route('nota.tampilNota')}}">Laporan</a>
                                </nav>
                            </div>

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#penjualan" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Penjualan
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="penjualan" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{ route('barang2.index')}}">Transaksi barang</a>
                                    <a class="nav-link" href="{{ route('adminlayanan.index')}}">Transaksi layanan</a>
                                    <a class="nav-link" href="{{route('nota.tampilNota2')}}">Laporan Barang</a>
                                    <a class="nav-link" href="{{route('layanan2.index')}}">Laporan Layanan</a>
                                </nav>
                            </div>

                            <a class="nav-link" href="{{ route('adminorder.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Orders
                            </a>

                            <a class="nav-link" href="{{route('supplier.index')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Supplier
                            </a>

                            <a class="nav-link" href="{{route('barang.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-wheat"></i></div>
                                Barang
                            </a>

                            <a class="nav-link" href="{{route('layanan.index')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-bell-concierge"></i></div>
                                Layanan
                            </a>

                            <a class="nav-link" href="{{route('user.index')}}" >
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-person"></i></div>
                                User
                            </a>

                        </div>
                    </div>
                </nav>
            </div>

            @yield('content')

            <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../../../../assets/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="../../../../assets/js/datatables-simple-demo.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../../../../assets/demo/chart-area-demo.js"></script>
        <script src="../../../../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.js" integrity="sha512-6LKCH7i2+zMNczKuCT9ciXgFCKFp3MevWTZUXDlk7azIYZ2wF5LRsrwZqO7Flt00enUI+HwzzT5uhOvy6MNPiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            // Mendapatkan tanggal saat ini
            var tanggalSekarang = new Date();

            // Format tanggal sesuai kebutuhan Anda (contoh: "Senin, 1 Januari 2023")
            var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            var tanggalDiformat = tanggalSekarang.toLocaleDateString('id-ID', options);

            // Menampilkan tanggal di dalam elemen HTML
            document.getElementById('tanggal').textContent = tanggalDiformat;
        </script>

        <script>
        $(document).ready(function() {
            $('#dataTable2').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
        });
        </script>

        <script>
            $(document).ready(function() {
                    $('#dataTable3').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
                });
        </script>

        <script>
            $(document).ready(function() {
                    $('#supplier').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
                });
        </script>

        <script>
            $(document).ready(function() {
                    $('#produkSupplier').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
                });
        </script>

        <script>
            $(document).ready(function() {
                    $('#cariSupplier2').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
                });
        </script>

        <script>
            $(document).ready(function() {
                    $('#cariLayanan').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
                });
        </script>

        <script>
            $(document).ready(function() {
                    $('#cariCustomer2').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
                });
        </script>

        <script>
            $(document).ready(function() {
                    $('#barang1').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
                });
        </script>

        <script>
            $(document).ready(function() {
                    $('#Customer4').DataTable(); // Menginisialisasi DataTables pada tabel dengan ID "dataTable"
                });
        </script>



    </body>
</html>
