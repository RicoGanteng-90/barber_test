@extends('admin.layout.layout')

@section('title', 'layanan')

@section('content')


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Penjualan layanan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Layanan</li>
                        </ol>
                    </div>
                </main>

                <div class="container">
                <div class="card bg-light">
                        <div class="card-body">
                        <form action="{{ route('nota.filter3') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" name="start_date" class="form-control" value="{{$start_date}}">
                                </div>
                                <div class="col-md-3">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" name="end_date" class="form-control" value="{{$end_date}}">
                                </div>
                                <div class="col-md-3">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <form action="{{ route('note.jualLayanan') }}">
                            @csrf
                        <input type="hidden" name="start_date" value="{{$start_date}}">
                        <input type="hidden" name="end_date" value="{{$end_date}}">
                        <button type="submit" class="btn btn-info">PDF</button>
                        </form>
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
                                            <th>Layanan</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>Customer</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($layanan as $nota)
                                        <tr>
                                            <td>{{$nota->tanggal_transaksi}}</td>
                                            <td>{{$nota->layanan}}</td>
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
