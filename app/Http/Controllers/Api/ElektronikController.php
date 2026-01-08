<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Elektronik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ElektronikController extends Controller
{
    public function index()
    {
        return response()->json(Elektronik::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_barang' => 'required',
            'deskripsi'   => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')
                ->store('elektronik', 'public');
        }

        return Elektronik::create($data);
    }

    public function show($id)
    {
        return Elektronik::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $elektronik = Elektronik::findOrFail($id);

        $data = $request->validate([
            'nama_barang' => 'required',
            'deskripsi'   => 'required',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'gambar'      => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            if ($elektronik->gambar) {
                Storage::disk('public')->delete($elektronik->gambar);
            }

            $data['gambar'] = $request->file('gambar')
                ->store('elektronik', 'public');
        }

        $elektronik->update($data);

        return $elektronik;
    }

    public function destroy($id)
    {
        $elektronik = Elektronik::findOrFail($id);

        if ($elektronik->gambar) {
            Storage::disk('public')->delete($elektronik->gambar);
        }

        $elektronik->delete();

        return response()->json(['message' => 'Data elektronik dihapus']);
    }
}
