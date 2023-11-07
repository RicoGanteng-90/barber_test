<?php

namespace App\Http\Controllers;

use App\Models\Kelola_barang;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product2 = Kelola_barang::all();

        return view('product.product', compact('product2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:80',
            'information' => 'string|max:500',
            'harga_barang' => 'required|string|max:50',
            'product_img' => 'image|max:2048',
            'quantity' => 'string',
        ]);

        if($validatedData){
        $product = new Kelola_barang();
        $product->nama_barang = $validatedData['nama_barang'];
        $product->information = $validatedData['information'];
        $product->harga_barang = $validatedData['harga_barang'];
        $product->quantity = $validatedData['quantity'];

        if ($request->hasFile('product_img')) {
            $image = $request->file('product_img');
            $imageName = time() . '.' . $image->getClientOriginalName();
            $image->move(public_path('assets/product'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        return back()->with('success', 'Produk telah dimasukkan.');
    }else{
        return back()->withErrors(['error'=>'Gagal untuk memasukkan produk.']);
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
