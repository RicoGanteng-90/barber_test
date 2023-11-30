<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Kelola_barang;
use App\Models\Kelola_layanan;
use App\Models\Kelola_pemesanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function index()
    {
        $customer_id = Auth::id();
        $order = Kelola_pemesanan::where('customer_id', $customer_id)->get();

        return view('order.order', compact('order'));
    }

    public function hapusOrder(Request $request, $id){
        $item = Kelola_pemesanan::findOrFail($id);

        if ($item->order_img) {
            $oldFile = public_path('bukti/' . $item->order_img);
            if (File::exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $item->delete();

        return back()->with('success', 'Item dihapus');
    }


    public function uploadBukti(Request $request, $id){

        $order = Kelola_pemesanan::findOrFail($id);

        if ($request->hasFile('order_img')) {
            $oldFile = 'bukti/' . $order->order_img;
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }

            $newFileName = $request->file('order_img')->getClientOriginalName();
            $request->file('order_img')->move(public_path('bukti/'), $newFileName);
            $order->order_img = $newFileName;
        }

        $order->save();

    return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }

}
