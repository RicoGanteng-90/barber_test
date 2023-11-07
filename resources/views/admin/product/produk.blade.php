@extends('admin.layout.layout')

@section('title', 'product')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Penjualan Barang</h1>
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
                                <p style="font-family: cursive;">Lihat customer :  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cariCustomer">Lihat customer</button></p>

                                </b>
                        </div>
                    </div>
                </div>
                <!-- Customer's Product End -->
<br>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                    @php
                                        $totalPrice = 0;
                                    @endphp
                                        <tr>
                                            <th>Barang</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            <th>Customer</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($buku as $buku)
                                    @php
                                        $totalPrice += $buku->total;
                                    @endphp
                                        <tr>
                                            <td>{{$buku->barang}}</td>
                                            <td>{{$buku->harga}}</td>
                                            <td>{{$buku->jumlah}}</td>
                                            <td>{{$buku->total}}</td>
                                            <td>{{$buku->nama_customer}}</td>
                                            <td>{{$buku->tanggal_transaksi}}</td>
                                        </tr>
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
                            <button type="button" class="btn btn-warning" onclick="hitungKembali()">Proses</button>
                            <form action="{{route('jual.barang')}}" method="post">
                                @csrf
                            <button type="submit" class="btn btn-success">Siapkan</button>
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
                    <table id="barang1">
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
                        @foreach($barang as $barang)
                        <tr>
                            <td><img src="{{asset('product/'.$barang->product_img)}}" alt="Image" style="object-fit: cover; width: 95px;"></td>
                            <td>{{$barang->nama_barang}}</td>
                            <td>{{$barang->harga_barang}}</td>
                            <form action="{{url('barangAdd/'.$barang->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <td><input type="number" name="qtybarang" style="width: 50px;" min="0"></td>
                            <td><button class="btn btn-success" type="submit">Tambahkan</td>
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
                <!--Product's modal end-->

                <!--Supplier's modal-->
                <div class="modal fade" id="cariCustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="card mb-4">
                            <div class="card-body">
                                <table id="cariCustomer2">
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
                                    @foreach($customer as $user)
                                        <tr>
                                            <td>{{$user->nama_user}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->no_telp}}</td>
                                            <td>{{$user->alamat}}</td>
                                            <form action="{{url('customerAdd/'.$user->id)}}" method="post" enctype="multipart/form-data">
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
                <!--Supplier's modal end-->

@endsection
