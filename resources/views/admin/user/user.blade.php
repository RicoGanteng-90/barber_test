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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputUser">Tambah User</button>
                                <a href="/user2" class="btn btn-primary">Deleted user</a>
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
                                        @foreach($user as $user)
                                        <tr>
                                            <td>{{$user->nama_user}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->no_telp}}</td>
                                            <td>{{$user->alamat}}</td>
                                            <td>{{$user->role_user}}</td>
                                            <td>
                                                @if (Auth::user()->role_user === 'admin' && $user->role_user === 'customer' || Auth::user()->role_user === 'owner')
                                                <form action="{{url('deleteUser/'.$user->id)}}" method="post" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                @endif
                                                @if (Auth::user()->role_user === 'admin' && $user->role_user === 'customer' || Auth::user()->role_user === 'owner')
                                                <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateUser{{$user->id}}">Update</button>
                                                @endif
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="updateUser{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form class="row g-3" action="{{ url('updateUser/'.$user->id) }}" method="post">
                                                @csrf

                                                <div class="col-6">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input name="username" type="text" class="form-control" id="username" value="{{ $user->username }}" required="" oninvalid="this.setCustomValidity('Tolong isi Nama terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                    <label for="nama_user" class="form-label">Nama</label>
                                                    <input name="nama_user" type="text" class="form-control" id="nama_user" value="{{ $user->nama_user }}" required="" oninvalid="this.setCustomValidity('Tolong isi Jumlah terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input name="email" type="text" class="form-control" id="email" value="{{ $user->email }}" required="" oninvalid="this.setCustomValidity('Tolong isi Harga terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                    <label for="no_telp" class="form-label">No Telepon</label>
                                                    <input name="no_telp" type="text" class="form-control" id="no_telp" value="{{ $user->no_telp }}" required="" oninvalid="this.setCustomValidity('Tolong isi Keterangan terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input name="alamat" type="text" class="form-control" id="alamat" value="{{ $user->alamat }}" required="" oninvalid="this.setCustomValidity('Tolong isi Alamat terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                    <p>Role</p>
                                                    <input type="radio" id="customer" name="role" value="customer" required>
                                                    <label style="margin-right:10px;" for="customer">Customer</label>

                                                    <input type="radio" id="admin" name="role" value="admin" required>
                                                    <label style="margin-right:30px;" for="admin">Admin</label>

                                                    @if(Auth::user() === 'owner')
                                                    <input type="radio" id="owner" name="role" value="owner" required>
                                                    <label style="margin-right:30px;" for="owner">Owner</label>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="modal-footer">
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

                                <div class="modal fade" id="inputUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="text-center">

                                            <form class="row g-3" action="{{route('user.create')}}" method="post">
                                                @csrf

                                                <div class="col-6">
                                                <label for="username" class="form-label">Username</label>
                                                <input name="username" type="text" class="form-control" id="username" required="" oninvalid="this.setCustomValidity('Tolong isi Nama terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                <label for="nama_user" class="form-label">Nama</label>
                                                <input name="nama_user" type="text" class="form-control" id="nama_user" required="" oninvalid="this.setCustomValidity('Tolong isi Jumlah terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                <label for="email" class="form-label">Email</label>
                                                <input name="email" type="text" class="form-control" id="email"  required="" oninvalid="this.setCustomValidity('Tolong isi Harga terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                <label for="password" class="form-label">Password</label>
                                                <input name="password" type="text" class="form-control" id="password"  required="" oninvalid="this.setCustomValidity('Tolong isi Password terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                    <label for="no_telp" class="form-label">No Telepon</label>
                                                    <input name="no_telp" type="text" class="form-control" id="no_telp" required="" oninvalid="this.setCustomValidity('Tolong isi Keterangan terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <input name="alamat" type="text" class="form-control" id="alamat" required="" oninvalid="this.setCustomValidity('Tolong isi Alamat terlebih dahulu')" oninput="setCustomValidity('')">
                                                </div>

                                                <div class="col-6">
                                                    <p>Role</p>
                                                    <input type="radio" id="customer" name="role_user" value="customer" required>
                                                    <label style="margin-right:10px;" for="customer">Customer</label><br>

                                                    <input type="radio" id="admin" name="role_user" value="admin" required>
                                                    <label style="margin-right:30px;" for="admin">Admin</label><br>

                                                    @if(Auth::user() === 'owner')
                                                    <input type="radio" id="owner" name="role_user" value="owner" required>
                                                    <label style="margin-right:29px;" for="owner">Owner</label>
                                                    @endif
                                                </div>

                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

@endsection
