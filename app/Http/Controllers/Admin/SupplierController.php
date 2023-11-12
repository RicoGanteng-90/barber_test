<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Stok_supplier;
use App\Http\Controllers\Controller;
use App\Models\Kelola_barang;
use App\Models\Kelola_supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Kelola_supplier::all();

        return view('admin.supplier.supplier', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $supplier = Kelola_supplier::all();

        if($supplier){
            $suppliers = new Kelola_supplier();
            $suppliers->nama_supplier = $request->input('nama_supplier');
            $suppliers->email = $request->input('email');
            $suppliers->no_telp = $request->input('no_telp');
            $suppliers->alamat = $request->input('alamat');
            $suppliers->save();
        }
        return back()->with('success', 'Supplier berhasil ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
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
        $supplier = Kelola_supplier::findOrFail($id);

        if($supplier){
            $supplier->nama_supplier = $request->input('nama_supplier');
            $supplier->email = $request->input('email');
            $supplier->no_telp = $request->input('no_telp');
            $supplier->alamat = $request->input('alamat');
            $supplier->save();
        }
        return back()->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Kelola_supplier::findOrFail($id);

        $supplier->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
