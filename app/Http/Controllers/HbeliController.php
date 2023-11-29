<?php

namespace App\Http\Controllers;

use App\Models\Dbeli;
use App\Models\Hbeli;
use App\Models\Hutang;
use App\Models\Stock;
use Illuminate\Http\Request;

class HbeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Hbeli::all();

        return response()->json([
            'status' => true,
            'message' => 'List Data Pembelian',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'kodespl' => 'required|exists:supliers,kodespl',
            'tglbeli' => 'required',
            'kodebrg' => 'required|exists:barangs,kodebrg',
            'hargabeli' => 'required',
            'qty' => 'required',
            'diskon' => 'required',
            'totalhutang' => 'required',
        ]);

        try {
            $lastTransaction = Hbeli::orderBy('id', 'desc')->first();
            $lastTransactionNumber =  'B' . date('Ym') . str_pad(((int)@$lastTransaction->id ?? 0) + 1, 3, '0', STR_PAD_LEFT);

            $data['notransaksi'] = $lastTransactionNumber;
            $hbl = new Hbeli(
                collect($data)->only('notransaksi', 'kodespl', 'tglbeli')->toArray()
            );

            $hbl->save();

            $data['totalrp'] = $data['qty'] * $data['hargabeli'];
            $data['diskonrp'] = $data['totalrp'] * $data['diskon'] / 100;
            $data['notransaksi'] = $hbl['notransaksi'];

            $dbeli = Dbeli::create(
                collect($data)->only('notransaksi', 'kodebrg', 'hargabeli', 'qty', 'diskon', 'diskonrp', 'totalrp')->toArray()
            );

            $data['qtybeli'] = $data['qty'];
            $stock = Stock::create(
                collect($data)->only('kodebrg', 'qtybeli')->toArray()

            );

            $hutang = Hutang::create(
                collect($data)->only('notransaksi', 'kodespl', 'tglbeli', 'totalhutang')->toArray()
            );

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Menambahkan Data Pembelian',
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data Pembelian',
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kodespl' => 'required|exists:supliers,kodespl',
            'tglbeli' => 'required',
        ]);

        try {
            $lastTransaction = Hbeli::orderBy('id', 'desc')->first();
            $lastTransactionNumber =  'B' . date('Ym') . str_pad(((int)@$lastTransaction->id ?? 0) + 1, 3, '0', STR_PAD_LEFT);

            $hbl = new Hbeli([
                'notransaksi' => $lastTransactionNumber,
                'kodespl' => $data['kodespl'],
                'tglbeli' => $data['tglbeli'],
            ]);

            $hbl->save();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Menambahkan Data Pembelian',
                'data' => $hbl
            ]);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                'status' => false,
                'message' => 'Gagal Menambahkan Data Pembelian'
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hbeli $hbeli)
    {
        return response()->json([
            'status' => true,
            'message' => 'Data Beli',
            'data' => $hbeli
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hbeli $hbeli)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hbeli $pembeli)
    {
        $data = $request->validate([
            'tglbeli' => 'string',
        ]);

        try {
            $pembeli->update($data);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil Update Data Beli',
                'data' => $pembeli
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal Update Data Beli'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hbeli $hbeli)
    {
        //
    }
}
