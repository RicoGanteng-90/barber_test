@extends('admin.layout.layout')

@section('title', 'Layanan')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pembukuan layanan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Layanan</li>
                        </ol>
                    </div>
                </main>

                <!-- Customer's Product -->
                <div class="container">
                <div class="card bg-light">
                        <div class="card-body">
                                <b>
                                <p style="font-family: cursive;">Tanggal :  <span id="tanggal"></span></p>
                                <p style="font-family: cursive;">Nama Layanan :  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cariBarang">Cari layanan</button></p>

                                </b>
                        </div>
                    </div>
                </div>
                <!-- Customer's Product End -->
<br>

                @if(session('error'))
                    <div style="text-align: center" class="alert alert-warning">{{session('error')}}</div>
                @endif

                @if(session('success'))
                    <div style="text-align: center" class="alert alert-success">{{session('success')}}</div>
                @endif

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
                                            <th>Layanan</th>
                                            <th>Harga</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($layan as $layan)
                                    <tr>
                                            <td>{{$layan->serv_img}}</td>
                                            <td>{{$layan->name}}</td>
                                            <td>{{$layan->price}}</td>
                                            <td>{{$layan->tanggal}}</td>
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
                    <table id="cariLayanan">
                    <thead>
                        <tr>
                            <th>Preview</th>
                            <th>Layanan</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($layanan as $layanan)
                    <tr>
                            <td><img src="{{asset('layanan/'.$layanan->img_service)}}" alt="Image" style="object-fit: cover; width: 180px;"></td>
                            <td>{{$layanan->name}}</td>
                            <td>{{$layanan->price}}</td>
                            <form action="{{url('addService/'.$layanan->id)}}" method="post" enctype="multipart/form-data">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>
                <!--Product's modal end-->
@endsection
