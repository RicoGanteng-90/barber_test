@extends('admin.layout.layout')

@section('title', 'Supplier')

@section('content')

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola Supplier</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Supplier</li>
                        </ol>
                    </div>
                </main>



                <div class="card mb-4">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputSupplier">Input supplier</button>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama supplier</th>
                                            <th>Email</th>
                                            <th>No telepon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($suppliers as $supplier)
                                        <tr>
                                            <td>{{$supplier->nama_supplier}}</td>
                                            <td>{{$supplier->email}}</td>
                                            <td>{{$supplier->no_telp}}</td>
                                            <td>{{$supplier->alamat}}</td>
                                            <td>
                                                <form action="{{url('deleteSupplier/'.$supplier->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editSupplier{{$supplier->id}}">Edit</button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailSupplier4{{$supplier->id}}">Detail</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="detailSupplier4{{$supplier->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <div class="text-center">
                                                        <p><strong>Nama : </strong> {{ $supplier->nama_supplier }}</p>
                                                        <p><strong>Email : </strong> {{ $supplier->email }}</p>
                                                        <p><strong>Nomor : </strong> {{ $supplier->no_telp }}</p>
                                                        <p><strong>Alamat : </strong> {{ $supplier->alamat }}</p>
                                                    </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>

                                        <div class="modal fade" id="editSupplier{{$supplier->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit supplier</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="text-center">
                                                        <form action="{{url('updateSupplier/'.$supplier->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                        <div class="row g-3">
                                                        <div class="col-6">
                                                        <label for="nama_supplier" class="form-label">Nama supplier</label>
                                                        <input name="nama_supplier" type="text" class="form-control" id="nama_supplier" value="{{$supplier->nama_supplier}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input name="email" type="text" class="form-control" id="email" value="{{$supplier->email}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="no_telp" class="form-label">Nomor telepon</label>
                                                        <input name="no_telp" type="text" class="form-control" id="no_telp" value="{{$supplier->no_telp}}">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="alamat" class="form-label">Alamat</label>
                                                        <input name="alamat" type="text" class="form-control" id="alamat" value="{{$supplier->alamat}}">
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
                                            </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="modal fade" id="inputSupplier" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="container">
                                        <h3 class="text-center">Input supplier</h3>
                                    <form class="row g-3" action="{{route('supplier.create')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="col-6">
                                            <label for="nama_supplier" class="form-label">Nama</label>
                                            <input name="nama_supplier" type="text" class="form-control" id="nama_supplier">
                                            </div>
                                            <div class="col-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input name="email" type="email" class="form-control" id="email">
                                            </div>
                                            <div class="col-6">
                                                <label for="no_telp" class="form-label">No telepon</label>
                                                <input name="no_telp" type="text" class="form-control" id="no_telp">
                                            </div>
                                            <div class="col-6">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <input name="alamat" type="text" class="form-control" id="alamat">
                                            </div>
                                            <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <button type="reset" class="btn btn-secondary">Reset</button>
                                            </div>
                                        </form><!-- Vertical Form -->
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>

@endsection
