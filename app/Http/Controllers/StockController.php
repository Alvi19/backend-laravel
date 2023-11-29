<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Stock::all();

        return response()->json([
            'status' => true,
            'message' => 'List Data Stock',
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
            'kodebrg' => 'required|exists:barangs,kodebrg',
            'qtybeli' => 'required'
        ]);

        try {
            $stock = Stock::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Menambahkan Data Stock',
                'data' => $stock
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data Stock',
            ]);;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return response()->json([
            'status' => true,
            'message' => 'Data Barang',
            'data' => $stock
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        $data = $request->validate([
            'kodebrg' => 'string',
            'qtybeli' => 'string',
        ]);

        try {
            $stock->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Update Data Stock',
                'data' => $stock
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Update Data Stock'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Hapus Data Stock'
        ]);
    }
}
