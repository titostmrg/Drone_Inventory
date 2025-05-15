<?php

namespace App\Http\Controllers;
use App\Models\DroneMerk;
use Illuminate\Http\Request;

class DroneMerkController extends Controller
{
    public function storeMerk(Request $request)
    {
        // Validasi
        $request->validate([
            'nama_merk' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan gambar ke storage
        $path = $request->file('gambar')->store('assets', 'public');

        // Simpan ke database
        DroneMerk::create([
            'nama_merk' => $request->nama_merk,
            'gambar' => 'storage/' . $path, // path yang bisa diakses publik
        ]);

        return redirect('/home')->with('success', 'Merk drone berhasil ditambahkan!');
    }
}
