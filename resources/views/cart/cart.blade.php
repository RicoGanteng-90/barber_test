@extends('layout.layout')

@section('title', 'Keranjang')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Keranjang</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home.index')}}"><strong>Home</strong></a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page"><strong>Cart</strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    @if(session('error'))
        <div style="text-align: center" class="alert alert-danger"><strong>{{session('error')}}</strong></div>
    @endif

    @if(session('success'))
        <div style="text-align: center" class="alert alert-success"><strong>{{session('success')}}</strong></div>
    @endif

    <!-- Product Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">

                    @php
                        $totalPrice = 0;
                    @endphp


                    @foreach($cartt as $cart)

                    @php
                        $totalPrice += $cart->price;
                    @endphp

                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="border: 2px solid; padding: 1%">
                        <div class="product-item position-relative">

                            <div class="position-relative bg-light overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('keranjang/'.$cart->cart_img) }}" alt="Image" style="object-fit: cover; width: 280px; height: 220px;">
                            <form action="{{url('cartHapus/'.$cart->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" data-cart-id="{{ $cart->id }}">Hapus</button>
                            </form>
                            </div>
                            <div class="text-center p-4">
                                <a class="d-block h5 mb-2" href="">{{ $cart->name }}</a>
                                <span class="text-primary me-1"><span>Rp. </span>{{ number_format($cart->price, 2, ',', '.') }}<span></span></span>
                                <form action="{{url('cartEdit/'.$cart->id)}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="number" value="{{ $cart->quantity }}" min="0" name="min" style="width: 55px; text-align:center">
                                    <button type="submit" class="btn btn-secondary">+/-</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End -->

    <div style="display: flex; justify-content: center;">
        @php
            $formattedTotalPrice = "Rp. " . number_format($totalPrice, 2, ',', '.');
        @endphp
        <input type="text" name="total" style="width: 220px; text-align:center; width: 290px; height: 50px; font-size: 20px; color:black; font-weight: bold" disabled value="{{ $formattedTotalPrice }}">
    </div>

    <br>

    <div style="display: flex; justify-content: center;">
    <form action="{{route('cart.check')}}" method="get" enctype="multipart/form-data">
        <button type="submit" class="btn btn-info">Checkout</button>
    </form>
    </div>

@endsection
