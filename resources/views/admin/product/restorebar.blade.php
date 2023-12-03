@extends('admin.layout.layout')

@section('title', 'Barang')

@section('content')


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="barang">Kelola barang</a></li>
                            <li class="breadcrumb-item active">Barang terhapus</li>
                        </ol>
                    </div>
                </main>

                        <br><br>

                        @if(session('error'))
                            <div style="text-align: center" class="alert alert-danger"><strong>{{session('error')}}</strong></div>
                        @endif

                        @if(session('success'))
                            <div style="text-align: center" class="alert alert-success"><strong>{{session('success')}}</strong></div>
                        @endif

                    <div class="card mb-4">
                            <div class="card-body">
                            <a href="barangHapus2" class="btn btn-danger">Hapus semua</a>
                            <a href="barangKembali2" class="btn btn-success">Restore semua</a>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Preview</th>
                                            <th>Nama barang</th>
                                            <th>Jenis</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($barang as $barang)
                                        <tr>
                                            <td><img src="{{ asset('product/' . $barang->product_img) }}" alt="Image" style="object-fit: cover; width: 130px; height: 150px;"><br><br></td>
                                            <td>{{$barang->nama_barang}}</td>
                                            <td>{{$barang->jenis_barang}}</td>
                                            <td>{{$barang->harga_barang}}</td>
                                            <td>{{$barang->quantity}}</td>
                                            <td>
                                                <a href="/barangKembali/{{$barang->id}}" type="submit" class="btn btn-success">Restore</a>
                                                <a href="/barangHapus/{{$barang->id}}" type="submit" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

@endsection
