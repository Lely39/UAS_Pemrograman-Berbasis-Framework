<?php

namespace App\Http\Controllers;

use App\Models\Elektronik;

class LandingpageController extends Controller
{
    public function home()
    {
        $elektroniks = Elektronik::where('stok', '>', 0)->latest()->get();

        return view('landingpage.home', compact('elektroniks'));
    }

    public function beli($id)
{
    $produk = Elektronik::findOrFail($id);
    return view('landingpage.beli', compact('produk'));
}

    public function detail($id)
    {
        $produk = Elektronik::findOrFail($id);

        return view('landingpage.detail', compact('produk'));
    }
}
