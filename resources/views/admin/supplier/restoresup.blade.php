@extends('admin.layout.layout')

@section('title', 'Supplier')

@section('content')

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola Supplier</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="supplier">Kelola supplier</a></li>
                            <li class="breadcrumb-item active">Supplier terhapus</li>
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
                            <a href="supplierHapus2" class="btn btn-danger">Hapus semua</a>
                            <a href="supplierKembali2" class="btn btn-success">Restore semua</a>
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
                                                <a href="/supplierKembali/{{$supplier->id}}" class="btn btn-success">Restore</a>
                                                <a href="/supplierHapus/{{$supplier->id}}" class="btn btn-danger">Hapus</a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endsection
