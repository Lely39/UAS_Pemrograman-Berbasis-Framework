<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    // GET /api/pesanan
    public function index()
    {
        return response()->json(
            Pesanan::with('elektronik')->get()
        );
    }

    // POST /api/pesanan
    public function store(Request $request)
    {
        $request->validate([
            'elektronik_id'       => 'required|exists:elektroniks,id',
            'nama_pemesan'        => 'required|string',
            'alamat'              => 'required|string',
            'jumlah_pesanan'      => 'required|integer',
            'metode_pembayaran'   => 'required|in:transfer_bank,e_wallet,cod',
            'setatus_pembayaran'  => 'required|in:menunggu,dibayar,gagal',
        ]);

        $pesanan = Pesanan::create($request->all());

        return response()->json($pesanan, 201);
    }

    // GET /api/pesanan/{id}
    public function show($id)
    {
        return response()->json(
            Pesanan::with('elektronik')->findOrFail($id)
        );
    }

    // PUT /api/pesanan/{id}
    public function update(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        $pesanan->update($request->all());

        return response()->json($pesanan);
    }

    // DELETE /api/pesanan/{id}
    public function destroy($id)
    {
        Pesanan::findOrFail($id)->delete();

        return response()->json(['message' => 'Pesanan berhasil dihapus']);
    }
}
