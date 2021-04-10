<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Sale::paginate(10);

        $car = Car::select('id', 'nama')->get();
        $arr_car = ['' => '== Pilih Mobil =='];
        foreach ($car as $val) {
            $arr_car[$val->id] = $val->nama;
        }

        return view('sale.index', [
            'result'    => $result,
            'arr_car'   => $arr_car
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string',
            'email'         => 'required|email',
            'no_hp'         => 'required|numeric',
            'tanggal_jual'  => 'required|date_format:Y-m-d',
            'car_id'        => 'required'
        ]);

        $arr_data = [
            'nama'          => $request->nama,
            'email'         => $request->email,
            'no_hp'         => $request->no_hp,
            'tanggal_jual'  => $request->tanggal_jual,
            'car_id'        => $request->car_id
        ];

        Sale::updateOrCreate(['id' => $request->sale_id], $arr_data);

        return redirect()->route('sale.index')->with('message', '<div class="alert alert-success">Penjualan Berhasil ditambahkan</div>');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = Sale::find($request->id);
        return response()->json([
            'data' => $data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = Sale::find($request->sale_id);
        if ($result->delete()) {
            return redirect()->back()->with('message', '<div class="alert alert-info">Penjualan terhapus.</div>');
        }
    }
}
