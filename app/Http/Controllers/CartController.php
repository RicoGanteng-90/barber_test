<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Kelola_barang;
use App\Models\Kelola_layanan;
use App\Models\Kelola_pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_id = Auth::id();
        $cartt = Cart::where('customer_id', $customer_id)->get();

        return view('cart.cart', compact('cartt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $qty3 = $request->input('jumlah');

        if ($qty3 == '0') {
            return back()->with('error', 'Pilih produk terlebih dahulu');
        }

    $prod = Kelola_barang::findOrFail($id);

    $id_customer = Auth::id();

    if ($prod->quantity < $qty3) {
        return back()->with('error', 'Stok produk habis');
    }

    if ($prod->quantity >= $qty3 && $qty3 > 0) {
        $cart = Cart::where('name', $prod->nama_barang)->first();

        if (!$cart) {
            $cart = new cart();
            $cart->customer_id = $id_customer;
            $cart->name = $prod->nama_barang;
            $cart->price = $prod->harga_barang*$qty3;
            $cart->quantity = $qty3;

            $imagePath = public_path('product/' . $prod->product_img);
            $newImagePath = public_path('keranjang/' . $prod->product_img);

        if (File::exists($imagePath)) {
            File::copy($imagePath, $newImagePath);
            $cart->cart_img = $prod->product_img;
        }

            $cart->save();
        } else {
            $cart->quantity += $qty3;
            $cart->price = $cart->quantity*$prod->harga_barang;

            $imagePath = public_path('product/' . $prod->product_img);
            $newImagePath = public_path('keranjang/' . $prod->product_img);

        if (File::exists($imagePath)) {
            File::copy($imagePath, $newImagePath);
            $cart->cart_img = $prod->product_img;
        }

            $cart->save();
        }

        return back()->with('success', 'Produk telah ditambahkan');
    } else {
        return back()->with('error', 'Produk gagal ditambahkan');
    }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

public function tambahLayanan(Request $request, $id)
{
    $lay = $request->input('lay');

    if (empty($lay)) {
        return back()->with('error', 'Silahkan input layanan terlebih dahulu');
    }

    $layanan = Kelola_layanan::findOrFail($id);

    if ($layanan->quantity < $lay) {
        return back()->with('error', 'Stok tidak mencukupi');
    }

    if ($layanan->quantity >= $lay && $lay > 0) {
    $cart = Cart::where('name', $layanan->nama_layanan)->first();

    $id_customer = Auth::id();

    if (!$cart) {
        $cart = new Cart();
        $cart->customer_id = $id_customer;
        $cart->name = $layanan->nama_layanan;
        $cart->price = $layanan->harga_layanan * $lay;
        $cart->quantity = $lay;

        $layanan->quantity -= $lay;
        $layanan->save();

        $imagePath = public_path('layanan/' . $layanan->img_service);
        $newImagePath = public_path('keranjang/' . $layanan->img_service);

        if (File::exists($imagePath)) {
            File::copy($imagePath, $newImagePath);
            $cart->cart_img = $layanan->img_service;
        }

        $cart->save();
    } else {
        $cart->quantity += $lay;
        $cart->price = $cart->quantity * $layanan->harga_layanan;

        // Update kolom quantity pada layanan
        $layanan->quantity -= $lay;
        $layanan->save();

        $imagePath = public_path('layanan/' . $layanan->img_service);
        $newImagePath = public_path('keranjang/' . $layanan->img_service);

        if (File::exists($imagePath)) {
            File::copy($imagePath, $newImagePath);
            $cart->cart_img = $layanan->img_service;
        }

        $cart->save();
    }
    return back()->with('success', 'Layanan telah ditambahkan');
    }else{
        return back()->with('success', 'Layanan gagal ditambahkan');
    }

    return back()->with('success', 'Layanan telah ditambahkan');
}




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
{
    $min = $request->input('min');

    $cart = Cart::findOrFail($id);

    if ($cart) {
        $originalQuantity = $cart->quantity;

        $cart->quantity = $min;
        $cart->price = $cart->price / $originalQuantity * $min;
        $cart->save();

        $product = Kelola_barang::where('nama_barang', $cart->nama_barang)->first();
        if ($product) {
            if ($product->quantity >= ($originalQuantity - $min)) {
                $product->quantity += ($originalQuantity - $min);
                $product->save();
            } else {
                return back()->with('error', 'Stok produk habis');
            }
        }

        $service = Kelola_layanan::where('nama_layanan', $cart->name)->first();
        if ($service) {
            if ($service->quantity >= ($originalQuantity - $min)) {
                $service->quantity += ($originalQuantity - $min);
                $service->save();
            } else {
                return back()->with('error', 'Stok layanan habis');
            }
        }
    }

    return back()->with('success', 'Jumlah produk/layanan');
}





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    $item = Cart::findOrFail($id);

    if ($item) {
        $name = $item->name;
        $quantity = $item->quantity;

        $item->delete();

        $product = Kelola_barang::where('nama_barang', $name)->first();
        if ($product) {
            $product->quantity += $quantity;
            $product->save();
        }

        $service = Kelola_layanan::where('nama_layanan', $name)->first();
        if ($service) {
            $service->quantity += $quantity;
            $service->save();
        }

        return back()->with('success', 'Item dihapus');
    } else {
        return back()->with('error', 'Gagal menghapus.');
    }
}


    public function checkout(Request $request){

            $user = Auth::user();

            $customer_id = $user->id;

            if ($user) {

                $order = new Kelola_pemesanan();
                    $order->customer_id = $user->id;
                    $order->nama_customer = $user->nama_user;
                    $order->email_customer = $user->email;
                    $order->no_telp = $user->no_telp;
                    $order->product = $request->input('product');
                    $order->tanggal_transaksi = now();
                    $order->tanggal_pemesanan = $request->input('event_time');
                    $order->metode_pembayaran = $request->input('payment_method');
                    $order->status_pemesanan = 'Menunggu konfirmasi';
                    $order->status_pembayaran = 'Belum lunas';
                    $order->total_bayar = $request->input('total_price');
                    $order->save();

                    Cart::where('customer_id', $customer_id)->delete();

            return redirect()->route('order.index')->with('success', 'Checkout berhasil!');
            }
    }

    public function check(){

        $customer_id = Auth::id();
        $cart = Cart::where('customer_id', $customer_id)->get();

        $totalPrice = 0;
        $total = 0;
        $productNames = [];

        foreach ($cart as $item) {
        $totalPrice += $item->price;
        $total = $item->quantity;
        $productNames[] = $item->name . '(' . $item->quantity . ')';
    }

        $productList = implode(', ', $productNames);

        return view('checkout.checkout', compact('cart', 'totalPrice', 'total', 'productList'));
    }
    }
