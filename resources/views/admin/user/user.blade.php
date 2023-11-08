@extends('admin.layout.layout')

@section('title', 'User')

@section('content')

<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Kelola User</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">User</li>
                        </ol>
                    </div>
                </main>

                <div class="card mb-4">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="">Tambah User</button>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama supplier</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>No telepon</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user as $user)
                                        <tr>
                                            <td>{{$user->nama_user}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->no_telp}}</td>
                                            <td>{{$user->alamat}}</td>
                                            <td>
                                                <form action="" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="">Update</button>
                                            </td>
                                        </tr>
                                        @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

@endsection
