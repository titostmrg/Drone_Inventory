<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DroneMerk; // Pastikan model Drone diimport dengan benar
use App\Models\Drone;
use Illuminate\Support\Facades\Storage;


class DroneController extends Controller
{
    
    public function index(Request $request) 
    {
        if (!$request->session()->has('is_logged_in')) {
            return redirect('/login');
        }

        // Ambil semua merk, hitung jumlah drone per merk
        $merks = DroneMerk::withCount('drones')->get();

        // Hitung semua drone
        $totalDrone = \App\Models\Drone::count();

        // Menghitung jumlah drone
        $droneBagus = Drone::where('keterangan', 1)->count(); // 1 = bagus
        $droneRusak = Drone::where('keterangan', 0)->count(); // 0 = rusak
        $totalDrone = $droneBagus + $droneRusak;

        return response()
            ->view('home', compact('merks', 'totalDrone', 'droneBagus', 'droneRusak'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function show(Request $request, $id)
    {
        if (!$request->session()->has('is_logged_in')) {
            return redirect('/login');
        }

        // Mengambil merk drone berdasarkan id untuk ditampilkan ke halaman details
        $merk = DroneMerk::findOrFail($id);

        // Mengambil merk drone dengan merk_id yang sama dengan ID merk yang dipilih
        $drones = Drone::where('merk_id', $id)->get();

        // return value ke view data drone dengan data drone dan merknya
        return response()
            ->view('details', compact('merk', 'drones'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'merk_id' => 'required|exists:drone_merks,id',
            'nama_drone' => 'required|string',
            'tanggal_pengadaan' => 'required|date',
            'harga' => 'required|numeric',
            'keterangan' => 'required|in:0,1',
            'gambar' => 'nullable|image|max:2048',
        ]);
    
        $path = null;
        if ($request->hasFile('gambar')) {
            // Simpan ke storage/app/public/assets
            $storedPath = $request->file('gambar')->store('assets', 'public');
            // Konversi path ke yang bisa diakses via URL (storage/assets/namafile.jpg)
            $path = str_replace('public/', 'storage/', $storedPath);
        }
    
        Drone::create([
            'merk_id' => $request->merk_id,
            'nama_drone' => $request->nama_drone,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'gambar' => 'storage/' . $path,
        ]);
    
        return redirect()->back()->with('success', 'Drone berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $drone = Drone::findOrFail($id);

        $request->validate([
            'nama_drone' => 'required|string|max:255',
            'tanggal_pengadaan' => 'nullable|date',
            'harga' => 'nullable|numeric',
            'keterangan' => 'required|in:0,1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_kerusakan' => 'nullable|string',
        ]);

        // Jika ada gambar baru diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada dan file-nya memang masih ada di storage
            if ($drone->gambar && Storage::exists(str_replace('storage/', 'public/', $drone->gambar))) {
                Storage::delete(str_replace('storage/', 'public/', $drone->gambar));
            }
    
            // Simpan gambar baru ke folder 'public/assets'
            $path = $request->file('gambar')->store('public/assets');
            // Simpan path dengan prefix 'storage/' agar bisa dipanggil dengan asset()
            $drone->gambar = str_replace('public/', 'storage/', $path);
        }

        // Update data lainnya
        $drone->nama_drone = $request->nama_drone;
        $drone->tanggal_pengadaan = $request->tanggal_pengadaan;
        $drone->harga = $request->harga;
        $drone->keterangan = $request->keterangan;
        $drone->deskripsi_kerusakan = $request->deskripsi_kerusakan;
        $drone->save();

        return redirect()->back()->with('success', 'Data drone berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $drone = Drone::findOrFail($id);

        // Hapus gambar dari storage jika ada
        if ($drone->gambar) {
            Storage::delete($drone->gambar);
        }

        $drone->delete();

        return redirect()->back()->with('success', 'Drone berhasil dihapus.');
    }


}
