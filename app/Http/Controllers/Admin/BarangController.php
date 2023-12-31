<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelola_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Kelola_barang::all();

        return view('admin.product.barang', compact('barang'));
    }

    public function barang()
    {
        $barang = Kelola_barang::onlyTrashed()->get();

        return view('admin.product.restorebar', compact('barang'));
    }

    public function kembalikan($id)
    {
    	$barang = Kelola_barang::onlyTrashed()->where('id', $id);
    	$barang->restore();
    	return back()->with('success', 'Barang berhasil di restore');
    }

    public function kembalikan2()
    {
    	$barang = Kelola_barang::onlyTrashed();
    	$barang->restore();
    	return back()->with('success', 'Barang berhasil di restore');
    }

    public function hapus_permanen($id)
    {
    	$barang = Kelola_barang::onlyTrashed()->where('id', $id)->first();

        if ($barang) {
            if ($barang->product_img) {
                $oldFilePath = public_path('product/' . $barang->product_img);

                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            }
        }

    	$barang->forceDelete();

    	return back()->with('success', 'Layanan berhasil di hapus');
    }

    public function hapus_permanen2()
    {
    	$barang = Kelola_barang::onlyTrashed()->get();

        foreach ($barang as $barang) {
            if ($barang) {
                if ($barang->product_img) {
                    $oldFilePath = public_path('product/' . $barang->product_img);

                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
            }
    	$barang->forceDelete();
        }

    	return back()->with('success', 'Layanan berhasil di hapus');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $barang = Kelola_barang::all();

        if($barang){
            $barang = new Kelola_barang();
            $barang->nama_barang = $request->input('nama_barang');
            $barang->jenis_barang = $request->input('jenis_barang');
            $barang->harga_barang = $request->input('harga_barang');
            $barang->information = $request->input('information');
            $barang->quantity = $request->input('quantity');

            if ($request->hasFile('product_img')) {
                $image = $request->file('product_img');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('product'), $imageName);
                $barang->product_img = $imageName;
            }

            $barang->save();
        }
        return back()->with('suceess', 'Berhasil input barang');
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
        $product = Kelola_barang::findOrFail($id);

    if ($product) {
        $product->nama_barang = $request->input('nama_barang');
        $product->jenis_barang = $request->input('jenis_barang');
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
    }}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Kelola_barang::findOrFail($id);

        $barang->delete();

        return back()->with('success', 'Product berhasil dihapus');
    }
}
