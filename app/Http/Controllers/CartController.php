<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Service;
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

    $prod = Product::findOrFail($id);

    $id_customer = Auth::id();

    if ($prod->quantity >= $qty3 && $qty3 > 0) {
        $cart = Cart::where('name', $prod->name)->first();

        if (!$cart) {
            $cart = new cart();
            $cart->customer_id = $id_customer;
            $cart->name = $prod->name;
            $cart->price = $prod->price*$qty3;
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
            $cart->price = $cart->quantity*$prod->price;

            $imagePath = public_path('product/' . $prod->product_img);
            $newImagePath = public_path('keranjang/' . $prod->product_img);

        if (File::exists($imagePath)) {
            File::copy($imagePath, $newImagePath);
            $cart->cart_img = $prod->product_img;
        }

            $cart->save();
        }

        return back()->with('success', 'Stok dan quantity produk telah berhasil diperbarui');
    } else {
        return back()->with('error', 'Stok habis atau qty2 tidak valid');
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

    $layanan = Service::findOrFail($id);

    // Pastikan ada cukup stok sebelum menambahkan ke keranjang
    if ($layanan->quantity < $lay) {
        return back()->with('error', 'Stok tidak mencukupi');
    }

    $cart = Cart::where('name', $layanan->name)->first();

    $id_customer = Auth::id();

    if (!$cart) {
        $cart = new Cart();
        $cart->customer_id = $id_customer;
        $cart->name = $layanan->name;
        $cart->price = $layanan->price * $lay;
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
        $cart->price = $cart->quantity * $layanan->price;

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

        $product = Product::where('name', $cart->name)->first();
        if ($product) {
            // Pengecekan stok produk
            if ($product->quantity >= ($originalQuantity - $min)) {
                $product->quantity += ($originalQuantity - $min);
                $product->save();
            } else {
                return back()->with('error', 'Stok produk habis');
            }
        }

        $service = Service::where('name', $cart->name)->first();
        if ($service) {
            // Pengecekan stok layanan
            if ($service->quantity >= ($originalQuantity - $min)) {
                $service->quantity += ($originalQuantity - $min);
                $service->save();
            } else {
                return back()->with('error', 'Stok layanan habis');
            }
        }
    }

    return back();
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

        // Hapus item dari tabel cart
        $item->delete();

        // Cek apakah item ada dalam tabel products
        $product = Product::where('name', $name)->first();
        if ($product) {
            // Jika ada, tambahkan quantity ke tabel products
            $product->quantity += $quantity;
            $product->save();
        }

        // Cek apakah item ada dalam tabel service
        $service = Service::where('name', $name)->first();
        if ($service) {
            // Jika ada, tambahkan quantity ke tabel service
            $service->quantity += $quantity;
            $service->save();
        }

        return back()->with('success', 'Item dihapus dan quantity ditambahkan');
    } else {
        return back()->with('error', 'Gagal menghapus.');
    }
}


    public function checkout(Request $request){

            $user = Auth::user();

            $customer_id = $user->id;

            if ($user) {

                $order = new Order();
                    $order->customer_id = $user->id;
                    $order->name = $user->name;
                    $order->product = $request->input('product');
                    $order->order_time = now();
                    $order->event_time = $request->input('event_time');
                    $order->total = $request->input('total');
                    $order->payment_method = $request->input('payment_method');
                    $order->order_satus = 'Menunggu konfirmasi';
                    $order->payment_status = 'Belum lunas';
                    $order->total_price = $request->input('total_price');
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
