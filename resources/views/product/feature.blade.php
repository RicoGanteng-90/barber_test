@extends('layout.layout')

@section('title', 'Service')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#"><strong>Home</strong></a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page"><strong>Services</strong></li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Feature Start -->
    <div class="container-fluid my-5 py-6">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 style="color: white;" class="display-5 mb-3">Layanan kami</h1>
                <p>Berikut merupakan beberapa layanan yang tersedia dalam barbershop kami.</p>
            </div>
            <div class="row g-3">

                @if(session('error'))
                    <div style="text-align: center" class="alert alert-danger">{{session('error')}}</div>
                @endif

                @if(session('success'))
                    <div style="text-align: center" class="alert alert-success">{{session('success')}}</div>
                @endif

            @foreach($service as $service)
            <div class="col-lg-3 col-md-3 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-dark text-center p-4 p-xl-5">
                    <img src="{{asset('layanan/'.$service->img_service)}}" alt="Image" style="object-fit: cover; width: 150px"><br><br>
                    <h4 class="mb-3">{{$service->nama_layanan}}</h4>
                    <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#detailLayanan{{$service->id}}">Lihat</button><br>
                    <form action="{{url('layananAdd/'.$service->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex align-items-center justify-content-center">
                            <button class="btn btn-secondary" type="submit">Tambah</button>&ensp;
                            <input type="number" name="lay" value="0" style="width: 60px; text-align: center;">
                        </div>
                    </form>
                </div>
            </div>

                <div class="modal fade" id="detailLayanan{{$service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 600px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail layanan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="product-details">
                                        <img src="{{asset('layanan/'.$service->img_service)}}" alt="Image" style="object-fit: cover; width: 230px; height: 200px;">
                                        <div class="product-info">
                                            <p><strong>Nama :</strong> {{$service->nama_layanan}}</p>
                                            <p><strong>Status :</strong> {{$service->status_layanan}}</p>
                                            <p><strong>Harga :</strong> Rp. {{number_format($service->harga_layanan, 2, ',', '.')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                @endforeach

            </div>
        </div>
    </div>
    <!-- Feature End -->

@endsection
