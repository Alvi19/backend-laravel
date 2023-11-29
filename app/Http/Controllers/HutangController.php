<?php

namespace App\Http\Controllers;

use App\Models\Hutang;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Hutang::all();

        return response()->json([
            'status' => true,
            'message' => 'List Data Hutang',
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
            'kodespl' => 'required|exists:supliers,kodespl',
            'tglbeli' => 'required',
            'totalhutang' => 'required'
        ]);

        try {
            $hutang = Hutang::create($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Menambahkan Data Hutang',
                'data' => $hutang
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data Stock',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hutang $hutang)
    {
        return response()->json([
            'status' => true,
            'message' => 'Data Hutang',
            'data' => $hutang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hutang $hutang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hutang $hutang)
    {
        $data = $request->validate([
            'notransaksi' => 'string',
            'kodespl' => 'string',
            'tglbeli' => 'string',
            'totalhutang' => 'string'
        ]);

        try {
            $hutang->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Update Data Hutang',
                'data' => $hutang
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => true,
                'message' => 'Gagal Update Data Hutang',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hutang $hutang)
    {
        $hutang->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berhasil Hapus Data Hutang',
        ]);
    }
}
