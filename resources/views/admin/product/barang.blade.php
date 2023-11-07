@extends('admin.layout.layout')

@section('title', 'product')

@section('content')


<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola barang</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Barang</li>
                        </ol>
                    </div>
                </main>

                    <div class="container">
                    <form class="row g-3" action="{{route('barang.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-6">
                            <label for="nama_barang" class="form-label">Nama</label>
                            <input name="nama_barang" type="text" class="form-control" id="nama_barang">
                            </div>
                            <div class="col-6">
                                <label for="jenis_barang" class="form-label">Jenis</label>
                                <input name="jenis_barang" type="text" class="form-control" id="jenis_barang">
                            </div>
                            <div class="col-6">
                                <label for="harga_barang" class="form-label">Harga</label>
                                <input name="harga_barang" type="text" class="form-control" id="harga_barang">
                            </div>
                            <div class="col-6">
                                <label for="information" class="form-label">information</label>
                                <input name="information" type="text" class="form-control" id="information">
                            </div>
                            <div class="col-6">
                                <label for="quantity" class="form-label">Jumlah</label>
                                <input name="quantity" type="number" class="form-control" id="quantity" min="0">
                            </div>
                            <div class="col-12">
                                <label for="product_img" class="form-label"></label>
                                <input name="product_img" type="file" class="form-control" id="product_img">
                            </div>

                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form><!-- Vertical Form -->
                    </div>

                        <br><br>

                <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Preview</th>
                                            <th>Nama barang</th>
                                            <th>Jenis</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>
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
                                            <td>{{$barang->information}}</td>
                                            <td>{{$barang->quantity}}</td>
                                            <td>
                                                <form action="{{url('deleteBarang/'.$barang->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBarang{{$barang->id}}">Edit</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="editBarang{{$barang->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="text-center">
                                                        <form action="{{url('updateBarang/'.$barang->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <img src="{{ asset('product/' . $barang->product_img) }}" alt="Image" style="object-fit: cover; width: 630px; height: 400px;"><br><br>

                                                        <div class="row g-3">
                                                        <div class="col-6">
                                                        <label for="nama_barang" class="form-label">Nama barang</label>
                                                        <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$barang->nama_barang}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="jenis_barang" class="form-label">Jenis</label>
                                                        <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" value="{{$barang->jenis_barang}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="harga_barang" class="form-label">Harga</label>
                                                        <input name="harga_barang" type="text" class="form-control" id="harga_barang" value="{{$barang->harga_barang}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="information" class="form-label">Keterangan</label>
                                                        <input name="information" type="text" class="form-control" id="information" value="{{$barang->information}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="quantity" class="form-label">Jumlah</label>
                                                        <input name="quantity" type="text" class="form-control" id="quantity" value="{{$barang->quantity}}">
                                                        </div>

                                                        <div class="col-12">
                                                        <label for="product_img" class="form-label"></label>
                                                        <input name="product_img" type="file" class="form-control" id="product_img" value="{{$barang->product_img}}">
                                                        </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>


@endsection
