@extends('admin.layout.layout')

@section('title', 'Orders')

@section('content')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>

                        @if(session('error'))
                            <div style="text-align: center" class="alert alert-danger"><strong>{{session('error')}}</strong></div>
                        @endif

                        @if(session('success'))
                            <div style="text-align: center" class="alert alert-success"><strong>{{session('success')}}</strong></div>
                        @endif

                        <div class="card mb-4">
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Nomor</th>
                                            <th>Produk</th>
                                            <th>Tanggal transaksi</th>
                                            <th>Tanggal pemesanan</th>
                                            <th>Metode pembayaran</th>
                                            <th>Total bayar</th>
                                            <th>Bukti</th>
                                            <th>Status pemesanan</th>
                                            <th>Status pembayaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order as $order)
                                        <tr>
                                            <td>{{$order->nama_customer}}</td>
                                            <td>{{$order->no_telp}}</td>
                                            <td>{{$order->product}}</td>
                                            <td>{{$order->tanggal_transaksi}}</td>
                                            <td>{{$order->tanggal_pemesanan}}</td>
                                            <td>{{$order->metode_pembayaran}}</td>
                                            <td>{{$order->total_bayar}}</td>
                                            <td><a href="{{ url('download-image/'.$order->order_img) }}"><img src="{{asset('bukti/'.$order->order_img)}}" alt="Belum ada bukti" style="object-fit: cover; width: 95px;"></a></td>
                                            <td>{{$order->status_pemesanan}}</td>
                                            <td>{{$order->status_pembayaran}}</td>
                                            <td>
                                                <div style="display: inline;">
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatus{{$order->id}}">Update</button>
                                                <form action="{{url('order-delete/'.$order->id)}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="updateStatus{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form id="updated-form-{{$order->id}}" action="/order-update/{{$order->id}}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                            <label for="status_pemesanan" class="form-label">Status order&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                            <input type="hidden" name="customer_id" value="{{$order->customer_id}}">
                                                <select name="status_pemesanan" class="form-select" id="status_pemesanan" aria-label="State">
                                                    <option hidden selected value="{{$order->status_pemesanan}}">{{$order->status_pemesanan}}</option>
                                                    <option value=""></option>
                                                    <option value="Menunggu konfirmasi">Menunggu konfirmasi</option>
                                                    <option value="Diproses">Diproses</option>
                                            </select>
                                            <br>
                                            <label for="status_pembayaran" class="form-label">Status pembayaran</label>
                                            <input type="hidden" name="customer_id" value="{{$order->customer_id}}">
                                            <select name="status_pembayaran" class="form-select" id="status_pembayaran" aria-label="State">
                                                <option hidden selected value="{{$order->status_pembayaran}}">{{$order->status_pembayaran}}</option>
                                                <option value=""></option>
                                                <option value="Belum lunas">Belum lunas</option>
                                                <option value="Telah lunas">Telah lunas</option>
                                            </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('updated-form-{{$order->id}}').submit();">Save changes</button>
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
                    </div>
                </main>
@endsection
