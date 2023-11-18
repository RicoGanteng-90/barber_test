<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use Barryvdh\DomPDF\PDF;
use App\Models\Jual_barang;
use App\Models\Nota_barang;
use Illuminate\Support\Str;
use App\Models\Jual_layanan;
use Illuminate\Http\Request;
use App\Models\Kelola_pemesanan;
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

        $filename = 'Nota_' . Str::random(40) . '.pdf';

        $pdf->loadView('cetak', compact('note'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream($filename);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function beliBarang(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $user = Auth::user();

        $barang = Nota_barang::whereBetween('tanggal_transaksi', [$start, $end])->get();

        $pdf = app()->make('dompdf.wrapper');

        $filename = 'Nota_' . Str::random(30) . '.pdf';

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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function notaJual(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $user = Auth::user();

        $jual = Jual_barang::whereBetween('tanggal_transaksi', [$start, $end])->get();

        $pdf = app()->make('dompdf.wrapper');

        $filename = 'Nota_' . str::random(30) . '.pdf';

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

     public function notaLayan(Request $request)
    {
        $start = $request->input('start_date');
        $end = $request->input('end_date');

        $user = Auth::user();

        $layan = Jual_layanan::whereBetween('tanggal_transaksi', [$start, $end])->get();

        $pdf = app()->make('dompdf.wrapper');

        $filename = 'Nota_' . str::random(30) . '.pdf';

        $pdf->loadView('cetak4', compact('layan'));
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
