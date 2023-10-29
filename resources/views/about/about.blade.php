@extends('layout.layout')

@section('title', 'About')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">About Us</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#"><strong>Home</strong></a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page"><strong>About Us</strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="assets/img/barber2.jpg">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 style="color: white;" class="display-5 mb-4">Mengapa anda harus memilih kami?</h1>
                    <p>Selamat datang di Reallife Barbershop! Kami adalah destinasi terpercaya untuk pria yang mengutamakan penampilan dan gaya. Mengapa memilih kami? Karena kami memiliki tim profesional berpengalaman yang tidak hanya mahir dalam memotong rambut, tetapi juga memahami tren terkini. Selain itu, kami menawarkan suasana santai dan nyaman di mana Anda dapat bersantai sambil mendapatkan layanan berkualitas tinggi. Kami berkomitmen untuk memberikan pengalaman grooming terbaik untuk setiap pelanggan kami. Segera kunjungi kami dan rasakan perbedaan kami!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

@endsection
