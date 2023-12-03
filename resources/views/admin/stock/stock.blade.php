@extends('admin.layout.layout')

@section('title', 'Stock')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stock</li>
                        </ol>
                    </div>
                </main>

                @if(session('error'))
                    <div style="text-align: center" class="alert alert-danger">{{session('error')}}</div>
                @endif

                @if(session('success'))
                    <div style="text-align: center" class="alert alert-success">{{session('success')}}</div>
                @endif

                <div class="container">
                <div class="card bg-light">
                        <div class="card-body">
                                <b>
                                <p style="font-family: cursive;">Tanggal :  <span id="tanggal"></span></p>
                                <p style="font-family: cursive;">Nama Barang :  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cariBarang">Cari barang</button></p>
                                </b>
                        </div>
                    </div>
                </div>
<br>
                <!--product's table-->
                <div class="container">
                    <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    DataTable Example
                                </div>
                                <div class="card-body">
                                    <table id="datatablesSimple">
                                        <thead>
                                            <tr>
                                                <th>Preview</th>
                                                <th>Barang</th>
                                                <th>Keterangan</th>
                                                <th>Harga</th>
                                                <th>Jumlah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($barang as $bar)
                                        <tr>
                                            <td>
                                                <img src="{{asset('product/'.$bar->product_img)}}" alt="Image" style="object-fit: cover; width: 95px;">
                                            </td>
                                            <td>{{$bar->nama_barang}}</td>
                                            <td>{{$bar->information}}</td>
                                            <td>{{$bar->harga_barang}}</td>
                                            <td>{{$bar->quantity}}</td>
                                            <td>
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBarang{{$bar->id}}">Edit</button>
                                                <form action="{{url('hapus-barang/'.$bar->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                <button type="submit" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailBarang{{$bar->id}}">Detail</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editBarang{{ $bar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <form action="{{url('update-barang/'.$bar->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                        <img src="{{ asset('product/' . $bar->product_img) }}" alt="Image" style="object-fit: cover; width: 630px; height: 400px;"><br><br>

                                                        <div class="row g-3">
                                                        <div class="col-6">
                                                        <label for="nama_barang" class="form-label">Nama barang</label>
                                                        <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$bar->nama_barang}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="information" class="form-label">Keterangan</label>
                                                        <input name="information" type="text" class="form-control" id="information" value="{{$bar->information}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="harga_barang" class="form-label">Harga</label>
                                                        <input name="harga_barang" type="text" class="form-control" id="harga_barang" value="{{$bar->harga_barang}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="quantity" class="form-label">Jumlah</label>
                                                        <input name="quantity" type="number" class="form-control" id="quantity" value="{{$bar->quantity}}">
                                                        </div>

                                                        <div class="col-12">
                                                        <label for="product_img" class="form-label">Jumlah</label>
                                                        <input name="product_img" type="file" class="form-control" id="product_img" value="{{$bar->product_img}}">
                                                        </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="detailBarang{{ $bar->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{ $bar->nama_barang }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <img src="{{ asset('product/' . $bar->product_img) }}" alt="Image" style="object-fit: cover; width: 230px; height: 200px;"><br><br>
                                                    <p><strong>Keterangan:</strong> {{ $bar->information }}</p>
                                                    <p><strong>Harga:</strong> {{ $bar->harga_barang }}</p>
                                                    <p><strong>Jumlah:</strong> {{ $bar->quantity }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end-->

                <!--Stock's modal-->
                <div class="modal fade" id="cariBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Input Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <table id="dataTable3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Preview</th>
                            <th>Barang</th>
                            <th>Keterangan</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Qty</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stoks as $stok)
                        <tr>

                            <td>{{$stok->id}}</td>
                            <td><img src="{{asset('product/'.$stok->product_img)}}" alt="Image" style="object-fit: cover; width: 95px;"></td>
                            <td>{{$stok->name}}</td>
                            <td>{{$stok->information}}</td>
                            <td>{{$stok->price}}</td>
                            <td>{{$stok->quantity}}</td>
                            <form action="{{url('adminStockStore/'.$stok->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <td>
                                <input type="hidden" name = "product_id" value="{{$stok->product_id}}">
                                <input type="number" name="qty2" inputmode="numeric">
                            </td>
                            <td>
                                    <button type="submit" class="btn btn-success">Tambah</button>
                            </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
                </div>
                <!--Stock's modal end-->

@endsection
