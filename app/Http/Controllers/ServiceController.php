<?php

namespace App\Http\Controllers;

use App\Models\Kelola_layanan;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service = Kelola_layanan::all();

        return view('product.feature', compact('service'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_layanan'=>'required|string',
            'harga_layanan'=>'required|string',
            'note_service'=>'string',
            'img_service'=>'required',
        ]);

        if($validate){
        $user = new Kelola_layanan();
        $user->nama_layanan = $request->nama_layanan;
        $user->harga_layanan = $request->harga_layanan;
        $user->note_service = $request->note_service;
        $user->img_service = $request->img_service;
        $user->save();

        return redirect()->route('service.index')->with('serv-succ', 'Layanan berhasil ditambahkan');
        }else{
            return back()->withErrors(['message', 'Layanan gagal dimasukkan']);
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
