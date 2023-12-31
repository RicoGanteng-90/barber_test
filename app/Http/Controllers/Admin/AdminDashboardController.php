<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $year = $request->input('tahun', date('Y'));

        $allMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $beli = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM nota_barangs) as months'))
                    ->rightJoin('nota_barangs', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
                    ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total')
                    ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $year)
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
            $result[$data->bulan]['total'] += $data->total;
        }

        $result = array_values($result);

        $resultJson = json_encode($result);

        //Break

        $year2 = $request->input('tahun2', date('Y'));

        $jual = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM jual_barangs) as months'))
                    ->rightJoin('jual_barangs', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
                    ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total_harga')
                    ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $year2)
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
            $result2[$data2->bulan]['total_harga'] += $data2->total_harga;
        }

        $result2 = array_values($result2);

        $resultJson2 = json_encode($result2);

            //Break

            $year3 = $request->input('tahun3', date('Y'));

            $layan = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM jual_layanans) as months'))
                        ->rightJoin('jual_layanans', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
                        ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total_harga')
                        ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $year3)
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
                $result3[$data3->bulan]['total_harga'] += $data3->total_harga;
            }

            $result3 = array_values($result3);

            $resultJson3 = json_encode($result3);

            //break

            $year4 = $request->input('tahun4', date('Y'));

            $customer = DB::table('users')
                        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as customer'))
                        ->where('role_user', '=', 'customer')
                        ->where(DB::raw('YEAR(created_at)'), '=', $year4)
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->orderBy('month')
                        ->get();

            $result4 = [];
            foreach ($allMonths as $monthNumber => $monthName) {
                $result4[$monthNumber] = [
                    'month' => $monthName,
                    'customer' => 0,
                ];
            }

            foreach ($customer as $data4) {
                $result4[$data4->month]['customer'] = $data4->customer;
            }

            $result4 = array_values($result4);

            $resultJson4 = json_encode($result4);

            //break
            $year5 = $request->input('tahun5', date('Y'));

            $supplier = DB::table('users')
                        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as supplier'))
                        ->where(DB::raw('YEAR(created_at)'), '=', $year5)
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->orderBy('month')
                        ->get();

            $result5 = [];
            foreach ($allMonths as $monthNumber => $monthName) {
                $result5[$monthNumber] = [
                    'month' => $monthName,
                    'supplier' => 0,
                ];
            }

            foreach ($supplier as $data5) {
                $result5[$data5->month]['supplier'] = $data5->supplier;
            }

            $result5 = array_values($result5);

            $resultJson5 = json_encode($result5);

            return view('admin.dashboard.index', compact('resultJson', 'resultJson2', 'resultJson3', 'resultJson4', 'resultJson5'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchData(Request $request)
    {
        $year = $request->input('tahun');

        $allMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $beli = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM nota_barangs) as months'))
            ->rightJoin('nota_barangs', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
            ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total')
            ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $year)
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
            $result[$data->bulan]['total'] += $data->total;
        }

        $result = array_values($result);

        return response()->json($result);
    }

    public function fetchData2(Request $request)
    {
        $year = $request->input('tahun2');

        $allMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $jual = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM jual_barangs) as months'))
                    ->rightJoin('jual_barangs', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
                    ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total_harga')
                    ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $year)
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
            $result2[$data2->bulan]['total_harga'] += $data2->total_harga;
        }

        $result2 = array_values($result2);

        return response()->json($result2);
    }

    public function fetchData3(Request $request)
    {
        $year = $request->input('tahun3');

        $allMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

            $layan = DB::table(DB::raw('(SELECT DISTINCT MONTH(tanggal_transaksi) as bulan FROM jual_layanans) as months'))
                        ->rightJoin('jual_layanans', 'months.bulan', '=', DB::raw('MONTH(tanggal_transaksi)'))
                        ->select(DB::raw('COALESCE(months.bulan, MONTH(tanggal_transaksi)) as bulan'), 'total_harga')
                        ->where(DB::raw('YEAR(tanggal_transaksi)'), '=', $year)
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
                $result3[$data3->bulan]['total_harga'] += $data3->total_harga;
            }

            $result3 = array_values($result3);

        return response()->json($result3);
    }

    public function fetchData4(Request $request)
    {
        $year = $request->input('tahun4');

        $allMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $customer = DB::table('users')
                        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as customer'))
                        ->where('role_user', '=', 'customer')
                        ->where(DB::raw('YEAR(created_at)'), '=', $year)
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->orderBy('month')
                        ->get();

            $result4 = [];
            foreach ($allMonths as $monthNumber => $monthName) {
                $result4[$monthNumber] = [
                    'month' => $monthName,
                    'customer' => 0,
                ];
            }

            foreach ($customer as $data4) {
                $result4[$data4->month]['customer'] = $data4->customer;
            }

            $result4 = array_values($result4);

        return response()->json($result4);
    }

    public function fetchData5(Request $request)
    {
        $year = $request->input('tahun5');

        $allMonths = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
            5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
            9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $supplier = DB::table('users')
                        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as supplier'))
                        ->where(DB::raw('YEAR(created_at)'), '=', $year)
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->orderBy('month')
                        ->get();

            $result5 = [];
            foreach ($allMonths as $monthNumber => $monthName) {
                $result5[$monthNumber] = [
                    'month' => $monthName,
                    'supplier' => 0,
                ];
            }

            foreach ($supplier as $data5) {
                $result5[$data5->month]['supplier'] = $data5->supplier;
            }

            $result5 = array_values($result5);

            return response()->json($result5);
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
