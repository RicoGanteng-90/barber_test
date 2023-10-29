<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="assets/lib/animate/animate.min.css" rel="stylesheet">
    <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        body{
            background-color: black;
        }

        #grad1 {
        background-image: linear-gradient(black 10%, white, black 85%);
        display: inline-block;
        }

        #grad1 img {
        mix-blend-mode: multiply; /* Apply blending mode to merge image and gradient */
        }

        #grad2 {
        background-image: linear-gradient(black 10%, white, black 85%);
        display: inline-block;
        }

        #grad2 img {
        mix-blend-mode: multiply; /* Apply blending mode to merge image and gradient */
        }

        .mb-3{
            color:aliceblue;
        }
    </style>
</head>

<body background="black">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-grey" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex" style="color: white;">
            <div class="col-lg-6 px-5 text-start">
            </div>
            <div class="col-lg-6 px-5 text-end">
                <small>Follow us:</small>
                <a class="text-body ms-3" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-twitter"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="text-body ms-3" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="index.html" class="navbar-brand ms-4 ms-lg-0">
                <a href="{{ route ('home.index')}}"><img src="assets/img/seturan.png" width="55px"></a>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{route('home.index')}}" class="nav-item nav-link {{ Request::is('home*') ? 'active' : '' }}">Home</a>
                    <a href="{{route('about.index')}}" class="nav-item nav-link {{ Request::is('about*') ? 'active' : '' }}">Tentang kami</a>
                    <a href="{{ route('product.index') }}" class="nav-item nav-link {{ Request::is('product*') ? 'active' : '' }}">Produk</a>
                    <a href="{{ route('service.index') }}" class="nav-item nav-link {{ Request::is('service*') ? 'active' : '' }}">Layanan</a>
                    <a href="{{ route('order.index') }}" class="nav-item nav-link {{ Request::is('order*') ? 'active' : '' }}">Order</a>
                </div>
                <div class="d-none d-lg-flex ms-2">
                    <a class="btn-sm-square bg-dark rounded-circle ms-3" href="">
                        <small class="fa fa-search text-body"></small>
                    </a>

                    <div class="dropdown">
                        <small class="fa fa-user text-body btn-sm-square bg-dark rounded-circle ms-3" data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;"></small>
                    <ul class="dropdown-menu" style="left: -130%;" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <form id="logout-form" action="{{route('session.destroy')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <li style="cursor: pointer;"><a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                        </form>
                    </ul>
                    </div>

                    <a class="btn-sm-square bg-dark rounded-circle ms-3" href="{{ route ('cart.index')}}">
                        <small class="fa fa-shopping-bag text-body"></small>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-light mb-4">Address</h4>
                        <p><a href="https://maps.app.goo.gl/JWFgk1rRsoy4HJxt5"><i class="fa fa-map-marker-alt me-3"></i>Jl. Perumnas 13, Condong Catur, Depok Sleman</a></p>
                        <p><a href="https://wa.me/6287738832515"><i class="fa fa-phone-alt me-3"></i>087738832515</a></p>
                        <p><a href="https://instagram.com/reallife_barbershopjogja?igshid=NjIwNzIyMDk2Mg=="><i class="fab fa-instagram me-3"></i>reallife_barbershopjogja</a></p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-light mb-4">Quick Links</h4>
                        <a class="btn btn-link" href="{{ route('home.index')}}">Home</a>
                        <a class="btn btn-link" href="{{ route('about.index')}}">Tentang kami</a>
                        <a class="btn btn-link" href="{{ route('product.index')}}">Produk</a>
                        <a class="btn btn-link" href="{{ route('service.index')}}">Layanan kami</a>
                        <a class="btn btn-link" href="{{ route('order.index')}}">Order</a>
                    </div>
                </div>
            </div>
            <div class="container-fluid copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

        <!-- JavaScript Libraries -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="assets/lib/wow/wow.min.js"></script>
        <script src="assets/lib/easing/easing.min.js"></script>
        <script src="assets/lib/waypoints/waypoints.min.js"></script>
        <script src="assets/lib/owlcarousel/owl.carousel.min.js"></script>

        <!-- Template Javascript -->
        <script src="assets/js/main.js"></script>

    </body>
</html>
