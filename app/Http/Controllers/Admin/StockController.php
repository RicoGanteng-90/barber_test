<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Stok_supplier;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver\BackedEnumValueResolver;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stoks = Stok_supplier::all();

        $barang = Product::all();

        return view('admin.stock.stock', compact('stoks', 'barang'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
{
    $qty2 = $request->input('qty2');

    // Ambil stok dari database berdasarkan ID yang diberikan
    $stok = Stok_supplier::findOrFail($id);

    if ($stok->quantity >= $qty2 && $qty2 > 0) {
        // Periksa apakah produk sudah ada
        $product = Product::where('name', $stok->name)->first();

        if (!$product) {
            // Produk belum ada, buat entri produk baru
            $product = new Product();
            $product->name = $stok->name;
            $product->price = $stok->price;
            $product->information = $stok->information;
            $product->product_img = $stok->product_img;
            $product->quantity = $qty2;
            $product->save();
        } else {
            // Produk sudah ada, tambahkan qty2 ke quantity
            $product->quantity += $qty2;
            $product->save();
        }

        // Kurangi stok dari stok supplier
        $stok->quantity -= $qty2;
        $stok->save();

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
    public function store()
    {

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
