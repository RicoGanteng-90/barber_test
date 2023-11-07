<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Kelola_barang;
use App\Models\Kelola_layanan;
use App\Models\Kelola_pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $customer_id = Auth::id();
        $order = Kelola_pemesanan::where('customer_id', $customer_id)->get();

        return view('order.order', compact('order'));
    }

    public function hapusOrder($id){
        $item = Kelola_pemesanan::findOrFail($id);

        $item->delete();

        return back()->with('success', 'Item dihapus');
    }


    public function uploadBukti(Request $request, $id){

        $order = Kelola_pemesanan::findOrFail($id);

    if ($request->hasFile('order_img')) {
        $image = $request->file('order_img');
        $imageName = time() . '.' . $image->getClientOriginalName();
        $image->move(public_path('bukti'), $imageName);

        $order->order_img = $imageName;
        $order->save();

    }

    return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

}
