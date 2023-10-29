@extends('layout.layout')

@section('title', 'Order')

@section('content')

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Order</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="{{ route('home.index')}}"><strong>Home</strong></a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page"><strong>Order</strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

@if ($order->count() > 0)
    <div class="order-container">
        @foreach ($order as $singleOrder)
            <div class="order-box" style="color: aliceblue;">
                <ul>
                    <li><strong>Nama: {{ $singleOrder->name }}</strong></li>
                    <li><strong>Barang/layanan: {{ $singleOrder->product }}</strong></li>
                    <li><strong>Total: {{ $singleOrder->total }}</strong></li>
                    <li><strong>Tanggal order: {{ $singleOrder->order_time }}</strong></li>
                    <li><strong>Tanggal Acara: {{ $singleOrder->event_time }}</strong></li>
                    <li><strong>Metode pembayaran: {{ $singleOrder->payment_method }}</strong></li>
                    <li><strong>Status pesanan: {{ $singleOrder->order_satus }}</strong></li>
                    <li><strong>Status pembayaran: {{ $singleOrder->payment_status }}</strong></li>
                </ul>
                <div class="total">
                    <strong>Total Harga: {{ $singleOrder->total_price }}</strong>
                </div>
                <br>
                @if ($singleOrder->order_satus === 'Menunggu konfirmasi' && $singleOrder->payment_status === 'Belum lunas')
                <form action="{{url('orderDelete/'.$singleOrder->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus order</button>
                </form>
                @elseif ($singleOrder->order_satus === 'Diproses' && $singleOrder->payment_status === 'Belum lunas')
                <input type="file" name="proof">
                <button type="button" class="btn btn-secondary">Kirim</button>
                @elseif ($singleOrder->order_satus === 'Diproses' && $singleOrder->payment_status === 'Lunas')
                <br>
                <button type="button" class="btn btn-info">Cetak nota</button>
                @endif
            </div>
        @endforeach
    </div>

    @else
    <h1 style="color: red; text-align:center">Pesanan kosong.</h1>
@endif

@endsection
