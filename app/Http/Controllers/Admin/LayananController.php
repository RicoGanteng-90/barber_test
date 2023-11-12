<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Kelola_layanan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = Kelola_layanan::all();

        return view('admin.layanan.layanan', compact('layanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $layanan = Kelola_layanan::all();

        if($layanan){
            $layanan = new Kelola_layanan();
            $layanan->nama_layanan = $request->input('nama_layanan');
            $layanan->quantity = $request->input('quantity');
            $layanan->harga_layanan = $request->input('harga_layanan');
            $layanan->informasi_layanan = $request->input('informasi_layanan');

            if ($request->hasFile('img_service')) {
                $image = $request->file('img_service');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move(public_path('layanan'), $imageName);
                $layanan->img_service = $imageName;
            }

            $layanan->save();
        }
        return back()->with('success', 'Berhasil input layanan');
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
        $layanan = Kelola_layanan::findOrFail($id);

    if ($layanan) {
        $layanan->nama_layanan = $request->input('nama_layanan');
        $layanan->quantity = $request->input('quantity');
        $layanan->informasi_layanan = $request->input('informasi_layanan');
        $layanan->harga_layanan = $request->input('harga_layanan');

        if ($request->hasFile('img_service')) {
            $oldFile = 'layanan/' . $layanan->img_service;
            if (File::exists($oldFile)) {
                File::delete($oldFile);
            }

            $newFileName = $request->file('img_service')->getClientOriginalName();
            $request->file('img_service')->move(public_path('layanan/'), $newFileName);
            $layanan->img_service = $newFileName;
        }

        $layanan->save();

        return back()->with('success', 'layanan berhasil diupdate');
    }}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $layanan = Kelola_layanan::findOrFail($id);

        if ($layanan->product_img) {
            $oldFilePath = public_path('product/'.$layanan->img_service);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        $layanan->delete();

        return back()->with('success', 'Layanan berhasil dihapus');
    }
}
