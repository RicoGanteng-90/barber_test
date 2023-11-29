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

                @if(session('error'))
                    <div style="text-align: center" class="alert alert-danger"><strong>{{session('error')}}</strong></div>
                @endif

                @if(session('success'))
                    <div style="text-align: center" class="alert alert-success"><strong>{{session('success')}}</strong></div>
                @endif

                <div class="card mb-4">
                            <div class="card-body">
                            <a href="userHapus2" class="btn btn-danger">Hapus semua</a>
                            <a href="userKembali2" class="btn btn-success">Restore semua</a>
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nama User</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>No telepon</th>
                                            <th>Alamat</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                        <td>{{$user->nama_user}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->no_telp}}</td>
                                            <td>{{$user->alamat}}</td>
                                            <td>{{$user->role_user}}</td>
                                            <td>
                                                <a href="/userKembali/{{$user->id}}" class="btn btn-success">Restore</a>
                                                <a href="/userHapus/{{$user->id}}" class="btn btn-danger">Hapus</a>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
@endsection
