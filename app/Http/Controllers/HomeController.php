<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        //setlocale(LC_TIME, 'id_ID');
    }

    public function index()
    {
        $hari_ini   = Carbon::now()->format('Y-m-d');
        $kemarin    = Carbon::now()->subDays(1)->format('Y-m-d');

        $row_ini    = $this->ambil($hari_ini);

        $total = Sale::where('tanggal_jual', $hari_ini)->count();
        $total_kemarin = Sale::where('tanggal_jual', $hari_ini)->where('car_id', $row_ini[0]->car_id)->count();
        $rumus = ($total/100) * $row_ini[0]->total;

        return view('home', [
            'row_ini' => $row_ini[0],
            'total_hari_ini' => $total,
            'total_kemarin' => $total_kemarin,
            'rumus' => $rumus
        ]);
    }

    public function ambil($tanggal)
    {
        $result = DB::table('sales as s')
                    ->select('s.id', 's.car_id', 's.tanggal_jual', DB::raw('count(*) as total'), 'cars.nama', DB::raw('sum(cars.harga) as harga_total'))
                    ->leftJoin('cars', 's.car_id', '=', 'cars.id')
                    ->where('s.tanggal_jual', $tanggal)
                    ->groupBy('s.car_id')->orderBy('total', 'DESC')
                    //->limit(1)
                    ->get();
        return $result;
    }
}
