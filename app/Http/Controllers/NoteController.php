<?php

namespace App\Http\Controllers;

use App\Models\Jual_barang;
use App\Models\Jual_layanan;
use App\Models\Kelola_pemesanan;
use App\Models\Nota_barang;
use Mpdf\Mpdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $note = Kelola_pemesanan::findOrFail($id);

        return view('cetak', compact('note'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cetak_pdf($id)
    {
        $user = Auth::user();

        $note = Kelola_pemesanan::findOrFail($id);
        $pdf = app()->make('dompdf.wrapper');
        $pdf->loadView('cetak', compact('note'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->stream('Order-Dari-'.$user->name.'-'.$note->id);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function beliBarang(Request $request)
    {
        $user = Auth::user();

        $barang = Nota_barang::all();
        $pdf = app()->make('dompdf.wrapper');

        $filename = 'Nota_' . now()->timestamp . '.pdf';

        $pdf->loadView('cetak2', compact('barang'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream($filename);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $barang = Nota_barang::all();

        return view('cetak2', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tampilNotaBarang(Request $request)
    {
        $jual = Nota_barang::all();

        return view('cetak3', compact('jual'));
    }

    public function notaJual(Request $request)
    {
        $user = Auth::user();

        $jual = Jual_barang::all();
        $pdf = app()->make('dompdf.wrapper');

        $filename = 'Nota_' . now()->timestamp . '.pdf';

        $pdf->loadView('cetak3', compact('jual'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream($filename);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function tampilNotaLayanan(Request $request)
     {
         $layan = Jual_layanan::all();

         return view('cetak3', compact('layan'));
     }

     public function notaLayan(Request $request)
    {
        $user = Auth::user();

        $layan = Jual_layanan::all();
        $pdf = app()->make('dompdf.wrapper');

        $filename = 'Nota_' . now()->timestamp . '.pdf';

        $pdf->loadView('cetak3', compact('layan'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream($filename);
    }

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
