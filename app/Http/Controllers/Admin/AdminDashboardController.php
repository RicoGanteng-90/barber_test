<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelola_pembelian;
use App\Models\Nota_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $beli = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM nota_barangs) as months'))
                    ->rightJoin('nota_barangs', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
                    ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total')
                    ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', DB::raw('YEAR(CURDATE())'))
                    ->orderBy('bulan')
                    ->get();

        $result = [];
        foreach ($allMonths as $monthNumber => $monthName) {
            $result[$monthNumber] = [
                'bulan' => $monthName,
                'total' => 0,
            ];
        }

        foreach ($beli as $data) {
            // Accumulate total for the same month
            $result[$data->bulan]['total'] += $data->total;
        }

        // Convert the associative array to a sequential array
        $result = array_values($result);

        $resultJson = json_encode($result);

        //Break

        $jual = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM jual_barangs) as months'))
                    ->rightJoin('jual_barangs', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
                    ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total_harga')
                    ->orderBy('bulan')
                    ->get();

        $result2 = [];
        foreach ($allMonths as $monthNumber => $monthName) {
            $result2[$monthNumber] = [
                'bulan' => $monthName,
                'total_harga' => 0,
            ];
        }

        foreach ($jual as $data2) {
            // Accumulate total_harga for the same month
            $result2[$data2->bulan]['total_harga'] += $data2->total_harga;
        }

        // Convert the associative array to a sequential array
        $result2 = array_values($result2);

        $resultJson2 = json_encode($result2);

            //Break

            $layan = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM jual_layanans) as months'))
                        ->rightJoin('jual_layanans', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
                        ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total_harga')
                        ->orderBy('bulan')
                        ->get();

            $result3 = [];
            foreach ($allMonths as $monthNumber => $monthName) {
                $result3[$monthNumber] = [
                    'bulan' => $monthName,
                    'total_harga' => 0,
                ];
            }

            foreach ($layan as $data3) {
                // Accumulate total_harga for the same month
                $result3[$data3->bulan]['total_harga'] += $data3->total_harga;
            }

            // Convert the associative array to a sequential array
            $result3 = array_values($result3);

            $resultJson3 = json_encode($result3);

        return view('admin.dashboard.index', compact('resultJson', 'resultJson2', 'resultJson3'));
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
