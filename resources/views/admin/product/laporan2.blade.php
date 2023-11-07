@extends('admin.layout.layout')

@section('title', 'product')

@section('content')


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Penjualan barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                    </div>
                </main>

                <div class="container">
                <div class="card bg-light">
                        <div class="card-body">
                        <a href="{{route('note.jualBarang')}}" class="btn btn-primary">PDF</a>
                        </div>
                    </div>
                </div>

<br>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Tanggal transaksi</th>
                                            <th>Barang</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>Customer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($jual as $nota)
                                        <tr>
                                            <td>{{$nota->tanggal_transaksi}}</td>
                                            <td>{{$nota->barang}}</td>
                                            <td>{{$nota->jumlah}}</td>
                                            <td>{{$nota->total_harga}}</td>
                                            <td>{{$nota->customer}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


@endsection
