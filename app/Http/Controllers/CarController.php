<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Car::paginate(10);
        return view('car.index', [
            'result' => $result
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
            'nama'  => 'required|string',
            'harga' => 'required|numeric',
            'stok'  => 'required|numeric'
        ]);

        $arr_data = [
            'nama'  => $request->nama,
            'harga' => $request->harga,
            'stok'  => $request->stok
        ];

        Car::updateOrCreate(['id' => $request->car_id], $arr_data);

        return redirect()->route('car.index')->with('message', '<div class="alert alert-success">Mobil Berhasil ditambahkan</div>');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $data = Car::find($request->id);
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
        $result = Car::find($request->car_id);
        if ($result->delete()) {
            return redirect()->back()->with('message', '<div class="alert alert-info">Mobil terhapus.</div>');
        }
    }
}
