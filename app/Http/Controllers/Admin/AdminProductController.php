<?php

namespace App\Http\Controllers\Admin;

use App\Models\Items;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Stok_supplier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Items::all();

        $supplier = Supplier::all();

        $barangSup = Stok_supplier::all();

        return view('admin.product.product', compact('items', 'supplier', 'barangSup'));
    }


    public function tambahSupplier(Request $request, $id)
    {
        $items2 = Items::all();

        foreach($items2 as $items2)
        {
            $supplier = Supplier::findOrFail($id);
            if($supplier)
            {
                $items2->supplier = $supplier->name;
                $items2->save();
            }
        }
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $qtyy = $request->input('qtyy');

    // Ambil stok dari database berdasarkan ID yang diberikan
    $item = Stok_supplier::findOrFail($id);

    if ($item->quantity >= $qtyy && $qtyy > 0) {
        // Periksa apakah produk sudah ada
        $items = Items::where('name', $item->name)->first();

        if (!$items) {
            // Produk belum ada, buat entri produk baru
            $items = new Items();
            $items->name = $item->name;
            $items->price = $item->price;
            $items->subtotal = $qtyy * $item->price;
            $items->product_img = $item->product_img;
            $items->quantity = $qtyy;
            $items->tanggal = now();
            $items->save();
        } else {
            // Produk sudah ada, tambahkan qty2 ke quantity
            $items->quantity += $qtyy;
            $items->subtotal = $items->quantity * $item->price;
            $items->save();
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
    public function show()
    {

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
        //
    }

}

