@extends('admin.layout.layout')

@section('title', 'Layanan')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola layanan</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Layanan</li>
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
                            <a href="layananHapus2" class="btn btn-danger">Hapus semua</a>
                            <a href="layananKembali2" class="btn btn-success">Restore semua</a>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Preview</th>
                                            <th>Nama layanan</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($layanan as $layanan)
                                        <tr>
                                            <td><img src="{{ asset('layanan/' . $layanan->img_service) }}" alt="Image" style="object-fit: cover; width: 130px; height: 150px;"><br><br></td>
                                            <td>{{$layanan->nama_layanan}}</td>
                                            <td>{{$layanan->quantity}}</td>
                                            <td>{{$layanan->harga_layanan}}</td>
                                            <td>
                                            <a href="/layananKembali/{{$layanan->id}}" type="submit" class="btn btn-success">Restore</a>
                                            <a href="layananHapus/{{$layanan->id}}" type="submit" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endsection
