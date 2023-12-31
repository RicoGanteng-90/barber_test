@extends('layout.layout')

@section('title', 'Checkout')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Checkout</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home.index')}}"><strong>Home</strong></a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page"><strong>Checkout</strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="card container bg-dark">
    <div class="card-body">
        <form class="row g-3" action="{{route('cart.checkout')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="col-md-6 text-center">
                <label for="nama_barang" class="form-label">Nama customer:</label>
                <input type="text" class="form-control text-center" id="nama_barang" name="nama_barang" value="{{Auth::user()->nama_user}}" readonly>
            </div>

            <div class="col-md-6 text-center">
                <label for="barang_layanan" class="form-label">Barang/Layanan:</label>
                <input type="text" class="form-control text-center" id="barang_layanan" name="product" value="{{$productList}}" readonly>
            </div>

            <div class="col-6 text-center">
                <label for="event_time" class="form-label">Tanggal acara:</label>
                <input type="date" class="form-control text-center" id="event_time" name="event_time" required="" oninvalid="this.setCustomValidity('Tolong isi Tanggal transaksinya')" oninput="setCustomValidity('')">
            </div>

            <div class="col-md-6 text-center">
                <label for="total_harga" class="form-label">Total harga:</label>
                @php
                    $formattedTotalPrice = "Rp. " . number_format($totalPrice, 2, ',', '.');
                @endphp
                <input type="text" class="form-control text-center" id="total_harga" name="total_price" value="{{$formattedTotalPrice}}" readonly>
            </div>

            <div class="col-md-6 offset-md-3 text-center" style="justify-items: center;">
                <label for="payment_method" class="form-label">Metode pembayaran:</label>
                <select class="form-control text-center" id="payment_method" name="payment_method" required="" oninvalid="this.setCustomValidity('Tolong isi metode pembayarannya')" oninput="setCustomValidity('')">
                    <option value=""></option>
                    <option value="BRI">BRI</option>
                </select>
            </div>


                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
    </div>
</div>



@endsection
