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

    @if(session('error'))
        <div style="text-align: center" class="alert alert-danger"><strong>{{session('error')}}</strong></div>
    @endif

    @if(session('success'))
        <div style="text-align: center" class="alert alert-success"><strong>{{session('success')}}</strong></div>
    @endif

@if ($order->count() > 0)
    <div class="order-container">
        @foreach ($order as $singleOrder)
            <div class="order-box" style="color: aliceblue;">
                <ul>
                    <li><strong>Nama : {{ $singleOrder->nama_customer }}</strong></li>
                    <li><strong>Email : {{ $singleOrder->email_customer }}</strong></li>
                    <li><strong>Nomor : {{ $singleOrder->no_telp }}</strong></li>
                    <li><strong>Barang/layanan : {{ $singleOrder->product }}</strong></li>
                    <li><strong>Tanggal order : {{ $singleOrder->tanggal_transaksi }}</strong></li>
                    <li><strong>Tanggal Acara : {{ $singleOrder->tanggal_pemesanan }}</strong></li>
                    <li><strong>Metode pembayaran : {{ $singleOrder->metode_pembayaran }}</strong></li>
                    <li><strong>Status pesanan : {{ $singleOrder->status_pemesanan }}</strong></li>
                    <li><strong>Status pembayaran : {{ $singleOrder->status_pembayaran }}</strong></li>
                </ul>
                <div class="total">
                    <strong>Total Harga: {{ $singleOrder->total_bayar }}</strong>
                </div>
                <br>
                @if ($singleOrder->status_pemesanan === 'Diproses' && $singleOrder->status_pembayaran === 'Belum lunas')
                <form action="{{url('uploadBukti/'.$singleOrder->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="order_img" name="order_img">
                    {{$singleOrder->order_img}}<br>
                    <button type="submit" class="btn btn-secondary">Kirim</button>
                </form>
                <form action="{{url('orderDelete/'.$singleOrder->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus order</button>
                </form>
                @elseif ($singleOrder->status_pemesanan === 'Diproses' && $singleOrder->status_pembayaran === 'Telah lunas')
                <br>
                <a href="{{url('cetakNota/'.$singleOrder->id)}}" class="btn btn-info">Cetak nota</a>
                @endif
            </div>
        @endforeach
    </div>

    @else
    <h1 style="color: red; text-align:center">Pesanan kosong</h1>
@endif

@endsection
