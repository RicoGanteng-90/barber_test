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

                        @php
                            $totalPrice = 0;
                        @endphp
<br>
                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
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
                                        @php
                                            $totalPrice += $item->total_beli;
                                        @endphp
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{$item->price}}</td>
                                            <td>{{$item->quantity}}</td>
                                            <td>{{$item->total_beli}}</td>
                                            <td>{{$item->supplier}}</td>
                                            <td>{{$item->tanggal}}</td>
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
                            <form action="{{route('nota.tambahBarang')}}" method="post">
                                @csrf
                            <button type="submit" class="btn btn-success">Buat nota</button>
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
                        @foreach($barang as $bar)
                        <tr>
                            <td><img src="{{asset('product/'.$bar->product_img)}}" alt="Image" style="object-fit: cover; width: 95px;"></td>
                            <td>{{$bar->nama_barang}}</td>
                            <td>{{$bar->harga_barang}}</td>
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
                        <h5 class="modal-title">Supplier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="card mb-4">
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
                                            <td>{{$supplier->nama_supplier}}</td>
                                            <td>{{$supplier->email}}</td>
                                            <td>{{$supplier->no_telp}}</td>
                                            <td>{{$supplier->alamat}}</td>
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
                    </div>
                    </div>
                </div>
                </div>
                <!--Supplier's modal end-->

@endsection
