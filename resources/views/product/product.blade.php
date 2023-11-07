@extends('layout.layout')

@section('title', 'Produk')

@section('content')

    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown">Products</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-white" href="#"><strong>Home</strong></a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page"><strong>Products</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Product Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 style="color: white;" class="display-5 mb-3">Produk kami</h1>
                        <p>Berikut merupakan produk produk yang kami jual.</p>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                    @foreach($product2 as $product2)


                    <div class="modal fade" id="detailBarang{{$product2->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="width: 600px;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Detail barang</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="product-details">
                                        <img src="{{asset('product/'.$product2->product_img)}}" alt="Image" style="object-fit: cover; width: 230px; height: 200px;">
                                        <div class="product-info">
                                            <p><strong>Nama:</strong> {{$product2->nama_barang}}</p>
                                            <p><strong>Jenis:</strong> {{$product2->jenis_barang}}</p>
                                            <p><strong>Jumlah:</strong> {{$product2->quantity}}</p>
                                            <p><strong>Harga:</strong> Rp. {{number_format($product2->harga_barang, 2, ',', '.')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>



                        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="border: 2px solid; padding:1%">
                            <div class="product-item">
                                <div class="position-relative bg-light overflow-hidden">
                                    <img class="img-fluid w-100" src="{{asset('product/'.$product2->product_img)}}" alt="Image" style="object-fit: cover; width: 280px; height:220px;">
                                </div>
                                <div class="text-center p-4">
                                    <a class="d-block h5 mb-2">{{$product2->nama_barang}}</a>
                                    <span class="text-primary me-1"><span>Rp. </span>{{number_format($product2->harga_barang,2,',','.')}}<span></span></span>
                                </div>
                                <div class="d-flex border-top" style="justify-content: center; display: flex;">
                                    <small class="w-50 text-center py-2">
                                    <form action="{{url('cartAdd/'.$product2->id)}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit" class="btn btn-primary add-to-cart">Tambah</button>&ensp;<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailBarang{{$product2->id}}" style="width: 70px;">Detail</button> <br><br>
                                        <input type="number" name="jumlah" style="width: 50px; text-align:center;" value="0">
                                    </form>
                                    </small>
                                </div>
                            </div>
                        </div>
                    @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End -->
@endsection
