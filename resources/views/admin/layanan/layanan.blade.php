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
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#inputLayanan">Tambah layanan</button>
                            <a href="/layanan3" type="submit" class="btn btn-primary">Layanan terhapus</a>
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
                                                <form action="{{url('deleteLayanan/'.$layanan->id)}}" method="post" enctype="multipart/form-data" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editLayanan{{$layanan->id}}">Edit</button>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#detailLayanan{{$layanan->id}}">Detail</button>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="detailLayanan{{ $layanan->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <img src="{{ asset('layanan/' . $layanan->img_service) }}" alt="Image" style="object-fit: cover; width: 230px; height: 200px;"><br><br>
                                                    <p><strong>Nama :</strong> {{ $layanan->nama_layanan }}</p>
                                                    <p><strong>Keterangan :</strong> {{ $layanan->informasi_layanan }}</p>
                                                    <p><strong>Harga :</strong> {{ $layanan->harga_layanan }}</p>
                                                    <p><strong>Jumlah :</strong> {{ $layanan->quantity }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                        <div class="modal fade" id="editLayanan{{$layanan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit layanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="text-center">
                                                        <form action="{{url('updateLayanan/'.$layanan->id)}}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <img src="{{ asset('layanan/' . $layanan->img_service) }}" alt="Image" style="object-fit: cover; width: 630px; height: 400px;"><br><br>

                                                        <div class="row g-3">
                                                        <div class="col-6">
                                                        <label for="nama_layanan" class="form-label">Nama layanan</label>
                                                        <input name="nama_layanan" type="text" class="form-control" id="nama_layanan" value="{{$layanan->nama_layanan}}" required="" oninvalid="this.setCustomValidity('Tolong isi Nama terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="quantity" class="form-label">Jumlah</label>
                                                        <input name="quantity" type="text" class="form-control" id="quantity" value="{{$layanan->quantity}}" required="" oninvalid="this.setCustomValidity('Tolong isi Jumlah terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="harga_layanan" class="form-label">Harga</label>
                                                        <input name="harga_layanan" type="text" class="form-control" id="harga_layanan" value="{{$layanan->harga_layanan}}" required="" oninvalid="this.setCustomValidity('Tolong isi Harga terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="col-6">
                                                        <label for="informasi_layanan" class="form-label">Keterangan</label>
                                                        <input name="informasi_layanan" type="text" class="form-control" id="informasi_layanan" value="{{$layanan->informasi_layanan}}" required="" oninvalid="this.setCustomValidity('Tolong isi Keterangan terlebih dahulu')" oninput="setCustomValidity('')">
                                                        </div>

                                                        <div class="col-12">
                                                        <label for="img_service" class="form-label"></label>
                                                        <input name="img_service" type="file" class="form-control" id="img_service" value="{{$layanan->img_service}}">
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

                        <div class="modal fade" id="inputLayanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit layanan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="text-center">
                                            <form class="row g-3" action="{{route('layanan.create')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-6">
                                                    <label for="nama_layanan" class="form-label">Nama</label>
                                                    <input name="nama_layanan" type="text" class="form-control" id="nama_layanan" required="" oninvalid="this.setCustomValidity('Tolong isi Nama terlebih dahulu')" oninput="setCustomValidity('')">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="harga_layanan" class="form-label">Harga</label>
                                                        <input name="harga_layanan" type="text" class="form-control" id="harga_layanan" required="" oninvalid="this.setCustomValidity('Tolong isi Harga terlebih dahulu')" oninput="setCustomValidity('')">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="informasi_layanan" class="form-label">Informasi</label>
                                                        <input name="informasi_layanan" type="text" class="form-control" id="informasi_layanan" required="" oninvalid="this.setCustomValidity('Tolong isi Keterangan terlebih dahulu')" oninput="setCustomValidity('')">
                                                    </div>
                                                    <div class="col-6">
                                                        <label for="quantity" class="form-label">Jumlah</label>
                                                        <input name="quantity" type="number" class="form-control" id="quantity" min="0" required="" oninvalid="this.setCustomValidity('Tolong isi Jumlah terlebih dahulu')" oninput="setCustomValidity('')">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="img_service" class="form-label"></label>
                                                        <input name="img_service" type="file" class="form-control" id="img_service" required="" oninvalid="this.setCustomValidity('Tolong isi Gambar terlebih dahulu')" oninput="setCustomValidity('')">
                                                    </div>

                                                    <div class="text-center">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                                    </div>

                                                    </div>
                                                    <br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </form><!-- Vertical Form -->
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>

@endsection
