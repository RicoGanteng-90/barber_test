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
                                <p style="font-family: cursive;">Cari customer :  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#yoiCustomer">Cari customer</button></p>

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

                @php
                    $totalPrice = 0;
                @endphp

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                DataTable Example
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Layanan</th>
                                            <th>Harga</th>
                                            <th>Total</th>
                                            <th>subTotal</th>
                                            <th>Tanggal</th>
                                            <th>Customer</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($layan as $layan)
                                        @php
                                            $totalPrice += $layan->subtotal;
                                        @endphp
                                    <tr>
                                            <td>{{$layan->name}}</td>
                                            <td>{{$layan->price}}</td>
                                            <td>{{$layan->total}}</td>
                                            <td>{{$layan->subtotal}}</td>
                                            <td>{{$layan->tanggal}}</td>
                                            <td>{{$layan->customer}}</td>
                                            <td>
                                            <form action="{{url('adminserviceDelete/'.$layan->id)}}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger">Hapus</button>
                                            </form>
                                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ubahLayanan{{$layan->id}}">Ubah</button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="ubahLayanan{{$layan->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{url('adminserviceUpdate/'.$layan->id)}}" method="post">
                                                @csrf
                                            <div class="modal-body text-center">
                                                <strong>Ubah jumlah :</strong><br>
                                                <input type="number" name="quantity" style="width: 400px;" min="0">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                            </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @php
                            $formattedTotalPrice = "Rp. " . number_format($totalPrice, 2, ',', '.');
                        @endphp

                        <div class="container">
                            <h1>{{$formattedTotalPrice}}</h1>
        <br>
                            <p>Nominal : <input type="text" id="nominal" name="nominal"></p>
                            <p>Kembali : <input type="text" id="kembali" name="kembali" readonly></p>
                            <button type="button" class="btn btn-warning" onclick="hitungKembali()">Proses</button><br>
                            <form action="{{route('layanan2.jualLayanan')}}" method="post">
                                @csrf
                            <button type="submit" class="btn btn-success">Siapkan data</button>
                            </form>
                        </div>

                        <script>
    function hitungKembali() {
        var totalPrice = <?php echo $totalPrice; ?>;
        var nominal = parseFloat(document.getElementById('nominal').value);

        if (!isNaN(nominal)) {
            var kembali = nominal - totalPrice;
            if (kembali >= 0) {
                var formattedKembali = "Rp. " + kembali.toLocaleString('id-ID') + ",00";
                document.getElementById('kembali').value = formattedKembali;
            } else {
                alert("Nominal tidak mencukupi!");
            }
        } else {
            alert("Masukkan nominal yang valid.");
        }
    }
</script>

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
                            <th>Qty</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($layanan as $layanan)
                    <tr>
                            <td><img src="{{asset('layanan/'.$layanan->img_service)}}" alt="Image" style="object-fit: cover; width: 180px;"></td>
                            <td>{{$layanan->nama_layanan}}</td>
                            <td>{{$layanan->harga_layanan}}</td>
                            <form action="{{url('addService/'.$layanan->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <td><input type="number" name="qtylayanan" style="width: 70px;"></td>
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

                <div class="modal fade" id="yoiCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="card mb-4">
                            <div class="card-body">
                                <table id="Customer4">
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
                                    @foreach($user as $user)
                                        <tr>
                                            <td>{{$user->nama_user}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->no_telp}}</td>
                                            <td>{{$user->alamat}}</td>
                                            <form action="{{url('addUser/'.$user->id)}}" method="post" enctype="multipart/form-data">
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
                    </div>
                    </div>
                </div>
                </div>
@endsection
