<?php

namespace App\Http\Controllers\admin;


use Illuminate\Http\Request;
use App\Models\Kelola_barang;
use App\Models\Stok_supplier;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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

        $barang = Kelola_barang::all();

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
        $product = Kelola_barang::where('nama_barang', $stok->name)->first();

        if (!$product) {
            // Produk belum ada, buat entri produk baru
            $product = new Kelola_barang();
            $product->nama_barang = $stok->name;
            $product->harga_barang = $stok->price;
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

        return back()->with('success', 'Stok berhasil diperbarui');
    } else {
        return back()->with('error', 'Stok habis');
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
    $product = Kelola_barang::findOrFail($id);

    if ($product) {
        $product->nama_barang = $request->input('nama_barang');
        $product->information = $request->input('information');
        $product->harga_barang = $request->input('harga_barang');
        $product->quantity = $request->input('quantity');

        if ($request->hasFile('product_img')) {
            $oldFile = 'product/' . $product->product_img;
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }

            $newFileName = $request->file('product_img')->getClientOriginalName();
            $request->file('product_img')->move(public_path('product/'), $newFileName);
            $product->product_img = $newFileName;
        }

        $product->save();

        return back()->with('success', 'Product berhasil diupdate');
    }

    return back()->with('error', 'Product tidak ditemukan');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Kelola_barang::findOrFail($id);

        if ($barang->product_img) {
            $oldFilePath = public_path('product/'.$barang->product_img);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $barang->delete();

        return back();
    }
}
