@extends('layout.layout')

@section('title', 'Home')

@section('content')

    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div id="grad1">
                        <img class="w-100" src="assets/img/barber1.jpg" alt="Image">
                    </div>
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7">
                                    <h1 style="color:white" class="display-2 mb-5 animated slideInDown">Caption</h1>
                                    <a href="{{route('product.index')}}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Products</a>
                                    <a href="{{route('service.index')}}" class="btn btn-dark rounded-pill py-sm-3 px-sm-5 ms-3">Services</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Feature Start -->
    <div class="container-fluid py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 style="color: white;" class="display-5 mb-3">Our Services</h1>
                <p>Berikut merupakan beberapa layanan yang tersedia dalam barbershop kami.</p>
            </div>
        <div class="row g-3">

            @foreach($product as $product)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-dark text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="{{asset('product/'.$product->product_img)}}" alt="Image" style="object-fit: cover; width: 280px; height:200px;">
                        <h4 class="mb-3">{{$product->name}}</h4><br>
                        <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="{{ route ('service.index') }}">Read More</a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Feature End -->
@endsection
