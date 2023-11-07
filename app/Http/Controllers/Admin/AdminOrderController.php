<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelola_pemesanan;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Kelola_pemesanan::all();

        return view('admin.order.order', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    public function download($order_img)
    {
        $filePath = public_path('bukti/'.$order_img);
        if (file_exists($filePath)) {
            $originalFileName = pathinfo($order_img, PATHINFO_FILENAME);
            $extension = pathinfo($order_img, PATHINFO_EXTENSION);

            $newFileName = 'buktiPembayaran.'.$extension; // Nama baru yang diinginkan untuk file yang diunduh
            return response()->download($filePath, $newFileName);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $order = Kelola_pemesanan::findOrFail($id);

        $orderStatus = $request->input('status_pemesanan');
        $paymentStatus = $request->input('status_pembayaran');

        $order->status_pemesanan = $orderStatus;
        $order->status_pembayaran = $paymentStatus;
        $order->save();

        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Kelola_pemesanan::findOrFail($id);

        if ($order->order_img) {
            $oldFilePath = public_path('bukti/'.$order->order_img);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $order->delete();

        return back();
    }
}
