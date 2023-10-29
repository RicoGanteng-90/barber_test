<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Stok_supplier;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('admin.product.product', compact('suppliers'));
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
    public function store(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'stock_id' => 'required|exists:stocks,id',
        ]);

        $product = Product::find($request->input('product_id'));
        $stock = Stok_supplier::find($request->input('stock_id'));

        if ($product && $stock) {
            // Update jumlah stok produk dengan menambahkan jumlah stok dari tabel stocks
            $product->increment('quantity', $stock->quantity);

            // Hapus stok yang sudah digunakan dari tabel stocks
            $stock->delete();

            return redirect()->route('products.index');
        }

        return redirect()->back()->with('error', 'Produk atau stok tidak ditemukan.');
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
