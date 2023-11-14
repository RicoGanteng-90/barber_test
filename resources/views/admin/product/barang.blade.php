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


                        @if(session('error'))
                            <div style="text-align: center" class="alert alert-danger"><strong>{{session('error')}}</strong></div>
                        @endif

                        @if(session('success'))
                            <div style="text-align: center" class="alert alert-success"><strong>{{session('success')}}</strong></div>
                        @endif

                    <div class="card mb-4">
                            <div class="card-body">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inputBarang">Tambah barang</button>
                            <a href="/barang3" type="submit" class="btn btn-primary">Barang terhapus</a>
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
                                                <form action="{{url('deleteBarang/'.$barang->id)}}" method="post" enctype="multipart/form-data" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBarang{{$barang->id}}">Edit</button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailBarang{{$barang->id}}">Detail</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="detailBarang{{ $barang->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <img src="{{ asset('product/' . $barang->product_img) }}" alt="Image" style="object-fit: cover; width: 230px; height: 200px;"><br><br>
                                                    <p><strong>Nama :</strong> {{ $barang->nama_barang }}</p>
                                                    <p><strong>Keterangan :</strong> {{ $barang->information }}</p>
                                                    <p><strong>Harga :</strong> {{ $barang->harga_barang }}</p>
                                                    <p><strong>Jumlah :</strong> {{ $barang->quantity }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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
                                                        <input name="nama_barang" type="text" class="form-control" id="nama_barang" value="{{$barang->nama_barang}}" required="" oninvalid="this.setCustomValidity('Tolong isi Nama terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="jenis_barang" class="form-label">Jenis</label>
                                                        <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" value="{{$barang->jenis_barang}}" required="" oninvalid="this.setCustomValidity('Tolong isi Jenis terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="harga_barang" class="form-label">Harga</label>
                                                        <input name="harga_barang" type="text" class="form-control" id="harga_barang" value="{{$barang->harga_barang}}" required="" oninvalid="this.setCustomValidity('Tolong isi Harga terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="information" class="form-label">Keterangan</label>
                                                        <input name="information" type="text" class="form-control" id="information" value="{{$barang->information}}" required="" oninvalid="this.setCustomValidity('Tolong isi Kterangan terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="quantity" class="form-label">Jumlah</label>
                                                        <input name="quantity" type="text" class="form-control" id="quantity" value="{{$barang->quantity}}" required="" oninvalid="this.setCustomValidity('Tolong isi Jumlah terlebih dahulu')" oninput="setCustomValidity('')">
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

                                    <div class="modal fade" id="inputBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="text-center">
                                            <form class="row g-3" action="{{route('barang.create')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-6">
                                                        <label for="nama_barang" class="form-label">Nama</label>
                                                        <input name="nama_barang" type="text" class="form-control" id="nama_barang" required="" oninvalid="this.setCustomValidity('Tolong isi Nama terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="jenis_barang" class="form-label">Jenis</label>
                                                            <input name="jenis_barang" type="text" class="form-control" id="jenis_barang" required="" oninvalid="this.setCustomValidity('Tolong isi Jenis terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="harga_barang" class="form-label">Harga</label>
                                                            <input name="harga_barang" type="text" class="form-control" id="harga_barang" required="" oninvalid="this.setCustomValidity('Tolong isi Harga terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="information" class="form-label">Keterangan</label>
                                                            <input name="information" type="text" class="form-control" id="information" required="" oninvalid="this.setCustomValidity('Tolong isi Keterangan terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="col-6">
                                                            <label for="quantity" class="form-label">Jumlah</label>
                                                            <input name="quantity" type="number" class="form-control" id="quantity" min="0" required="" oninvalid="this.setCustomValidity('Tolong isi Jumlah terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="product_img" class="form-label"></label>
                                                            <input name="product_img" type="file" class="form-control" id="product_img" required="" oninvalid="this.setCustomValidity('Tolong isi Gambar terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </form><!-- Vertical Form -->
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

@endsection
