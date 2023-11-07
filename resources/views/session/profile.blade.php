@extends('layout.layout')

@section('title', 'Profile')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Profile</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="#"><strong>Home</strong></a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page"><strong>Profile</strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    @if(session('success2'))
        <div style="text-align:center;" class="alert alert-success">{{session('success2')}}</div>
    @elseif(session('error2'))
        <div style="text-align:center;" class="alert alert-danger">{{session('error2')}}</div>
    @endif
<br>
<br>
    <form method="post" action="{{route('profile.update')}}">
        @csrf
    <div class="center-box">
    <div class="container">
        <b>
            <h3>Edit profile</h2><br>
        <label for="nama" style="color: black;">Nama : </label>
        <input type="text" name="nama" id="nama" value="{{ Auth::user()->nama_user }}">

        <br><br>

        <label for="email" style="color: black;">Email : </label>
        <input type="email" name="email" id="email" value="{{ Auth::user()->email }}">

        <br><br>

        <label for="not_telp" style="color: black;">No telp : </label>
        <input type="text" name="not_telp" id="not_telp" value="{{ Auth::user()->no_telp }}">
        </b>

        <br><br>

        <button type="submit" class="btn btn-warning">Update profile</button>
    </div>
    </div>
    </form>

    <br><br>

    @if(session('success'))
        <div style="text-align:center;" class="alert alert-success">{{session('success')}}</div>
    @elseif(session('error'))
        <div style="text-align:center;" class="alert alert-danger">{{session('error')}}</div>
    @endif

    <form method="post" action="{{route('profile.edit')}}">
        @csrf
    <div class="center-box">
    <div class="container">
        <b>
            <h3>Ubah password</h2><br>
        <label for="oldPassword" style="color: black;">Password saat ini : </label>
        <input type="password" name="oldPassword" id="oldPassword">

        <br><br>

        <label for="newPassword" style="color: black;">Password baru : </label>
        <input type="password" name="newPassword" id="newPassword">

        <br><br>

        <label for="repeatPassword" style="color: black;">Ulangi password baru: </label>
        <input type="password" name="repeatPassword" id="repeatPassword">
        </b>

        <br><br>

        <button type="submit" class="btn btn-warning">Update password</button>
    </div>
    </div>
    </form>
@endsection
