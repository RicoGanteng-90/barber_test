@extends('admin.layout.layout')

@section('title', 'product')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pembukuan Barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                    </div>
                </main>

                <!-- Customer's Product -->
                <div class="container">
                <div class="card bg-light">
                        <div class="card-body">
                                <b>
                                <p style="font-family: cursive;">Tanggal :  <span id="tanggal"></span></p>
                                <p style="font-family: cursive;">Nama Barang :  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cariBarang">Cari barang</button></p>
                                <p style="font-family: cursive;">Lihat Supplier :  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cariSupplier">Lihat Supplier</button></p>

                                </b>
                        </div>
                    </div>
                </div>
                <!-- Customer's Product End -->
<br>
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
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                            <th>Supplier</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($items as $item)
                                        <tr>
                                            <td>{{$item->product_img}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->subtotal}}</td>
                                            <td>{{$item->supplier}}</td>
                                            <td>{{$item->tanggal}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                <!--Product's modal-->
                <div class="modal fade" id="cariBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Input Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <table id="produkSupplier">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>Barang</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barangSup as $bar)
                        <tr>
                            <td>{{$bar->product_img}}</td>
                            <td>{{$bar->name}}</td>
                            <td>{{$bar->price}}</td>
                            <form action="{{url('adminproductcreate/'.$bar->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <td><input type="number" name="qtyy" style="width: 50px;"></td>
                            <td><button class="btn btn-success" type="submit">Tambahkan</td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>
                <!--Product's modal end-->

                <!--Supplier's modal-->
                <div class="modal fade" id="cariSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="cariSupplier2">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Nomor</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($supplier as $supplier)
                                        <tr>
                                            <td>{{$supplier->name}}</td>
                                            <td>{{$supplier->email}}</td>
                                            <td>{{$supplier->number}}</td>
                                            <td>{{$supplier->address}}</td>
                                            <form action="{{url('supplierAdd/'.$supplier->id)}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <td>
                                                    <button type="submit" class="btn btn-success">Tambahkan</button>
                                            </td>
                                            </form>
                                        </tr>
                                        @endforeach
                                  </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>
                <!--Supplier's modal end-->

@endsection
