<?php

namespace App\Http\Controllers;

use App\Models\Dbeli;
use Illuminate\Http\Request;

class DbeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Dbeli::all();

        return response()->json([
            'status' => true,
            'message' => 'List Data Detail Pembelian',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'notransaksi' => 'required|exists:hbelis,notransaksi',
            'kodebrg' => 'required|exists:barangs,kodebrg',
            'hargabeli' => 'required',
            'qty' => 'required',
            'diskon' => 'required',
        ]);

        try {
            $data['totalrp'] = $data['qty'] * $data['hargabeli'];
            $data['diskonrp'] = $data['totalrp'] * $data['diskon'] / 100;

            $dbeli = Dbeli::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Menambahkan Data Detail Pembelian',
                'data' => $dbeli
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data Detail Pembelian'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Dbeli $detail_pembelian)
    {
        return response()->json([
            'status' => true,
            'message' => 'Data Barang',
            'data' => $detail_pembelian
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dbeli $dbeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dbeli $detail_pembelian)
    {
        $data = $request->validate([
            'hargabeli' => 'string',
            'qty' => 'string',
            'diskon' => 'string',
            'diskonrp' => 'string',
            'totalrp' => 'string'
        ]);

        try {
            $detail_pembelian->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Update Data Detail Pembelian',
                'data' => $detail_pembelian
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Update Data Detail Pembelian'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dbeli $detail_pembelian)
    {
        $detail_pembelian->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Hapus Data Detail Pembelian'
        ]);
    }
}
