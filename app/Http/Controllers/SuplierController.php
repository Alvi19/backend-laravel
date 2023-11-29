<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = $request->input('q');

        $suplier = Suplier::where('namaspl', 'like', "%$data%")->get();

        return response()->json([
            'status' => true,
            'message' => 'List Data Suplier',
            'data' => $suplier
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
            'kodespl' => 'required',
            'namaspl' => 'required',
        ]);

        try {
            $suplier = Suplier::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Menambahkan Data Suplier',
                'data' => $suplier
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data Suplier'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Suplier $suplier)
    {
        return response()->json([
            'status' => true,
            'message' => 'Data Barang',
            'data' => $suplier
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suplier $suplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suplier $suplier)
    {
        $data = $request->validate([
            'kodespl' => 'string',
            'namaspl' => 'string',
        ]);

        try {
            $suplier->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Update Data Suplier',
                'data' => $suplier
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Update Data Suplier'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suplier $suplier)
    {
        $suplier->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Hapus Data Suplier'
        ]);
    }
}
